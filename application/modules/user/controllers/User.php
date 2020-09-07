<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('user_logged_in'))
		{
			set_session('from_checkout' , false);
			redirect(base_url().'login');
		}
		$this->load->model('dashboard_model');
	}
	public function index()
	{	
		$data['user_detail'] = $this->dashboard_model->get_user_detail();
		$this->load->view('dashboard' , $data);
	}
	public function dashboard()
	{	
		$data['user_detail'] = $this->dashboard_model->get_user_detail();
		$this->load->view('dashboard' , $data);
	}
	public function bookings_needer()
	{	
		$data['comp_bookings'] = $this->dashboard_model->get_bookings(array('1'));
		$data['cancel_bookings'] = $this->dashboard_model->get_bookings(array('3'));
		$data['refund_bookings'] = $this->dashboard_model->get_bookings(array('4'));
		$data['completed_bookings'] = $this->dashboard_model->get_bookings(array('2','5'));
		$data['mover_bookings'] = $this->dashboard_model->get_mover_bookings(array('1'));
		$data['mover_cancelled'] = $this->dashboard_model->get_mover_bookings(array('3'));
		$data['refunded_mover_bookings'] = $this->dashboard_model->get_mover_bookings(array('4'));
		$data['completed_mover_bookings'] = $this->dashboard_model->get_mover_bookings(array('2','5'));
		$data['list_mover_bookings'] = $this->dashboard_model->get_list_mover_bookings();

		$this->load->view('bookings_needer' , $data);
	}


	public function bookings_provider()
	{	
		$data['comp_bookings'] = $this->dashboard_model->get_bookings_provider(array('1'));
		$data['cancel_bookings'] = $this->dashboard_model->get_bookings_provider(array('3','4'));
		$data['completed_bookings'] = $this->dashboard_model->get_bookings_provider(array('2','5'));
		$data['mover_active'] = $this->dashboard_model->get_booked_mover(array('1'));
		$data['mover_cancelled'] = $this->dashboard_model->get_booked_mover(array('3','4'));
		$data['mover_completed'] = $this->dashboard_model->get_booked_mover(array('2','5'));
		$this->load->view('bookings_provider' , $data);
	}

	public function get_mover_detail()
	{
		$data = $_POST;


		$data['mover_detail'] = $this->dashboard_model->get_mover_detail($data['booking_id']);
		
		if(!empty($data['mover_detail'])){
			$response = $this->load->view('booked_mover_detail_ajax', $data, TRUE);
			$finalResult = array('msg' => 'success', 'response'=>$response);
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'success', 'response'=>"<p style='color:red;'>Mover detail not found.</p>");
			echo json_encode($finalResult);
			exit;
		}

	}
	public function profile()
	{	
		$data['user_detail'] = $this->dashboard_model->get_user_detail();
		$this->load->view('profile' , $data);
	}

	public function edit_profile()
	{	
		$data['user_detail'] = $this->dashboard_model->get_user_detail();
		$this->load->view('edit_profile' , $data);
	}

	public function settings()
	{	
		$data['user_detail'] = $this->dashboard_model->get_user_detail();
		$this->load->view('settings' , $data);
	}

	public function inbox()
	{	
		$data['user_detail'] = $this->dashboard_model->get_user_detail();
		$data['messages'] = getRecentChats();
		$data['first_messages'] = array();
		if (!empty($data['messages'])) {
			$arr = reset($data['messages']);
			if (!empty($arr)) {
				$data['first_messages'] = $this->dashboard_model->getMessages($arr);
			}
		}
		// show($data['first_messages']);exit;
		$this->load->view('inbox' , $data);
	}

	public function listings()
	{	
		$data['storage_listings'] = $this->dashboard_model->get_storage_listings();
		$data['mover_listings'] = $this->dashboard_model->get_mover_listings();
		$this->load->view('my_listings' , $data);
	}



	public function update_user()
	{
		$data = $_POST;

		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
		$this->form_validation->set_rules('dob', 'Date of birth', 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address1', 'Street Address Line 1', 'trim|required|xss_clean');

		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
		$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
		$this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');

		$this->form_validation->set_rules('about', 'Describe yourself', 'trim|required|xss_clean');
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'trim|required|xss_clean|valid_email');


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->dashboard_model->update_details($data);
			if($status){
				$this->session->set_userdata('profile_updated' , 1);
				$finalResult = array('msg' => 'success', 'response'=>'<p>profile successfully updated.</p>');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong!</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}

	public function change_email()
	{
		$data = $_POST;
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'This email already associated with another account.'));
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		}
		$status = $this->dashboard_model->change_email($data);
		// if($status){

		$data['user_detail'] = $this->dashboard_model->get_user_detail();

		$data['unique_id'] = $data['user_detail']['unique_id'];
			// show($data);exit;
			// $this->send_email_to_user();
		$this->send_change_email($data);

		$finalResult = array('msg' => 'success', 'response'=>'<p>Please check your email inbox to complete process.</p>');
		echo json_encode($finalResult);
		exit;
		// }else{
		// 	$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong!</p>');
		// 	echo json_encode($finalResult);
		// 	exit;
		// }


	}

	public function update_password()
	{
		$data = $_POST;
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|callback_check_old_password');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[password]|xss_clean');
		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{
			$status = $this->dashboard_model->update_password($data);
			if($status){

				$this->send_password_email();

				$finalResult = array('msg' => 'success', 'response'=>'<p>Your Password Successfully Changed!</p>');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong!</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}
	public function check_old_password()
	{
		$data = $_POST;
		$status = $this->dashboard_model->check_old_password($data);
		if ($status > 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_old_password', 'Old Password is Wrong.');
			return FALSE;
		}	
	}

	public function notify_setting()
	{
		$data = $_POST;

		// if(empty($data)){
		// 	$finalResult = array('msg' => 'error', 'response'=>'<p>Please select at least one notification type.</p>');
		// 	echo json_encode($finalResult);
		// 	exit;
		// }

		$status = $this->dashboard_model->notify_setting($data);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'<p>Notification settings has been changed.</p>');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong! Please try again.</p>');
			echo json_encode($finalResult);
			exit;
		}
	}

	public function update_dp()
	{

		$data['profile_dp'] = '';

		if(!empty($_FILES['profile_dp']['name'])){

			$config['upload_path']          = FCPATH.'assets/profile_pictures/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 5000;
			$config['max_width']            = 600;
			$config['max_height']           = 600;
			$config['encrypt_name'] 		= TRUE;

			$this->load->library('upload', $config);

			if($this->upload->do_upload('profile_dp'))
			{
				$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
				$data['profile_dp'] = $upload_data['file_name'];

				$status = $this->dashboard_model->update_profile_dp($data);
				if ($status) {

					$array=array(
						'profile_pic'=>$data['profile_dp'],
					);

					$this->session->set_userdata($array);

					$response_arr = array(
						'msg'=> 'success',
						'response'=> 'Your Profile picture successfully updated.',
					);
					echo json_encode($response_arr);
					exit;

				}else{
					$finalResult = array('msg' => 'error', 'response'=>"Something went wrong.");
					echo json_encode($finalResult);
					exit;
				}

			}else{
				$finalResult = array('msg' => 'error', 'response'=> $this->upload->display_errors());
				echo json_encode($finalResult);
				exit;
			} 

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Please select a picture.");
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function set_price_publish()
	{
		$data = $_POST;

		$status = $this->dashboard_model->set_price_publish($data);

		if($status > 0){

			$this->send_email_price_set($data);

			$finalResult = array('msg' => 'success', 'response'=>"Price successfully set and storage published.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}
	public function deactive_list()
	{
		$data = $_POST;

		$status = $this->dashboard_model->set_deactive_list($data);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"List has been successfully deactivated.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function delete_list()
	{
		$data = $_POST;

		$status = $this->dashboard_model->set_delete_list($data);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"List has been successfully deleted.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}


	public function owner_cancel_booking()
	{
		$data = $_POST;

		$booking_detail = $this->dashboard_model->get_booking_detail($data['booking_id']);

		$time_dif = get_time_difference($booking_detail['booking_date']);
		$cancel_time = get_cancellation_policy(get_booked_meta_value('cancellation_policy' , @$data['list_id']));
		if($time_dif < $cancel_time) {

			$status = $this->dashboard_model->owner_cancel_booking($data , $booking_detail);

			if($status > 0){

				$booking_detail = $this->dashboard_model->get_booking_detail($data['booking_id']);

				$this->send_email_to_needer($booking_detail);

				$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
				echo json_encode($finalResult);
				exit;

			} else {
				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
				echo json_encode($finalResult);
				exit;
			}

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Sorry you can't perform this action because cancellation time is past.");
			echo json_encode($finalResult);
			exit;
		}

	}


	public function owner_cancel_mover_booking()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->dashboard_model->get_booking_detail($data['booking_id']);

		// $time_dif = get_time_difference($booking_detail['booking_date']);
		// $cancel_time = get_cancellation_policy(get_booked_meta_value('cancellation_policy' , @$data['list_id']));
		// if($time_dif < $cancel_time) {

		$status = $this->dashboard_model->owner_cancel_booking($data , $data['booking_detail']);

		if($status > 0){

			$data['booking_detail'] = $this->dashboard_model->get_booking_detail($data['booking_id']);

			$this->send_email_to_needer($data['booking_detail'] );

			$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}



	public function needer_cancel_only_mover_booking()
	{
		$data = $_POST;

		$status = $this->dashboard_model->needer_cancel_only_mover_booking($data);

		if($status > 0){

			$data['booking_detail'] = $this->dashboard_model->get_booking_detail($data['booking_id']);

			$owner_detail = $this->dashboard_model->get_list_owner_detail($data['booking_detail']['mover_id']);

			$this->send_email_to_provider($data['booking_detail'] , $owner_detail);
			$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
			echo json_encode($finalResult);
			exit;

		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;

		}
	}


	public function needer_cancel_booking()
	{
		$data = $_POST;

		$booking_detail = $this->dashboard_model->get_booking_detail($data['booking_id']);

		$time_dif = get_time_difference($booking_detail['booking_date']);

		$cancel_time = get_cancellation_policy(get_booked_meta_value('cancellation_policy' , @$booking_detail['listings_id']));


		if($time_dif < $cancel_time) {

			$status = $this->dashboard_model->needer_cancel_booking($data);

			if($status > 0){

				$booking_detail = $this->dashboard_model->get_booking_detail($data['booking_id']);

				$owner_detail = $this->dashboard_model->get_list_owner_detail($booking_detail['listings_id']);
				$this->send_email_to_provider($booking_detail , $owner_detail);

				if($booking_detail['mover_needed'] == 1 && check_mover_status($data['booking_id']) == 1) {

					$status = $this->dashboard_model->needer_cancel_list_mover_booking($data);

					if($status > 0){

						$booking_mover = $this->dashboard_model->get_mover_detail($booking_detail['id']);
						$owner_detail = $this->dashboard_model->get_list_owner_detail($booking_mover['mover_id']);

						$this->send_email_to_mover_provider($booking_mover , $owner_detail);
					}
				}

				$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
				echo json_encode($finalResult);
				exit;

			} else {
				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
				echo json_encode($finalResult);
				exit;
			}

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Sorry you can't perform this action because cancellation time is past.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function needer_cancel_mover_booking()
	{
		$data = $_POST;

		$booking_detail = $this->dashboard_model->get_booking_mover_detail($data['booking_id']);

		$status = $this->dashboard_model->needer_cancel_mover_booking($booking_detail);

		if($status > 0){

			$booking_detail = $this->dashboard_model->get_booking_mover_detail($data['booking_id']);

			$owner_detail = $this->dashboard_model->get_list_owner_detail($booking_detail['mover_id']);
			$this->send_email_to_provider($booking_detail , $owner_detail);

			if($booking_detail['mover_needed'] == 1) {
				
				$status = $this->dashboard_model->needer_cancel_list_mover_booking($data);

				if($status > 0){
					$booking_mover = $this->dashboard_model->get_mover_detail($booking_detail['id']);
					$owner_detail = $this->dashboard_model->get_list_owner_detail($booking_mover['mover_id']);
					$this->send_email_to_mover_provider($booking_mover , $owner_detail);
				}
			}

			$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}

	public function send_change_email($data)
	{
		$to = $data['user_detail']['email'];
		$subject = "Change Email Request";

		$unique_id = $data['unique_id'];

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.get_session("username").', </b> </legend>
		<br>
		<p>Please confirm that your email address is correct to continue. click the link below to change email. <br> <a href="'.base_url().'home/change_email/'.$unique_id.'">'.base_url().'home/change_email/'.$unique_id.'</a></p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}
	public function send_email_to_needer($detail)
	{
		$to = $detail['email'];
		$subject = "Booking Cancelled";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$detail["first_name"]." ".$detail["last_name"].', </b> </legend>
		<br>
		<p>Your booking has been cancelled by provider.</p>
		<p>Booking REF #'.$detail['id'].'</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}

	public function send_email_to_provider($b_detail , $o_detail)
	{
		$to = $o_detail['email'];
		$subject = "Booking Cancelled";


		if(!empty($b_detail['parent_id'])) {
			$b_detail['id'] = $b_detail['parent_id'];
		}

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$o_detail["first_name"]." ".$o_detail["last_name"].', </b> </legend>
		<br>
		<p>Booking has been cancelled by needer.</p>
		<p>Booking REF #'.$b_detail['id'].'</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}


	public function send_email_to_mover_provider($b_detail , $o_detail)
	{
		$to = $o_detail['email'];
		$subject = "Booking Cancelled";


		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$o_detail["first_name"]." ".$o_detail["last_name"].', </b> </legend>
		<br>
		<p>Booking has been cancelled by needer.</p>
		<p>Booking REF #'.$b_detail['parent_id'].'</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}


	public function send_password_email()
	{
		$data = array();
		$to = get_session('email');
		$subject = "Password Changed";

		$body = $this->load->view('change_pass_email.php' , $data,TRUE);
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}

	public function send_email_price_set($data)
	{
		$list_detail = $this->dashboard_model->get_detail($data['unique_id']);

		$to = admin_email();
		$subject = "Storage space published and price is set";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		<p><strong> Storage Title :</strong> '.$list_detail["title"].' </p>
		<p><strong> Price/day :</strong> $'.$data["price"].' </p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}

	public function bookingReview(){
		$data = $this->input->post();
		$this->dashboard_model->insertBookingReview($data);
		$this->sendReviewEmailToAdmin($data);
		$finalResult = array('msg' => 'success', 'response'=> "Comment has been sent to admin.");
		echo json_encode($finalResult);
		exit;
	}

	public function bookingRating(){
		$this->security->xss_clean($this->input->post());
		$data = $this->input->post();
		// echo "<pre>";
		// print_r($data);exit;
		$this->dashboard_model->insertBookingRating($data);
		// $this->sendReviewEmailToAdmin($data);
		$finalResult = array('msg' => 'success', 'response'=> "Review has been added successfully.");
		echo json_encode($finalResult);
		exit;
	}

	public function sendReviewEmailToAdmin($data){

		$to = admin_email();
		$subject = "User Comment Against booking ref # ".$data['booking_id'];

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		<p>'.get_session("username").' has posted a comment against booking.</p>
		<p><strong> Booking REF # </strong> '.$data["booking_id"].'</p>
		<p><strong> Comment :</strong> '.$data["review"].' </p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

}