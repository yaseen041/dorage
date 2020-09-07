<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mover extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(get_section_content('mover' , 'mover_provide') == '0'){
			show_404();
		}
		$this->load->model('add_mover_model');
	}
	public function step1($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_mover_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_mover_model->get_detail($unique_id);
		} else {
			$data['stp_detail'] = array();
		}

		$this->load->view('mover_step1' , $data);
	}


	public function step2($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_mover_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_mover_model->get_detail($unique_id);
		} else {
			$data['stp_detail'] = array();
		}

		$this->load->view('mover_step2' , $data);
	}



	public function step3($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_mover_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_mover_model->get_detail($unique_id);
		} else {
			$data['stp_detail'] = array();
		}
		$this->load->view('mover_step3' , $data);
	}


	public function back_to_step1()
	{	
		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_mover_model->get_detail($_POST['unique_id']);
			
		} else {
			$data['stp_detail'] = array();
		}

		$response = $this->load->view('mover_step1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/step1/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function edit_mover($unique_id = '')
	{

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_mover_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_mover_model->get_detail($unique_id);
		} else {
			$data['stp_detail'] = array();
		}
		$this->load->view('mover_update' , $data);
	}

	public function update_step1_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_mover_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('update_mover_step1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}


	public function update_step1()
	{
		$data = $_POST;

		$this->form_validation->set_rules('mover_title', 'Mover Title', 'trim|required|xss_clean', array('required' => 'Please enter "Mover Title".'));

		$this->form_validation->set_rules('mover_description', 'Mover Description', 'trim|required|xss_clean', array('required' => 'Please write "Mover Description".'));

		$this->form_validation->set_rules('place', 'Zip Code', 'trim|required|xss_clean', array('required' => 'Please enter "Zip Code Location".'));


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;

		}else{

			$errors = '';

			foreach ($_POST['posted_data'] as $key => $value) {

				if(empty($value)) {
					echo $value;
					$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
				}
			}

			if(empty($data['lat_long'])){
				$errors .= 'Please enter valid "Zip Code Location".<br>';
			}

			if(!empty($errors)) {
				$finalResult = array('msg' => 'error', 'response'=>$errors);
				echo json_encode($finalResult);
				exit;
			}

			$list_id = $this->add_mover_model->update_stp1_after($data);


			if(!empty($_FILES['mover_image']['name'])){

				$config['upload_path']          = FCPATH.'assets/storage_images/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 5000;
				$config['max_width']            = 2050;
				$config['max_height']           = 1050;
				$config['encrypt_name'] 		= TRUE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('mover_image')){

					$upload_data = $this->upload->data();
					$data['mover_image'] = $upload_data['file_name'];

					$status = $this->add_mover_model->update_mover_image($data);

					$this->send_email_update_mover($data);

					$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
					echo json_encode($finalResult);
					exit;

				}else{

					$finalResult = array('msg' => 'error', 'response'=> $this->upload->display_errors());
					echo json_encode($finalResult);
					exit;
				}
			}

			if($list_id == 'info_changed') {

			// $data['updatein'] = 'space characteristics';

				$this->send_email_update_mover($data);

				$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
				echo json_encode($finalResult);
				exit;

			} elseif($list_id == 'already_changed') {

				$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
				echo json_encode($finalResult);
				exit;


			} else {

				$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
				echo json_encode($finalResult);
				exit;

			}

		}
	}

	public function update_step2_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_mover_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('update_mover_step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step2()
	{
		$data = $_POST;

		$errors = '';

		foreach ($_POST['posted_data'] as $key => $value) {

			if(empty($value)) {
				echo $value;
				$errors .=  ucwords(str_replace("_"," ",$key)).' field is required.<br>';
			}
		}


		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}

		if (!is_numeric($_POST['posted_data']['crew_charges']))
		{
			$finalResult = array('msg' => 'error', 'response'=>"Crew Charges must be numeric.");
			echo json_encode($finalResult);
			exit;
		}


		$list_id = $this->add_mover_model->update_stp2_after($data);

		if($list_id == 'info_changed') {

			// $data['updatein'] = 'space characteristics';

			$this->send_email_update_mover($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($list_id == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function step4($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_mover_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_mover_model->get_detail($unique_id);
		} else {
			$data['stp_detail'] = array();
		}
		$this->load->view('mover_step4' , $data);
	}



	public function back_to_step3()
	{	
		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_mover_model->get_detail($_POST['unique_id']);

		} else {
			$data['stp_detail'] = array();
		}



		$response = $this->load->view('mover_step3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/step3/".$data['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function back_to_step2()
	{	
		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_mover_model->get_detail($_POST['unique_id']);

		} else {
			$data['stp_detail'] = array();
		}

		$response = $this->load->view('mover_step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/step2/".$data['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function mover_review($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_mover_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}
		}

		$data['mover_detail'] = $this->add_mover_model->get_detail($unique_id);

		$this->load->view('mover_review' , $data);
	}

	public function unblock_booking_dates()
	{

		$data = $_POST;
		$status = $this->add_mover_model->unblock_booking_dates($data);

		if($status > 0) {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully unblocked.");
			echo json_encode($finalResult);
			exit;

		}else{
			$finalResult = array('msg' => 'error', 'response'=>"Somthing went wrong. please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}

	public function block_booking_dates()
	{

		$data = $_POST;
		$status = $this->add_mover_model->insert_block_booking_dates($data);

		if( !empty($status) ) {
			$finalResult = array('msg' => 'success', 'response'=>$status);
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Somthing went wrong. please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}


	public function submit_data()
	{
		$data = $_POST;

		if($_POST){

			if(!get_session('user_logged_in')){

				$finalResult = array('msg' => 'not_login', 'response' => 'Please login to proceed.');
				echo json_encode($finalResult);
				exit;

			} else {

				if(!empty($_POST['unique_id'])){

					$has_detail = $this->add_mover_model->check_detail($_POST['unique_id']);

					//echo $has_detail; exit;

					if(!$has_detail) {

						$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
						echo json_encode($finalResult);
						exit;
					}
				}

				if($data['form_id'] == 'mover_step1') {

					$this->form_validation->set_rules('mover_title', 'Mover Title', 'trim|required|xss_clean', array('required' => 'Please enter "Mover Title".'));

					$this->form_validation->set_rules('mover_description', 'Mover Description', 'trim|required|xss_clean', array('required' => 'Please write "Mover Description".'));

					$this->form_validation->set_rules('place', 'Zip Code', 'trim|required|xss_clean', array('required' => 'Please enter "Zip Code Location".'));


					if ($this->form_validation->run($this) == FALSE)
					{
						$finalResult = array('msg' => 'error', 'response'=>validation_errors());
						echo json_encode($finalResult);
						exit;

					}else{

						$errors = '';

						foreach ($_POST['posted_data'] as $key => $value) {

							if(empty($value)) {
								echo $value;
								$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
							}
						}

						if(empty($data['lat_long'])){
							$errors .= 'Please enter valid "Zip Code Location".<br>';
						}

						if(!empty($errors)) {
							$finalResult = array('msg' => 'error', 'response'=>$errors);
							echo json_encode($finalResult);
							exit;
						}

						if($_POST['unique_id'] != ''){

							$data['unique_id'] = $_POST['unique_id'];
							$list_id = $this->add_mover_model->update_stp1($data);

						}else{

							$data['unique_id'] = md5(uniqid());
							$list_id = $this->add_mover_model->insert_stp1($data);
						}

						if($data['unique_id'] != ''){
							$data['stp_detail'] = $this->add_mover_model->get_detail($data['unique_id']);
						} else {
							$data['stp_detail'] = array();
						}

						if(!empty($_FILES['mover_image']['name'])){

							$config['upload_path']          = FCPATH.'assets/storage_images/';
							$config['allowed_types']        = 'gif|jpg|png|jpeg';
							$config['max_size']             = 5000;
							$config['max_width']            = 1950;
							$config['max_height']           = 1050;
							$config['encrypt_name'] 		= TRUE;

							$this->load->library('upload', $config);

							if($this->upload->do_upload('mover_image')){

								$upload_data = $this->upload->data();
								$data['mover_image'] = $upload_data['file_name'];
								$data['list_id'] = $list_id;

								$status = $this->add_mover_model->upload_mover_image($data);
							}else{

								$finalResult = array('msg' => 'error', 'response'=> $this->upload->display_errors());
								echo json_encode($finalResult);
								exit;
							}
						}


						$response = $this->load->view('mover_step2_ajax', $data, TRUE);

						$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/step2/".$data['unique_id']);
						echo json_encode($finalResult);
						exit;

					}

				} elseif($data['form_id'] == 'mover_step2') { 

					$errors = '';

					foreach ($_POST['posted_data'] as $key => $value) {

						if(empty($value)) {
							echo $value;
							$errors .=  ucwords(str_replace("_"," ",$key)).' field is required.<br>';
						}
					}


					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}

					if (!is_numeric($_POST['posted_data']['crew_charges'])) // '/[^a-z\d]/i' should also work.
					{
						$finalResult = array('msg' => 'error', 'response'=>"Crew Charges must be numeric.");
						echo json_encode($finalResult);
						exit;
					}


					$status = $this->add_mover_model->insert_stp2($data);

					$data['stp_detail'] = $this->add_mover_model->get_detail($_POST['unique_id']);

					$response = $this->load->view('mover_step3_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/step3/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'mover_step3') { 

					$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'trim|required|xss_clean|valid_email');


					if ($this->form_validation->run($this) == FALSE)
					{
						$finalResult = array('msg' => 'error', 'response'=>validation_errors());
						echo json_encode($finalResult);
						exit;

					}else{

						$status = $this->add_mover_model->insert_step3($data);

						$data['stp_detail'] = $this->add_mover_model->get_detail($data['unique_id']);

						$response = $this->load->view('mover_step4_ajax', $data, TRUE);

						$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/step4/".$_POST['unique_id']);
						echo json_encode($finalResult);
						exit;
					}

				} elseif($data['form_id'] == 'mover_step4') {

					$status = $this->add_mover_model->insert_step4($data);

					$data['mover_detail'] = $this->add_mover_model->get_detail($data['unique_id']);

					$this->send_email($data);

					$response = $this->load->view('mover_review_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/mover/mover_review/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;


				}
			}
		}
	}

	public function mover_publish()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->add_mover_model->mover_publish($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully published");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function mover_unpublish()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->add_mover_model->mover_unpublish($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully unpublished");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}


	public function send_email_update_mover($data)
	{
		$to = admin_email();

		$list_detail = $this->add_mover_model->get_detail($data['unique_id']);

		$this->load->library('email');

		$this->email->from('.no_reply_email().');
		$this->email->to(admin_email());

		$this->email->subject('List Update From Mover Provider');

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		'.$list_detail["first_name"].' '.$list_detail["last_name"].' has recently updated his/her listing please review and active his/her list.

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		$this->email->message($body);

		$this->email->set_mailtype("html");

		$this->email->send();
	}


	public function send_email($data)
	{

		$to = admin_email();
		$subject = "New Mover Added";

		$mover_detail = $this->add_mover_model->get_detail($data['unique_id']);

		$split = str_split($mover_detail['description'], 210);
		$final = $split[0] . "...";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		New mover has been added.

		<p><strong> Title :</strong> '.$mover_detail["title"].' </p>
		<p><strong> Description :</strong> $'.$final.' </p>

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
}