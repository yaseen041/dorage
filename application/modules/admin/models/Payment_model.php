<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

	public function getPaymentsReleased(){
		$this->db->select('bp.*, concat(u.first_name, " ",u.last_name) as owner_name, u.email as owner_email');
		$this->db->from('bookings_payment bp');
		$this->db->join('users u', 'u.id = bp.users_id', 'left');
		$this->db->join('bookings b', 'b.id = bp.bookings_id', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}	

}

/* End of file Payment_model.php */
/* Location: ./application/modules/admin/models/Payment_model.php */