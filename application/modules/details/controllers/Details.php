<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('detail_model');
	}
	public function index()
	{	
		show_404();
		// $data['pending_orders'] = $this->admin_model->get_orders();
		// $this->load->view('properties', $data);
		$this->load->view('properties');
	}
	public function storage($unique_id = '', $event_name , $from_home = '')
	{	
		if(empty($unique_id) || empty($event_name)) {
			show_404();
		}

		$data['list_detail'] = $this->detail_model->get_complete_detail($unique_id);

		$data['list_images'] = $this->detail_model->get_list_images($data['list_detail']['id']);

		$data['basic_amenities'] = $this->detail_model->get_storage_amenities($data['list_detail']['id'] , '0');
		$data['safety_amenities'] = $this->detail_model->get_storage_amenities($data['list_detail']['id'] , '1');


		$data['basic_space_rules'] = $this->detail_model->get_space_rules(0);
		$data['rules'] = $this->detail_model->get_list_rules($data['list_detail']['id']);

		$data['extra_space_rules'] = $this->detail_model->get_storage_space_rules($data['list_detail']['id'], '1');

		$data['additional_rules'] = $this->detail_model->get_storage_additional_rules($data['list_detail']['id']);

		if(empty($data['list_detail'])) {
			show_404();
		}

		//print_r($data['list_detail']); exit;

		if($data['list_detail']['is_published'] == '0' || $data['list_detail']['status'] == '0' || $data['list_detail']['is_deleted'] == '1') {
			show_404();
		}

		$li_detail = $data['list_detail'];
		if(!empty($from_home) && empty(get_session('search_parameters')['search_startdate'])){

			unset_session('search_parameters');
			set_session('search_parameters', array("place"=> $li_detail['place'] , "lat_long" => $li_detail['latitude'].",".$li_detail['longitude'] , "search_startdate" => '',"storage_size_type" => ''));
			

		} elseif(empty(get_session('search_parameters')['place'])) {
			set_session('search_parameters', array("place"=> $li_detail['place'] , "lat_long" => $li_detail['latitude'].",".$li_detail['longitude'] , "search_startdate" => '', "storage_size_type" => ''));
		}

		if(!empty(get_session('search_parameters')['search_startdate'])) {

			$dates = explode('to',get_session('search_parameters')['search_startdate']);

			$data['start_date'] = $dates[0];
			$data['end_date'] = $dates[1];


			$date1 = date_create($data['start_date']);
			$date2 = date_create($data['end_date']);

		//difference between two dates
			$diff = date_diff($date1,$date2);

		//count days
			$booking_days = $diff->format("%a") + 1;

			$data['booking_days'] = $booking_days;

			$data['listings_id'] = $data['list_detail']['id'];

			if( ( $booking_days < (int) get_meta_value('booking_min_day' , $data['listings_id']) )  || ( $booking_days > (int) get_meta_value('booking_max_day' , $data['listings_id']))) {

				$data['availablity_detail'] = "<p class='text-danger'><br>This storage is not available for booking in your selected dates.</p>";

			} else{
				$data['availablity_detail'] = $this->load->view('booking_ajax', $data, TRUE);
			}

		} else {
			$data['availablity_detail'] = '';
		}

		$this->load->view('property_detail' , $data);
	}

	public function mover($unique_id = '', $event_name)
	{	
		if(empty($unique_id) || empty($event_name)) {
			show_404();
		}

		$data['mover_detail'] = $this->detail_model->get_complete_detail($unique_id);
		$data['vehicles'] = $this->detail_model->get_vehicles($data['mover_detail']['id']);

		if(empty($data['mover_detail'])) {
			show_404();
		}


		if($data['mover_detail']['is_published'] == '0' || $data['mover_detail']['status'] == '0' || $data['mover_detail']['is_deleted'] == '1' || $data['mover_detail']['is_banned'] == '1') {
			show_404();
		}
		
		$this->load->view('mover_detail' , $data);
	}

	public function check_availability()
	{
		$data = $_POST;
		
		$dates = explode('to',$data['booking_date']);

		if(empty($dates[0])) {
			$finalResult = array('msg' => 'error', 'response'=>"Please select correct dates range.");
			echo json_encode($finalResult);
			exit;
		}

		$data['start_date'] = $dates[0];
		$data['end_date'] = $dates[1];
		$sessionValues = get_session('search_parameters');
		$sessionValues['search_startdate'] = $data['booking_date'];
		set_session('search_parameters',$sessionValues);

		if(empty($dates[0])) {
			$finalResult = array('msg' => 'error', 'response'=>"Please select correct dates range.");
			echo json_encode($finalResult);
			exit;
		}

		if(empty($dates[1])) {
			$finalResult = array('msg' => 'success', 'response'=>"<p class='text-danger'><br>Please select correct dates range.</p>");
			echo json_encode($finalResult);
			exit;
		}

		if (empty($data['listings_id'])) {
			$finalResult = array('msg' => 'success', 'response'=>"<p class='text-danger'><br>Somthig went wrong. Please reload window and try again.</p>");
			echo json_encode($finalResult);
			exit;
		}

		$date1 = date_create($data['start_date']);
		$date2 = date_create($data['end_date']);

		//difference between two dates
		$diff = date_diff($date1,$date2);

		//count days
		$booking_days = $diff->format("%a") + 1;

		$data['booking_days'] = $booking_days;
		// var_dump( $booking_days < (int) get_meta_value('booking_max_day' , $data['listings_id']) );exit;

		if( ( $booking_days < (int) get_meta_value('booking_min_day' , $data['listings_id']) )  || ( $booking_days > (int) get_meta_value('booking_max_day' , $data['listings_id']))) {

			$finalResult = array('msg' => 'success', 'response'=>"<p class='text-danger'><br>This storage is not available for booking in your selected dates.</p>");
			echo json_encode($finalResult);
			exit;

		}

		$status = $this->detail_model->get_availability_detail($data);

		if($status > 0){


			$finalResult = array('msg' => 'success', 'response'=>"<p class='text-danger'><br>This storage is not available for booking in your selected dates.</p>");
			echo json_encode($finalResult);
			exit;

		} else {

			$data['list_detail'] = $this->detail_model->get_detail_by_id($data['listings_id']);

			$response = $this->load->view('booking_ajax', $data, TRUE);

			$finalResult = array('msg' => 'success', 'response'=>$response);
			echo json_encode($finalResult);
			exit;
			
		}		
	}

	public function book_now()
	{
		$data = $_POST;

		if(!get_session('user_logged_in')){

			$finalResult = array('msg' => 'not_login', 'response' => 'Please login to proceed.');
			echo json_encode($finalResult);
			exit;
		}

		$list_detail = $this->detail_model->get_detail_by_id($data['listings_id']);

		if($list_detail['users_id'] == get_session('user_id')){

			$finalResult = array('msg' => 'error', 'response' => "You cann't create booking against your own listing.");
			echo json_encode($finalResult);
			exit;
		}

		if(get_session('profile_updated') == 0){

			$finalResult = array('msg' => 'error', 'response' => "Please complete your profile to continue. <a href='".base_url()."user/edit_profile' target='_blank'> Goto profile </a>");
			echo json_encode($finalResult);
			exit;
		}
		

		$data['unique_id'] = md5(uniqid());

		$status = $this->detail_model->book_now($data);

		if($status) {

			$finalResult = array('msg' => 'success', 'response' =>base_url().'booking/payment/'.$data['unique_id']);
			echo json_encode($finalResult);
			exit;

		}
	}

	public function chatMessage(){

		$data = $this->input->post();
		$data = $this->security->xss_clean($data);
		if (!get_session('user_logged_in')) {
			$finalResult = array('msg' => 'login_error', 'response' => 'Login is required.');
			echo json_encode($finalResult);
			exit;
		}
		$userRecord = singleRow('users', '*', 'id = '.get_session('user_id'));
		if ($userRecord['profile_updated'] == 0) {
			$finalResult = array('msg' => 'error', 'response' => 'Please update your profile before sending a message.');
			echo json_encode($finalResult);
			exit;
		}
		if (empty($data['message'])) {
			$finalResult = array('msg' => 'error', 'response' => 'Please fill the message field.');
			echo json_encode($finalResult);
			exit;
		}
		$receiver = $this->detail_model->insertChatMessage($data);
		$this->send_email_to_receiver($receiver);
		$finalResult = array('msg' => 'success', 'response' => 'Message has been sent, Please check your inbox for messages history.');
		echo json_encode($finalResult);
		exit;
	}

	public function send_email_to_receiver($receiver)
	{
		$record = singleRow('users', '*', 'id = "'.$receiver['users_id'].'"');

		$to = $record['email'];
		$subject = "New Message";

		$body = "<html>
		<head>
		<title></title>
		</head>
		<body>
		<h3> Hi ".$record['first_name']." ".$record['last_name'].",</h3>

		<p>You have received new message against your list.</p><br>
		<p><strong>List Title :</strong> ".$receiver['title']." </p>

		<p> <a href='".base_url()."'> Login to Dorage </a> for more detail </p>

		<strong> Regards, </strong> <br>
		<strong> Dorage Management Team  <br> Thanks </strong>

		</body>
		</html>";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'.no_reply_email().'>' . "\r\n";
		
         //Send mail 
		@mail($to,$subject,$body,$headers);
	}

	public function reviewAgainstListing(){
		$data = $this->input->post();
		$data = $this->security->xss_clean($this->input->post());
		if(!get_session('user_logged_in')){
			$finalResult = array('msg' => 'login_error', 'response' => 'Login is required to leave a review, Please login.');
			echo json_encode($finalResult);
			exit;
		}
		if (empty($data['reviewMessage'])) {
			$finalResult = array('msg' => 'login_error', 'response' => 'Please enter review.');
			echo json_encode($finalResult);
			exit;
		}
		$this->detail_model->insertReview($data);
		$finalResult = array('msg' => 'success', 'response' => 'Review has been added against this listing.');
		echo json_encode($finalResult);
		exit;
	}

	public function replyAgainstReview(){
		$data = $this->input->post();
		$data = $this->security->xss_clean($this->input->post());
		if(!get_session('user_logged_in')){
			$finalResult = array('msg' => 'login_error', 'response' => 'Login is required to reply, Please login.');
			echo json_encode($finalResult);
			exit;
		}
		if (empty($data['replyMessage'])) {
			$finalResult = array('msg' => 'login_error', 'response' => 'Please enter reply.');
			echo json_encode($finalResult);
			exit;
		}
		$this->detail_model->insertReply($data);
		$finalResult = array('msg' => 'success', 'response' => 'Reply has been added against a review.');
		echo json_encode($finalResult);
		exit;
	}

}