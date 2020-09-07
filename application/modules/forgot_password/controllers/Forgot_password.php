<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Forgot_password extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('forgot_model');
		if(get_session('user_logged_in'))
		{
			redirect(base_url());
		}	
	}
	public function index()
	{
		$this->load->view('forgot_password');
	}
	public function retrieve_password()
	{
	   $data = $_POST;
	   $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|callback_email_exist');
       
	   if ($this->form_validation->run($this) == FALSE)
	   	{
	   		$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;

	   	}else{
	   		
	   		$data['forgot_pass_key'] = md5(uniqid());

            $data['userdata'] = $this->forgot_model->get_user($data['email']);
            
	   		$status = $this->forgot_model->set_uniquekey($data['email'] , $data['forgot_pass_key']);
            
	   		if($status){
				$htmlresponse = $this->load->view('recover_pass_email', $data, TRUE);
				$this->send_confirmation_email( $data['email'] , $htmlresponse);    
				$finalResult = array('msg' => 'success', 'response'=>'<p>Please check your email inbox and follow the instructions. Thanks.</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
	   	}
	}
	public function email_exist($email)
	{
		if(empty($email)){
			$this->form_validation->set_message('email_exist', 'Email address is required.');
			return FALSE;
		}
		$email = $this->forgot_model->check_email($email);
		if ($email > 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('email_exist', 'This email is not exist.');
			return FALSE;
		}
	}

	public function send_confirmation_email($user_email , $email_body)
	{
		$to = $user_email;
		$subject = 'Recover Password';
		$body = $email_body;
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}
	public function reset_password()
	{   
		if(empty($_GET['email']) || empty($_GET['secret_key'])){
			redirect(base_url().'login','refresh');
		}

        $data['email'] = $_GET['email'];
        $data['forgot_pass_key'] = $_GET['secret_key'];
		$this->load->view('reset_password', $data, FALSE);
	}
	public function set_new_password()
	{
		$data = $_POST;

		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run($this) == FALSE)
	   	{
	   		$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
	   	}else{
	   		$status = $this->forgot_model->set_new_password($data);

	   		if($status > 0){
				$finalResult = array('msg' => 'success', 'response'=>"Your password has been changed successfully.");
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong!</p>');
				echo json_encode($finalResult);
				exit;
			}
	   	}
	}
}