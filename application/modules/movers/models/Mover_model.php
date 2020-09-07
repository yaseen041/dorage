<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mover_model extends CI_Model {

	public function get_movers($data)
	{
		$parameters = get_session('search_parameters');
		$lat_long = explode("," , $parameters['lat_long']);

		$latitude = $lat_long[0];
		$longitude = $lat_long[1];

		$this->db->select('id');

		if($latitude != '' && $parameters['place'] != ''){
			$this->db->select('(3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance');            
			$this->db->having('distance <=',5);  
		}
		$this->db->where('list_type' , 1);
		$query = $this->db->get('listings');
		$listingsids = $query->result_array();

		$listings_arr1 = array();
		$listings_arr1[] = 0;

		foreach ($listingsids as $list) {
			$listings_arr1[] = $list['id'];
		}

		$this->db->select('*');
		$this->db->where('is_published' , 1);
		$this->db->where('status' , 1);
		$this->db->where('is_banned',0);
		$this->db->where('list_type' , 1);
		$this->db->where_in('id' ,$listings_arr1);
		$query = $this->db->get('listings');
		return $query->result_array();
	}	

	public function searchMovers($data){

		if($data['location'] != ''){
			$lat_long = explode("," , $data['lat_long']);
			$latitude = $lat_long[0];
			$longitude = $lat_long[1];
		} else {
			$latitude = "";
			$longitude = "";
		}

		$this->db->select('id');

		if($latitude != '' && $data['location'] != ''){
			$this->db->select('(3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance');            
			$this->db->having('distance <=',15);  
		}
		$this->db->where('list_type' , 1);
		$this->db->where('users_id !=' ,get_session('user_id'));
		$query = $this->db->get('listings');
		$listingsids = $query->result_array();

		$listings_arr1 = array();
		$listings_arr1[] = 0;

		foreach ($listingsids as $list) {
			$listings_arr1[] = $list['id'];
		}

		if(!empty($data['mover_state'])) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'state');
			$this->db->where_in('meta_value' , $data['mover_state']);
			if (!empty($listings_arr1)) {
				$this->db->where_in('listings_id' , $listings_arr1);
			}
			$query = $this->db->get('listings_meta');
			$stateids = $query->result_array();

			$listings_arr2 = array();
			$listings_arr2[] = 0;

			foreach ($stateids as $list) {
				$listings_arr2[] = $list['listings_id'];
			}

			$listings_arr1 = $listings_arr2;
			
		}


		$this->db->select('*');
		$this->db->where('is_published', 1);
		$this->db->where('status', 1);
		$this->db->where('is_banned',0);
		$this->db->where('is_deleted',0);
		$this->db->where('list_type', 1);
		$this->db->where('users_id !=',get_session('user_id'));
		$this->db->where_in('id',$listings_arr1);
		$query = $this->db->get('listings');
		$movers = $query->result_array();

		$returnMovers = array();
		foreach ($movers as $mover) {
			if ($data['number_of_people'] <= get_meta_value('how_many_crews', $mover['id'])) {
				$returnMovers[] = $mover;
			}
		}
		return $returnMovers;
	}


	public function insertMoverBookin($data){

		$date = $data['mover_date'];

		$charge = (empty(get_meta_value('crew_charges', $data['listing_id'])))?0:get_meta_value('crew_charges', $data['listing_id']);

		$total = $charge*$data['number_of_people']*($data['number_of_hours']+1);

		$refundable = $charge*$data['number_of_people'];

		$this->db->select('*');
		$this->db->from('listings');
		$this->db->where('id' , $data['listing_id']);
		$list_basic = $this->db->get()->row_array();

		$list_basic['orignal_list_id'] = $list_basic['id'];

		unset($list_basic['id']);

		$this->db->insert('booked_listings', $list_basic);

		$mover_id = $this->db->insert_id();

		$this->db->select('meta_key , meta_value');
		$this->db->from('listings_meta');
		$this->db->where('listings_id' , $data['listing_id']);
		$list_meta = $this->db->get()->result_array();

		foreach ($list_meta as $metaa) {
			$this->db->set('meta_key' , $metaa['meta_key']);
			$this->db->set('meta_value' , $metaa['meta_value']);
			$this->db->set('listings_id' ,$mover_id);
			$query = $this->db->insert('booked_listings_meta');
		}

		$this->db->select('image,image_order');
		$this->db->where('listings_id' , $data['listing_id']);
		$storage_images = $this->db->get('storage_images')->result_array();

		foreach ($storage_images as $storage_image) {
			$this->db->set('image' , $storage_image['image']);
			$this->db->set('listings_id' ,$mover_id);
			$this->db->set('image_order' , $storage_image['image_order']);
			$query = $this->db->insert('booked_storage_images');
		}


		$booking_id = md5(uniqid());
		$this->db->set('unique_id', $booking_id);
		$this->db->set('orignal_list_id' ,$list_basic['orignal_list_id']);
		$this->db->set('listings_id', 0);
		$this->db->set('users_id', get_session('user_id'));
		$this->db->set('booking_start', date("Y-m-d" , strtotime($date)));
		// $this->db->set('booking_end', date("Y-m-d" , strtotime($date[1])));
		$this->db->set('mover_id', $mover_id);
		$this->db->set('no_crews', $data['number_of_people']);
		$this->db->set('crew_charges', get_meta_value('crew_charges', $data['listing_id']));
		$this->db->set('no_hours', $data['number_of_hours']);
		$this->db->set('extra_hours',1);
		$this->db->set('mover_price', $charge);
		$this->db->set('total_amount', $total);
		$this->db->set('refundable_mover', $refundable);
		$this->db->set('booking_date', date('Y-m-d H:i:s'));
		$this->db->set('booking_status', 0);
		$this->db->insert('bookings');

		return $booking_id;
	}

	public function checkListingOwner($data){
		$this->db->select('*');
		$this->db->from('listings');
		$this->db->where('id', $data['listing_id']);
		$this->db->where('users_id', get_session('user_id'));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function getMoverBookingDetail($id){
		$this->db->select('l.*, b.*, l.unique_id as listings_unique_id');
		$this->db->from('bookings b');
		$this->db->join('booked_listings l', 'l.id = b.mover_id', 'left');
		$this->db->where('b.unique_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

}

/* End of file Mover_model.php */
/* Location: ./application/modules/movers/modals/Mover_model.php */