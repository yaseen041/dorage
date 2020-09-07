<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_users($status = '1')
	{
		$this->db->where('status' , $status);
		$this->db->where('is_deleted' ,0);
		$result = $this->db->get('users')->result_array();
		return $result;
	}

	public function get_deleted_users()
	{
		$this->db->where('is_deleted' ,1);
		$result = $this->db->get('users')->result_array();
		return $result;
	}

	public function insert_user($data)
	{
		$hash_pass="password('".trim($data['password'])."')";

		$date1 = strtr($data['dob'], '/', '-');

		$this->db->set('first_name', $data['first_name']);
		$this->db->set('last_name', $data['last_name']);
		$this->db->set('email', $data['email']);
		$this->db->set('password',$hash_pass, FALSE);

		$this->db->set('gender', $data['gender']);
		$this->db->set('dob', date("Y-m-d" , strtotime($date1)));
		$this->db->set('phone', $data['phone']);
		$this->db->set('address', $data['address']);
		$this->db->set('about', $data['describe_yourself']);

		$query = $this->db->insert('users');
		if ($this->db->insert_id() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_user($data)
	{
		// $hash_pass="password('".trim($data['password'])."')";

		$date1 = strtr($data['dob'], '/', '-');

		$this->db->set('first_name', $data['first_name']);
		$this->db->set('last_name', $data['last_name']);
		// $this->db->set('email', $data['email']);
		// $this->db->set('password',$hash_pass, FALSE);

		$this->db->set('gender', $data['gender']);
		$this->db->set('dob', date("Y-m-d" , strtotime($date1)));
		$this->db->set('phone', $data['phone']);
		$this->db->set('address', $data['address']);
		$this->db->set('about', $data['describe_yourself']);
		$this->db->where('id', $data['user_id']);
		$query = $this->db->update('users');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function inactive_status($user_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $user_id);
		$result = $this->db->update('users');
		return $this->db->affected_rows();
	}
	public function active_status($user_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $user_id);
		$result = $this->db->update('users');
		return $this->db->affected_rows();
	}

	public function get_user_detail($user_id)
	{
		$this->db->where('id', $user_id);
		$result = $this->db->get('users')->row_array();
		return $result;
	}

	public function add_banned($user_id)
	{
		$this->db->set('is_banned',1);
		$this->db->where('id', $user_id);
		$query = $this->db->update('users');

		$this->db->set('status',0);
		$this->db->where('users_id', $user_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}

	public function restore_user($user_id)
	{
		$this->db->set('is_deleted',0);
		$this->db->where('id', $user_id);
		$query = $this->db->update('users');
		return $this->db->affected_rows();
	}
	public function delete_user($user_id)
	{
		$this->db->set('is_deleted',1);
		$this->db->where('id', $user_id);
		$query = $this->db->update('users');
		return $this->db->affected_rows();
	}
	public function user_permanent_delete($user_id)
	{
		$this->db->where('id', $user_id);
		$query = $this->db->delete('users');
		return $this->db->affected_rows();
	}

	public function remove_banned($user_id)
	{
		$this->db->set('is_banned',0);
		$this->db->where('id', $user_id);
		$query = $this->db->update('users');

		return $this->db->affected_rows();
	}

}

/* End of file user_model.php */
   /* Location: ./application/modules/admin/models/user_model.php */