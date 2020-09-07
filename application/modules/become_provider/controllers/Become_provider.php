<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Become_provider extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{	
		$this->load->view('become_provider');
	}
}