<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	   		//Do your magic here
	}
	public function get_bookings($status = '')
	{
		$this->db->where('listings_id !=' , 0);
		$this->db->where('payment_status' , 1);
		$this->db->where('booking_status' , $status);
		$this->db->order_by("id", "DESC");
		$result = $this->db->get('bookings')->result_array();
		return $result;
	}
	public function get_released_bookings()
	{
		$this->db->where('listings_id !=' , 0);
		$this->db->where('payment_status' , 1);
		$this->db->where_in('booking_status' , array('2' , '3') );
		$this->db->order_by("id", "DESC");
		$result = $this->db->get('bookings')->result_array();
		return $result;
	}

	public function get_booking_detail($data)
	{
		$this->db->select("bookings.*");
		$this->db->select("users.first_name,users.last_name,users.email,users.phone,users.profile_dp");
		$this->db->from("bookings");
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.unique_id' , $data['booking_id']);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function check_sortage_payment($booking_id)
	{
		$this->db->select("storage_payment_release");
		$this->db->where('id', $booking_id);
		$result = $this->db->get('bookings')->row_array();
		return $result['storage_payment_release'];
	}

	public function check_mover_payment($booking_id)
	{
		$this->db->select("mover_payment_release");
		$this->db->where('id', $booking_id);
		$result = $this->db->get('bookings')->row_array();
		return $result['mover_payment_release'];
	}

	public function check_customer_payment($booking_id)
	{
		$this->db->select("customer_refund");
		$this->db->where('id', $booking_id);
		$result = $this->db->get('bookings')->row_array();
		return $result['customer_refund'];
	}

	public function mark_completed($booking_id)
	{
		$this->db->set('booking_status' ,2);
		$this->db->where('unique_id' , $booking_id);
		$query = $this->db->update('bookings');
		return $this->db->affected_rows();
	}

	public function mark_released($booking_id)
	{
		$this->db->set('booking_status' ,5);
		$this->db->where('id' , $booking_id);
		$query = $this->db->update('bookings');
		return $this->db->affected_rows();
	}

	public function mark_refunded($booking_id)
	{
		$this->db->set('booking_status' ,4);
		$this->db->where('id' , $booking_id);
		$query = $this->db->update('bookings');
		return $this->db->affected_rows();
	}

	public function get_storage_detail($booking_id)
	{
		$this->db->select("users.paypal_email , booked_listings.users_id");
		$this->db->select("bookings.booking_start, bookings.booking_end, bookings.list_price");
		$this->db->from("bookings");
		$this->db->join('booked_listings', 'bookings.listings_id = booked_listings.id', 'left');
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('bookings.id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result;
	}
	public function is_customer_refund($booking_id)
	{
		$this->db->select("customer_refund");
		$this->db->from("bookings");
		$this->db->where('id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result['customer_refund'];

	}
	public function get_payment_detail_for_mover($booking_id)
	{
		$this->db->select("users.paypal_email , booked_listings.users_id");
		$this->db->select("bookings.no_crews, bookings.no_hours, bookings.crew_charges, bookings.mover_price");
		$this->db->from("bookings");
		$this->db->join('booked_listings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('bookings.parent_id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function get_payment_detail_for_single_mover($booking_id)
	{
		$this->db->select("users.paypal_email , booked_listings.users_id");
		$this->db->select("bookings.no_crews, bookings.no_hours, bookings.crew_charges, bookings.mover_price");
		$this->db->from("bookings");
		$this->db->join('booked_listings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('bookings.id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result;
	}
	public function get_payment_detail_for_mover_customer($booking_id)
	{
		$this->db->select("users.paypal_email");
		$this->db->select("bookings.users_id, bookings.no_crews, bookings.no_hours, bookings.crew_charges, bookings.mover_price");
		$this->db->from("bookings");
		// $this->db->join('booked_listings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.parent_id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function get_payment_detail_for_mover_only_customer($booking_id)
	{
		$this->db->select("users.paypal_email");
		$this->db->select("bookings.users_id, bookings.no_crews, bookings.no_hours, bookings.crew_charges, bookings.mover_price");
		$this->db->from("bookings");
		// $this->db->join('booked_listings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function get_refund_detail_for_customer($booking_id)
	{
		$this->db->select("users.paypal_email");
		$this->db->select("bookings.*");
		$this->db->from("bookings");
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.id' , $booking_id);
		$result = $this->db->get()->row_array();
		return $result;

	}

	public function get_list_detail($id)
	{
		$this->db->select("booked_listings.*");
		$this->db->select("users.first_name,users.last_name,users.email,users.phone,users.profile_dp");
		$this->db->from("booked_listings");
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('booked_listings.id' ,$id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_mover_detail($id)
	{
		$this->db->select("booked_listings.*");
		$this->db->select("bookings.*");
		$this->db->select("users.first_name,users.last_name,users.email,users.phone,users.profile_dp");
		$this->db->from("booked_listings");
		$this->db->join('bookings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'booked_listings.users_id = users.id', 'left');
		$this->db->where('bookings.parent_id' ,$id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_mover_booking_detail($id)
	{
		$this->db->select("booked_listings.*");
		$this->db->select("bookings.*");
		$this->db->select("users.first_name,users.last_name,users.email,users.phone,users.profile_dp");
		$this->db->from("booked_listings");
		$this->db->join('bookings', 'bookings.mover_id = booked_listings.id', 'left');
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.parent_id' ,$id);
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

	public function get_booking_detail_by_id($booking_id)
	{
		$this->db->select("bookings.*");
		$this->db->select("users.first_name , users.last_name, users.email");
		$this->db->from("bookings");
		$this->db->join('users', 'bookings.users_id = users.id', 'left');
		$this->db->where('bookings.id' ,$booking_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function cancel_booking($data)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',2);
		$this->db->set('cancell_reason',$data['cancell_reason']);
		$this->db->where('id', $data['booking_id']);
		$query = $this->db->update('bookings');

		return $this->db->affected_rows();
	}

	public function review_approve($data)
	{
		$this->db->set('status',1);
		$this->db->where('id', $data['review_id']);
		$query = $this->db->update('bookings_rating');

		return $this->db->affected_rows();
	}

	public function review_disapprove($data)
	{
		$this->db->set('status',0);
		$this->db->where('id', $data['review_id']);
		$query = $this->db->update('bookings_rating');

		return $this->db->affected_rows();
	}


	function cancel_list_mover_booking($data)
	{
		$this->db->set('booking_status',3);
		$this->db->set('cancelled_by',2);
		$this->db->set('cancell_reason',$data['cancell_reason']);
		$this->db->where('parent_id', $data['booking_id']);
		$query = $this->db->update('bookings');

		$result = $this->db->affected_rows();


		$this->db->set('mover_needed',2);
		$this->db->where('id', $data['booking_id']);
		$query = $this->db->update('bookings');


		return $result;
	}

	public function insertPaymentReleaseToStorage($data){

		$this->db->set('users_id', $data['user_id']);
		$this->db->set('trx_id', $data['tran_id']);
		$this->db->set('bookings_id', $data['booking_id']);
		$this->db->set('total_amount', $data['total_amount']);
		$this->db->set('amount', $data['amount']);
		$this->db->set('profit', ($data['total_amount'] - $data['amount']));
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->set('payment_type', 'released');
		$this->db->insert('bookings_payment');


		$this->db->set('booking_status', 5);
		$this->db->set('storage_payment_release', 1);
		$this->db->where('id', $data['booking_id']);
		$this->db->update('bookings');

		return true;
	}

	public function insertPaymentReleaseToMover($data) {

		$detail = $this->get_booking_detail_by_id($data['booking_id']);

		$this->db->set('users_id', $data['user_id']);
		$this->db->set('trx_id', $data['tran_id']);

		if($detail['parent_id'] > 0){
			$this->db->set('bookings_id', $detail['parent_id']);
		} else {
			$this->db->set('bookings_id', $data['booking_id']);
		}

		$this->db->set('total_amount', $data['total_amount']);
		$this->db->set('amount', $data['amount']);
		$this->db->set('profit', ($data['total_amount'] - $data['amount']));
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->set('payment_type', 'released');
		$this->db->insert('bookings_payment');


		$this->db->set('mover_payment_release', 1);
		if($detail['customer_refund'] == 1) {
			$this->db->set('booking_status', 5);
		}
		$this->db->where('id', $data['booking_id']);
		$this->db->update('bookings');

		return true;
	}

	public function insertPaymentReleaseToCustomer($data){

		$detail = $this->get_booking_detail_by_id($data['booking_id']);


		$this->db->set('users_id', $data['user_id']);
		$this->db->set('trx_id', $data['tran_id']);
		if($data['booking_detail']['parent_id'] > 0){
			$this->db->set('bookings_id', $data['booking_detail']['parent_id']);
		} else {
			$this->db->set('bookings_id', $data['booking_id']);
		}
		$this->db->set('total_amount', $data['total_amount']);
		$this->db->set('amount', $data['amount']);
		$this->db->set('profit', ($data['total_amount'] - $data['amount']));
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->set('payment_type', 'refund');
		$this->db->insert('bookings_payment');

		if($detail['mover_payment_release'] == 1) {
			$this->db->set('booking_status', 5);
		}
		$this->db->set('customer_refund', 1);
		$this->db->where('id', $data['booking_id']);
		$this->db->update('bookings');

		return true;
	}

	public function insertPaymentonlyRefund($data){

		$detail = $this->get_booking_detail_by_id($data['booking_id']);


		$this->db->set('users_id', $data['user_id']);
		$this->db->set('trx_id', $data['tran_id']);
		if($data['booking_detail']['parent_id'] > 0){
			$this->db->set('bookings_id', $data['booking_detail']['parent_id']);
		} else {
			$this->db->set('bookings_id', $data['booking_id']);
		}
		$this->db->set('total_amount', $data['total_amount']);
		$this->db->set('amount', $data['amount']);
		$this->db->set('profit', ($data['total_amount'] - $data['amount']));
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->set('payment_type', 'refund');
		$this->db->insert('bookings_payment');

		$this->db->set('booking_status', 4);
		$this->db->set('customer_refund', 1);
		$this->db->where('id', $data['booking_id']);
		$this->db->update('bookings');

		return true;
	}


	public function insertPaymentRefund($data){

		$booking_detail = singleRow('bookings', '*', 'unique_id = "'.$data['booking_unique_id'].'"');
		$listing = singleRow('listings', '*', 'id = '.$booking_detail['listings_id']);
		$this->db->set('users_id', $booking_detail['users_id']);
		$this->db->set('trx_id', $data['tran_id']);
		$this->db->set('bookings_id', $booking_detail['id']);
		$this->db->set('total_amount', $data['total_amount']);
		$this->db->set('amount', $data['amount']);
		$this->db->set('profit', 0);
		$this->db->set('date_added', date('Y-m-d H:i:s'));
		$this->db->set('payment_type', 'refund');
		$this->db->insert('bookings_payment');
		$this->db->set('booking_status', 4);
		$this->db->where('id', $booking_detail['id']);
		$this->db->update('bookings');
	}
	public function get_mover_released_bookings()
	{
		$this->db->where('listings_id' , 0);
		$this->db->where('payment_status' , 1);
		$this->db->where_in('booking_status' , array('2' , '3'));
		// $this->db->where('parent_id' , 0);
		$this->db->order_by("id", "DESC");
		$result = $this->db->get('bookings')->result_array();
		return $result;
	}

	public function get_mover_refunded()
	{
		$this->db->where('listings_id' , 0);
		$this->db->where('payment_status' , 1);
		$this->db->where('booking_status' ,4);
		// $this->db->where('parent_id' , 0);
		$this->db->order_by("id", "DESC");
		$result = $this->db->get('bookings')->result_array();
		return $result;
	}

	public function get_mover_released()
	{
		$this->db->where('listings_id' , 0);
		$this->db->where('payment_status' , 1);
		$this->db->where('booking_status' ,5);
		// $this->db->where('parent_id' , 0);
		$this->db->order_by("id", "DESC");
		$result = $this->db->get('bookings')->result_array();
		return $result;
	}

	public function get_mover_bookings($status)
	{
		$this->db->where('listings_id' , 0);
		$this->db->where('payment_status' , 1);
		$this->db->where('booking_status' , $status);
			// $this->db->where('parent_id' , 0);
		$this->db->order_by("id", "DESC");
		$result = $this->db->get('bookings')->result_array();
		return $result;
	}

}

/* End of file user_model.php */
   /* Location: ./application/modules/admin/models/user_model.php */