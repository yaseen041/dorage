<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		// $this->load->model(admin_controller().'user_model');	
	}
	public function index()
	{	
		$this->load->view('contact_us');
	}
}