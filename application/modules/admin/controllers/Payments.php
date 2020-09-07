<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		$this->load->model('admin/payment_model');
	}

	public function index(){
		$data['payments'] = $this->payment_model->getPaymentsReleased();
		$data['totalProfit'] = array_sum(array_column($data['payments'], 'profit'));
		$this->load->view('admin/payments', $data);
	}

}

/* End of file Payments.php */
/* Location: ./application/modules/admin/controllers/Payments.php */