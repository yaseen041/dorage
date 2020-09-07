<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listings extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		$this->load->model(admin_controller().'admin_model');
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		$this->load->model(admin_controller().'list_model');	
	}
	public function storage()
	{	
		$data['storage_listings'] = $this->list_model->get_storage_listings('1');
		$this->load->view('storage' , $data);
	}
	public function inactive_storage()
	{	
		$data['storage_listings'] = $this->list_model->get_storage_listings('0');
		$this->load->view('inactive_storage' , $data);
	}
	public function updated_storages()
	{	
		$data['storage_listings'] = $this->list_model->get_updated_storage_listings();
		$this->load->view('updated_storages' , $data);
	}
	public function deleted_storages()
	{	
		$data['storage_listings'] = $this->list_model->get_deleted_storage_listings();
		$this->load->view('deleted_storages' , $data);
	}

	public function updated_movers()
	{	
		$data['mover_listings'] = $this->list_model->get_updated_mover_listings();
		$this->load->view('updated_movers' , $data);
	}

	public function deleted_movers()
	{	
		$data['mover_listings'] = $this->list_model->get_deleted_mover_listings();
		$this->load->view('deleted_movers' , $data);
	}

	public function mover()
	{	
		$data['mover_listings'] = $this->list_model->get_mover_listings('1');
		$this->load->view('mover', $data);
	}

	public function inactive_mover()
	{	
		$data['mover_listings'] = $this->list_model->get_mover_listings('0');
		$this->load->view('inactive_mover' , $data);
	}


	public function reviews()
	{	
		$data['reviews'] = $this->list_model->get_list_reviews();
		$this->load->view('manage_reviews' , $data);
	}

	public function mover_detail($unique_id = '')
	{
		if(empty($unique_id)) {
			show_404();
		}

		$data['mover_detail'] = $this->list_model->get_complete_detail($unique_id);
		$data['vehicles'] = $this->list_model->get_vehicles($data['mover_detail']['id']);

		if(empty($data['mover_detail'])) {
			show_404();
		}
		
		$this->load->view('mover_detail' , $data);
	}

	public function storage_detail($unique_id = '')
	{	
		if(empty($unique_id)){
			show_404();
		}

		$data['list_detail'] = $this->list_model->get_complete_detail($unique_id);
		$data['list_images'] = $this->list_model->get_list_images($data['list_detail']['id']);

		$data['basic_amenities'] = $this->list_model->get_storage_amenities($data['list_detail']['id'] , '0');
		$data['safety_amenities'] = $this->list_model->get_storage_amenities($data['list_detail']['id'] , '1');

		$data['basic_space_rules'] = $this->list_model->get_space_rules(0);
		$data['rules'] = $this->list_model->get_list_rules($data['list_detail']['id']);

		$data['extra_space_rules'] = $this->list_model->get_storage_space_rules($data['list_detail']['id'], '1');

		$data['additional_rules'] = $this->list_model->get_storage_additional_rules($data['list_detail']['id']);

		if(empty($data['list_detail'])) {
			show_404();
		}

		$this->load->view('storage_detail' , $data);
	}

	public function list_delete()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->list_delete($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully deleted.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function restore_list()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->restore_list($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully restored.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function list_permanent_delete()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->list_permanent_delete($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully permanent deleted.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function add_featured()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->add_featured($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully add featured.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function remove_featured()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->remove_featured($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully remove feature");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function add_banned()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->add_banned($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully banned.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function remove_banned()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->remove_banned($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully remove banned.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}
	public function update_price_active()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->update_price_active($unique_id);

		if($status > 0){

			$this->send_email_price_update($_POST);
			$finalResult = array('msg' => 'success', 'response'=>"Successfully updated and active.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function make_active()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->make_active($unique_id);

		if($status > 0){

			$this->send_email_update($unique_id);
			$finalResult = array('msg' => 'success', 'response'=>"Successfully updated and active.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}


	public function make_mover_active()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->make_active($unique_id);

		if($status > 0){

			$this->send_email_mover_update($_POST);
			$finalResult = array('msg' => 'success', 'response'=>"Successfully updated and active.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function status_active()
	{
		$unique_id = $_POST['unique_id'];
		$price = $_POST['price'];

		$status = $this->list_model->status_active($unique_id , $price);

		if($status > 0){

			if(empty($price)) {
				$this->send_email_price_notset($_POST);
			} else {
				$this->send_email_price_set($_POST);
			}

			$finalResult = array('msg' => 'success', 'response'=>"Successfully active.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}
	public function mover_status_active()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->mover_status_active($unique_id);

		if($status > 0){

			$this->send_email($_POST);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully active.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function mover_status_inactive()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->mover_status_inactive($unique_id);

		if($status > 0){

			$this->send_email_mover_inactive($_POST);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully inactive.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}


	public function status_inactive()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->list_model->status_inactive($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully remove feature");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}
	public function send_email($data)
	{
		$list_detail = $this->list_model->get_detail($data['unique_id']);

		$to = $list_detail['email'];
		$subject = "Mover activated";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your mover listing has been activated.</p>
		<p><strong> Title :</strong> '.$list_detail['title'].'</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}

	public function send_email_mover_inactive($data)
	{
		$list_detail = $this->list_model->get_detail($data['unique_id']);

		$to = $list_detail['email'];
		$subject = "Mover inactivated";


		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your mover listing has been inactivated.</p>
		<p><strong> Title :</strong> '.$list_detail['title'].'</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}
	public function send_email_mover_update($data)
	{
		$list_detail = $this->list_model->get_detail($data['unique_id']);

		$this->load->library('email');

		$this->email->from('.no_reply_email().');
		$this->email->to($list_detail['email']);

		$this->email->subject('Mover activated');

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your mover listing has been inactivated.</p>
		<p><strong> Mover Title :</strong> '.$list_detail['title'].'</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		$this->email->message($body);

		$this->email->set_mailtype("html");

		$this->email->send();

	}
	public function send_email_price_update($data)
	{
		$list_detail = $this->list_model->get_detail($data['unique_id']);

		$this->load->library('email');

		$this->email->from('.no_reply_email().');
		$this->email->to($list_detail['email']);

		$this->email->subject('Storage space activated and price updated');

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your storage space has been activated and as per our discussion we have set the recommended price.</p>
		<p><strong> Storage Title :</strong> '.$list_detail["title"].' </p>
		<p><strong> Price/day :</strong> $'.$list_detail["price"].' </p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		$this->email->message($body);

		$this->email->set_mailtype("html");

		$this->email->send();
	}


	public function send_email_price_set($data)
	{

		$list_detail = $this->list_model->get_detail($data['unique_id']);



		$to = $list_detail['email'];

		$subject = "Storage space activated and price set";


		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your storage space has been activated and as per our discussion we have set the recommended price. </p>
		<p><strong> Storage Title :</strong> '.$list_detail["title"].' </p>
		<p><strong> Price/day :</strong> $'.$list_detail["price"].' </p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email

		$headers = "MIME-Version: 1.0" . "\r\n";

		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers

		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";

         //Send mail 

		@mail($to,$subject,$body,$headers);

	}

	public function send_email_update($unique_id)
	{
		$list_detail = $this->list_model->get_detail($unique_id);

		$this->load->library('email');

		$this->email->from('.no_reply_email().');
		$this->email->to($list_detail['email']);

		$this->email->subject('Storage space activated');


		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your storage space has been activated.</p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		$this->email->message($body);
		$this->email->set_mailtype("html");
		$this->email->send();
	}

	public function send_email_price_notset($data)
	{
		$list_detail = $this->list_model->get_detail($data['unique_id']);

		$to = $list_detail['email'];
		$subject = "Storage space activated but price is not set";


		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>Your storage space has been activated and you price is not set yet, Please set you price from your account and publish storage space.</p>
		<p><strong> Storage Title :</strong> '.$list_detail["title"].' </p>

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}
}