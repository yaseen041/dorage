<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('booking_model');

		if(!get_session('user_logged_in')){
			show_404();
		}
	}
	public function index()
	{	
		show_404();
	}
	public function payment($unique_id = '')
	{	

		if (empty($unique_id)) {
			show_404();
		}

		$data['booking_detail'] = $this->booking_model->get_booking_detail($unique_id);

		if(empty($data['booking_detail'])) {
			show_404();
		}

		$date1 = date_create($data['booking_detail']['booking_start']);
		$date2 = date_create($data['booking_detail']['booking_end']);

		//difference between two dates
		$diff = date_diff($date1,$date2);
		
		//count days
		$data['booking_days'] = $diff->format("%a") + 1;
		// show($data);exit;
		$this->load->view('payment' , $data);
	}

	public function get_detail()
	{
		$data = $_POST;

		$loading_amount = 0;
		$moving_amount = 0;
		$data['crew_charge_hour'] = 0;

		if(!empty($data['selected_mover_id'])){
			
			$charge = (empty(get_meta_value('crew_charges', $data['selected_mover_id'])))? 0 : get_meta_value('crew_charges', $data['selected_mover_id']);

			$data['crew_charge_hour'] = $charge;

			$refundamount = $charge * $data['selected_crews']*($data['selected_hours']);

			$moving_amount = $charge * $data['selected_crews']*($data['selected_hours']+1);

			$data['refundable'] = $moving_amount - $refundamount;

		}

		$data['mover_package'] = $loading_amount + $moving_amount;

		$data['insurance_amount'] = 0; 

		if($data['insurance'] == "1"){

			$data['insurance_amount'] = get_section_content('insurance' , 'insurance_value');

		}

		$data['booking_detail'] = $this->booking_model->get_booking_detail($data['booking_id']);

		$date1 = date_create($data['booking_detail']['booking_start']);
		$date2 = date_create($data['booking_detail']['booking_end']);

		//difference between two dates
		$diff = date_diff($date1,$date2);
		
		//count days
		$data['booking_days'] = $diff->format("%a") + 1;

		$data['booking_detail']['total_amount'] += $data['mover_package'];
		$data['booking_detail']['total_amount'] += $data['insurance_amount'];

		$response = $this->load->view('payment_details_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;

	}

	public function proceed_payment()
	{
		$data = $_POST;

		if($_POST){

			if($data['insurance'] == "1" || $data['mover_needed'] == "1" ) {
				$status = $this->booking_model->booking_update($data);

				if($status > 0){

					$finalResult = array('msg' => 'success', 'response'=>base_url().'make_payment/paypal/'.$data['booking_id']);
					echo json_encode($finalResult);
					exit;

				} else {

					$finalResult = array('msg' => 'error', 'response'=>'Sorry! Something went wrong please reload page and try again.');
					echo json_encode($finalResult);
					exit;
				}
			} else {
				$finalResult = array('msg' => 'success', 'response'=>base_url().'make_payment/paypal/'.$data['booking_id']);
				echo json_encode($finalResult);
				exit;
			}

		} else {
			show_404();
		}
	}

	public function getMovers(){

		$data = $this->input->post();

		$this->form_validation->set_rules('mover_state', 'Mover State', 'required');
		$this->form_validation->set_rules('mover_date', 'Mover date', 'required');
		$this->form_validation->set_rules('number_of_people', 'Crew members', 'required|min_length[1]');
		$this->form_validation->set_rules('number_of_hours', 'Hours', 'required|min_length[1]');
		if(!empty($data['location'])) {
			$this->form_validation->set_rules('lat_long', 'Invalid Location', 'required');
		}
		if ($this->form_validation->run() == false) {
			$finalResult = array('msg' => 'error', 'response'=> validation_errors());
			echo json_encode($finalResult);
			exit;
		} else {

			$data['mover_listings'] = $this->booking_model->get_movers($data);

			$loading_amount = 0;
			$moving_amount = 0;
			$data['crew_charge_hour'] = 0;

			if(!empty($data['selected_mover_id'])){

				$charge = (empty(get_meta_value('crew_charges', $data['selected_mover_id'])))? 0 : get_meta_value('crew_charges', $data['selected_mover_id']);

				$data['crew_charge_hour'] = $charge;

				$moving_amount = $charge * $data['selected_crews']*($data['selected_hours']+1);

			}

			$data['mover_package'] = $loading_amount + $moving_amount;

			$data['insurance_amount'] = 0; 

			if($data['insurance'] == "1"){

				$data['insurance_amount'] = get_section_content('insurance' , 'insurance_value');

			}

			$data['booking_detail'] = $this->booking_model->get_booking_detail($data['booking_id']);

			$date1 = date_create($data['booking_detail']['booking_start']);
			$date2 = date_create($data['booking_detail']['booking_end']);

		    //difference between two dates
			$diff = date_diff($date1,$date2);

		    //count days
			$data['booking_days'] = $diff->format("%a") + 1;

			$data['booking_detail']['total_amount'] += $data['mover_package'];
			$data['booking_detail']['total_amount'] += $data['insurance_amount'];

			$response2 = $this->load->view('payment_details_ajax', $data, TRUE);

			$data['movers'] = $this->booking_model->searchMovers($data);
			$response = $this->load->view('booking/movers_list_ajax', $data, true);
			$finalResult = array('msg' => 'success', 'response'=> $response, 'response2'=> $response2);

			echo json_encode($finalResult);
			exit;
		}
	}

}