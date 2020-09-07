<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

	public function getUserDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function insertChatMessage($data){
		$this->db->set('chat_from', get_session('user_id'));
		$this->db->set('chat_to', $data['chatwith']);
		$this->db->set('message', $data['message']);
		$this->db->set('sent', $data['timeStamp']);
		$this->db->set('chat_read', 0);
		$this->db->insert('chat');
	}

	public function getChatMessage($data){

		$this->db->select('c.*,  concat(u.first_name," ", u.last_name) as username, u.profile_dp as profile_dp, u2.profile_dp as profile_dp_other, concat(u2.first_name," ", u2.last_name) as username_other, l.title as listing_title');
		$this->db->from('chat c');
		$this->db->join('users u', 'u.id = c.chat_from', 'left');
		$this->db->join('users u2', 'u2.id = c.chat_to', 'left');
		$this->db->join('listings l', 'l.unique_id = c.listing_unique_id', 'left');
		$where = "(c.chat_from = ".get_session('user_id')." OR c.chat_to = ".get_session('user_id').")";
		$this->db->where($where);
		$where = "(c.chat_from = ".$data['user']." OR c.chat_to = ".$data['user'].")";
		$this->db->where($where);
		$this->db->order_by('c.sent', 'desc');
		$query = $this->db->get();

		$this->db->set('chat_read', 1);
		$this->db->where("chat_to", get_session('user_id'));
		$this->db->where("chat_from", $data['user']);
		$this->db->update('chat');
		
		return $query->result_array();
	}

	public function getChatNotification(){

		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where('chat_to', get_session('user_id'));
		$this->db->where('chat_read', 0);
		$query = $this->db->get();
		return $query->num_rows();
	}

}

/* End of file Chat_model.php */
/* Location: ./application/modules/Chat/models/Chat_model.php */