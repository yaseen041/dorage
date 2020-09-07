<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Activation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('activation_model');	
	}
	public function confirm($activation_key = "")
	{
		if(empty($activation_key)){
			$this->session->set_flashdata('error_status' , "Some thing went wrong. Please try again!");
			redirect(base_url().'login','refresh');
		}
		$status = $this->activation_model->acctivate_account($activation_key);
		if($status > 0){
			
			$this->session->set_flashdata('activation_succ_status' , "Your account has been successfully activated.");
			redirect(base_url().'login');
		} else {
		   $this->session->set_flashdata('activation_error_status' , "Some thing went wrong. Please try again!");
           redirect(base_url().'login');
		}
	}
	public function resend()
	{
		$data = $_POST;
		$data['activation_key'] = md5(uniqid());
	   	$status = $this->activation_model->set_acctivation_key($data);
	   	if ($status > 0) {

	   		$data['userdata'] = $this->activation_model->get_detail($data['email']);

			$email_body = $this->load->view('activate_account_email' , $data,TRUE);

			$to = $data['email'];
			$subject = 'Account Activation';
			$body = $email_body;
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
			if(@mail($to,$subject,$body,$headers))
			{
				$finalResult = array('msg' => 'success', 'response'=>"<p>Activation email successfully sent. Please check your email and active your account. Thanks.</p>");
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
				echo json_encode($finalResult);
				exit;
			}
	   	} else {
	   		$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again or contact with kiwitokiwi support.");
			echo json_encode($finalResult);
			exit;
	   	}
	}
}