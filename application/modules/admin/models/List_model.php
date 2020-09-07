<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}

	public function get_detail($unique_id)
	{
		$this->db->select("listings.title , listings.price");
		$this->db->select("users.first_name , users.last_name, users.email");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.unique_id' ,$unique_id);
		$query = $this->db->get()->row_array();
		return $query;
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

	public function get_space_rules($type)
	{
		$this->db->where('status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('type' , $type);
		$query = $this->db->get('space_rules')->result_array();
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

	public function get_vehicles($listings_id)
	{
		$this->db->select('name,quantity');
		$this->db->where('listings_id' , $listings_id);
		return $this->db->get('mover_vehicles')->result_array();
	}
	public function get_storage_listings($status)
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name , users.last_name");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.list_type',0);
		$this->db->where('listings.step_completed',3);
		$this->db->where('listings.is_published',1);
		$this->db->where('listings.is_updated',0);
		$this->db->where('listings.is_deleted',0);
		$this->db->where('listings.is_banned',0);
		$this->db->where('listings.status',$status);
		if($status == 0) {
			$this->db->where('listings.new_price',NULL);
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_list_reviews()
	{
		$this->db->select('concat(u.first_name, " ", u.last_name) as username, u.profile_dp ,br.*');
		$this->db->from('bookings_rating br');
		$this->db->join('bookings b', 'br.bookings_id = b.id', 'left');
		$this->db->join('listings l', 'l.id = b.orignal_list_id', 'left');
		$this->db->join('users u', 'u.id = br.users_id', 'left');
		// $this->db->where('l.id', $id);
		// $this->db->where('br.orignal_list_id', $id);
		// $this->db->where('br.status',1);
		$this->db->order_by('br.date_added', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_updated_storage_listings()
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name , users.last_name");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.list_type',0);
		$this->db->where('listings.status',0);
		$this->db->where('listings.is_published',1);
		$this->db->where('listings.step_completed',3);
		$this->db->where('listings.is_updated',1);
		$this->db->where('listings.is_deleted',0);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}
	public function get_deleted_storage_listings()
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name , users.last_name");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.list_type',0);
		$this->db->where('listings.is_deleted',1);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_deleted_mover_listings()
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name , users.last_name");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.list_type',1);
		$this->db->where('listings.is_deleted',1);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_mover_listings($status)
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name , users.last_name");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.list_type',1);
		$this->db->where('listings.step_completed',4);
		$this->db->where('listings.is_updated',0);
		$this->db->where('listings.is_published',1);
		$this->db->where('listings.is_deleted',0);
		$this->db->where('listings.status',$status);
		$this->db->order_by('listings.id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_updated_mover_listings()
	{
		$this->db->select("listings.*");
		$this->db->select("users.first_name , users.last_name");
		$this->db->from("listings");
		$this->db->join('users', 'listings.users_id = users.id', 'left');
		$this->db->where('listings.list_type',1);
		$this->db->where('listings.status',0);
		$this->db->where('listings.is_published',1);
		$this->db->where('listings.step_completed',4);
		$this->db->where('listings.is_updated',1);
		$this->db->where('listings.is_deleted',0);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function update_price_active($unique_id)
	{
		$this->db->select('new_price');
		$this->db->where('unique_id', $unique_id);
		$list = $this->db->get('listings')->row_array();

		$this->db->set('status',1);
		$this->db->set('price',$list['new_price']);
		$this->db->set('new_price',NULL);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function make_active($unique_id)
	{
		$this->db->set('status',1);
		$this->db->set('is_updated',0);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function status_active($unique_id , $price)
	{
		$this->db->set('status',1);
		if(!empty($price) || $price != false){
			$this->db->set('price',$price);
		} else {
			$this->db->set('is_published',0);	
		}
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function restore_list($unique_id)
	{
		$this->db->set('is_deleted',0);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');
		return $this->db->affected_rows();
	}
	public function list_delete($unique_id)
	{
		$this->db->set('is_deleted',1);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');
		return $this->db->affected_rows();
	}
	public function list_permanent_delete($unique_id)
	{
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->delete('listings');
		return $this->db->affected_rows();
	}
	public function mover_status_active($unique_id)
	{
		$this->db->set('status',1);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');
		return $this->db->affected_rows();
	}
	public function mover_status_inactive($unique_id)
	{
		$this->db->set('status',0);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');
		return $this->db->affected_rows();
	}

	public function add_featured($unique_id)
	{
		$this->db->set('is_featured',1);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function remove_featured($unique_id)
	{
		$this->db->set('is_featured',0);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}

	public function add_banned($unique_id)
	{
		$this->db->set('is_banned',1);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function remove_banned($unique_id)
	{
		$this->db->set('is_banned',0);
		$this->db->where('unique_id', $unique_id);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
}

/* End of file user_model.php */
   /* Location: ./application/modules/admin/models/user_model.php */