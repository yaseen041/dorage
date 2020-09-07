<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_mover_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function check_detail($unique_id)
	{
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id' ,$unique_id);
		$this->db->where('list_type' ,1);
		$this->db->where('is_deleted' ,0);
		$query = $this->db->get('listings')->row();
		if(count($query) > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	public function get_detail($unique_id)
	{
		$this->db->select('listings.*,users.first_name, users.last_name');
		$this->db->from('listings');
		$this->db->join('users' , 'users.id = listings.users_id' , 'left');
		$this->db->where('listings.unique_id' ,$unique_id);
		
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_dates($listings_id)
	{
		$this->db->where('listings_id' , $listings_id);
		$status = $this->db->get('mover_blocked_dates');
		return $status->result_array();
	}

	public function insert_block_booking_dates($data)
	{
		$this->db->set('listings_id' , $data['listings_id']);
		$this->db->set('start_date' , date('Y-m-d' , strtotime($data['startDate'])));
		$this->db->set('end_date' , date('Y-m-d' , strtotime($data['endDate'])));
		$query = $this->db->insert('mover_blocked_dates');
		return $this->db->insert_id();
	}
	public function unblock_booking_dates($data)
	{
		$this->db->where('id' , $data['b_dates_id']);
		$query = $this->db->delete('mover_blocked_dates');
		return $this->db->affected_rows();
	}

	public function update_stp1($data)
	{
		$this->db->trans_start();

		$latlong = explode(',', @$data['lat_long']);


		$this->db->set('list_type' ,1);
		$this->db->set('title' , $data['mover_title']);
		$this->db->set('description' , $data['mover_description']);
		$this->db->set('place' ,@$data['place']);
		$this->db->set('latitude' ,@trim($latlong[0]));
		$this->db->set('longitude' ,@trim($latlong[1]));
		$this->db->where('unique_id', $data['unique_id']);		
		$query = $this->db->update('listings');

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

		if ($this->db->trans_status() === TRUE)
		{
			return $list_id;

		} else {
			return false;
		}
	}

	public function update_stp1_after($data)
	{

		$latlong = explode(',', @$data['lat_long']);

		$this->db->set('list_type' ,1);
		$this->db->set('title' , $data['mover_title']);
		$this->db->set('description' , $data['mover_description']);
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
				return "info_changed";

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

	}

	public function insert_stp1($data)
	{
		$this->db->trans_start();

		$latlong = explode(',', @$data['lat_long']);

		$this->db->set('unique_id' , $data['unique_id']);
		$this->db->set('users_id' , get_session('user_id'));
		$this->db->set('list_type' ,1);
		$this->db->set('title' , $data['mover_title']);
		$this->db->set('description' , $data['mover_description']);
		$this->db->set('place' ,@$data['place']);
		$this->db->set('latitude' ,@trim($latlong[0]));
		$this->db->set('longitude' ,@trim($latlong[1]));
		$this->db->set('step_completed' ,1);
		$query = $this->db->insert('listings');
		$list_id = $this->db->insert_id();

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

		if ($this->db->trans_status() === TRUE)
		{
			return $list_id;

		} else {
			return false;
		}

	}

	public function insert_step3($data)
	{

		$this->db->trans_start();
		
		$this->db->set('paypal_email' ,$data['paypal_email']);
		$this->db->where('id', get_session('user_id'));
		$query1 = $this->db->update('users');

		if ($this->db->trans_status() === TRUE)
		{
			return true;

		} else {
			return false;
		}
	}

	public function insert_step4($data)
	{   
		$this->db->trans_start();

		$this->db->select('id');
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->get('listings')->row_array();
		$list_id = $query['id'];

		$this->db->set('step_completed' ,4);
		$this->db->where('id', $list_id);
		$query1 = $this->db->update('listings');

		if ($this->db->trans_status() === TRUE)
		{
			return true;

		} else {
			return false;
		}

	}

	public function update_stp2_after($data)
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
	public function insert_stp2($data)
	{
		$this->db->trans_start();

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

		$this->db->set('step_completed' ,2);
		$this->db->where('id', $list_id);
		$query1 = $this->db->update('listings');

		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			return true;

		} else {
			return false;
		}
	}


	public function upload_mover_image($data)
	{
		$this->db->where('listings_id' , $data['list_id']);
		$this->db->delete('storage_images');

		$this->db->set('image' , $data['mover_image']);
		$this->db->set('listings_id', $data['list_id']);
		$query = $this->db->insert('storage_images');

		return $this->db->affected_rows();
	}


	public function update_mover_image($data)
	{

		$this->db->select('id');
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->get('listings')->row_array();
		$list_id = $query['id'];

		$this->db->where('listings_id' , $list_id);
		$this->db->delete('storage_images');

		$this->db->set('status',0);
		$this->db->set('is_updated',1);
		$this->db->where('id', $list_id);		
		$update = $this->db->update('listings');

		$this->db->set('image' , $data['mover_image']);
		$this->db->set('listings_id', $list_id);
		$query = $this->db->insert('storage_images');

		return $this->db->affected_rows();
	}

	public function delete_mover_picture($data)
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

	public function get_vehicles($listings_id)
	{
		$this->db->select('*');
		$this->db->where('listings_id' , $listings_id);
		return $this->db->get('mover_vehicles')->result_array();

	}

	public function mover_publish($unique_id)
	{
		$this->db->set('publish',1);
		$this->db->where('user_id' , get_session('user_id'));
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function mover_unpublish($unique_id)
	{
		$this->db->set('publish',0);
		$this->db->where('user_id' , get_session('user_id'));
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}


}

/* End of file Home_model.php */
   /* Location: ./application/modules/admin/models/Add_listing_model.php */