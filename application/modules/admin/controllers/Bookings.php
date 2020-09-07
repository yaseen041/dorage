<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		$this->load->model(admin_controller().'admin_model');
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		$this->load->model(admin_controller().'booking_model');	
	}

	public function index()
	{	
		$data['bookings'] = $this->booking_model->get_bookings('1');
		$this->load->view('bookings' , $data);
	}

	public function payment_to_be_released()
	{	
		$data['bookings'] = $this->booking_model->get_released_bookings();
		$data['mover_bookings'] = $this->booking_model->get_mover_released_bookings();
		$this->load->view('payment_to_be_released' , $data);
	}

	public function cancelled()
	{	
		$data['bookings'] = $this->booking_model->get_bookings('3');
		$this->load->view('cancelled_bookings' , $data);
	}

	public function completed()
	{	
		$data['bookings'] = $this->booking_model->get_bookings('2');
		$this->load->view('completed_bookings' , $data);
	}

	public function refunded()
	{	
		$data['bookings'] = $this->booking_model->get_bookings('4');
		$data['mover_bookings'] = $this->booking_model->get_mover_refunded();
		$this->load->view('refund_bookings' , $data);
	}

	public function released()
	{

		$data['bookings'] = $this->booking_model->get_bookings('5');
		$data['mover_bookings'] = $this->booking_model->get_mover_released();
		$this->load->view('released_bookings' , $data);

	}

	public function booking_detail()
	{
		$data = $_POST;

		$booking_detail = $this->booking_model->get_booking_detail($data);

		$data['booking_detail'] = $booking_detail;

		if(!empty($data['booking_detail'])){

			$data['list_detail'] = $this->booking_model->get_list_detail($booking_detail['listings_id']);

			$data['mover_detail'] = array();

			if($booking_detail['mover_needed']) {
				$data['mover_detail'] = $this->booking_model->get_mover_detail($booking_detail['id']);
			}
			$response = $this->load->view('booking_detail_ajax', $data, TRUE);
			$finalResult = array('msg' => 'success', 'response'=>$response);
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"<p style='color:red;'>Booking detail not found.</p>");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function cancel_booking()
	{
		$data = $_POST;

		$status = $this->booking_model->cancel_booking($data);

		if($status > 0){

			$owner_detail = $this->booking_model->get_list_owner_detail($data['list_id']);
			$booking_detail = $this->booking_model->get_booking_detail_by_id($data['booking_id']);

			$this->send_email_to_provider($booking_detail , $owner_detail);
			$this->send_email_to_needer($booking_detail);

			$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}


	public function cancel_list_mover_booking()
	{
		$data = $_POST;

		$booking_detail = $this->booking_model->get_mover_booking_detail($data['booking_id']);

		$status = $this->booking_model->cancel_list_mover_booking($data);


		if($status > 0){

			$owner_detail = $this->booking_model->get_list_owner_detail($booking_detail['mover_id']);
			
			$this->send_email_to_provider($booking_detail , $owner_detail);
			$this->send_email_to_needer($booking_detail);

			$finalResult = array('msg' => 'success', 'response'=>"Booking has been successfully cancelled.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}




	public function mover_booking_detail()
	{
		$data = $_POST;

		$booking_detail = $this->booking_model->get_booking_detail($data);

		$data['mover_detail'] = $booking_detail;

		if(!empty($data['mover_detail'])){

			$data['list_detail'] = $this->booking_model->get_list_detail($booking_detail['mover_id']);

			$response = $this->load->view('mover_booking_detail_ajax', $data, TRUE);
			$finalResult = array('msg' => 'success', 'response'=>$response);
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"<p style='color:red;'>Booking detail not found.</p>");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function refundBooking(){
		$data = $this->security->xss_clean($this->input->post());
		// echo "<pre>";
		// print_r($data);exit;
		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {
			$this->booking_model->insertPaymentRefund($data);
			$this->sendPaymentRefundEmail($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been refunded');
			echo json_encode($finalResult);
			exit;
		}
	}
	public function getStoragePaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_storage_detail($data['booking_id']);

		$date1 = date_create($data['booking_detail']['booking_start']);
		$date2 = date_create($data['booking_detail']['booking_end']);

		//difference between two dates
		$diff = date_diff($date1,$date2);
		
		//count days
		$data['booking_days'] = $diff->format("%a") + 1;

		$data['total_amount'] = $data['booking_detail']['list_price'] * $data['booking_days'];

		$data['profit_amount'] = (10/100) * $data['total_amount'];

		$response = $this->load->view('release_payment_to_storage_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function getMoverPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_payment_detail_for_mover($data['booking_id']);
		$cutomer_refund = $this->booking_model->is_customer_refund($data['booking_id']);
		if($cutomer_refund == 1) {
			$data['booking_detail']['no_hours'] = $data['booking_detail']['no_hours'] - 1;
			$data['total_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']);
		} else {
			$data['total_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']);
		}

		$data['profit_amount'] = (10/100) * $data['total_amount'];

		$response = $this->load->view('release_payment_to_mover_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function getSingleMoverPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_payment_detail_for_single_mover($data['booking_id']);
		$cutomer_refund = $this->booking_model->is_customer_refund($data['booking_id']);
		if($cutomer_refund == 1) {
			$data['booking_detail']['no_hours'] = $data['booking_detail']['no_hours'] - 1;
			$data['total_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']);
		} else {
			$data['total_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']);
		}

		$data['profit_amount'] = (10/100) * $data['total_amount'];

		$response = $this->load->view('release_payment_to_mover_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function getStorageRefundPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_refund_detail_for_customer($data['booking_id']);
		
		$data['total_amount'] = $data['booking_detail']['list_total'] + $data['booking_detail']['insurance_amount'] + $data['booking_detail']['tax_amount'];

		$response = $this->load->view('refund_payment_to_customer_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function getMoverRefundPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_refund_detail_for_customer($data['booking_id']);
		

		if($data['booking_detail']['parent_id'] > 0){
			$data['total_amount'] = $data['booking_detail']['mover_price'] + $data['booking_detail']['refundable_mover'] ;	
		} else {
			$data['total_amount'] = $data['booking_detail']['total_amount'];
		}
		

		$response = $this->load->view('refund_payment_to_customer_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function getCustomerrefundPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_refund_detail_for_customer($data['booking_id']);
		
		if($data['booking_detail']['parent_id'] != 0) {
			$data['total_amount'] = $data['booking_detail']['mover_price'];
		} else {
			$data['total_amount'] = $data['booking_detail']['paid_amount'];
		}
		

		$response = $this->load->view('release_payment_to_customer_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}
	public function getCustomerPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_payment_detail_for_mover_customer($data['booking_id']);
		
		$data['total_min_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']-1);
		
		$data['total_max_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']);

		$data['total_amount'] = $data['total_max_amount'] - $data['total_min_amount'];

		$response = $this->load->view('release_payment_to_customer_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}
	public function getMoverCustomerPaymentModal()
	{
		$data = $_POST;

		$data['booking_detail'] = $this->booking_model->get_payment_detail_for_mover_only_customer($data['booking_id']);
		
		$data['total_min_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']-1);
		
		$data['total_max_amount'] = $data['booking_detail']['crew_charges'] * $data['booking_detail']['no_crews'] * ($data['booking_detail']['no_hours']);

		$data['total_amount'] = $data['total_max_amount'] - $data['total_min_amount'];

		$response = $this->load->view('release_payment_to_customer_ajax', $data, TRUE);
		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function mover_bookings()
	{
		$data['bookings'] = $this->booking_model->get_mover_bookings('1');
		$this->load->view('mover_bookings' , $data);
	}

	public function mover_completed()
	{
		$data['bookings'] = $this->booking_model->get_mover_bookings('2');
		$this->load->view('mover_completed_bookings' , $data);
	}

	public function mover_cancelled()
	{
		$data['bookings'] = $this->booking_model->get_mover_bookings('3');
		$this->load->view('mover_cancelled_bookings' , $data);
	}

	public function releasePaymentTostorage(){
		$data = $this->security->xss_clean($this->input->post());

		$status = $this->booking_model->check_sortage_payment($data['booking_id']);

		if($status == 1) {
			$finalResult = array('msg' => 'error', 'response'=>"Already released.");
			echo json_encode($finalResult);
			exit;
		}

		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {

			$this->booking_model->insertPaymentReleaseToStorage($data);
			$this->sendPaymentReleasedEmailtoStorage($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been marked as released');
			echo json_encode($finalResult);
			exit;
		}
	}

	public function releasePaymentTomover(){
		$data = $this->security->xss_clean($this->input->post());
		
		$status = $this->booking_model->check_mover_payment($data['booking_id']);

		if($status == 1) {
			$finalResult = array('msg' => 'error', 'response'=>"Already released.");
			echo json_encode($finalResult);
			exit;
		}

		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {
			$this->booking_model->insertPaymentReleaseToMover($data);
			$this->sendPaymentReleasedEmailtoMover($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been marked as released');
			echo json_encode($finalResult);
			exit;
		}
	}

	public function releasePaymentToSinglemover(){
		$data = $this->security->xss_clean($this->input->post());
		
		$status = $this->booking_model->check_mover_payment($data['booking_id']);

		if($status == 1) {
			$finalResult = array('msg' => 'error', 'response'=>"Already released.");
			echo json_encode($finalResult);
			exit;
		}

		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {
			$this->booking_model->insertPaymentReleaseToMover($data);
			$this->sendPaymentReleasedEmailtoSingleMover($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been marked as released');
			echo json_encode($finalResult);
			exit;
		}
	}




	public function releasePaymentTocustomer()
	{
		$data = $this->security->xss_clean($this->input->post());
		
		$status = $this->booking_model->check_customer_payment($data['booking_id']);

		if($status == 1) {
			$finalResult = array('msg' => 'error', 'response'=>"Already refunded.");
			echo json_encode($finalResult);
			exit;
		}

		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {
			$data['booking_detail'] = $this->booking_model->get_booking_detail_by_id($data['booking_id']);
			$this->booking_model->insertPaymentReleaseToCustomer($data);
			$this->sendPaymentReleasedEmailtoCustomer($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been marked as refunded');
			echo json_encode($finalResult);
			exit;
		}
	}


	public function insertPaymentonlyRefund()
	{
		$data = $this->security->xss_clean($this->input->post());
		
		$status = $this->booking_model->check_customer_payment($data['booking_id']);

		if($status == 1) {
			$finalResult = array('msg' => 'error', 'response'=>"Already refunded.");
			echo json_encode($finalResult);
			exit;
		}

		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {
			$data['booking_detail'] = $this->booking_model->get_booking_detail_by_id($data['booking_id']);
			$this->booking_model->insertPaymentonlyRefund($data);
			$this->sendPaymentReleasedEmailtoCustomer($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been marked as refunded');
			echo json_encode($finalResult);
			exit;
		}
	}




	public function releasePaymentToMovercustomer()
	{
		$data = $this->security->xss_clean($this->input->post());
		
		$status = $this->booking_model->check_customer_payment($data['booking_id']);

		if($status == 1) {
			$finalResult = array('msg' => 'error', 'response'=>"Already refunded.");
			echo json_encode($finalResult);
			exit;
		}

		$this->form_validation->set_rules('tran_id', 'Transaction ID', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|min_length[1]');
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {
			$data['booking_detail'] = $this->booking_model->get_booking_detail_by_id($data['booking_id']);
			$this->booking_model->insertPaymentReleaseToCustomer($data);
			$this->sendPaymentReleasedEmailtoCustomer($data);
			$finalResult = array('msg' => 'success', 'response' => 'Booking payment has been marked as refunded');
			echo json_encode($finalResult);
			exit;
		}
	}

	public function mark_completed()
	{
		$data = $_POST;

		$status = $this->booking_model->mark_completed($data['booking_id']);

		if($status > 0) {
			$finalResult = array('msg' => 'success', 'response'=>"This booking successfully marked as completed.");
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
			echo json_encode($finalResult);
			exit;
		}

	}


	public function mark_refunded()
	{
		$data = $_POST;

		$status = $this->booking_model->mark_refunded($data['booking_id']);

		if($status > 0) {
			$finalResult = array('msg' => 'success', 'response'=>"This booking successfully marked as refunded.");
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
			echo json_encode($finalResult);
			exit;
		}

	}


	public function mark_released()
	{
		$data = $_POST;

		$status = $this->booking_model->mark_released($data['booking_id']);

		if($status > 0) {
			$finalResult = array('msg' => 'success', 'response'=>"This booking successfully marked as released.");
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
			echo json_encode($finalResult);
			exit;
		}

	}


	public function review_approve()
	{
		$data = $_POST;

		$status = $this->booking_model->review_approve($data);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Review has been successfully approved.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}

	public function review_disapprove()
	{
		$data = $_POST;

		$status = $this->booking_model->review_disapprove($data);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Review has been successfully disapproved.");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}

	public function sendPaymentRefundEmail($data){

		$booking_detail = singleRow('bookings', '*', 'unique_id = "'.$data['booking_unique_id'].'"');

		$listing = singleRow('booked_listings', '*', 'id = '.$booking_detail['listings_id']);
		
		$user_detail = singleRow('users', '*', 'id = '.$booking_detail['users_id']);
		
		$to = $user_detail['email'];
		$subject = "Payment refund against booking ref # ".$booking_detail['id'];
		
		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$user_detail["first_name"]." ".$user_detail["last_name"].', </b> </legend>
		<br>
		<p>Admin has refunded the payment against your <b>booking ref # '.$booking_detail["id"].'.</b></p>
		<p><strong> Refund Amount: </strong> $'.$data["amount"].' </p>

		<p>Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

	public function sendPaymentReleasedEmailtoStorage($data){

		$booking_detail = singleRow('bookings', '*', 'id = "'.$data['booking_id'].'"');
		$listing = singleRow('booked_listings', '*', 'id = '.$booking_detail['listings_id']);
		$user_detail = singleRow('users', '*', 'id = '.$listing['users_id']);
		$to = $user_detail['email'];

		if($booking_detail['parent_id'] > 0) {
			$booking_id = $booking_detail['parent_id'];
		} else {
			$booking_id = $booking_detail['id'];
		}

		$subject = "Payment released against booking ref # ".$booking_id;
		
		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$user_detail["first_name"]." ".$user_detail["last_name"].', </b> </legend>
		<br>
		<p>Admin has released payment against your <b>booking ref # '.$booking_detail["id"].'.</b></p>
		<p><strong> Released Amount: </strong> $'.$data["amount"].' </p>

		<p>Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

	public function sendPaymentReleasedEmailtoSingleMover($data){
		
		$booking_detail = singleRow('bookings', '*', 'id = "'.$data['booking_id'].'"');
		
		$listing = singleRow('booked_listings', '*', 'id = '.$booking_detail['mover_id']);
		$user_detail = singleRow('users', '*', 'id = '.$listing['users_id']);
		
		$to = $user_detail['email'];
		$subject = "Payment released against booking ref # ".$booking_detail['id'];
		

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$user_detail["first_name"]." ".$user_detail["last_name"].', </b> </legend>
		<br>
		<p>Admin has released payment against your <b>booking ref # '.$booking_detail["id"].'.</b></p>
		<p><strong> Released Amount: </strong> $'.$data["amount"].' </p>

		<p>Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

	public function sendPaymentReleasedEmailtoMover($data){
		$booking_detail = singleRow('bookings', '*', 'id = "'.$data['booking_id'].'"');
		$listing = singleRow('booked_listings', '*', 'id = '.$booking_detail['mover_id']);
		$user_detail = singleRow('users', '*', 'id = '.$listing['users_id']);
		$to = $user_detail['email'];

		if($booking_detail['parent_id'] > 0){
			$booking_id = $booking_detail['parent_id'];
		} else {
			$booking_id = $booking_detail['id'];
		}

		$subject = "Payment released against booking ref # ".$booking_id;

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$user_detail["first_name"]." ".$user_detail["last_name"].', </b> </legend>
		<br>
		<p>Admin has released payment against your <b>booking ref # '.$booking_id.'.</b></p>
		<p><strong> Released Amount: </strong> $'.$data["amount"].' </p>

		<p>Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

	public function sendPaymentReleasedEmailtoCustomer($data){

		$user_detail = singleRow('users', '*', 'id = '.$data['user_id']);
		$to = $user_detail['email'];
		if($data['booking_detail']['parent_id'] > 0) {
			$data['booking_id'] = $data['booking_detail']['parent_id'];
		}
		$subject = "Payment refund against booking ref # ".$data['booking_id'];
		

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$user_detail["first_name"]." ".$user_detail["last_name"].', </b> </legend>
		<br>
		<p>Admin has been refunded payment against your <b>booking ref # '.$data["booking_id"].'.</b></p>
		<p><strong> Refunded Amount: </strong> $'.$data["amount"].' </p>

		<p>Thanks,<br>
		Dorage</p>
		</div>';

		$body = $this->load->view('admin/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		@mail($to,$subject,$body,$headers);
	}

	public function send_email_to_needer($detail)
	{
		$to = $detail['email'];
		$subject = "Booking Cancelled";

		if($detail['parent_id'] > 0 ) {
			$booking_id = $detail['parent_id']; 
		} else {
			$booking_id = $detail['id']; 
		}

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$detail["first_name"]." ".$detail["last_name"].', </b> </legend>
		<br>
		<p>Your booking has been cancelled by admin.</b></p>
		<p><strong>Booking REF # </strong>'.$booking_id.'</p>

		<p>Thanks,<br>
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

	public function send_email_to_provider($b_detail , $o_detail)
	{
		$to = $o_detail['email'];
		$subject = "Booking Cancelled";

		if($b_detail['parent_id'] > 0 ) {
			$booking_id = $b_detail['parent_id']; 
		} else {
			$booking_id = $b_detail['id']; 
		}

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$o_detail["first_name"]." ".$o_detail["last_name"].', </b> </legend>
		<br>
		<p>Booking has been cancelled by admin.</b></p>
		<p><strong>Booking REF # </strong>'.$booking_id.'</p>

		<p>Thanks,<br>
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