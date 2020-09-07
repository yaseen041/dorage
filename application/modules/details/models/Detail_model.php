<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_space_rules($type)
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('type' , $type);
		$query = $this->db->get('space_rules')->result_array();
		return $query;
	}

	public function get_list_rules($listings_id)
	{
		$this->db->select('space_rules_id');
		$this->db->where('listings_id' , $listings_id);
		$query = $this->db->get('listed_space_rules')->result_array();

		$rules = array();

		$rules[] = 0;

		foreach ($query as $row) {
			$rules[] = $row['space_rules_id']; 
		}
		return $rules;
	}

	public function get_complete_detail($unique_id)
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name,users.last_name,users.email,users.phone,users.profile_dp");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.unique_id' ,$unique_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_vehicles($listings_id)
	{
		$this->db->select('name,quantity');
		$this->db->where('listings_id' , $listings_id);
		return $this->db->get('mover_vehicles')->result_array();
	}

	public function get_list_images($listings_id)
	{
		$this->db->select('image');
		$this->db->where('listings_id' , $listings_id);
		$this->db->order_by('image_order', 'ASC');
		$query = $this->db->get('storage_images')->result_array();
		return $query;
	}


	public function get_storage_amenities($listings_id , $type)
	{
		$this->db->select('amenities.name as amenity_name');
		$this->db->from("amenities");
		$this->db->where('amenities.type' , $type);
		$this->db->join('sotrage_amenities', 'amenities.id = sotrage_amenities.amenities_id', 'left');
		$this->db->where('sotrage_amenities.listings_id' , $listings_id);
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_storage_additional_rules($listings_id)
	{
		$this->db->select('rule');
		$this->db->where('listings_id' , $listings_id);
		$query = $this->db->get('listed_space_additional_rules')->result_array();
		return $query;
	}

	public function get_storage_space_rules($listings_id , $type)
	{
		$this->db->select('space_rules.name as rule_name');
		$this->db->from("space_rules");
		$this->db->where('space_rules.type' , $type);
		$this->db->join('listed_space_rules', 'space_rules.id = listed_space_rules.space_rules_id', 'left');
		$this->db->where('listed_space_rules.listings_id' , $listings_id);
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_availability_detail($data)
	{

		$selected_dates = getDatesFromRange($data['start_date'], $data['end_date']);
		$result = array();

		foreach($selected_dates as $dateloop){
			$this->db->select('*');
			$this->db->where('listings_id' , $data['listings_id']);
			$this->db->where('start_date <=',$dateloop);
			$this->db->where('end_date >=',$dateloop); 
			$result = $this->db->get('blocked_booking_dates')->result_array();
			if(count($result) > 0) {
				break;
			}
		}

		return count($result);
	}

	public function get_detail_by_id($listings_id)
	{
		$this->db->select("users_id,price");
		$this->db->from("listings");
		$this->db->where('id' ,$listings_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function book_now($data)
	{
		$this->db->select('*');
		$this->db->from('listings');
		$this->db->where('id' , $data['listings_id']);
		$list_basic = $this->db->get()->row_array();

		$list_basic['orignal_list_id'] = $list_basic['id'];

		unset($list_basic['id']);

		$this->db->insert('booked_listings', $list_basic);

		$list_id = $this->db->insert_id();

		$this->db->select('meta_key , meta_value');
		$this->db->from('listings_meta');
		$this->db->where('listings_id' , $data['listings_id']);
		$list_meta = $this->db->get()->result_array();

		foreach ($list_meta as $metaa) {
			$this->db->set('meta_key' , $metaa['meta_key']);
			$this->db->set('meta_value' , $metaa['meta_value']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('booked_listings_meta');
		}

		$this->db->select('rule');
		$this->db->where('listings_id' , $data['listings_id']);
		$listed_add_rules = $this->db->get('listed_space_additional_rules')->result_array();

		foreach ($listed_add_rules as $add_rule) {
			$this->db->set('rule' , $add_rule['rule']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('booked_listed_space_additional_rules');
		}


		$this->db->select('space_rules_id');
		$this->db->where('listings_id' , $data['listings_id']);
		$space_rules = $this->db->get('listed_space_rules')->result_array();

		foreach ($space_rules as $sp_rule) {
			$this->db->set('space_rules_id' , $sp_rule['space_rules_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('booked_listed_space_rules');
		}


		$this->db->select('image,image_order');
		$this->db->where('listings_id' , $data['listings_id']);
		$storage_images = $this->db->get('storage_images')->result_array();

		foreach ($storage_images as $storage_image) {
			$this->db->set('image' , $storage_image['image']);
			$this->db->set('listings_id' ,$list_id);
			$this->db->set('image_order' , $storage_image['image_order']);
			$query = $this->db->insert('booked_storage_images');
		}

		$date1 = date_create($data['booking_startdate']);
		$date2 = date_create($data['booking_enddate']);

		    //difference between two dates
		$diff = date_diff($date1,$date2);

		    //count days
		$booking_days = $diff->format("%a") + 1;

		$list_total = $data['perday_amount'] * $booking_days;

		$this->db->set('unique_id' , $data['unique_id']);
		$this->db->set('orignal_list_id' ,$list_basic['orignal_list_id']);
		$this->db->set('listings_id' , $list_id);
		$this->db->set('users_id' ,get_session('user_id'));
		$this->db->set('booking_start ' , date("Y-m-d" , strtotime($data['booking_startdate'])));
		$this->db->set('booking_end' , date("Y-m-d" , strtotime($data['booking_enddate'])));
		$this->db->set('list_price' , $data['perday_amount']);
		$this->db->set('list_total' , $list_total);
		$this->db->set('tax_amount' , $data['tax_amount']);
		$this->db->set('total_amount' , $data['total_amount']);
		$this->db->set('booking_date' , date("Y-m-d h:i:s"));

		$res = $this->db->insert('bookings');

		return $res;
	}

	public function insertChatMessage($data){
		$record = singleRow('listings', '*', 'unique_id = "'.$data['property'].'"');

		$this->db->set('chat_from', get_session('user_id'));
		$this->db->set('chat_to', $record['users_id']);
		$this->db->set('message', $data['message']);
		$this->db->set('listing_unique_id', $data['stlink']);
		$this->db->set('sent', time());
		$this->db->set('chat_read', 0);
		$this->db->insert('chat');

		return $record;
	}

	public function insertReview($data){
		$record = singleRow('listings', '*', 'unique_id = "'.$data['listing_id'].'"');
		$this->db->set('listing_id', $record['id']);
		$this->db->set('user_id', get_session('user_id'));
		$this->db->set('review', $data['reviewMessage']);
		$this->db->set('stars', $data['rating']);
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->insert('listing_reviews');
	}

	public function insertReply($data){
		$record = singleRow('listing_reviews', '*', 'id = '.$data['review_id']);
		$this->db->set('listing_id', $record['listing_id']);
		$this->db->set('user_id', get_session('user_id'));
		$this->db->set('parent_id', $data['review_id']);
		$this->db->set('review', $data['replyMessage']);
		$this->db->set('stars', $data['rating']);
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->insert('listing_reviews');
	}

}

/* End of file Home_model.php */
   /* Location: ./application/modules/admin/models/Home_model.php */