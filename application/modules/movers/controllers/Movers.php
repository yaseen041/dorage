<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movers extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(get_section_content('mover' , 'mover_provide') == '0'){
			show_404();
		}
		$this->load->model('movers/mover_model');
	}

	public function index(){
		$this->load->view('movers/mover_search');
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
			$data['movers'] = $this->mover_model->searchMovers($data);
			$response = $this->load->view('movers/movers_list_ajax', $data, true);
			$finalResult = array('msg' => 'success', 'response'=> $response);
			echo json_encode($finalResult);
			exit;
		}
	}

	public function createBooking(){
		$data = $this->input->post();
		if (!get_session('user_logged_in')) {
			$finalResult = array('msg' => 'error', 'response'=> 'Login is required for proceeding to booking');
			echo json_encode($finalResult);
			exit;
		}
		$checkOwner = $this->mover_model->checkListingOwner($data);
		if ($checkOwner) {
			$finalResult = array('msg' => 'error', 'response'=> "You cann't create booking against your own listing.");
			echo json_encode($finalResult);
			exit;
		}
		$booking_id = $this->mover_model->insertMoverBookin($data);
		$finalResult = array('msg' => 'success', 'response'=> base_url().'movers/booking_detail/'.$booking_id);
		echo json_encode($finalResult);
		exit;
	}

	public function booking_detail($id){
		if (!get_session('user_logged_in')) {
			show_404();
		}
		if (empty($id)) {
			show_404();
		}
		$data['booking_detail'] = $this->mover_model->getMoverBookingDetail($id);
		$this->load->view('movers/booking_detail', $data);
	}

}

/* End of file Movers.php */
/* Location: ./application/modules/movers/controllers/Movers.php */