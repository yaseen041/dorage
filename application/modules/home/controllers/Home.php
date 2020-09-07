<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	public function index()
	{
		$data['states'] = $this->home_model->get_states();

		$data['sizeTypes'] = $this->home_model->get_size_types();
		$data['storage_types'] = $this->home_model->get_storage_types();
		$data['space_characters'] = $this->home_model->get_room_space_character();

		$data['listings'] = $this->home_model->get_storage_listings();
		$data['featured_listings'] = $this->home_model->get_storage_listings('1');

		$this->load->view('home' , $data);
	}

	public function get_storage_types()
	{
		if(!empty($_POST['storage_id'])){
			$data['storage_types'] = $this->home_model->get_storage_types($_POST['storage_id']);
		} else {
			$data['storage_types'] = array();
		}
		
		$response = $this->load->view('space_storage_types_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function get_space_characters()
	{
		$storage_type = array();

		$storage_type[] = 0;

		if(!empty($_POST['storage_type'])) {
			foreach ($_POST['storage_type'] as $key => $value) {
				$storage_type[] = $value;
			}
		}
		
		$data['space_characters'] = $this->home_model->get_room_space_character($storage_type);	

		$response = $this->load->view('room_space_character_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function addfavourite()
	{
		$listings_id = $_POST['listings_id'];

		$status = $this->home_model->addfavourite($listings_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully added");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function removefavourite()
	{
		$listings_id = $_POST['listings_id'];

		$status = $this->home_model->removefavourite($listings_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully removed");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function change_email($unique_id = '')
	{

		$data['user_detail'] = $this->home_model->get_user_detail(trim($unique_id));

		if (empty($data['user_detail'])) {
			show_404();
		}

		if (empty($data['user_detail']['email2'])) {
			show_404();
		}

		$status = $this->home_model->change_email($data);

		if($status > 0){

			if($this->session->userdata('user_logged_in'))
			{
				set_session('email' , $data['user_detail']['email2']);
				$this->session->set_flashdata('activation_success_status' , 'Your email has been successfully changed.');
				redirect(base_url().'user/settings');
			} else {
				$this->session->set_flashdata('activation_success_status' , 'Your email has been successfully changed.');
				redirect(base_url().'login');
			}
			
		} else {
			$this->session->set_flashdata('activation_error_status' , 'Something went wrong. Please try again.');
			redirect(base_url());
		}

	}
}