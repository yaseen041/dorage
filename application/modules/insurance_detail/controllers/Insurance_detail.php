<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_detail extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	if(get_section_content('insurance' , 'insurance_provide') == '0'){
    		show_404();
    	}
        $this->load->view('insurance_detail');
    }
}
