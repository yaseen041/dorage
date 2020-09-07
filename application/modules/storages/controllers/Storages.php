<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storages extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('storage_model');
		$this->load->library("pagination");
	}
	
	public function index()
	{	
		$data = $_GET;

		$data['listings'] = array();
		$data['states'] = $this->storage_model->get_states();
		$data['sizeTypes'] = $this->storage_model->get_size_types();

		if(!empty($_GET['storage_size_type'])) {
			$data['storage_types'] = $this->storage_model->get_storage_types($_GET['storage_size_type']);
		} else {
			$data['storage_types'] = array();
		}

		$storage_type_arr = array();

		if(!empty($_GET['storage_type'][0])) {

			if(!empty($_GET['storage_type'])) {
				foreach ($_GET['storage_type'] as $key => $value) {
					$storage_type_arr[] = $value;
				}
			}

		}

		$data['space_characters'] = $this->storage_model->get_room_space_character();

		$data['storage_type_arr'] = $storage_type_arr;

		$space_character_arr = array();

		if(!empty($_GET['space_character'])) {
			foreach ($_GET['space_character'] as $key => $value) {
				$space_character_arr[] = $value;
			}
		}

		$data['space_character_arr'] = $space_character_arr;

		$data['listings'] = $this->storage_model->get_listings($_GET, $storage_type_arr , $space_character_arr);
		$this->load->view('storages' , $data);
	}

	public function search()
	{	
		$data = $_GET;

		set_session('search_parameters',$_GET);

		$date = explode('to', @$data['search_startdate']);

		$date1 = date_create(@$date[0]);
		$date2 = date_create(@$date[1]);

		//difference between two dates
		$diff = date_diff($date1,$date2);

		//count days
		$data['booking_days'] = $diff->format("%a") + 1;

		$latlong = explode(',', @$data['lat_long']);
		$data['lat'] = @trim($latlong[0]);
		$data['lng'] = @trim($latlong[1]);

		
		$data['sizeTypes'] = $this->storage_model->get_size_types();

		if(!empty($_GET['storage_size_type'])) {
			$data['storage_types'] = $this->storage_model->get_storage_types($_GET['storage_size_type']);
		} else {
			$data['storage_types'] = array();
		}

		$storage_type_arr = array();

		if(!empty($_GET['storage_type'][0])) {

			if(!empty($_GET['storage_type'])) {
				foreach ($_GET['storage_type'] as $key => $value) {
					$storage_type_arr[] = $value;
				}
			}
		}

		$data['space_characters'] = $this->storage_model->get_room_space_character();

		$data['storage_type_arr'] = $storage_type_arr;

		$space_character_arr = array();

		if(!empty($_GET['space_character'])) {
			foreach ($_GET['space_character'] as $key => $value) {
				$space_character_arr[] = $value;
			}
		}

		$data['space_character_arr'] = $space_character_arr;

		$total_storages = $this->storage_model->get_count_listings($data, $storage_type_arr , $space_character_arr);

		$config = array();
		$config["base_url"] = site_url('storages/search');
		$total_row = count($total_storages);
		$config["total_rows"] = $total_row;
		$config['prefix'] = '/';
		$config["per_page"] = 10;
		$config['suffix'] = '/?'.$_SERVER['QUERY_STRING'];
		$config['uri_segment'] = 3;
		$config['first_url'] = site_url('storages/search/?'.$_SERVER['QUERY_STRING'].'');
		//$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 5;

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<a>';
		$config['first_tag_close'] = '</a>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<a class="prev">';
		$config['prev_tag_close'] = '</a>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<a>';
		$config['next_tag_close'] = '</a>';
		$config['last_tag_open'] = '<a>';
		$config['last_tag_close'] = '</a>';
		$config['cur_tag_open'] = '<a href="javascript:void(0)" class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['num_tag_open'] = '<a>';
		$config['num_tag_close'] = '</a>';

		$this->pagination->initialize($config);
			//print_r($post_cat_ids);exit;
		$start_page = $this->uri->segment(3);
			// echo $start_page;exit;
		if(isset($start_page)){
			$page = $start_page;
		}else{
			$page = 0;
		}
			//$page = 2;
		$data['links'] = $this->pagination->create_links();
		if(!empty($data['lat'])){
			$data['listings'] = $this->storage_model->get_search_listings($config["per_page"],$page,$data, $storage_type_arr , $space_character_arr);
			$data['location_error'] = '';
		} else {
			$data['listings'] = array();
			$data['location_error'] = 'You have entered an invalid location. Please select a valid location from suggested list and try again.';
		}
		$data['states'] = $this->storage_model->get_states();
		// show($data);exit;
		$this->load->view('storages' , $data);
	}
}