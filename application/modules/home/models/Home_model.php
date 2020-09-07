<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_user_detail($unique_id)
	{
		$this->db->where('unique_id', $unique_id);
		return $this->db->get('users')->row_array();
	}

	public function get_states()
	{
		return $this->db->get('states')->result_array();
	}

	public function change_email($data)
	{
		$this->db->set('email2' , NULL);
		$this->db->set('email' , $data['user_detail']['email2']);
		$this->db->where('unique_id' , $data['user_detail']['unique_id']);
		$result = $this->db->update('users');
		return $this->db->affected_rows();
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


	public function get_storage_listings($featured = '0')
	{
		$this->db->select("listings.*");
		$this->db->from("listings");
		$this->db->join('users', 'users.id = listings.users_id ', 'left');
		$this->db->where('users.status',1);
		$this->db->where('users.is_banned',0);
		$this->db->where('listings.list_type',0);
		$this->db->where('listings.is_featured',$featured);
		$this->db->where('listings.status',1);
		$this->db->where('listings.is_banned',0);
		$this->db->where('listings.is_published',1);
		if($featured == 0) {
			$this->db->limit(9);
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_list_image($listings_id , $list = '')
	{
		$this->db->select('image');
		$this->db->where('listings_id' , $listings_id);
		if(!empty($list)) {
			$this->db->where_in('image_order' , array('1' , '2' , '3'));
		}
		$this->db->limit(1);
		$query = $this->db->get('storage_images')->row_array();
		return $query['image'];
	}

	public function get_booked_list_image($listings_id)
	{
		$this->db->select('image');
		$this->db->where('listings_id' , $listings_id);
		$this->db->limit(1);
		$query = $this->db->get('booked_storage_images')->row_array();
		return $query['image'];
	}

	public function addfavourite($listings_id)
	{
		$this->db->set('listings_id',$listings_id);
		$this->db->set('users_id' , get_session('user_id'));
		$query = $this->db->insert('favourite');

		return $this->db->insert_id();
	}

	public function removefavourite($listings_id)
	{
		$this->db->where('listings_id',$listings_id);
		$this->db->where('users_id' , get_session('user_id'));
		$query = $this->db->delete('favourite');

		return $this->db->affected_rows();
	}
}

/* End of file Home_model.php */
   /* Location: ./application/modules/admin/models/Home_model.php */