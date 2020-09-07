<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		$this->load->model(admin_controller().'admin_model');
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		$this->load->model(admin_controller().'user_model');	
	}
	public function index()
	{	
		$data['users'] = $this->user_model->get_users('1');
		$this->load->view('users' , $data);
	}
	public function inactive_users()
	{	
		$data['users'] = $this->user_model->get_users('0');
		$this->load->view('inactive_users' , $data);
	}

	public function deleted_users()
	{	
		$data['users'] = $this->user_model->get_deleted_users();
		$this->load->view('deleted_users' , $data);
	}

	public function add_user()
	{
		$this->load->view('add_user');
	}
	
	public function insert_user()
	{
		$data = $_POST;
		// show($data);
		// exit;

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('email', 'Email','trim|required|xss_clean|is_unique[users.email]', array('is_unique' => 'Email Already Associated With Another Account.'));

		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->user_model->insert_user($data);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'<p>User Successfully Saved!</p>');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong!</p>');
				echo json_encode($finalResult);
				exit;
			}
			
		}
	}

	public function inactive_status()
	{
		$user_id = $this->input->post('user_id');
		$status = $this->user_model->inactive_status($user_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'User Successfully inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive user.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_status()
	{
		$user_id = $this->input->post('user_id');
		$status = $this->user_model->active_status($user_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'User Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active user.');
			echo json_encode($finalResult);
			exit;
		}
		
	}

	public function edit_user($user_id)
	{
		$data['user_detail'] = $this->user_model->get_user_detail($user_id);
		if (empty($data['user_detail'])) {
			show_404();
		}
		$this->load->view('edit_user' , $data);
	}

	public function update_user()
	{
		$data = $_POST;

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->user_model->update_user($data);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'<p>User Successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong!</p>');
				echo json_encode($finalResult);
				exit;
			}
			
		}
	}

	public function add_banned()
	{
		$user_id = $_POST['user_id'];

		$status = $this->user_model->add_banned($user_id);

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
		$user_id = $_POST['user_id'];

		$status = $this->user_model->remove_banned($user_id);

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

	public function delete_user()
	{
		$user_id = $_POST['user_id'];

		$status = $this->user_model->delete_user($user_id);

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

	public function restore_user()
	{
		$user_id = $_POST['user_id'];

		$status = $this->user_model->restore_user($user_id);

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

	public function user_permanent_delete()
	{
		$user_id = $_POST['user_id'];

		$status = $this->user_model->user_permanent_delete($user_id);

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
}