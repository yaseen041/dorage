<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_booking_detail($unique_id){

		$this->db->select("booked_listings.*");
		$this->db->select("bookings.*");
		$this->db->from("booked_listings");
		$this->db->join('bookings', 'bookings.listings_id = booked_listings.id', 'left');
		$this->db->where('bookings.unique_id' ,$unique_id);
		$this->db->where('bookings.users_id' ,get_session('user_id'));
		$query = $this->db->get()->row_array();
		return $query;
	}

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
		$this->db->where('users_id !=' ,get_session('user_id'));
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

	public function booking_update($data)
	{
		$date = date("Y-m-d" , strtotime($data['availability_dates']));
		if($data['insurance'] == 1){
			$this->db->set('insurance_amount' , $data['insurance_amount']);
		}
		$this->db->set('insurance_needed', $data['insurance']);

		if($data['mover_needed'] == 1 && !empty($data['selected_mover_id'])) {
			$this->db->set('mover_needed', $data['mover_needed']);
		}else {
			$this->db->set('mover_needed', 0);
		}
		$this->db->set('total_amount' , $data['total_amount']);
		$this->db->where('unique_id' , $data['booking_id']);
		$query = $this->db->update('bookings');

		$this->db->select('id');
		$this->db->where('unique_id' , $data['booking_id']);
		$book_id = $this->db->get('bookings')->row_array();


		if($data['mover_needed'] == 1 && !empty($data['selected_mover_id'])) {

			$this->db->select('*');
			$this->db->from('listings');
			$this->db->where('id' , $data['selected_mover_id']);
			$list_basic = $this->db->get()->row_array();

			$list_basic['orignal_list_id'] = $list_basic['id'];

			unset($list_basic['id']);

			$this->db->insert('booked_listings', $list_basic);

			$mover_id = $this->db->insert_id();

			$this->db->select('meta_key , meta_value');
			$this->db->from('listings_meta');
			$this->db->where('listings_id' , $data['selected_mover_id']);
			$list_meta = $this->db->get()->result_array();

			foreach ($list_meta as $metaa) {
				$this->db->set('meta_key' , $metaa['meta_key']);
				$this->db->set('meta_value' , $metaa['meta_value']);
				$this->db->set('listings_id' ,$mover_id);
				$query = $this->db->insert('booked_listings_meta');
			}

			$this->db->select('image,image_order');
			$this->db->where('listings_id' , $data['selected_mover_id']);
			$storage_images = $this->db->get('storage_images')->result_array();

			foreach ($storage_images as $storage_image) {
				$this->db->set('image' , $storage_image['image']);
				$this->db->set('listings_id' ,$mover_id);
				$this->db->set('image_order' , $storage_image['image_order']);
				$query = $this->db->insert('booked_storage_images');
			}


			$refundamount = $data['crew_charges'] * $data['selected_crews']*($data['selected_hours']);

			$moving_amount = $data['crew_charges'] * $data['selected_crews']*($data['selected_hours']+1);

			$refundable = $moving_amount - $refundamount;

			$this->db->set('unique_id' , md5(uniqid()));
			$this->db->set('orignal_list_id' ,$list_basic['orignal_list_id']);
			$this->db->set('users_id' ,get_session('user_id'));
			$this->db->set('mover_id' , $mover_id);
			$this->db->set('no_crews' , $data['selected_crews']);
			$this->db->set('crew_charges' , $data['crew_charges']);
			$this->db->set('no_hours' , $data['selected_hours']);
			$this->db->set('extra_hours' , 1);
			$this->db->set('mover_price' , $data['mover_package']-$refundable);
			$this->db->set('refundable_mover' , $refundable);
			$this->db->set('booking_start' , $date);
			// $this->db->set('booking_end' , $date[1]);
			$this->db->set('parent_id' , $book_id['id']);
			$this->db->set('booking_date' , date("Y-m-d h:i:s"));
			$query = $this->db->insert('bookings');
		}

		return $this->db->affected_rows();
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

}

/* End of file Home_model.php */
   /* Location: ./application/modules/admin/models/Home_model.php */