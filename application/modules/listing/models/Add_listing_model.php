<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_listing_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_size_types()
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('storage_size_types')->result_array();
		return $query;	
	}

	public function get_storage_types($storage_id)
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('storage_size_types_id' , $storage_id);
		$query = $this->db->get('space_storage_types')->result_array();
		return $query;
	}
	public function get_room_space_character($space_storage_type)
	{
		// $this->db->where('space_storage_types_id',$space_storage_type);
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('room_space_character')->result_array();
		return $query;
	}

	public function get_list_character($list_id)
	{
		$this->db->select('meta_value');
		$this->db->where('meta_key','room_space_character');
		$this->db->where('listings_id',$list_id);
		$query = $this->db->get('listings_meta')->result_array();
		return $query;
	}

	public function get_cancellation_policies()
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('cancellation_policies')->result_array();
		return $query;
	}

	public function get_policy_note()
	{
		$this->db->select("*");
		$this->db->from('settings');
		$this->db->where('page','cancellation_policy');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function check_detail($unique_id)
	{
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id' ,$unique_id);
		$this->db->where('list_type' ,0);
		$this->db->where('is_deleted' ,0);
		$query = $this->db->get('listings')->row();
		if(!empty($query)) {
			return 1;
		} else {
			return 0;
		}
	}

	public function get_detail($unique_id = '' , $list_id = '')
	{
		$this->db->select('listings.*,users.first_name, users.last_name');
		$this->db->from('listings');
		$this->db->join('users' , 'users.id = listings.users_id' , 'left');
		if(!empty($unique_id)){
			$this->db->where('listings.unique_id' ,$unique_id);
		} else {
			$this->db->where('listings.id' ,$list_id);
		}
		
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function update_stp1($data)
	{
		$latlong = explode(',', @$data['lat_long']);

		$this->db->set('list_type' ,0);
		$this->db->set('place' ,@$data['place']);
		$this->db->set('latitude' ,@trim($latlong[0]));
		$this->db->set('longitude' ,@trim($latlong[1]));

		$this->db->where('unique_id', $data['unique_id']);		
		$query = $this->db->update('listings');

		$affected_rows = $this->db->affected_rows();

		$this->db->select('status,id');
		$this->db->where('unique_id', $data['unique_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$old_values = $this->db->get('listings_meta')->result_array();

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {

			if($affected_rows > 0){

				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');
				return "location_changed";

			} else {
				$check = 0;

				foreach ($old_values as $oldvalue) {
					foreach ($_POST['posted_data'] as $key => $value) {
						if($oldvalue['meta_key'] == $key){
							if($oldvalue['meta_value'] != $value)
							{
								$check = 1;
							}
						}
					}
				}

				if($check) {
					$this->db->set('status',0);
					$this->db->set('is_updated',1);
					$this->db->where('id', $list_id);		
					$update = $this->db->update('listings');

					if($update > 0) {
						return "location_changed";
					} else {
						return "already_changed";
					}
				} else {
					return "already_changed";
				}

			}
		}

	}

	public function insert_stp1($data)
	{
		$latlong = explode(',', @$data['lat_long']);

		$this->db->set('unique_id' , $data['unique_id']);
		$this->db->set('users_id' , get_session('user_id'));
		$this->db->set('list_type' ,0);

		$this->db->set('place' ,@$data['place']);
		$this->db->set('latitude' ,@trim($latlong[0]));
		$this->db->set('longitude' ,@trim($latlong[1]));
		
		$query = $this->db->insert('listings');
		$list_id = $this->db->insert_id();


		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		return $list_id;

	}

	public function insert_stp2($data)
	{

		$this->db->select('id');
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->get('listings')->row_array();
		$list_id = $query['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($data['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		foreach ($data['room_space_character'] as $key => $value) {
			$this->db->set('meta_key' , 'room_space_character');
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		return true;
	}

	public function update_stp2($data)
	{

		$this->db->select('status,id');
		$this->db->where('unique_id', $data['unique_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('meta_key !=','room_space_character');
		$this->db->where('listings_id',$list_id);
		$old_values = $this->db->get('listings_meta')->result_array();

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('meta_key','room_space_character');
		$this->db->where('listings_id',$list_id);
		$old_ch_values = $this->db->get('listings_meta')->result_array();

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($data['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		$new_char_array = array();
		foreach ($data['room_space_character'] as $key => $value) {
			$new_char_array[] = $value;
			$this->db->set('meta_key' , 'room_space_character');
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		$new_char_oldarray = array();
		foreach ($old_ch_values as $oldvalue) {
			$new_char_oldarray[] = $oldvalue['meta_value'];
		}

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {

			$array_dif = array_diff($new_char_array,$new_char_oldarray);
			$array_dif1 = array_diff($new_char_oldarray,$new_char_array);

			// print_r($array_dif);exit;

			if (!empty($array_dif) || !empty($array_dif1)) {

				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				return "info_changed";
			}

			$check = 0;

			foreach ($old_values as $oldvalue) {
				foreach ($_POST['posted_data'] as $key => $value) {
					if($oldvalue['meta_key'] == $key){
						if($oldvalue['meta_value'] != $value)
						{
							$check = 1;
						}
					}
				}
			}

			if($check) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "info_changed";
				} else {
					return "already_changed";
				}
			} else {
				return "already_changed";
			}
		}

	}

	public function get_amenities($type = '0')
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('type' , $type);
		$query = $this->db->get('amenities')->result_array();
		return $query;
	}


	public function get_shared_spaces()
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('spaces_guest_use')->result_array();
		return $query;
	}

	public function insert_step1_2($data)
	{
		$this->db->trans_start();

		$this->db->where('listings_id' , $data['listings_id']);
		$status = $this->db->delete('sotrage_amenities');

		if(!empty($data['amenity'])){

			foreach ($data['amenity'] as $key => $value) {
				$this->db->set('listings_id' , $data['listings_id']);
				$this->db->set('amenities_id' , $value);
				$query = $this->db->insert('sotrage_amenities');
			}
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			return true;
			
		} else {
			return false;
		}
	}

	public function update_step1_2($data)
	{

		$this->db->select('status,id');
		$this->db->where('id' , $data['listings_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		$this->db->select('amenities_id');
		$this->db->where('listings_id',$list_id);
		$old_values = $this->db->get('sotrage_amenities')->result_array();

		$this->db->where('listings_id' , $data['listings_id']);
		$status = $this->db->delete('sotrage_amenities');

		$new_amanities = array();

		if(!empty($data['amenity'])){

			foreach ($data['amenity'] as $key => $value) {
				$new_amanities[] = $value;
				$this->db->set('listings_id' , $data['listings_id']);
				$this->db->set('amenities_id' , $value);
				$query = $this->db->insert('sotrage_amenities');
			}
		}

		$old_amanities = array();

		foreach ($old_values as $oldvalue) {
			$old_amanities[] =  $oldvalue['amenities_id'];
		}

		$array_dif = array_diff($new_amanities, $old_amanities);
		$array_dif1 = array_diff($old_amanities, $new_amanities);

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {

			if (!empty($array_dif) || !empty($array_dif1)) {

				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				return "info_changed";
			} else {
				return "already_changed";
			}
		}
		
	}


	public function get_list_amenities($listings_id)
	{
		$this->db->select('amenities_id');
		$this->db->where('listings_id' , $listings_id);
		$query = $this->db->get('sotrage_amenities')->result_array();

		$amenities = array();

		$amenities[] = 0;

		foreach ($query as $row) {
			$amenities[] = $row['amenities_id']; 
		}
		return $amenities;
	}
	public function insert_step1_3($data)
	{
		$this->db->set('step_completed' , 1);
		$this->db->where('unique_id', $data['unique_id']);		
		$uquery = $this->db->update('listings');
		

		$this->db->select('id');
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->get('listings')->row_array();
		$list_id = $query['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}
		return true;
	}
	public function update_step1_3($data)
	{

		$this->db->select('status,id');
		$this->db->where('unique_id', $data['unique_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$old_values = $this->db->get('listings_meta')->result_array();


		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {
			$check = 0;

			foreach ($old_values as $oldvalue) {
				foreach ($_POST['posted_data'] as $key => $value) {
					if($oldvalue['meta_key'] == $key){
						if($oldvalue['meta_value'] != $value)
						{
							$check = 1;
						}
					}
				}
			}

			if($check) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "location_changed";
				} else {
					return "already_changed";
				}
			} else {
				return "already_changed";
			}
		}

	}


	public function get_storage_images($listings_id)
	{
		$this->db->where('listings_id' , $listings_id);
		return $this->db->get('storage_images')->result_array();
	}

	public function upload_list_image($data)
	{
		$this->db->set('listings_id', str_replace("'", "",$data['listings_id']));
		$this->db->set('image' , $data['list_image']);
		$query = $this->db->insert('storage_images');

		$image_id = $this->db->insert_id();

		$this->db->select('status');
		$this->db->where('id', str_replace("'", "",$data['listings_id']));
		$list_dtl = $this->db->get('listings')->row_array();

		if($list_dtl['status'] == 0){
			return "new_list-".$image_id;
		} else {

			$this->db->set('status',0);
			$this->db->set('is_updated',1);
			$this->db->where('id', str_replace("'", "",$data['listings_id']));		
			$update = $this->db->update('listings');

			if($update > 0) {
				return "old_list-".$image_id;
			} else {
				return "new_list-".$image_id;
			}

		}
	}

	public function delete_storage_picture($data)
	{

		$this->db->where('id' , $data['image_id']);
		$image_detail = $this->db->get('storage_images')->row();

		$DelFilePath = FCPATH.'assets/storage_images/'.$image_detail->image;

		if (file_exists($DelFilePath)) { 

			unlink ($DelFilePath);

		}
		$this->db->where('id' , $data['image_id']);
		$query = $this->db->delete('storage_images');
		return $this->db->affected_rows();
	}

	public function insert_step2_0($data)
	{
		$this->db->select('status,id');
		$this->db->where('unique_id', $data['unique_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$old_values = $this->db->get('listings_meta')->result_array();


		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {
			$check = 0;

			foreach ($old_values as $oldvalue) {
				foreach ($_POST['posted_data'] as $key => $value) {
					if($oldvalue['meta_key'] == $key){
						if($oldvalue['meta_value'] != $value)
						{
							$check = 1;
						}
					}
				}
			}

			if($check) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "video_link_changed";
				} else {
					return "already_changed";
				}
			} else {
				return "already_changed";
			}
		}

	}
	public function insert_step2_1($data)
	{
		$this->db->set('title' , $data['storage_title']);
		$this->db->set('description' , $data['description']);
		$this->db->set('step_completed' , 2);
		$this->db->where('unique_id', $data['unique_id']);		
		$query = $this->db->update('listings');
		return $this->db->affected_rows();

	}
	public function update_step2_1($data)
	{
		$this->db->set('title' , $data['storage_title']);
		$this->db->set('description' , $data['description']);
		$this->db->where('unique_id', $data['unique_id']);		
		$query = $this->db->update('listings');

		$affected_rows =  $this->db->affected_rows();

		$this->db->select('status,id');
		$this->db->where('unique_id', $data['unique_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {

			if($affected_rows > 0) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "title_desc_changed";
				} else {
					return "already_changed";
				}
			} else {
				return "already_changed";
			}
		}
	}
	public function get_requirments($type)
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('type' , $type);
		$query = $this->db->get('customer_requirements')->result_array();
		return $query;
	}

	public function get_space_rules($type)
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('type' , $type);
		$query = $this->db->get('space_rules')->result_array();
		return $query;
	}

	public function get_additional_rules($listings_id)
	{
		$this->db->where('listings_id' , $listings_id);
		return $this->db->get('listed_space_additional_rules')->result_array();
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

	public function insert_space_rules($data)
	{
		$this->db->trans_start();

		$this->db->where('listings_id' , $data['listings_id']);
		$status = $this->db->delete('listed_space_rules');

		if(!empty($data['space_rule'])){

			foreach ($data['space_rule'] as $key => $value) {
				$this->db->set('listings_id' , $data['listings_id']);
				$this->db->set('space_rules_id' , $value);
				$query = $this->db->insert('listed_space_rules');
			}
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			return true;

		} else {
			return false;
		}
	}

	public function insert_additional_space_rules($data)
	{
		$this->db->trans_start();

		$this->db->where('listings_id' , $data['listings_id']);
		$status = $this->db->delete('listed_space_additional_rules');

		if(!empty($data['additional_rule'])){

			foreach ($data['additional_rule'] as $key => $value) {
				if(!empty($value)){
					$this->db->set('listings_id' , $data['listings_id']);
					$this->db->set('rule' , $value);
					$query = $this->db->insert('listed_space_additional_rules');
				}
			}
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			return true;

		} else {
			return false;
		}
	}

	public function update_space_rules($data)
	{

		$this->db->select('rule');
		$this->db->where('listings_id' , $data['listings_id']);
		$old_space_additional_rules = $this->db->get('listed_space_additional_rules')->result_array();

		$old_additional_r = array();

		foreach ($old_space_additional_rules as $ad_rule) {
			$old_additional_r[] = $ad_rule['rule'];
		}

		$this->db->where('listings_id' , $data['listings_id']);
		$status = $this->db->delete('listed_space_additional_rules');

		$new_additional_r = array();

		if(!empty($data['additional_rule'])){

			foreach ($data['additional_rule'] as $key => $value) {
				if(!empty($value)){
					$new_additional_r[] = $value;
					$this->db->set('listings_id' , $data['listings_id']);
					$this->db->set('rule' , $value);
					$query = $this->db->insert('listed_space_additional_rules');
				}
			}
		}

		$this->db->select('space_rules_id');
		$this->db->where('listings_id' , $data['listings_id']);
		$old_space_rules = $this->db->get('listed_space_rules')->result_array();

		$old_space_r = array();

		foreach ($old_space_rules as $sp_rule) {
			$old_space_r[] = $sp_rule['space_rules_id'];
		}

		$this->db->where('listings_id' , $data['listings_id']);
		$status = $this->db->delete('listed_space_rules');

		$new_space_r = array();

		if(!empty($data['space_rule'])){

			foreach ($data['space_rule'] as $key => $value) {
				$new_space_r[] = $value;
				$this->db->set('listings_id' , $data['listings_id']);
				$this->db->set('space_rules_id' , $value);
				$query = $this->db->insert('listed_space_rules');
			}
		}

		$additional_array1 = array_diff($old_additional_r,$new_additional_r);
		$additional_array2 = array_diff($new_additional_r,$old_additional_r);
		$space_rule_array1 = array_diff($old_space_r,$new_space_r);
		$space_rule_array2 = array_diff($new_space_r,$old_space_r);

		$this->db->select('status,id');
		$this->db->where('id' , $data['listings_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {

			if(!empty($space_rule_array1) || !empty($space_rule_array2)) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "info_changed";
				}
			} elseif(!empty($additional_array1) || !empty($additional_array2)) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "info_changed";
				}
			} else {
				return "already_changed";
			}
		}

	}

	public function insert_step3_3($data)
	{
		$this->db->select('id');
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->get('listings')->row_array();
		$list_id = $query['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}
		return true;
	}

	public function update_step3_3($data)
	{
		$this->db->select('status,id');
		$this->db->where('unique_id', $data['unique_id']);
		$list_dtl = $this->db->get('listings')->row_array();
		$list_id = $list_dtl['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$old_values = $this->db->get('listings_meta')->result_array();

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}
		

		if($list_dtl['status'] == 0){
			return "already_changed";
		} else {
			$check = 0;

			foreach ($old_values as $oldvalue) {
				foreach ($_POST['posted_data'] as $key => $value) {
					if($oldvalue['meta_key'] == $key){
						if($oldvalue['meta_value'] != $value)
						{
							$check = 1;
						}
					}
				}
			}

			if($check) {
				$this->db->set('status',0);
				$this->db->set('is_updated',1);
				$this->db->where('id', $list_id);		
				$update = $this->db->update('listings');

				if($update > 0) {
					return "info_changed";
				} else {
					return "already_changed";
				}
			} else {
				return "already_changed";
			}
		}
	}

	public function get_dates($listings_id)
	{
		$this->db->where('listings_id' , $listings_id);
		$status = $this->db->get('blocked_booking_dates');
		return $status->result_array();
	}

	public function insert_block_booking_dates($data)
	{
		$this->db->set('listings_id' , $data['listings_id']);
		$this->db->set('start_date' , date('Y-m-d' , strtotime($data['startDate'])));
		$this->db->set('end_date' , date('Y-m-d' , strtotime($data['endDate'])));
		$query = $this->db->insert('blocked_booking_dates');
		return $this->db->insert_id();
	}
	public function unblock_booking_dates($data)
	{
		$this->db->where('id' , $data['b_dates_id']);
		$query = $this->db->delete('blocked_booking_dates');
		return $this->db->affected_rows();
	}

	public function insert_step3_5($data)
	{
		$this->db->select('id');
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->get('listings')->row_array();
		$list_id = $query['id'];

		$this->db->where('group_id',$data['form_id']);
		$this->db->where('listings_id',$list_id);
		$query = $this->db->delete('listings_meta');

		foreach ($_POST['posted_data'] as $key => $value) { 
			$this->db->set('meta_key' , $key);
			$this->db->set('meta_value' , $value);
			$this->db->set('group_id',$data['form_id']);
			$this->db->set('listings_id' ,$list_id);
			$query = $this->db->insert('listings_meta');
		}
		return true;
	}

	public function update_orignal_price($data)
	{
		$this->db->set('new_price',$data['new_price']);
		$this->db->set('status',0);
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->update('listings');
		return $this->db->affected_rows();
	}

	public function insert_step3_6($data)
	{
		$this->db->set('step_completed' , 3);
		$this->db->where('unique_id', $data['unique_id']);		
		$query = $this->db->update('listings');
		return $this->db->affected_rows();
	}


	// ------------------------------- list review details ---------------------
	public function get_complete_detail($unique_id)
	{
		$this->db->select("*");
		$this->db->from("listings");
		$this->db->where('unique_id' ,$unique_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_list_images($listings_id)
	{
		$this->db->select('image');
		$this->db->where('listings_id' , $listings_id);
		$query = $this->db->get('storage_images')->result_array();
		return $query;
	}

	public function set_image_orders($image_order)
	{
		foreach ($image_order as $key => $value) {
			$this->db->set('image_order',$value);
			$this->db->where('id' , $key);
			$query = $this->db->update('storage_images');
		}
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

	// ------------------------------- / list review details --------------------- 


	public function storage_publish($unique_id)
	{
		$this->db->set('publish',1);
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function storage_unpublish($unique_id)
	{
		$this->db->set('publish',0);
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}

}

/* End of file Home_model.php */
   /* Location: ./application/modules/admin/models/Add_listing_model.php */