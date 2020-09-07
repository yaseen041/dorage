<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('chatting/chat_model');
	}

	public function user($post,$id){
		$user = $this->session->userdata('employee');
		$data['chat_with'] = $id;
		$data['post'] = $post;
		$data['chat_user'] = $this->chat_model->getUserDetail($id);
		$data['user'] = $id;
		$data['messages'] = $this->chat_model->getChatMessage($data);
		krsort($data['messages']);
		$this->load->view('chatting/index', $data);
	}

	public function sendMessage(){
		$data = $this->input->post();
		$data['timeStamp'] = time();
		$this->chat_model->insertChatMessage($data);
		echo "true";
	}

	public function getMessage(){
		$data = $this->input->post();
		$data['messages'] = $this->chat_model->getChatMessage($data);
		$data['chatWith'] = $data['user'];
		$data['total_msg'] = count($data['messages']);
		$data['user_detail'] = singleRow('users', '*', 'id = '. $data['user']);
		krsort($data['messages']);
		$html = $this->load->view('chatting/ajaxChatbox', $data, true);
		$response = array('html' => $html, 'total_msg' => $data['total_msg'], 'user' => $data['user_detail']);
		echo json_encode($response);
	}

	public function notifications(){
		$notifications = $this->chat_model->getChatNotification();
		echo $notifications;
	}

	public function sideBarUpdate(){
		$html = $this->load->view('chatting/ajaxRecentChats', '', true);
		echo json_encode($html);
	}

	public function getAgreement(){
		$data = $this->input->post();
		if (!empty($this->session->userdata('employee'))) {
			$user = $this->session->userdata('employee');
		}else{
			$user = $this->session->userdata('employer');
		}
		if (isAdOwner($user['user_id'],$data['dataPostID'])){
			$detail = getAgreementDetail($user['user_id'],$data['dataPostID']);
			if (empty($detail)) {
				echo "<button class='btn btn-mini btn-primary adAgreement' data-post=".$data['dataPostID']." data-id=".$user['user_id']." data-employee-id=".$data['dataId'].">Agree</button>";
				
			}elseif($detail['employee_id'] == $data['dataId']){
				if (isAgreementSigned($user['user_id'],$data['dataId'],$data['dataPostID'])) {
					if ($detail['employee_agree'] == 0) { 
						echo "<button class='btn btn-mini btn-primary disabled'>Agreed</button> <button class='btn btn-mini btn-danger cancelAgreement' data-agreement-id=".$detail['ad_id'].">Cancel</button>";
					}else{
						echo "<button class='btn btn-mini btn-primary disabled'>Agreed</button>";
					}
				}else{
					echo "<button class='btn btn-mini btn-primary adAgreement' data-post=".$data['dataPostID']." data-id=".$user['user_id']." data-employee-id=".$data['dataId'].">Agree</button>";
				}
			}
		}else if(hasEmployeeAgreement($user['user_id'],$data['dataPostID'])){
			if (checkEmployeeAgreement($user['user_id'],$data['dataPostID'])) {
				echo "<button class='btn btn-mini btn-primary disabled'>Agreed</button>";
			}else{
				echo "<button class='btn btn-mini btn-primary adEmployeeAgreement' data-post=".$data['dataPostID'].">Agree</button> <button class='btn btn-mini btn-danger cancelEmployeeAgreement' data-post-id=".$data['dataPostID'].">Cancel</button>";
			}
		}
	}

}

/* End of file Chat.php */
/* Location: ./application/modules/Chat/controllers/Chat.php */