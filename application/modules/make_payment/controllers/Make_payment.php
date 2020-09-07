<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Make_payment extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->model('make_payment_model');
	}
	public function result_paypal()
	{
		$booking_id = get_session('payment_id');
		
		if(empty($_REQUEST['txn_id'])){
			echo "Something Went Wrong.";
		}else{

			$trx_id = $_REQUEST['txn_id'];
			$payment_status = $_REQUEST['payment_status'];
			$payer_email = $_REQUEST['payer_email'];
			$amount = $_REQUEST['mc_gross'];
			if($payment_status == 'Completed' || $payment_status == 'Processed'){
				$payment_status = 1;
				$amount = $amount;
			}elseif($payment_status == 'Pending'){
				$payment_status = 1;
				// $amount =0 ;
			}else{
				$payment_status = 1;
				//$amount = 0;
			}
			
			$insert_pay = $this->make_payment_model->deposit_amount($amount,$payment_status,$trx_id,$payer_email);

			$booking_detail = $this->make_payment_model->get_booking_details($booking_id);

			if($booking_detail['listings_id'] != 0) {
				$this->send_email_storage_owner($booking_detail['listings_id']);
				if($booking_detail['mover_needed'] == 1) {
					$this->send_email_mover_owner_att($booking_detail['listings_id']);
				}
			} else {
				$this->send_email_mover_owner($booking_detail['mover_id']);
			}

			$this->send_email_admin();
			unset_session('payment_id');

			set_session('booking_success', "<b>Booking Ref #".$booking_detail['id']."</b><br> Your payment has been successfully completed.");
			
			redirect(base_url().'user/bookings_needer');
		}
	}
	public function cancel_paypal()
	{
		$this->load->view('cancel_paypal');
	}
	public function paypal($booking_id = '')
	{
		if(empty($booking_id)){
			show_404();
		}

		set_session('payment_id' ,$booking_id);
		$data['booking_detail'] = $this->make_payment_model->get_booking_details($booking_id);
		$this->load->view('paypal_form' , $data);
	}

	public function mover_paypal($booking_id = '')
	{
		if(empty($booking_id)){
			show_404();
		}

		set_session('payment_id' ,$booking_id);
		$data['booking_detail'] = $this->make_payment_model->get_booking_mover_details($booking_id);
		//print_r($data['booking_detail']); exit;
		$this->load->view('paypal_form' , $data);
	}

	public function send_email_storage_owner($listings_id)
	{
		$list_detail = $this->make_payment_model->get_list_detail($listings_id);

		$to = $list_detail['email'];
		$subject = "New Booking For Storage";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$list_detail["first_name"]." ".$list_detail["last_name"].', </b> </legend>
		<br>
		<p>New booking for your storage space has been added.</p>
		<p><strong> Title :</strong> '.$list_detail['title'].'</p>

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

	public function send_email_mover_owner_att($parent_id)
	{
		$mover_detail = $this->make_payment_model->get_mover_list_detail($parent_id);
		$to = $mover_detail['email'];
		$subject = "New Booking for Mover";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$mover_detail["first_name"]." ".$mover_detail["last_name"].', </b> </legend>
		<br>
		<p>New booking for your mover has been added.</p>
		<p><strong> Title :</strong> '.$mover_detail['title'].'</p>

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


	public function send_email_mover_owner($mover_id)
	{
		$mover_detail = $this->make_payment_model->get_list_detail($mover_id);
		$to = $mover_detail['email'];
		$subject = "New Booking for Mover";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear '.$mover_detail["first_name"]." ".$mover_detail["last_name"].', </b> </legend>
		<br>
		<p>New booking for your mover has been added.</p>
		<p><strong> Title :</strong> '.$mover_detail['title'].'</p>

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

	public function send_email_admin()
	{
		$to = admin_email();
		$subject = "New Booking";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		<p>New booking has been added.</p>

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
