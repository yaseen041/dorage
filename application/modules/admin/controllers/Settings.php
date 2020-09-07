<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
		if(!$this->session->userdata('admin_logged_in'))
		{
			redirect(admin_url().'login');
		}
		$this->load->model(admin_controller().'settings_model');	
	}

	public function index()
	{
		//$data['settings'] = $this->cms_model->get_all_settings();
		$this->load->view('settings');
	}

	function general_settings($para1="")
	{

		if ($para1 == "") {
			redirect(admin_url().'settings', 'refresh');
		}
		elseif ($para1=="update_home") {


			$this->db->set('meta_value' , $this->input->post('welcome_text'));
			$this->db->where('page', 'home');
			$this->db->where('meta_key', 'welcome_text');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('welcome_desc'));
			$this->db->where('page', 'home');
			$this->db->where('meta_key', 'welcome_desc');
			$this->db->update('settings');


			$this->db->set('meta_value' , $this->input->post('footer_text'));
			$this->db->where('page', 'home');
			$this->db->where('meta_key', 'footer_text');
			$this->db->update('settings');

			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');

			if(!empty($_FILES['banner_image']['name'])){

				$config['upload_path']          = FCPATH.'assets/images/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 5000;
				$config['max_width']            = 1950;
				$config['max_height']           = 1050;
				$config['encrypt_name'] 		= TRUE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('banner_image')){

					$upload_data = $this->upload->data();
					$data['banner_image'] = $upload_data['file_name'];

					$this->db->set('meta_value' , $data['banner_image']);
					$this->db->where('page', 'home');
					$this->db->where('meta_key', 'banner_image');
					$this->db->update('settings');

					$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settingsfff!');

				}else{
					$this->session->set_flashdata('alert_error', $this->upload->display_errors());
				}
			}
			
			redirect(admin_url().'settings', 'refresh');
		}
		elseif ($para1=="update_aboutus") {
			// echo "<pre>";
			// print_r($this->input->post());exit;
			$this->db->set('meta_value' , $this->input->post('aboutus_text1'));
			$this->db->where('page', 'aboutus');
			$this->db->where('meta_key', 'about_us');
			$this->db->update('settings');
			
			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');

		}
		elseif ($para1=="update_pricing") {

			$this->db->set('meta_value' , $this->input->post('pricing_heading'));
			$this->db->where('page', 'pricing');
			$this->db->where('meta_key', 'pricing_heading');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('pricing_statement'));
			$this->db->where('page', 'pricing');
			$this->db->where('meta_key', 'pricing_statement');
			$this->db->update('settings');


			$this->db->set('meta_value' , $this->input->post('update_pricing_heading'));
			$this->db->where('page', 'pricing');
			$this->db->where('meta_key', 'update_pricing_heading');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('update_pricing_statement'));
			$this->db->where('page', 'pricing');
			$this->db->where('meta_key', 'update_pricing_statement');
			$this->db->update('settings');

			
			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');

		}
		elseif ($para1=="update_contact_us") {

			$this->db->set('meta_value' , $this->input->post('contactus_address'));
			$this->db->where('page', 'contactus');
			$this->db->where('meta_key', 'contactus_address');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('contactus_phone'));
			$this->db->where('page', 'contactus');
			$this->db->where('meta_key', 'contactus_phone');
			$this->db->update('settings');


			$this->db->set('meta_value' , $this->input->post('contactus_email'));
			$this->db->where('page', 'contactus');
			$this->db->where('meta_key', 'contactus_email');
			$this->db->update('settings');

			
			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');

		}
		elseif ($para1=="update_mover_fun") {

			$right_option = $this->input->post('mover_provide');
			if (isset($right_option)) {
				$mover_provide = '0';
			} else {
				$mover_provide = '1';
			}

			$this->db->set('meta_value' , $mover_provide);
			$this->db->where('page', 'mover');
			$this->db->where('meta_key', 'mover_provide');
			$this->db->update('settings');

			
			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}
		elseif ($para1=="update_insurance") {

			$right_option = $this->input->post('insurance_provide');
			if (isset($right_option)) {
				$insurance_provide = '0';
			} else {
				$insurance_provide = '1';
			}

			$this->db->set('meta_value' , $this->input->post('insurance_value'));
			$this->db->where('page', 'insurance');
			$this->db->where('meta_key', 'insurance_value');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('insurance_statement'));
			$this->db->where('page', 'insurance');
			$this->db->where('meta_key', 'insurance_statement');
			$this->db->update('settings');


			$this->db->set('meta_value' , $this->input->post('insurance_detail'));
			$this->db->where('page', 'insurance');
			$this->db->where('meta_key', 'insurance_detail');
			$this->db->update('settings');

			$this->db->set('meta_value' , $insurance_provide);
			$this->db->where('page', 'insurance');
			$this->db->where('meta_key', 'insurance_provide');
			$this->db->update('settings');

			
			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}
		elseif ($para1=="update_social_links") {
			
			$this->db->set('meta_value' , $this->input->post('facebook'));
			$this->db->where('page', 'social_links');
			$this->db->where('meta_key', 'facebook');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('twitter'));
			$this->db->where('page', 'social_links');
			$this->db->where('meta_key', 'twitter');
			$this->db->update('settings');

			$this->db->set('meta_value' , $this->input->post('instagram'));
			$this->db->where('page', 'social_links');
			$this->db->where('meta_key', 'instagram');
			$this->db->update('settings');

			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}

		elseif ($para1=="update_careers") {
			
			$this->db->set('meta_value' , $this->input->post('careers_text'));
			$this->db->where('page', 'careers');
			$this->db->where('meta_key', 'careers');
			$this->db->update('settings');

			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}

		elseif ($para1=="update_policies") {
			
			$this->db->set('meta_value' , $this->input->post('policy1'));
			$this->db->where('page', 'policies');
			$this->db->where('meta_key', 'policies');
			$this->db->update('settings');


			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}

		elseif ($para1=="update_terms_and_conditions") {
			$this->db->set('meta_value' , $this->input->post('tcondition1'));
			$this->db->where('page', 'termconditions');
			$this->db->where('meta_key', 'termconditions');
			$this->db->update('settings');

			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}
		elseif ($para1=="update_privacy_policy") {
			$this->db->set('meta_value' , $this->input->post('ppolicy1'));
			$this->db->where('page', 'privacypolicy');
			$this->db->where('meta_key', 'privacypolicy');
			$this->db->update('settings');

			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}
		elseif ($para1=="update_help") {
			$this->db->set('meta_value' , $this->input->post('help_text'));
			$this->db->where('page', 'help');
			$this->db->where('meta_key', 'help');
			$this->db->update('settings');

			$this->session->set_flashdata('alert_success', 'You Have Successfully Edited The Settings!');
			redirect(admin_url().'settings', 'refresh');
		}
		
	}
}