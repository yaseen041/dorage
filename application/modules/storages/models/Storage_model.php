<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storage_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_states()
	{
		return $this->db->get('states')->result_array();
	}


	public function get_size_types()
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('storage_size_types')->result_array();
		return $query;	
	}

	public function get_storage_types($size_type = '')
	{
		if(!empty($size_type)) {
			$this->db->where('storage_size_types_id',$size_type);
		}
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('space_storage_types')->result_array();
		return $query;
	}

	public function get_room_space_character()
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get('room_space_character')->result_array();
		return $query;
	}

	public function get_count_listings($data, $storage_type_arr , $space_character_arr)
	{
		$latitude = $data['lat'];
		$longitude = $data['lng'];
		$check = 0;

		$listings_arr5 = array();



		if(!empty($data['place'])) { 

			$this->db->select('id');
			
			if($latitude != '' && $data['place'] != ''){
				$this->db->select('(3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance');            
				$this->db->having('distance <=',70);  
			}
			$this->db->where('list_type' , 0);
			$this->db->where('is_deleted' , 0);
			$this->db->where('status' , 1);
			$query = $this->db->get('listings');
			$listingsids = $query->result_array();

			$listings_arr1 = array();
			$listings_arr1[] = 0;

			foreach ($listingsids as $list) {
				$listings_arr1[] = $list['id'];
			}

			$listings_arr5 = $listings_arr1;
			$check = 1;
		}

		if(!empty($data['storage_size_type'])) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'storage_size_type');
			$this->db->where('meta_value' , $data['storage_size_type']);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$sizetypeids = $query->result_array();

			$listings_arr2 = array();
			$listings_arr2[] = 0;

			foreach ($sizetypeids as $list) {
				$listings_arr2[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr2;
			$check = 1;
		}

		if(!empty($storage_type_arr)) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'space_storage_type');
			$this->db->where_in('meta_value' , $storage_type_arr);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$spacetypeids = $query->result_array();

			$listings_arr3 = array();
			$listings_arr3[] = 0;

			foreach ($spacetypeids as $list) {
				$listings_arr3[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr3;
			$check = 1;

		}

		if(!empty($space_character_arr)) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'room_space_character');
			$this->db->where_in('meta_value' , $space_character_arr);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$chartypeids = $query->result_array();

			$listings_arr4 = array();
			$listings_arr4[] = 0;

			foreach ($chartypeids as $list) {
				$listings_arr4[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr4;
			$check = 1;
		}

		if(!empty($data['list_state'])) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'state');
			$this->db->where_in('meta_value' , $data['list_state']);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$stateids = $query->result_array();

			$listings_arr9 = array();
			$listings_arr9[] = 0;

			foreach ($stateids as $list) {
				$listings_arr9[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr9;
			$check = 1;
		}

		if(!empty($data['search_startdate'])) {

			$book_days = (int)$data['booking_days'];

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'booking_min_day');
			$this->db->where('meta_value <=' , $book_days);

			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			} else {
				$this->db->where('listings_id' , 0);
			}
			$query = $this->db->get('listings_meta');
			$datetypeids = $query->result_array();

			$listings_arr6 = array();
			$listings_arr6[] = 0;

			foreach ($datetypeids as $list) {
				$listings_arr6[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr6;



			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'booking_max_day');
			$this->db->where('meta_value >=' , $book_days);

			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$datetypeids1 = $query->result_array();


			$listings_arr7 = array();
			$listings_arr7[] = 0;

			foreach ($datetypeids1 as $list) {
				$listings_arr7[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr7;
			//print_r($listings_arr5);
			//exit;


			$date = explode('to', $data['search_startdate']);

			$selected_dates = getDatesFromRange($date[0], $date[1]);
			$listings_arr8 = array();
			$listings_arr8[] = 0;

			foreach($selected_dates as $dateloop){
				$this->db->select('listings_id');
				if (!empty($listings_arr5)) {
					$this->db->where_in('listings_id' , $listings_arr5);
				}
				$this->db->where('start_date <=',$dateloop);
				$this->db->where('end_date >=',$dateloop); 
				$listings_ids = $this->db->get('blocked_booking_dates')->result_array();
				foreach ($listings_ids as $list) {
					$listings_arr8[] = $list['listings_id'];
				}
			}
			$listings_arr8 = array_unique($listings_arr8);
			// $listings_arr5 = $listings_arr8;
			$listings_arr5 = array_diff($listings_arr5, $listings_arr8);
			$listings_arr5 = array_unique($listings_arr5);
			$listings_arr5[] = 0;

			$check = 1;
		}

		$this->db->select("listings.*");
		$this->db->from("listings");
		
		$this->db->join('users', 'users.id = listings.users_id ', 'left');
		$this->db->where('users.status',1);
		$this->db->where('users.is_banned',0);

		$this->db->where('listings.is_published' , 1);
		$this->db->where('listings.status' , 1);
		$this->db->where('listings.is_banned',0);
		$this->db->where('listings.list_type' , 0);
		$this->db->where('listings.is_deleted' , 0);
		if($check == 1){
			$this->db->where_in('listings.id' ,$listings_arr5);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_search_listings($limit,$start,$data, $storage_type_arr , $space_character_arr)
	{
		$latitude = $data['lat'];
		$longitude = $data['lng'];
		$check = 0;

		$listings_arr5 = array();

		if(!empty($data['place'])) { 

			$this->db->select('id');
			
			if($latitude != '' && $data['place'] != ''){
				$this->db->select('(3959 * acos( cos( radians('.$latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( latitude ) ) ) ) AS distance');            
				$this->db->having('distance <=',70);  
			}
			$this->db->where('list_type' , 0);
			$this->db->where('is_deleted' , 0);
			$this->db->where('status' , 1);
			$query = $this->db->get('listings');
			$listingsids = $query->result_array();
			// show($this->db->last_query());exit;
			$listings_arr1 = array();
			$listings_arr1[] = 0;

			foreach ($listingsids as $list) {
				$listings_arr1[] = $list['id'];
			}

			$listings_arr5 = $listings_arr1;


			$check = 1;

		}

		if(!empty($data['storage_size_type'])) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'storage_size_type');
			$this->db->where('meta_value' , $data['storage_size_type']);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$sizetypeids = $query->result_array();

			$listings_arr2 = array();
			$listings_arr2[] = 0;

			foreach ($sizetypeids as $list) {
				$listings_arr2[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr2;

			$check = 1;
		}

		if(!empty($storage_type_arr)) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'space_storage_type');
			$this->db->where_in('meta_value' , $storage_type_arr);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$spacetypeids = $query->result_array();

			$listings_arr3 = array();
			$listings_arr3[] = 0;

			foreach ($spacetypeids as $list) {
				$listings_arr3[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr3;

			$check = 1;

		}

		if(!empty($space_character_arr)) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'room_space_character');
			$this->db->where_in('meta_value' , $space_character_arr);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$chartypeids = $query->result_array();

			$listings_arr4 = array();
			$listings_arr4[] = 0;

			foreach ($chartypeids as $list) {
				$listings_arr4[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr4;

			$check = 1;
		}

		if(!empty($data['list_state'])) {

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'state');
			$this->db->where_in('meta_value' , $data['list_state']);
			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$stateids = $query->result_array();

			$listings_arr9 = array();
			$listings_arr9[] = 0;

			foreach ($stateids as $list) {
				$listings_arr9[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr9;
			$check = 1;
		}

		if(!empty($data['search_startdate'])) {

			$book_days = (int)$data['booking_days'];

			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'booking_min_day');
			$this->db->where('meta_value <=' , $book_days);

			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			} else {
				$this->db->where('listings_id' , 0);
			}
			$query = $this->db->get('listings_meta');
			$datetypeids = $query->result_array();

			$listings_arr6 = array();
			$listings_arr6[] = 0;

			foreach ($datetypeids as $list) {
				$listings_arr6[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr6;



			$this->db->select('listings_id');
			$this->db->where('meta_key' , 'booking_max_day');
			$this->db->where('meta_value >=' , $book_days);

			if (!empty($listings_arr5)) {
				$this->db->where_in('listings_id' , $listings_arr5);
			}
			$query = $this->db->get('listings_meta');
			$datetypeids1 = $query->result_array();


			$listings_arr7 = array();
			$listings_arr7[] = 0;

			foreach ($datetypeids1 as $list) {
				$listings_arr7[] = $list['listings_id'];
			}

			$listings_arr5 = $listings_arr7;
			//print_r($listings_arr5);
			//exit;


			$date = explode('to', $data['search_startdate']);

			$selected_dates = getDatesFromRange($date[0], $date[1]);
			$listings_arr8 = array();
			$listings_arr8[] = 0;

			foreach($selected_dates as $dateloop){
				$this->db->select('listings_id');
				if (!empty($listings_arr5)) {
					$this->db->where_in('listings_id' , $listings_arr5);
				}
				$this->db->where('start_date <=',$dateloop);
				$this->db->where('end_date >=',$dateloop); 
				$listings_ids = $this->db->get('blocked_booking_dates')->result_array();
				foreach ($listings_ids as $list) {
					$listings_arr8[] = $list['listings_id'];
				}
			}
			$listings_arr8 = array_unique($listings_arr8);
			// $listings_arr5 = $listings_arr8;
			$listings_arr5 = array_diff($listings_arr5, $listings_arr8);
			$listings_arr5 = array_unique($listings_arr5);
			$listings_arr5[] = 0;

			$check = 1;
		}
		$this->db->select('listings.*, (3959 * acos( cos( radians('.$latitude.') ) * cos( radians( listings.latitude ) ) * cos( radians( listings.longitude ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( listings.latitude ) ) ) ) AS distance, (select sum(br.stars)/count(br.id) from bookings_rating br left join bookings b on b.id = br.bookings_id left join listings l on l.id = b.listings_id where l.id = listings.id  ) as list_rating');
		$this->db->from("listings");
		$this->db->join('users', 'users.id = listings.users_id ', 'left');
		$this->db->where('users.status',1);
		$this->db->where('users.is_banned',0);
		$this->db->where('listings.is_published' , 1);
		$this->db->where('listings.status' , 1);
		$this->db->where('listings.is_banned',0);
		$this->db->where('listings.list_type' , 0);
		$this->db->where('listings.is_deleted' , 0);
		if($check == 1){
			$this->db->where_in('listings.id' ,$listings_arr5);
		}
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		// show($this->db->last_query());exit;
		return $query->result_array();
	}

	
}

/* End of file storage_model.php */
   /* Location: ./application/modules/admin/models/storage_model.php */