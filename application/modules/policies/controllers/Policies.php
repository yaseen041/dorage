<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Policies extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	$data['content'] = 
        $this->load->view('policies');
    }
}
