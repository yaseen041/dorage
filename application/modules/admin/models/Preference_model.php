<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preference_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}
	public function get_spaces()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('storage_size_types')->result_array();
		return $result;
	}
	public function get_space_storages()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('space_storage_types')->result_array();
		return $result;
	}


	public function states()
	{
		$result = $this->db->get('states')->result_array();
		return $result;
	}

	public function insert_taxes($data)
	{
		$this->db->truncate('taxes');

		foreach ($data['state'] as $key => $value) {
			$this->db->set('state_id' , $key);
			$this->db->set('tax_rate' , $value);
			$this->db->insert('taxes');
		}
		return true;
	}

	public function get_space_storage_types()
	{
		$this->db->select('space_storage_types.*');
		$this->db->select('storage_size_types.name as storage_name');
		$this->db->from('space_storage_types');
		$this->db->join('storage_size_types', 'storage_size_types.id = space_storage_types.storage_size_types_id', 'left');
		$this->db->where('space_storage_types.is_deleted',0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function get_room_space_characteristic()
	{
		$this->db->select('room_space_character.*');
		$this->db->select('space_storage_types.name as storage_name');
		$this->db->from('room_space_character');
		$this->db->join('space_storage_types', 'space_storage_types.id = room_space_character.space_storage_types_id', 'left');
		$this->db->where('room_space_character.is_deleted',0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function check_storage_name($storage_name)
	{
		$this->db->select('*');
		$this->db->where('name', $storage_name);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('storage_size_types');
		return $query->num_rows();
	}

	public function check_space_storage_type_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['space_storage_type']);
		$this->db->where('storage_size_types_id', $data['space_type']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('space_storage_types');
		return $query->num_rows();
	}

	public function insert_space_type($data)
	{
		$this->db->set('name' , $data['space_type']);
		$this->db->insert('storage_size_types');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function insert_space_storage_type($data)
	{
		$this->db->set('name', $data['space_storage_type']);
		$this->db->set('storage_size_types_id', $data['space_type']);
		$this->db->set('description', $data['description']);
		$this->db->insert('space_storage_types');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function get_space_detail($space_id)
	{
		$this->db->where('id' , $space_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('storage_size_types');
		return $result->row_array();
	}

	public function get_space_storage_type_detail($space_storage_type_id)
	{
		$this->db->where('id',$space_storage_type_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('space_storage_types');
		return $result->row_array();
	}

	public function check_space_name_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['space_type']);
		$this->db->where('id !=', $data['space_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('storage_size_types');
		return $query->num_rows();
	}

	public function space_storage_type_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['space_storage_type']);
		$this->db->where('id !=', $data['space_type']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('space_storage_types');
		return $query->num_rows();
	}

	public function update_storage_space($data)
	{
		$this->db->set('name' , $data['space_type']);
		$this->db->where('id', $data['space_id']);
		$query =  $this->db->update('storage_size_types');
		return $this->db->affected_rows();
	}

	public function update_space_storage_type($data)
	{
		$this->db->set('name' , $data['space_storage_type']);
		$this->db->set('storage_size_types_id' , $data['space_type']);
		$this->db->set('description', $data['description']);
		$this->db->where('id', $data['space_storage_type_id']);
		$query =  $this->db->update('space_storage_types');
		return $this->db->affected_rows();
	}
	public function delete_storage($space_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $space_id);
		$query =  $this->db->update('storage_size_types');
		return $this->db->affected_rows();
	}

	public function delete_space_storage_type($space_storage_type_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $space_storage_type_id);
		$query =  $this->db->update('space_storage_types');
		return $this->db->affected_rows();
	}
	public function inactive_storage_status($space_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $space_id);
		$result = $this->db->update('storage_size_types');
		return $this->db->affected_rows();
	}
	public function active_storage_status($space_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $space_id);
		$result = $this->db->update('storage_size_types');
		return $this->db->affected_rows();
	}
	public function inactive_space_storage_type_status($space_storage_type_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $space_storage_type_id);
		$result = $this->db->update('space_storage_types');
		return $this->db->affected_rows();
	}
	public function active_space_storage_type_status($space_storage_type_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $space_storage_type_id);
		$result = $this->db->update('space_storage_types');
		return $this->db->affected_rows();
	}
	public function get_amenities()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('amenities')->result_array();
		return $result;
	}

	public function inactive_amenity($amenity_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $amenity_id);
		$result = $this->db->update('amenities');
		return $this->db->affected_rows();
	}
	public function active_amenity($amenity_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $amenity_id);
		$result = $this->db->update('amenities');
		return $this->db->affected_rows();
	}
	public function insert_amenity($data)
	{
		$this->db->set('name', $data['amenity_title']);
		$this->db->set('description', $data['description']);
		if(isset($data['amenity_type'])) {
			$this->db->set('type',1);
		}
		$query = $this->db->insert('amenities');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function update_amenity($data)
	{
		$this->db->set('name', $data['amenity_title']);
		$this->db->set('description', $data['description']);
		if(isset($data['amenity_type'])) {
			$this->db->set('type',1);
		} else {
			$this->db->set('type',0);
		}
		$this->db->where('id', $data['amenity_id']);
		$query =  $this->db->update('amenities');
		return $this->db->affected_rows();
	}

	public function delete_amenity($amenity_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $amenity_id);
		$query =  $this->db->update('amenities');
		return $this->db->affected_rows();
	}
	public function get_amenity_detail($amenity_id)
	{
		$this->db->where('id',$amenity_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('amenities');
		return $result->row_array();
	}

	public function check_amenity_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['amenity_title']);
		$this->db->where('id !=', $data['amenity_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('amenities');
		return $query->num_rows();
	}
	public function get_spaces_can_use()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('spaces_guest_use')->result_array();
		return $result;
	}
	public function inactive_space_can_use($space_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $space_id);
		$result = $this->db->update('spaces_guest_use');
		return $this->db->affected_rows();
	}
	public function active_space_can_use($space_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $space_id);
		$result = $this->db->update('spaces_guest_use');
		return $this->db->affected_rows();
	}
	public function insert_space_can_use($data)
	{
		$this->db->set('name', $data['space_title']);
		$query = $this->db->insert('spaces_guest_use');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}
	public function get_space_can_use($space_id)
	{
		$this->db->where('id',$space_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('spaces_guest_use');
		return $result->row_array();
	}

	public function check_space_can_use_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['space_title']);
		$this->db->where('id !=', $data['space_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('spaces_guest_use');
		return $query->num_rows();
	}
	public function update_space_can_use($data)
	{
		$this->db->set('name' , $data['space_title']);
		$this->db->where('id', $data['space_id']);
		$query =  $this->db->update('spaces_guest_use');
		return $this->db->affected_rows();
	}
	public function delete_space_can_use($space_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $space_id);
		$query =  $this->db->update('spaces_guest_use');
		return $this->db->affected_rows();
	}
	public function get_space_rules()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('space_rules')->result_array();
		return $result;
	}
	public function inactive_space_rule($rule_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $rule_id);
		$result = $this->db->update('space_rules');
		return $this->db->affected_rows();
	}
	public function active_space_rule($rule_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $rule_id);
		$result = $this->db->update('space_rules');
		return $this->db->affected_rows();
	}

	public function insert_space_rule($data)
	{
		$this->db->set('name', $data['rule_title']);
		$this->db->set('description', $data['description']);
		if(isset($data['rule_type'])) {
			$this->db->set('type',1);
		}
		$query = $this->db->insert('space_rules');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}


	public function get_rule_detail($rule_id)
	{
		$this->db->where('id',$rule_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('space_rules');
		return $result->row_array();
	}

	public function delete_space_rule($rule_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $rule_id);
		$query =  $this->db->update('space_rules');
		return $this->db->affected_rows();
	}

	public function check_space_rule_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['rule_title']);
		$this->db->where('id !=', $data['rule_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('space_rules');
		return $query->num_rows();
	}
	public function update_space_rule($data)
	{
		$this->db->set('name', $data['rule_title']);
		$this->db->set('description', $data['description']);
		if(isset($data['rule_type'])) {
			$this->db->set('type',1);
		} else {
			$this->db->set('type',0);
		}
		$this->db->where('id', $data['rule_id']);
		$query =  $this->db->update('space_rules');
		return $this->db->affected_rows();
	}
	public function check_room_space_characteristic_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['room_space_characteristic']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('room_space_character');
		return $query->num_rows();
	}
	public function insert_room_space_characteristic($data)
	{
		$this->db->set('name', $data['room_space_characteristic']);
		// $this->db->set('space_storage_types_id', $data['space_type']);
		$this->db->insert('room_space_character');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}
	
	public function get_room_space_char($id)
	{
		$this->db->where('id',$id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('room_space_character');
		return $result->row_array();
	}

	public function inactive_room_space_char_status($room_char_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $room_char_id);
		$result = $this->db->update('room_space_character');
		return $this->db->affected_rows();
	}
	public function active_room_space_characteristic_status($room_char_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $room_char_id);
		$result = $this->db->update('room_space_character');
		return $this->db->affected_rows();
	}
	public function room_space_characteristic_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['room_space_characteristic']);
		$this->db->where('id !=', $data['room_char_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('room_space_character');
		return $query->num_rows();
	}
	public function update_room_space_characteristic($data)
	{

		$this->db->set('name' , $data['room_space_characteristic']);
		// $this->db->set('space_storage_types_id' , $data['space_type']);
		$this->db->where('id', $data['room_char_id']);
		$query =  $this->db->update('room_space_character');
		return $this->db->affected_rows();
	}

	public function delete_room_space_characteristic($room_char_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $room_char_id);
		$query =  $this->db->update('room_space_character');
		return $this->db->affected_rows();
	}
	public function get_cancellation_policies()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('cancellation_policies')->result_array();
		return $result;
	}

	public function get_policy_note()
	{
		$this->db->select("*");
		$this->db->from('settings');
		$this->db->where('page','cancellation_policy');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_policy_note($data)
	{
		$this->db->set('meta_value',$data['policy_note_text']);
		$this->db->where('meta_id' , $data['note_id']);
		$query = $this->db->update('settings');
		return $this->db->affected_rows();
	}

	public function inactive_cancellation_policy($policy_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $policy_id);
		$result = $this->db->update('cancellation_policies');
		return $this->db->affected_rows();
	}
	public function active_cancellation_policy($policy_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $policy_id);
		$result = $this->db->update('cancellation_policies');
		return $this->db->affected_rows();
	}
	public function cancellation_policy_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['cancellation_policy']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('cancellation_policies');
		return $query->num_rows();
	}

	public function insert_cancellation_policy($data)
	{
		$this->db->set('name', $data['cancellation_policy']);
		$this->db->insert('cancellation_policies');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function get_policy_detail($policy_id)
	{
		$this->db->where('id' , $policy_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('cancellation_policies');
		return $result->row_array();
	}

	public function delete_policy($policy_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $policy_id);
		$query =  $this->db->update('cancellation_policies');
		return $this->db->affected_rows();
	}
	public function check_policy_name_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['cancellation_policy']);
		$this->db->where('id !=', $data['policy_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('cancellation_policies');
		return $query->num_rows();
	}
	public function update_cancellation_policy($data)
	{
		$this->db->set('name' , $data['cancellation_policy']);
		$this->db->where('id', $data['policy_id']);
		$query =  $this->db->update('cancellation_policies');
		return $this->db->affected_rows();
	}
	public function get_requirements()
	{
		$this->db->where('is_deleted',0);
		$result = $this->db->get('customer_requirements')->result_array();
		return $result;
	}
	public function inactive_requirement($requirement_id)
	{
		$this->db->set('status', 0);
		$this->db->where('id', $requirement_id);
		$result = $this->db->update('customer_requirements');
		return $this->db->affected_rows();
	}
	public function active_requirement($requirement_id)
	{
		$this->db->set('status', 1);
		$this->db->where('id', $requirement_id);
		$result = $this->db->update('customer_requirements');
		return $this->db->affected_rows();
	}
	public function insert_requirement($data)
	{
		$this->db->set('name', $data['requirement_title']);
		if(isset($data['requirement_type'])) {
			$this->db->set('type',1);
		}
		$query = $this->db->insert('customer_requirements');
		if($this->db->insert_id() > 0){
			return true;
		} else {
			return false;
		}
	}

	public function delete_requirement($requirement_id)
	{
		$this->db->set('is_deleted' , 1);
		$this->db->where('id', $requirement_id);
		$query =  $this->db->update('customer_requirements');
		return $this->db->affected_rows();
	}
	public function get_requirement_detail($requirement_id)
	{
		$this->db->where('id',$requirement_id);
		$this->db->where('is_deleted',0);
		$result = $this->db->get('customer_requirements');
		return $result->row_array();
	}

	public function check_requirement_update_exist($data)
	{
		$this->db->select('*');
		$this->db->where('name', $data['requirement_title']);
		$this->db->where('id !=', $data['requirement_id']);
		$this->db->where('is_deleted',0);
		$query = $this->db->get('customer_requirements');
		return $query->num_rows();
	}

	public function update_requirement($data)
	{
		$this->db->set('name', $data['requirement_title']);
		if(isset($data['requirement_type'])) {
			$this->db->set('type',1);
		} else {
			$this->db->set('type',0);
		}
		$this->db->where('id', $data['requirement_id']);
		$query =  $this->db->update('customer_requirements');
		return $this->db->affected_rows();
	}

}

/* End of file admin_model.php */
   /* Location: ./application/modules/admin/models/admin_model.php */