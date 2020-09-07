<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}
	public function get_user_detail()
	{
		$this->db->where('id', get_session('user_id'));
		return $this->db->get('users')->row_array();
	}

	public function get_bookings($status)
	{
		$this->db->select("booked_listings.orignal_list_id , booked_listings.title , booked_listings.place , booked_listings.users_id as owner_id");
		$this->db->select("users.first_name , users.last_name , users.email , users.phone");
		$this->db->select("bookings.* , bookings.id as booking_id");
		if ($status == 4) {
			$this->db->select("bookings_payment.amount");
		}
		$this->db->from("booked_listings");
		$this->db->join('bookings', 'bookings.listings_id = booked_listings.id', 'left');
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		if ($status == 4) {
			$this->db->join('bookings_payment', 'bookings_payment.bookings_id = bookings.id', 'left');
		}
		$this->db->where('bookings.users_id' ,get_session('user_id'));
		$this->db->where_in('bookings.booking_status' ,$status);
		$this->db->order_by('bookings.id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}


	public function get_bookings_provider($status)
	{
		$this->db->select("booked_listings.title , booked_listings.place , booked_listings.users_id as owner_id");
		$this->db->select("users.first_name , users.last_name , users.email , users.phone");
		$this->db->select("bookings.* , bookings.id as booking_id");
		$this->db->from("booked_listings");
		$this->db->join('bookings', 'bookings.listings_id = booked_listings.id', 'left');
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('booked_listings.users_id' ,get_session('user_id'));
		$this->db->where_in('bookings.booking_status' ,$status);
		$this->db->order_by('bookings.id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}


	public function get_booked_mover($status)
	{
		$this->db->select("booked_listings.title , booked_listings.place , booked_listings.users_id as owner_id");
		$this->db->select("users.first_name , users.last_name , users.email , users.phone");
		$this->db->select("bookings.* , bookings.id as booking_id");
		$this->db->from("booked_listings");
		$this->db->join('bookings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('booked_listings.users_id' ,get_session('user_id'));
		$this->db->where_in('bookings.booking_status' ,$status);
		$this->db->order_by('bookings.id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}



	public function get_detail($unique_id)
	{
		$this->db->select("booked_listings.title");
		$this->db->select("users.first_name , users.last_name, users.email");
		$this->db->from("booked_listings");
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('booked_listings.unique_id' ,$unique_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_list_owner_detail($list_id)
	{
		$this->db->select("booked_listings.title");
		$this->db->select("users.first_name , users.last_name, users.email");
		$this->db->from("booked_listings");
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('booked_listings.id' ,$list_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_booking_detail($booking_id)
	{
		$this->db->select("bookings.*");
		$this->db->select("users.first_name , users.last_name, users.email");
		$this->db->from("bookings");
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.id' ,$booking_id);
		$query = $this->db->get()->row_array();
		return $query;
	}


	public function get_booking_mover_detail($booking_id)
	{
		$this->db->select("bookings.*");
		$this->db->select("users.first_name , users.last_name, users.email");
		$this->db->from("bookings");
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.parent_id' ,$booking_id);
		$query = $this->db->get()->row_array();
		return $query;
	}


	public function update_details($data)
	{
		// $date1 = strtr($data['dob'], '/', '-');
		// echo $date1; exit;
		$this->db->set('first_name', $data['first_name']);
		$this->db->set('last_name', $data['last_name']);
		$this->db->set('gender', $data['gender']);
		$this->db->set('dob', date("Y-m-d" , strtotime($data['dob'])) );
		$this->db->set('phone', $data['phone']);
		$this->db->set('address1', $data['address1']);
		$this->db->set('address2', $data['address2']);

		$this->db->set('city', $data['city']);
		$this->db->set('state', $data['state']);
		$this->db->set('zip', $data['zip']);

		$this->db->set('paypal_email', $data['paypal_email']);
		$this->db->set('about', $data['about']);
		$this->db->set('profile_updated', 1);
		$this->db->where('id', get_session('user_id'));
		$query = $this->db->update('users');
		return true;
	}

	public function update_profile_dp($data)
	{
		$this->db->set('profile_dp', $data['profile_dp']);
		$this->db->where('id',get_session('user_id'));
		$query = $this->db->update('users');
		if($this->db->affected_rows() > 0){
			return true;	
		}
		else{
			return false;	
		}
	}

	public function check_old_password($data)
	{
		$hash_pass="password('".$data['old_password']."')";
		$this->db->select('*');
		$this->db->where('password',$hash_pass,FALSE);
		$this->db->where('id', $this->session->userdata('user_id'));
		$query = $this->db->get('users');
		return $query->num_rows();
	}
	public function change_email($data)
	{
		$this->db->set('email2',$data['email']);
		$this->db->where('id', $this->session->userdata('user_id'));
		$result = $this->db->update('users');
		return $this->db->affected_rows();
	}

	public function update_password($data)
	{
		$hash_pass="password('".$data['password']."')";
		$this->db->set('password',$hash_pass, FALSE);
		$this->db->where('id', $this->session->userdata('user_id'));
		$result = $this->db->update('users');
		return $this->db->affected_rows();
	}

	public function get_storage_listings()
	{
		$this->db->select("*");
		$this->db->from("listings");
		$this->db->where('list_type',0);
		$this->db->where('is_deleted',0);
		$this->db->where('users_id',get_session('user_id'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function get_mover_listings()
	{
		$this->db->where('list_type',1);
		$this->db->where('is_deleted',0);
		$this->db->where('users_id',get_session('user_id'));
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('listings')->result_array();
		return $query;
	}
	public function set_price_publish($data)
	{
		$this->db->set('is_published',1);
		$this->db->set('price',$data['price']);
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id', $data['unique_id']);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}
	public function set_deactive_list($data)
	{
		$this->db->set('status',0);
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id', $data['list_id']);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}

	public function set_delete_list($data)
	{
		$this->db->set('is_deleted',1);
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->where('unique_id', $data['list_id']);
		$query = $this->db->update('listings');

		return $this->db->affected_rows();
	}

	public function notify_setting($data)
	{
		$this->db->where('users_id' , get_session('user_id'));
		$this->db->delete('notification');

		$notify = '3';
		if (isset($data['notify_email']) && isset($data['notify_text'])) {
			$notify = '2';
		} elseif (isset($data['notify_email'])) {
			$notify = '0';
		} elseif (isset($data['notify_text'])) {
			$notify = '1';
		}


		if ($notify != '3') {
			$this->db->set('users_id' , get_session('user_id'));
			$this->db->set('notify_by' , $notify);
			$query = $this->db->insert('notification');
		}

		return true;
	}

	public function get_mover_detail($parent_id)
	{
		$this->db->select("booked_listings.title , booked_listings.place , booked_listings.users_id as owner_id");

		$this->db->select("bookings.parent_id, bookings.mover_id, bookings.mover_price, bookings.refundable_mover, bookings.no_crews, bookings.no_hours, bookings.crew_charges, bookings.booking_start, bookings.booking_end, bookings.cancell_reason");

		$this->db->from("booked_listings");
		$this->db->join('bookings','bookings.mover_id = booked_listings.id','left');
		// $this->db->where('bookings.users_id', get_session('user_id'));
		$this->db->where('bookings.parent_id', $parent_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function needer_cancel_only_mover_booking($data)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',1);
		$this->db->set('cancell_reason',$data['cancell_reason']);
		$this->db->where('id', $data['booking_id']);
		$query = $this->db->update('bookings');

		$result = $this->db->affected_rows();

		return $result;
	}
	
	public function owner_cancel_booking($data , $booking_detail)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',0);
		$this->db->set('cancell_reason',$data['cancell_reason']);
		$this->db->where('id', $data['booking_id']);
		$query = $this->db->update('bookings');

		$result = $this->db->affected_rows();

		if(!empty($booking_detail['parent_id'])) {
			$this->db->set('mover_needed',2);
			$this->db->where('id', $booking_detail['parent_id']);
			$query = $this->db->update('bookings');
		}

		return $result;
	}
	public function needer_cancel_booking($data)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',1);
		$this->db->set('cancell_reason',$data['cancell_reason']);
		$this->db->where('id', $data['booking_id']);
		$query = $this->db->update('bookings');

		return $this->db->affected_rows();
	}

	public function needer_cancel_mover_booking($data)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',1);
		$this->db->set('cancell_reason',$data['cancell_reason']);
		$this->db->where('id', $data['id']);
		$query = $this->db->update('bookings');
		$result = $this->db->affected_rows();

		$this->db->set('mover_needed',2);
		$this->db->where('id', $data['parent_id']);
		$query = $this->db->update('bookings');
		$result = $this->db->affected_rows();

		return $result;
	}

	public function needer_cancel_list_mover_booking($data)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',1);
		$this->db->where('parent_id', $data['booking_id']);
		$query = $this->db->update('bookings');

		return $this->db->affected_rows();
	}

	public function getMessages($data){
		$this->db->select('c.*,  concat(u.first_name," ", u.last_name) as username, u.profile_dp as profile_dp, u2.profile_dp as profile_dp_other, concat(u2.first_name," ", u2.last_name) as username_other, l.title as listing_title');
		$this->db->from('chat c');
		$this->db->join('users u', 'u.id = c.chat_from', 'left');
		$this->db->join('users u2', 'u2.id = c.chat_to', 'left');
		$this->db->join('listings l', 'l.unique_id = c.listing_unique_id', 'left');
		$where = "(c.chat_from = ".$data['chat_from']." AND c.chat_to = ".$data['chat_to'].")";
		$this->db->where($where);
		$where = "(c.chat_from = ".$data['chat_to']." AND c.chat_to = ".$data['chat_from'].")";
		$this->db->or_where($where);
		$this->db->order_by('sent', 'asc');
		// $this->db->limit(10);
		$query = $this->db->get();

		$this->db->set('chat_read', 1);
		$this->db->where("chat_to", get_session('user_id'));
		if (get_session('user_id') == $data['chat_from']) {
			$this->db->where("chat_from", $data['chat_to']);
		}else{
			$this->db->where("chat_from", $data['chat_from']);
		}
		$this->db->update('chat');
		
		return $query->result_array();
	}

	public function insertBookingReview($data){
		$this->db->set('booking_review', $data['review']);
		$this->db->where('id', $data['booking_id']);
		$this->db->update('bookings');
	}

	public function insertBookingRating($data){
		$this->db->set('bookings_id', $data['booking_id']);
		$this->db->set('orignal_list_id', $data['orignal_list_id']);
		$this->db->set('users_id', get_session('user_id'));
		$this->db->set('stars', $data['stars']);
		$this->db->set('review', $data['review']);
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->insert('bookings_rating');
	}

	public function get_list_mover_bookings(){
		$this->db->select('l.*, b.*');
		$this->db->from('bookings b');
		$this->db->join('booked_listings l', 'l.id = b.mover_id', 'left');
		$this->db->where('b.listings_id', 0);
		$this->db->where('b.parent_id !=', 0);
		// $this->db->where('b.booking_status', 1);
		$this->db->where('b.users_id', get_session('user_id'));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_mover_bookings($status){

		$this->db->select('l.*, b.*, b.id as booking_id');
		$this->db->select("users.first_name , users.last_name, users.phone , users.email");
		$this->db->from('bookings b');
		$this->db->join('booked_listings l', 'l.id = b.mover_id', 'left');
		$this->db->join('users', 'l.users_id = users.id', 'left');
		$this->db->where('b.listings_id', 0);
		$this->db->where('b.parent_id !=', NULL);
		$this->db->where_in('b.booking_status', $status);
		$this->db->where('b.users_id', get_session('user_id'));
		$this->db->order_by('b.id', 'desc');
		$query = $this->db->get();
		// echo $this->db->last_query();  exit;
		return $query->result_array();
	}


}