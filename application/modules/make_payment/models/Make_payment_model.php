<?php 
class Make_payment_model extends CI_Model
{
	public function get_booking_details($booking_id)
	{
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('unique_id', $booking_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function get_booking_mover_details($booking_id)
	{
		$this->db->select('bookings.*');
		$this->db->select('booked_listings.title');
		$this->db->from('bookings');
		$this->db->join('booked_listings', 'booked_listings.id = bookings.mover_id', 'left');
		$this->db->where('bookings.unique_id', $booking_id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function deposit_amount($amount,$payment_status,$trx_id,$payer_email)
	{

		$this->db->trans_start();
		
		$this->db->set('trx_id', $trx_id); 	
		$this->db->set('payer_email', $payer_email);
		$this->db->set('payment_status', $payment_status); 
		$this->db->set('booking_status',1); 
		$this->db->set('paid_amount', $amount);
		$this->db->set('payment_method', 'paypal');
		$this->db->where('unique_id', get_session('payment_id'));
		$query = $this->db->update('bookings');


		$this->db->select('id');
		$this->db->where('unique_id', get_session('payment_id'));
		$query1 = $this->db->get('bookings')->row_array();

		$this->db->set('payment_method', 'paypal');
		$this->db->set('booking_status',1);
		$this->db->set('payment_status', $payment_status); 
		$this->db->where('parent_id', $query1['id']);
		$query = $this->db->update('bookings');

		$this->db->trans_complete();

        if($this->db->trans_status() === true){
            return true;    
        }
        else{
            return false;   
        }	
	}

	public function get_list_detail($list_id)
	{
		$this->db->select("booked_listings.title");
		$this->db->select("users.first_name,users.last_name,users.email");
		$this->db->from("booked_listings");
		$this->db->join('users', 'users.id = booked_listings.users_id', 'left');
		$this->db->where('booked_listings.id' ,$list_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function get_mover_list_detail($parent_id)
	{
		$this->db->select("mover_id");
		$this->db->from("bookings");
		$this->db->where('parent_id' ,$parent_id);
		$parent = $this->db->get()->row_array();

		$this->db->select("booked_listings.title");
		$this->db->select("users.first_name,users.last_name,users.email");
		$this->db->from("booked_listings");
		$this->db->join('users', 'users.id = booked_listings.users_id', 'left');
		$this->db->where('booked_listings.id' ,$parent['mover_id']);
		$query = $this->db->get()->row_array();
		return $query;
	}

}

?>