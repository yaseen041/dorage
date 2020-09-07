<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preference extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		$this->load->model(admin_controller().'preference_model');	
	}
	public function storage_size_types()
	{	
		$data['spaces'] = $this->preference_model->get_spaces();
		$this->load->view('storage_size_types' , $data);
	}
	public function space_storage_types()
	{	
		$data['spaces'] = $this->preference_model->get_space_storage_types();
		$this->load->view('space_storage_types' , $data);
	}

	public function room_space_characteristics()
	{	
		$data['characteristics'] = $this->preference_model->get_room_space_characteristic();
		$this->load->view('room_space_characteristic' , $data);
	}


	public function add_storage_size_type()
	{	
		$this->load->view('add_storage_size_type');
	}
	public function edit_storage_size_type($space_id)
	{	
		$data['space_detail'] = $this->preference_model->get_space_detail($space_id);
		if (empty($data['space_detail'])) {
			show_404();
		}
		$this->load->view('edit_storage_size_type' , $data);
	}
	public function insert_space()
	{
		$data = $_POST;

		$this->form_validation->set_rules('space_type', 'Space Type', 'trim|required|xss_clean|callback_storage_name_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_space_type($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Storage size type successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}

	}
	public function storage_name_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_storage_name($data['space_type']);
		if ($status > 0)
		{
			$this->form_validation->set_message('storage_name_exist', 'Storage Size Type Already Exist.');
			return FALSE;

		} else {
			return TRUE;
		}
	}

	public function taxes()
	{
		$data['states'] = $this->preference_model->states();
		$this->load->view('taxes' , $data);
	}

	public function insert_taxes()
	{
		$data = $_POST;
		$status = $this->preference_model->insert_taxes($data);
		if($status){   
			$finalResult = array('msg' => 'success', 'response'=>'<p>Successfully updated!</p>');
			echo json_encode($finalResult);
			exit;
		} else {
			$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
			echo json_encode($finalResult);
			exit;
		}
	}

	public function update_space()
	{
		$data = $_POST;

		$this->form_validation->set_rules('space_type', 'Space Type', 'trim|required|xss_clean|callback_space_name_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_storage_space($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Storage Size Type Successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}

	public function space_name_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_space_name_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('space_name_update_exist', 'Storage Size Type Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}

	public function delete_storage()
	{
		if (!empty($_POST['space_id'])) {
			$status = $this->preference_model->delete_storage($_POST['space_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Storage Size Type Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete storage size type .');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}
	public function inactive_storage_status()
	{
		$space_id = $this->input->post('space_id');
		$status = $this->preference_model->inactive_storage_status($space_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Storage Size Type Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive storage size type.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_storage_status()
	{
		$space_id = $this->input->post('space_id');
		$status = $this->preference_model->active_storage_status($space_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Storage Size Type Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active storage size type.');
			echo json_encode($finalResult);
			exit;
		}
		
	}


	public function inactive_space_storage_type_status()
	{
		$space_storage_type_id = $this->input->post('space_storage_type_id');
		$status = $this->preference_model->inactive_space_storage_type_status($space_storage_type_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Property Available Space Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive property available space.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_space_storage_type_status()
	{
		$space_storage_type_id = $this->input->post('space_storage_type_id');
		$status = $this->preference_model->active_space_storage_type_status($space_storage_type_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Property Available Space Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active property available space.');
			echo json_encode($finalResult);
			exit;
		}
		
	}


	public function add_space_storage_type()
	{	
		$data['spaces'] = $this->preference_model->get_spaces();
		$this->load->view('add_space_storage_type' , $data);
	}

	public function insert_space_storage_type()
	{
		$data = $_POST;

		$this->form_validation->set_rules('space_storage_type', 'Space Storage Type', 'trim|required|xss_clean|callback_space_storage_type_exist');


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_space_storage_type($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Space storage type successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function space_storage_type_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_space_storage_type_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('space_storage_type_exist', 'Space Storage Type Already Exist.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function edit_space_storage_type($space_storage_type_id)
	{	
		$data['space_storage_type_detail'] = $this->preference_model->get_space_storage_type_detail($space_storage_type_id);
		if (empty($data['space_storage_type_detail'])) {
			show_404();
		}
		$data['spaces'] = $this->preference_model->get_spaces();
		$this->load->view('edit_space_storage_type' , $data);
	}


	public function update_space_storage_type()
	{
		$data = $_POST;

		$this->form_validation->set_rules('space_storage_type', 'Available Space', 'trim|required|xss_clean|callback_space_storage_type_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_space_storage_type($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Space storage type successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function space_storage_type_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->space_storage_type_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('space_storage_type_update_exist', 'Space storage type already exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}

	public function delete_space_storage_type()
	{
		if (!empty($_POST['space_storage_type_id'])) {
			$status = $this->preference_model->delete_space_storage_type($_POST['space_storage_type_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Property Available Space Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete property available space.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}
	public function amenities()
	{
		$data['amenities'] = $this->preference_model->get_amenities();
		$this->load->view('amenities' , $data);
	}
	public function inactive_amenity()
	{
		$amenity_id = $this->input->post('amenity_id');
		$status = $this->preference_model->inactive_amenity($amenity_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Amenity Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive amenity.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_amenity()
	{
		$amenity_id = $this->input->post('amenity_id');
		$status = $this->preference_model->active_amenity($amenity_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Amenity Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active amenity.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function add_amenity()
	{
		$this->load->view('add_amenity');
	}

	public function insert_amenity()
	{
		$data = $_POST;

		$this->form_validation->set_rules('amenity_title', 'Amenity Title', 'trim|required|xss_clean|is_unique[amenities.name]', array('is_unique' => 'Amenity Title Already Exist.'));

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_amenity($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Amenity successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}
	public function edit_amenity($amenity_id)
	{	
		$data['amenity_detail'] = $this->preference_model->get_amenity_detail($amenity_id);
		if (empty($data['amenity_detail'])) {
			show_404();
		}
		$this->load->view('edit_amenity' , $data);
	}

	public function update_amenity()
	{
		$data = $_POST;

		$this->form_validation->set_rules('amenity_title', 'Amenity Title', 'trim|required|xss_clean|callback_amenity_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_amenity($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Amenity Successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}
	public function amenity_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_amenity_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('amenity_update_exist', 'Amenity Title Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}


	public function delete_amenity()
	{
		if (!empty($_POST['amenity_id'])) {
			$status = $this->preference_model->delete_amenity($_POST['amenity_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Amenity Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete amenity.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}



	// ----------------------------------


	public function spaces_can_use()
	{
		$data['spaces'] = $this->preference_model->get_spaces_can_use();
		$this->load->view('spaces_use' , $data);
	}
	public function inactive_space_can_use()
	{
		$space_id = $this->input->post('space_id');
		$status = $this->preference_model->inactive_space_can_use($space_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Space Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive space.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_space_can_use()
	{
		$space_id = $this->input->post('space_id');
		$status = $this->preference_model->active_space_can_use($space_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Space Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active space.');
			echo json_encode($finalResult);
			exit;
		}
		
	}

	public function add_space_can_use()
	{
		$this->load->view('add_space_can_use');
	}

	public function insert_space_can_use()
	{
		$data = $_POST;

		$this->form_validation->set_rules('space_title', 'Space Title', 'trim|required|xss_clean|is_unique[spaces_guest_use.name]', array('is_unique' => 'Space Title Already Exist.'));

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_space_can_use($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Space successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function edit_space_can_use($space_id)
	{	
		$data['space_detail'] = $this->preference_model->get_space_can_use($space_id);
		if (empty($data['space_detail'])) {
			show_404();
		}
		$this->load->view('edit_space_can_use' , $data);
	}


	public function update_space_can_use()
	{
		$data = $_POST;

		$this->form_validation->set_rules('space_title', 'Space Title', 'trim|required|xss_clean|callback_space_can_use_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_space_can_use($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Space successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}
	public function space_can_use_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_space_can_use_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('space_can_use_update_exist', 'Space Title Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}

	public function delete_space_can_use()
	{
		if (!empty($_POST['space_id'])) {
			$status = $this->preference_model->delete_space_can_use($_POST['space_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Space Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete space.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}

	//---------------------------------- space_rules ----------------//

	public function space_rules()
	{
		$data['rules'] = $this->preference_model->get_space_rules();
		$this->load->view('space_rules' , $data);
	}

	public function inactive_space_rule()
	{
		$rule_id = $this->input->post('rule_id');
		$status = $this->preference_model->inactive_space_rule($rule_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'House Rule Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive house rule.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_space_rule()
	{
		$rule_id = $this->input->post('rule_id');
		$status = $this->preference_model->active_space_rule($rule_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Space Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active space.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function add_space_rule()
	{
		$this->load->view('add_space_rule');
	}

	public function insert_space_rule()
	{
		$data = $_POST;

		$this->form_validation->set_rules('rule_title', 'Rule Title', 'trim|required|xss_clean|is_unique[space_rules.name]', array('is_unique' => 'Rule Title Already Exist.'));

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_space_rule($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Rule successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function edit_space_rule($rule_id)
	{	
		$data['rule_detail'] = $this->preference_model->get_rule_detail($rule_id);
		if (empty($data['rule_detail'])) {
			show_404();
		}
		$this->load->view('edit_space_rule' , $data);
	}

	public function delete_space_rule()
	{
		if (!empty($_POST['rule_id'])) {
			$status = $this->preference_model->delete_space_rule($_POST['rule_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Rule Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete space rule.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}

	public function update_space_rule()
	{
		$data = $_POST;

		$this->form_validation->set_rules('rule_title', 'Rule Title', 'trim|required|xss_clean|callback_space_rule_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_space_rule($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Rule successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}


	public function space_rule_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_space_rule_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('space_rule_update_exist', 'Rule Title Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}


	//-------------------------------------------


	public function add_room_space_characteristic()
	{	
		$data['space_storage_types'] = $this->preference_model->get_space_storages();
		$this->load->view('add_room_space_characteristic' , $data);
	}

	public function insert_room_space_characteristic()
	{
		$data = $_POST;

		$this->form_validation->set_rules('room_space_characteristic', 'Room Space Characteristic', 'trim|required|xss_clean|callback_room_space_characteristic_exist');


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_room_space_characteristic($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Room space characteristic successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function room_space_characteristic_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_room_space_characteristic_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('room_space_characteristic_exist', 'Room Space Characteristic Already Exist.');
			return FALSE;
		} else {
			return TRUE;
		}
	}


	public function inactive_room_space_characteristic_status()
	{
		$room_space_char_id = $this->input->post('room_space_characteristic_id');
		$status = $this->preference_model->inactive_room_space_char_status($room_space_char_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Room Space Characteristic Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive room space characteristic.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_room_space_characteristic_status()
	{
		$room_space_char_id = $this->input->post('room_space_characteristic_id');
		$status = $this->preference_model->active_room_space_characteristic_status($room_space_char_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Room Space Characteristic Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active room space characteristic.');
			echo json_encode($finalResult);
			exit;
		}
		
	}

	public function edit_room_space_characteristic($id)
	{	
		$data['room_char_detail'] = $this->preference_model->get_room_space_char($id);
		if (empty($data['room_char_detail'])) {
			show_404();
		}
		$data['space_storage_types'] = $this->preference_model->get_space_storages();
		$this->load->view('edit_room_space_characteristic' , $data);
	}


	public function update_room_space_characteristic()
	{
		$data = $_POST;

		$this->form_validation->set_rules('room_space_characteristic', 'Room Space Characteristic', 'trim|required|xss_clean|callback_room_space_characteristic_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_room_space_characteristic($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Room Space Characteristic successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function room_space_characteristic_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->room_space_characteristic_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('room_space_characteristic_update_exist', 'Room Space Characteristic Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}

	public function delete_room_space_characteristic()
	{
		if (!empty($_POST['room_char_id'])) {
			$status = $this->preference_model->delete_room_space_characteristic($_POST['room_char_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Room Space Characteristic Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete room space characteristic.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}

	public function cancellation_policies()
	{	
		$data['policies'] = $this->preference_model->get_cancellation_policies();
		$data['policy_note'] = $this->preference_model->get_policy_note();
		$this->load->view('cancellation_policies' , $data);
	}

	public function update_policy_note()
	{
		$data = $_POST;

		$this->form_validation->set_rules('policy_note_text', 'Cancellation Policy Note', 'trim|required|xss_clean');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_policy_note($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Cancellation Policy Note Successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}


	public function inactive_policy_status()
	{
		$policy_id = $this->input->post('room_space_characteristic_id');
		$status = $this->preference_model->inactive_cancellation_policy($policy_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Cancellation Policy Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive cancellation policy.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_policy_status()
	{
		$policy_id = $this->input->post('room_space_characteristic_id');
		$status = $this->preference_model->active_cancellation_policy($policy_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Cancellation Policy Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active cancellation policy.');
			echo json_encode($finalResult);
			exit;
		}
		
	}

	public function add_cancellation_policy()
	{	
		$this->load->view('add_cancellation_policy');
	}

	public function insert_cancellation_policy()
	{
		$data = $_POST;

		$this->form_validation->set_rules('cancellation_policy', 'Cancellation Policy', 'trim|required|xss_clean|callback_cancellation_policy_exist');


		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_cancellation_policy($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Cancellation policy successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}

	public function cancellation_policy_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->cancellation_policy_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('cancellation_policy_exist', 'Cancellation Policy Already Exist.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function edit_cancellation_policy($policy_id)
	{	
		$data['policy_detail'] = $this->preference_model->get_policy_detail($policy_id);
		if (empty($data['policy_detail'])) {
			show_404();
		}
		$this->load->view('edit_cancellation_policy' , $data);
	}

	public function update_cancellation_policy()
	{
		$data = $_POST;

		$this->form_validation->set_rules('cancellation_policy', 'Cancellation Policy', 'trim|required|xss_clean|callback_policy_name_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_cancellation_policy($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Cancellation policy successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}

	public function policy_name_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_policy_name_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('policy_name_update_exist', 'Cancellation Policy Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}

	public function delete_policy()
	{
		if (!empty($_POST['policy_id'])) {
			$status = $this->preference_model->delete_policy($_POST['policy_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Cancellation Policy Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete cancellation policy.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}


	// -----------------------------------



	public function customer_requirements()
	{
		$data['requirements'] = $this->preference_model->get_requirements();
		$this->load->view('customer_requirements' , $data);
	}
	public function inactive_requirement()
	{
		$requirement_id = $this->input->post('requirement_id');
		$status = $this->preference_model->inactive_requirement($requirement_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Customer Requirement Successfully Inactive.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to inactive customer requirement.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function active_requirement()
	{
		$requirement_id = $this->input->post('requirement_id');
		$status = $this->preference_model->active_requirement($requirement_id);
		if($status){
			$finalResult = array('msg' => 'success', 'response'=>'Customer Requirement Successfully Active.');
			echo json_encode($finalResult);
			exit;
		}else{
			$finalResult = array('msg' => 'error', 'response'=>'Unable to active customer requirement.');
			echo json_encode($finalResult);
			exit;
		}
		
	}
	public function add_requirement()
	{	
		$this->load->view('add_requirement');
	}

	public function insert_requirement()
	{
		$data = $_POST;

		$this->form_validation->set_rules('requirement_title', 'Customer Requirement Title', 'trim|required|xss_clean|is_unique[customer_requirements.name]', array('is_unique' => 'Customer Requirement Title Already Exist.'));

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{ 

			$status = $this->preference_model->insert_requirement($data);
			if($status){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Customer requirement successfully added!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}
		}
	}



	public function edit_requirement($requirement_id)
	{	
		$data['requirement_detail'] = $this->preference_model->get_requirement_detail($requirement_id);
		if (empty($data['requirement_detail'])) {
			show_404();
		}
		$this->load->view('edit_requirement' , $data);
	}

	public function update_requirement()
	{
		$data = $_POST;

		$this->form_validation->set_rules('requirement_title', 'Customer Requirement Title', 'trim|required|xss_clean|callback_requirement_update_exist');

		if ($this->form_validation->run($this) == FALSE)
		{
			$finalResult = array('msg' => 'error', 'response'=>validation_errors());
			echo json_encode($finalResult);
			exit;
		}else{

			$status = $this->preference_model->update_requirement($data);
			if($status > 0){   
				$finalResult = array('msg' => 'success', 'response'=>'<p>Customer Requirement Successfully updated!</p>');
				echo json_encode($finalResult);
				exit;
			} else {
				$finalResult = array('msg' => 'error', 'response'=>'<p>Something went wrong !</p>');
				echo json_encode($finalResult);
				exit;
			}

		}
	}
	public function requirement_update_exist()
	{
		$data = $_POST;
		$status = $this->preference_model->check_requirement_update_exist($data);
		if ($status > 0)
		{
			$this->form_validation->set_message('requirement_update_exist', 'Customer Requirement Title Already Exist.');
			return FALSE;
			
		} else {
			return TRUE;
		}
	}


	public function delete_requirement()
	{
		if (!empty($_POST['requirement_id'])) {
			$status = $this->preference_model->delete_requirement($_POST['requirement_id']);
			if($status){
				$finalResult = array('msg' => 'success', 'response'=>'Customer Requirement Successfully Deleted.');
				echo json_encode($finalResult);
				exit;
			}else{
				$finalResult = array('msg' => 'error', 'response'=>'Unable to delete customer requirement.');
				echo json_encode($finalResult);
				exit;
			} 
		}
	}

}