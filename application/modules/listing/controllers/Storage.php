<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storage extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('add_listing_model');
	}

	public function step1($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

			$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

			$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		} else {
			$data['stp_detail'] = array();
		}

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();
		$this->load->view('step1' , $data);
	}

	public function back_to_step1()
	{	
		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

			$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 
			
			$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

			
		} else {
			$data['stp_detail'] = array();
			$data['storage_types'] = array();
		}

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$response = $this->load->view('step1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}



	public function step1_1($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		} else {

			redirect('listing/storage/step1');
		}

		$s_storage_type = get_meta_value('space_storage_type',$data['stp_detail']['id']); 

		$data['space_characteristics'] = $this->add_listing_model->get_room_space_character($s_storage_type);

		$list_characteristics = $this->add_listing_model->get_list_character($data['stp_detail']['id']);

		$selected_character = array();
		foreach($list_characteristics as $event_tag){
			$selected_character[] = $event_tag['meta_value'];
		}

		$data['selected_character'] = $selected_character;

		$data['cancellation_policies'] = $this->add_listing_model->get_cancellation_policies();

		$data['policy_note'] = $this->add_listing_model->get_policy_note();

		$this->load->view('step1_1' , $data);
	}

	public function get_storage_types()
	{
		$storage_id = $this->input->post('storage_id');
		$data['storage_types'] = $this->add_listing_model->get_storage_types($storage_id);

		$htmlview = $this->load->view('storage_types_options_ajax', $data, TRUE);

		$response_arr = array(
			'msg'=> 'success',
			'response'=> $htmlview
		);
		echo json_encode($response_arr);
	}

	public function step1_2($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		} else {

			redirect('listing/storage/step1');
		}

		$data['amenities'] = $this->add_listing_model->get_list_amenities($data['stp_detail']['id']);

		$data['basic_amenities'] = $this->add_listing_model->get_amenities(0);
		$data['safety_amenities'] = $this->add_listing_model->get_amenities(1);

		$this->load->view('step1_2' , $data);
	}

	public function back_to_step1_1()
	{

		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);
			
		} else {
			$data['stp_detail'] = array();
			
		}

		$s_storage_type = get_meta_value('space_storage_type',$data['stp_detail']['id']); 

		$data['space_characteristics'] = $this->add_listing_model->get_room_space_character($s_storage_type);

		$list_characteristics = $this->add_listing_model->get_list_character($data['stp_detail']['id']);

		$selected_character = array();
		foreach($list_characteristics as $event_tag){
			$selected_character[] = $event_tag['meta_value'];
		}

		$data['selected_character'] = $selected_character;

		$data['cancellation_policies'] = $this->add_listing_model->get_cancellation_policies();

		$data['policy_note'] = $this->add_listing_model->get_policy_note();
		
		$response = $this->load->view('step1_1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_1/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}



	public function back_to_step1_2()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['amenities'] = $this->add_listing_model->get_list_amenities($data['stp_detail']['id']);

		$data['basic_amenities'] = $this->add_listing_model->get_amenities(0);
		$data['safety_amenities'] = $this->add_listing_model->get_amenities(1);


		$response = $this->load->view('step1_2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_2/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function step1_3($unique_id = '')
	{
		$data['unique_id'] = $unique_id;

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		} else {

			redirect('listing/storage/step1');
		}

		$this->load->view('step1_3' , $data);
	}



	public function step1_complete($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$this->load->view('step1_complete' , $data);
	}


	public function step2($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}
		
		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$this->load->view('step2' , $data);
	}

	public function back_to_step1_complete()
	{	


		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$response = $this->load->view('step1_complete_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_complete/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function goto_step2()
	{	

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$data['unique_id'] = $_POST['unique_id'];

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$response = $this->load->view('step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step2/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}
	public function edit_step1($unique_id = '')
	{	

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

			$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

			$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		} else {
			$data['stp_detail'] = array();
		}

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$this->load->view('edit_step1' , $data);
		
	}

	public function edit_step1_from_step3($unique_id = '')
	{	

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

			$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

			$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		} else {
			$data['stp_detail'] = array();
		}

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$this->load->view('edit_step1_from_step3' , $data);
		
	}

	public function edit_step1_from_step2($unique_id = '')
	{	

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

			$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

			$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

			$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		} else {
			$data['stp_detail'] = array();
		}

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$this->load->view('edit_step1_from_step2' , $data);
		
	}

	public function goto_edit_step1()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

		$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$response = $this->load->view('edit_step1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/edit_step1/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function goto_edit_step1_from_step2_complete()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

		$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);
		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$response = $this->load->view('edit_step1_from_step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/edit_step1_from_step2/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function goto_edit_step1_from_step3_complete()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);



		$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

		$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$response = $this->load->view('edit_step1_from_step3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/edit_step1_from_step3/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step1_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$s_size_type = get_meta_value('storage_size_type',$data['stp_detail']['id']); 

		$data['storage_types'] = $this->add_listing_model->get_storage_types($s_size_type);

		$data['sizeTypes'] = $this->add_listing_model->get_size_types();

		$response = $this->load->view('update_step1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step1_1_ajax()
	{	

		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);
			
		} else {
			$data['stp_detail'] = array();
			
		}

		$s_storage_type = get_meta_value('space_storage_type',$data['stp_detail']['id']); 

		$data['space_characteristics'] = $this->add_listing_model->get_room_space_character($s_storage_type);

		$list_characteristics = $this->add_listing_model->get_list_character($data['stp_detail']['id']);

		$selected_character = array();
		foreach($list_characteristics as $event_tag){
			$selected_character[] = $event_tag['meta_value'];
		}

		$data['selected_character'] = $selected_character;

		$data['cancellation_policies'] = $this->add_listing_model->get_cancellation_policies();

		$data['policy_note'] = $this->add_listing_model->get_policy_note();

		$response = $this->load->view('update_step1_1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step1_2_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['amenities'] = $this->add_listing_model->get_list_amenities($data['stp_detail']['id']);

		$data['basic_amenities'] = $this->add_listing_model->get_amenities(0);
		$data['safety_amenities'] = $this->add_listing_model->get_amenities(1);


		$response = $this->load->view('update_step1_2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step1_3_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('update_step1_3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}


	public function update_step1()
	{

		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}


		$errors = '';

		foreach ($_POST['posted_data'] as $key => $value) {
			if(empty($value)) {
				$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
			}
		}

		if (empty($data['lat_long'])) {
			$errors .= "Please select a valid place.";
		}

		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}


		$list_id = $this->add_listing_model->update_stp1($data);
		
		if($list_id == 'location_changed') {
			
			// $data['updatein'] = 'location or storage size type and space storage type';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($list_id == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}

	}


	public function update_step1_1()
	{

		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$errors = '';

		if(empty($data['room_space_character'])){
			$errors .=  'Please select atleast 1 room space character.<br>';
		}

		foreach ($_POST['posted_data'] as $key => $value) {
			if(empty($value)) {
				$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
			}
		}

		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}

		$status = $this->add_listing_model->update_stp2($data);

		if($status == 'info_changed') {
			
			// $data['updatein'] = 'space characteristics';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($status == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}

	}

	public function update_step1_2()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['listings_id'] = $data['stp_detail']['id'];

		$status = $this->add_listing_model->update_step1_2($data);

		if($status == 'info_changed') {
			
			// $data['updatein'] = 'space characteristics';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($status == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}
	}

	public function update_step1_3()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}


		$errors = '';

		foreach ($_POST['posted_data'] as $key => $value) {
			if(empty($value)) {
				$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
			}
		}

		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}

		$status = $this->add_listing_model->update_step1_3($data);

		if($status == "location_changed") {

			// $data['updatein'] = 'location';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($status == "already_changed") {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}
	}

	public function back_to_step2()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$response = $this->load->view('step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step2/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function step2_1($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}
		
		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$this->load->view('step2_1' , $data);
	}


	public function step2_complete($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$this->load->view('step2_complete' , $data);
	}

	public function goto_edit_step2()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$response = $this->load->view('edit_step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/edit_step2/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function goto_edit_step2_from_step3()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$response = $this->load->view('edit_step2_from_step3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/edit_step2_from_step3/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function edit_step2($unique_id = '')
	{	

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}
		} 


		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$this->load->view('edit_step2' , $data);
		
	}


	public function edit_step2_from_step3($unique_id = '')
	{	

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}
		} 


		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$this->load->view('edit_step2_from_step3' , $data);
		
	}


	public function update_step2_ajax()
	{	

		if($_POST['unique_id'] != NULL){

			$data['unique_id'] = $_POST['unique_id'];

			$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);
			
		} else {
			$data['stp_detail'] = array();
			
		}


		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['images'] = $this->add_listing_model->get_storage_images($data['stp_detail']['id']);

		$response = $this->load->view('update_step2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step2_1_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);
		$data['cancellation_policies'] = $this->add_listing_model->get_cancellation_policies();
		$data['policy_note'] = $this->add_listing_model->get_policy_note();

		$s_storage_type = get_meta_value('space_storage_type',$data['stp_detail']['id']); 

		$data['space_characteristics'] = $this->add_listing_model->get_room_space_character($s_storage_type);

		$response = $this->load->view('update_step2_1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step2()
	{

		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		
		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$pictures = $this->add_listing_model->get_list_images($data['stp_detail']['id']);

		if(empty($pictures)) {

			$finalResult = array('msg' => 'error', 'response'=>"Please upload atleast one image.");
			echo json_encode($finalResult);
			exit;
		}

		$errors = '';

		foreach ($_POST['image_order'] as $key => $value) {
			if(empty($value)) {
				$errors =  'Please set order of all images.<br>';
			}
		}

		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}

		$pictures = $this->add_listing_model->set_image_orders($data['image_order']);

		
		$status = $this->add_listing_model->insert_step2_0($data);
		
		if($status == 'video_link_changed') {
			
			// $data['updatein'] = 'video link';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($status == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}

	}

	public function update_step2_1()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$this->form_validation->set_rules('storage_title', 'Storage title', 'trim|required|xss_clean', array('required' => 'Please enter "Storage space title".'));

		$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean', array('required' => 'Please write "Description" of your storage space.'));


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;

		}else{

			$status = $this->add_listing_model->update_step2_1($data);
			if($status == 'title_desc_changed') {

				// $data['updatein'] = 'Title or Description';

				$this->send_email_update_storage($data);

				$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
				echo json_encode($finalResult);
				exit;

			} elseif($status == 'already_changed') {

				$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
				echo json_encode($finalResult);
				exit;


			} else {

				$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
				echo json_encode($finalResult);
				exit;

			}
		}
	}

	public function goto_step3()
	{	

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$data['unique_id'] = $_POST['unique_id'];

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['basic_requirments'] = $this->add_listing_model->get_requirments(0);
		$data['before_requirments'] = $this->add_listing_model->get_requirments(1);

		$response = $this->load->view('step3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function step3($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}
		
		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$data['basic_requirments'] = $this->add_listing_model->get_requirments(0);
		$data['before_requirments'] = $this->add_listing_model->get_requirments(1);

		$this->load->view('step3' , $data);
	}


	public function back_to_step2_complete()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$response = $this->load->view('step2_complete_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step2_complete/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function goto_step3_1()
	{	

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$data['unique_id'] = $_POST['unique_id'];

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['basic_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['extra_rules'] = $this->add_listing_model->get_space_rules(1);

		$data['additional_rules'] = $this->add_listing_model->get_additional_rules($data['stp_detail']['id']);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['stp_detail']['id']);

		$response = $this->load->view('step3_1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_1/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}



	public function step3_1($unique_id = '')
	{	

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$data['basic_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['extra_rules'] = $this->add_listing_model->get_space_rules(1);

		$data['additional_rules'] = $this->add_listing_model->get_additional_rules($data['stp_detail']['id']);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['stp_detail']['id']);

		$this->load->view('step3_1', $data);
	}

	public function back_to_step3()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['basic_requirments'] = $this->add_listing_model->get_requirments(0);
		$data['before_requirments'] = $this->add_listing_model->get_requirments(1);

		$response = $this->load->view('step3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function step3_2($unique_id = '')
	{	

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$this->load->view('step3_2', $data);
	}

	public function back_to_step3_1()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}


		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['basic_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['extra_rules'] = $this->add_listing_model->get_space_rules(1);

		$data['additional_rules'] = $this->add_listing_model->get_additional_rules($data['stp_detail']['id']);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['stp_detail']['id']);

		$response = $this->load->view('step3_1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_1/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function back_to_step3_2()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}


		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('step3_2_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_2/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function step3_3($unique_id = '')
	{	

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$this->load->view('step3_3', $data);
	}


	public function back_to_step3_3()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}


		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('step3_3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_3/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function step3_4($unique_id = '')
	{
		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$result = $this->add_listing_model->get_dates($data['stp_detail']['id']);

		$dates = '';

		foreach ($result as $res) {

			$s_month = date('m' , strtotime($res['start_date']));
			$s_day = date('d' , strtotime($res['start_date']));

			$e_month = date('m' , strtotime($res['end_date']));
			$e_day = date('d' , strtotime($res['end_date']));

			$s_month = $s_month -1;
			$e_month = $e_month -1;

			$dates .="{
				id: ".$res['id'].",
				name:'' ,
				location:'' ,
				startDate: new Date(currentYear, ".$s_month.", ".$s_day."),
				endDate: new Date(currentYear, ".$e_month.", ".$e_day.")
			},";

		}

		$data['dates'] = $dates;

		$this->load->view('step3_4', $data);
	}
	public function unblock_booking_dates()
	{

		$data = $_POST;
		$status = $this->add_listing_model->unblock_booking_dates($data);

		if($status > 0) {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully unblocked.");
			echo json_encode($finalResult);
			exit;

		}else{
			$finalResult = array('msg' => 'error', 'response'=>"Somthing went wrong. please try again.");
			echo json_encode($finalResult);
			exit;
		}

	}

	public function block_booking_dates()
	{

		$data = $_POST;
		$status = $this->add_listing_model->insert_block_booking_dates($data);

		if( !empty($status) ) {
			$finalResult = array('msg' => 'success', 'response'=>$status);
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Somthing went wrong. please try again.");
			echo json_encode($finalResult);
			exit;
		}

		

	}


	public function back_to_step3_4()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}


		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$result = $this->add_listing_model->get_dates($data['stp_detail']['id']);

		$dates = '';

		foreach ($result as $res) {

			$s_month = date('m' , strtotime($res['start_date']));
			$s_day = date('d' , strtotime($res['start_date']));

			$e_month = date('m' , strtotime($res['end_date']));
			$e_day = date('d' , strtotime($res['end_date']));

			$s_month = $s_month -1;
			$e_month = $e_month -1;

			$dates .="{
				id: ".$res['id'].",
				name:'' ,
				location:'' ,
				startDate: new Date(currentYear, ".$s_month.", ".$s_day."),
				endDate: new Date(currentYear, ".$e_month.", ".$e_day.")
			},";

		}

		$data['dates'] = $dates;

		$response = $this->load->view('step3_4_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_4/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function step3_5($unique_id = '')
	{
		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$this->load->view('step3_5', $data);
	}




	public function back_to_step3_5()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}


		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);


		$response = $this->load->view('step3_5_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_5/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}

	public function step3_6($unique_id = '')
	{
		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$this->load->view('step3_6', $data);
	}


	public function step3_complete($unique_id = '')
	{

		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		} else {

			redirect('listing/storage/step1');
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$this->load->view('step3_complete' , $data);
	}

	public function goto_edit_step3()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);

		$data['basic_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['extra_rules'] = $this->add_listing_model->get_space_rules(1);

		$data['additional_rules'] = $this->add_listing_model->get_additional_rules($data['stp_detail']['id']);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['stp_detail']['id']);

		$response = $this->load->view('edit_step3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/edit_step3/".$_POST['unique_id']);
		echo json_encode($finalResult);
		exit;
	}


	public function edit_step3($unique_id = '')
	{	

		$data['unique_id'] = $unique_id;

		if($unique_id != NULL){

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($unique_id);

		$data['basic_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['extra_rules'] = $this->add_listing_model->get_space_rules(1);

		$data['additional_rules'] = $this->add_listing_model->get_additional_rules($data['stp_detail']['id']);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['stp_detail']['id']);

		$this->load->view('edit_step3' , $data);
	}

	public function update_step3_1_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$data['basic_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['extra_rules'] = $this->add_listing_model->get_space_rules(1);

		$data['additional_rules'] = $this->add_listing_model->get_additional_rules($data['stp_detail']['id']);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['stp_detail']['id']);

		$response = $this->load->view('update_step3_1_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step3_3_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('update_step3_3_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}


	public function update_step3_4_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$result = $this->add_listing_model->get_dates($data['stp_detail']['id']);

		$dates = '';

		foreach ($result as $res) {

			$s_month = date('m' , strtotime($res['start_date']));
			$s_day = date('d' , strtotime($res['start_date']));

			$e_month = date('m' , strtotime($res['end_date']));
			$e_day = date('d' , strtotime($res['end_date']));

			$s_month = $s_month -1;
			$e_month = $e_month -1;

			$dates .="{
				id: ".$res['id'].",
				name:'' ,
				location:'' ,
				startDate: new Date(currentYear, ".$s_month.", ".$s_day."),
				endDate: new Date(currentYear, ".$e_month.", ".$e_day.")
			},";

		}

		$data['dates'] = $dates;

		$response = $this->load->view('update_step3_4_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step3_5_ajax()
	{	

		if($_POST['unique_id'] != NULL){
			$data['unique_id'] = $_POST['unique_id'];
		}

		$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

		$response = $this->load->view('update_step3_5_ajax', $data, TRUE);

		$finalResult = array('msg' => 'success', 'response'=>$response);
		echo json_encode($finalResult);
		exit;
	}

	public function update_step3_1()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$status = $this->add_listing_model->update_space_rules($data);

		if($status == 'info_changed') {
			
			// $data['updatein'] = 'space characteristics';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($status == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;

		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}
	}

	public function update_step3_3()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$errors = '';

		foreach ($_POST['posted_data'] as $key => $value) {
			if(empty($value)) {
				$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
			}
			if($key  == 'booking_min_day') {
				$booing_min = $value;
			}
			if($key  == 'booking_max_day') {
				$booing_max = $value;
			}

		}

		if($booing_max < $booing_min) {
			$errors .= "Booking Day Max must be greater the or equal to Booking Day Min.<br>";
		}

		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}

		$status = $this->add_listing_model->update_step3_3($data);
		
		if($status == 'info_changed') {
			
			// $data['updatein'] = 'space characteristics';

			$this->send_email_update_storage($data);

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
			echo json_encode($finalResult);
			exit;

		} elseif($status == 'already_changed') {

			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}
	}


	public function update_step3_5()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$errors = '';

		foreach ($_POST['posted_data'] as $key => $value) {
			if(empty($value)) {
				$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
			}
			if($key == 'price_min_day'){
				$price_min = $value;

				if($price_min < 0) {
					$errors .= "Minimum price must be greater then Zero.<br>";
				}

			}

			if($key == 'price_max_day'){
				$price_max = $value;
				if($price_max < 0) {
					$errors .= "Maximum price must be greater then Zero.<br>";
				}
			}
		}

		if($price_max < $price_min) {
			$errors .= "Maximum price must be greater then Minimum price.<br>";
		}

		if(!empty($errors)) {
			$finalResult = array('msg' => 'error', 'response'=>$errors);
			echo json_encode($finalResult);
			exit;
		}

		$status = $this->add_listing_model->insert_step3_5($data);

		if($status > 0) {
			// $this->send_email_update_price($data);
			$finalResult = array('msg' => 'success', 'response'=>"Successfully saved.");
			echo json_encode($finalResult);
			exit;


		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
			echo json_encode($finalResult);
			exit;

		}
	}

	public function update_orignal_price()
	{
		$data = $_POST;

		if(!empty($_POST['unique_id'])){

			$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

			if(!$has_detail) {

				$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
				echo json_encode($finalResult);
				exit;
			}
		}

		$this->form_validation->set_rules('new_price', 'New Price', 'trim|required|xss_clean', array('required' => 'Please enter "New Price" of your storage space.'));


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;

		}else{

			$status = $this->add_listing_model->update_orignal_price($data);
			if($status > 0) {
				$this->send_email_update_price($data);
				$finalResult = array('msg' => 'success', 'response'=>"Successfully saved and your listing has been inactive temporarily until admin approve your edition.");
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>"Please make changes before save.");
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function submit_data()
	{
		$data = $_POST;

		if($_POST){

			if(!get_session('user_logged_in')){

				$finalResult = array('msg' => 'not_login', 'response' => 'Please login to proceed.');
				echo json_encode($finalResult);
				exit;

			} else {

				if(!empty($_POST['unique_id'])){

					$has_detail = $this->add_listing_model->check_detail($_POST['unique_id']);

					//echo $has_detail; exit;

					if(!$has_detail) {

						$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please reload page and try again.");
						echo json_encode($finalResult);
						exit;
					}
				}

				if($data['form_id'] == 'step1') {

					$errors = '';

					foreach ($_POST['posted_data'] as $key => $value) {
						if(empty($value)) {
							$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
						}
					}

					if (empty($data['lat_long'])) {
						$errors .= "Please select a valid place.";
					}

					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}


					if($_POST['unique_id'] != ''){

						$data['unique_id'] = $_POST['unique_id'];
						$list_id = $this->add_listing_model->update_stp1($data);

					}else{

						$data['unique_id'] = md5(uniqid());
						$list_id = $this->add_listing_model->insert_stp1($data);
					}

					if($data['unique_id'] != ''){
						$data['stp_detail'] = $this->add_listing_model->get_detail($data['unique_id']);
					} else {
						$data['stp_detail'] = array();
					}

					$s_storage_type = get_meta_value('space_storage_type',$data['stp_detail']['id']); 

					$data['space_characteristics'] = $this->add_listing_model->get_room_space_character($s_storage_type);

					$list_characteristics = $this->add_listing_model->get_list_character($data['stp_detail']['id']);

					$selected_character = array();
					foreach($list_characteristics as $event_tag){
						$selected_character[] = $event_tag['meta_value'];
					}

					$data['selected_character'] = $selected_character;

					$data['cancellation_policies'] = $this->add_listing_model->get_cancellation_policies();

					$data['policy_note'] = $this->add_listing_model->get_policy_note();

					$response = $this->load->view('step1_1_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_1/".$data['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'step1_1') {

					$errors = '';

					if(empty($data['room_space_character'])){
						$errors .=  'Please select atleast 1 room space character.<br>';
					}

					foreach ($_POST['posted_data'] as $key => $value) {
						if(empty($value)) {
							$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
						}
					}

					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}

					$status = $this->add_listing_model->insert_stp2($data);

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

					$data['amenities'] = $this->add_listing_model->get_list_amenities($data['stp_detail']['id']);

					$data['basic_amenities'] = $this->add_listing_model->get_amenities(0);
					$data['safety_amenities'] = $this->add_listing_model->get_amenities(1);

					$response = $this->load->view('step1_2_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_2/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;


				} elseif($data['form_id'] == 'step1_2') { 

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

					$data['listings_id'] = $data['stp_detail']['id'];

					$status = $this->add_listing_model->insert_step1_2($data);

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

					$data['amenities'] = $this->add_listing_model->get_list_amenities($data['stp_detail']['id']);

					$response = $this->load->view('step1_3_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_3/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'step1_3') {

					$errors = '';

					foreach ($_POST['posted_data'] as $key => $value) {
						if(empty($value)) {
							$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
						}
					}

					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}

					$status = $this->add_listing_model->insert_step1_3($data);

					$response = $this->load->view('step1_complete_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step1_complete/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'step2') {

					$status = $this->add_listing_model->insert_step2_0($data);

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

					$pictures = $this->add_listing_model->get_list_images($data['stp_detail']['id']);

					if(empty($pictures)) {

						$finalResult = array('msg' => 'error', 'response'=>"Please upload atleast one image.");
						echo json_encode($finalResult);
						exit;
					}

					$errors = '';

					foreach ($_POST['image_order'] as $key => $value) {
						if(empty($value)) {
							$errors =  'Please set order of all images.<br>';
						}
					}

					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}

					$pictures = $this->add_listing_model->set_image_orders($data['image_order']);

					$response = $this->load->view('step2_1_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step2_1/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;
				} elseif($data['form_id'] == 'step2_1') {


					$this->form_validation->set_rules('storage_title', 'Storage title', 'trim|required|xss_clean', array('required' => 'Please enter "Storage space title".'));

					$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean', array('required' => 'Please write "Description" of your storage space.'));


					if ($this->form_validation->run($this) == FALSE)
					{
						$finalResult = array('msg' => 'error', 'response'=>validation_errors());
						echo json_encode($finalResult);
						exit;

					}else{

						$status = $this->add_listing_model->insert_step2_1($data);

						$response = $this->load->view('step2_complete_ajax', $data, TRUE);

						$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step2_complete/".$_POST['unique_id']);
						echo json_encode($finalResult);
						exit;
					}
				} elseif($data['form_id'] == 'step3_1') {

					$status = $this->add_listing_model->insert_space_rules($data);

					$status = $this->add_listing_model->insert_additional_space_rules($data);

					$response = $this->load->view('step3_2_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_2/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'step3_2') {

					if(isset($_POST['check'])) {

						$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

						$response = $this->load->view('step3_3_ajax', $data, TRUE);

						$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_3/".$_POST['unique_id']);
						echo json_encode($finalResult);
						exit;
					} else {

						$finalResult = array('msg' => 'error', 'response'=>"Please check 'Got it! I’ll keep my calendar up to date.'.");
						echo json_encode($finalResult);
						exit;
					}
				} elseif($data['form_id'] == 'step3_3') {

					$errors = '';

					foreach ($_POST['posted_data'] as $key => $value) {
						if(empty($value)) {
							$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
						}

						if($key  == 'booking_min_day') {
							$booing_min = $value;
						}
						if($key  == 'booking_max_day') {
							$booing_max = $value;
						}
					}

					if($booing_max < $booing_min) {
						$errors .= "Booking Day Max must be greater the or equal to Booking Day Min.<br>";
					}

					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}

					$status = $this->add_listing_model->insert_step3_3($data);

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

					$result = $this->add_listing_model->get_dates($data['stp_detail']['id']);

					$dates = '';

					foreach ($result as $res) {

						$s_month = date('m' , strtotime($res['start_date']));
						$s_day = date('d' , strtotime($res['start_date']));

						$e_month = date('m' , strtotime($res['end_date']));
						$e_day = date('d' , strtotime($res['end_date']));

						$s_month = $s_month -1;
						$e_month = $e_month -1;

						$dates .="{
							id: ".$res['id'].",
							name:'' ,
							location:'' ,
							startDate: new Date(currentYear, ".$s_month.", ".$s_day."),
							endDate: new Date(currentYear, ".$e_month.", ".$e_day.")
						},";

					}

					$data['dates'] = $dates;

					$response = $this->load->view('step3_4_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_4/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'step3_4') {

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);


					$response = $this->load->view('step3_5_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_5/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				} elseif($data['form_id'] == 'step3_5') {


					$errors = '';

					foreach ($_POST['posted_data'] as $key => $value) {
						if(empty($value)) {
							$errors .=  ucwords(str_replace("_"," ",$key)).' is required.<br>';
						}
						if($key == 'price_min_day'){
							$price_min = $value;

							if($price_min < 0) {
								$errors .= "Minimum price must be greater then Zero.<br>";
							}

						}

						if($key == 'price_max_day'){
							$price_max = $value;
							if($price_max < 0) {
								$errors .= "Maximum price must be greater then Zero.<br>";
							}
						}
					}

					if($price_max < $price_min) {
						$errors .= "Maximum price must be greater then Minimum price.<br>";
					}

					if(!empty($errors)) {
						$finalResult = array('msg' => 'error', 'response'=>$errors);
						echo json_encode($finalResult);
						exit;
					}

					$status = $this->add_listing_model->insert_step3_5($data);

					$response = $this->load->view('step3_6_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_6/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;


				} elseif($data['form_id'] == 'step3_6') {

					$status = $this->add_listing_model->insert_step3_6($data);

					$this->send_email($data);

					$data['stp_detail'] = $this->add_listing_model->get_detail($_POST['unique_id']);

					$response = $this->load->view('step3_complete_ajax', $data, TRUE);

					$finalResult = array('msg' => 'success', 'response'=>$response, 'new_url'=> base_url()."listing/storage/step3_complete/".$_POST['unique_id']);
					echo json_encode($finalResult);
					exit;

				}
			}
		}
	}

	public function upload_storage_picture()
	{
		$data['listings_id'] = '';

		foreach ($_FILES['files'] as $res) {

			foreach ($res as $listings_id => $value) {
				$data['listings_id'] = $listings_id;

				// print_r($_FILES['files']); exit;

				$_FILES['userfile']['name']= $_FILES['files']['name'][$listings_id][0];
				$_FILES['userfile']['type']    = $_FILES['files']['type'][$listings_id][0];
				$_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$listings_id][0]; 
				$_FILES['userfile']['error']       = $_FILES['files']['error'][$listings_id][0];
				$_FILES['userfile']['size']    = $_FILES['files']['size'][$listings_id][0];

				$config['upload_path']          = FCPATH.'assets/storage_images/';
				$config['allowed_types']        = 'jpg|gif|png|jpeg|JPG|PNG';

				$config['max_size']             = 5000;
				$config['max_width']            = 2050;
				$config['max_height']           = 1050;
				$config['encrypt_name'] 		= TRUE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('userfile'))
				{
					$upload_data = $this->upload->data();
					$data['list_image'] = $upload_data['file_name']; 

					$status = $this->add_listing_model->upload_list_image($data);

					$status = explode("-" , $status);

					if ($status[0] == 'new_list') {

						$finalResult = array('msg' => 'success', 'image_id' => $status[1], 'response'=>"Successfully uploaded.");
						echo json_encode($finalResult);
						exit;

					}elseif ($status[0] == 'old_list') {


						// $data['updatein'] = 'Images';

						$this->send_email_update_storage($data);

						$finalResult = array('msg' => 'success', 'image_id' => $status[1], 'response'=>"Successfully upload and your listing has been inactive temporarily until admin approve your edition.");
						echo json_encode($finalResult);
						exit;

					}else{
						$finalResult = array('msg' => 'error', 'response'=>"Something went wrong.");
						echo json_encode($finalResult);
						exit;
					}

				}else{
					$finalResult = array('msg' => 'error', 'response'=> $this->upload->display_errors());
					echo json_encode($finalResult);
					exit;
				} 
			}
		} 
	}


	public function delete_storage_picture()
	{
		$data = $_POST;

		$status = $this->add_listing_model->delete_storage_picture($data);

		if ($status > 0) {

			$finalResult = array('msg' => 'success', 'response' => 'Successfully Deleted');
			echo json_encode($finalResult);
			exit;

		} else {

			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function review_list($unique_id = '')
	{
		if(!empty($unique_id)){

			$data['unique_id'] = $unique_id;

			$has_detail = $this->add_listing_model->check_detail($unique_id);

			if($has_detail == 0) {
				show_404();
			}

		}


		$data['list_detail'] = $this->add_listing_model->get_complete_detail($unique_id);
		$data['list_images'] = $this->add_listing_model->get_list_images($data['list_detail']['id']);

		$data['basic_amenities'] = $this->add_listing_model->get_storage_amenities($data['list_detail']['id'] , '0');
		$data['safety_amenities'] = $this->add_listing_model->get_storage_amenities($data['list_detail']['id'] , '1');


		$data['basic_space_rules'] = $this->add_listing_model->get_space_rules(0);
		$data['rules'] = $this->add_listing_model->get_list_rules($data['list_detail']['id']);

		$data['extra_space_rules'] = $this->add_listing_model->get_storage_space_rules($data['list_detail']['id'] , '1');

		$data['additional_rules'] = $this->add_listing_model->get_storage_additional_rules($data['list_detail']['id']);

		$this->load->view('review_list' , $data);
	}

	public function storage_publish()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->add_listing_model->storage_publish($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully published");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}

	public function storage_unpublish()
	{
		$unique_id = $_POST['unique_id'];

		$status = $this->add_listing_model->storage_unpublish($unique_id);

		if($status > 0){

			$finalResult = array('msg' => 'success', 'response'=>"Successfully unpublished");
			echo json_encode($finalResult);
			exit;

		} else {
			$finalResult = array('msg' => 'error', 'response'=>"Something went wrong please try again.");
			echo json_encode($finalResult);
			exit;
		}
	}
	public function send_email($data)
	{

		$to = admin_email();

		$subject = "New Storage Space Added";

		$list_detail = $this->add_listing_model->get_detail($data['unique_id']);

		$split = str_split($list_detail['description'], 210);
		$final = $split[0] . "...";

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		New storage space has been added.

		<p><strong> Title :</strong> '.$list_detail["title"].' </p>
		<p><strong> Description :</strong> $'.$final.' </p>

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

	public function send_email_update_storage($data)
	{

		$to = admin_email();
		$subject = "List Update From Storage Provider";

		$list_detail = $this->add_listing_model->get_detail(@$data['unique_id'],str_replace("'", "",@$data['listings_id']));

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		'.$list_detail["first_name"].' '.$list_detail["last_name"].' has recently updated his/her listing please review and active his/her list.

		<p> Thanks,<br>
		Dorage</p>
		</div>';

		$email_body = $this->load->view('home/email_template' , $ticket_data,TRUE);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";

		//Send mail 
		@mail($to,$subject,$email_body,$headers);

	}

	public function send_email_update_price($data)
	{

		$to = admin_email();

		$subject = "Price updated From Storage Provider";

		$list_detail = $this->add_listing_model->get_detail($data['unique_id']);

		$ticket_data['msg_body'] = '<div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; width: 100%;">
		<legend><b style="color: #777777;"> Dear Admin, </b> </legend>
		<br>
		'.$list_detail["first_name"].' '.$list_detail["last_name"].' has recently updated his/her listing price please review and active his/her list.

		<p><strong> Title :</strong> '.$list_detail["title"].' </p>
		<p><strong> Old Price/day :</strong> $'.$list_detail["price"].' </p>
		<p><strong> New Price/day :</strong> $'.$list_detail["new_price"].' </p>

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