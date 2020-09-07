<!-- Forgot Password Popup Model -->

<div class="modal fade login-popup centered-modal" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close close-login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Reset Password</h4>
			</div>
			<form id="retrieve_password_form" action="" method="post" novalidate>
				<div class="modal-body">

					<p>Enter the email address associated with your account, and we’ll email you a link to reset your password.</p>
					<div class="input-group" style="width:100%;">
						<span><i class="fa fa-envelope mail-icon"></i></span>
						<input type="email" class="form-control" name="email" placeholder="Email Address" required>
					</div>

				</div>

				<div class="modal-footer text-center">
					<p class="pull-left back-login"><a href="javascript:void(0)" id="back_to_login_mdl"><i class="fa fa-angle-left"></i> Back to Login </a> </p>
					<button type="submit" data-loading-text="Please wait..." id="retrieve_password" class="btn next-btn pull-right">Send Reset Link</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Forgot Password End -->

<!-- Login Popup Model -->

<div class="modal fade login-popup centered-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close close-login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Login</h4>
			</div>

			<div class="modal-body">

				<div id="verification_error" class="alert alert-danger clearfix" style="display: none;">

				</div>

				<div id="verification_success" class="alert alert-success clearfix" style="display: none;">

				</div>

				<form id="login_form" action="" method="post">

					<div class="input-group" style="width:100%;">
						<span><i class="fa fa-envelope mail-icon"></i></span>
						<input type="email" class="form-control" name="login_email" placeholder="Email Address" required>
					</div>


					<div class="input-group" style="width:100%;">	
						<span><i class="fa fa-lock lock-icon"></i></span>
						<input type="password" class="form-control" name="login_password" placeholder="Password" required>
					</div>

					<div class="forgot-outer">
						<div class="form-check pull-left" style="margin-left: -17px;">
							<label>
								<input type="checkbox" name="check"> <span class="label-text" > </span><span class="remb">Remember me</span>
							</label>
						</div>

						<div class="pull-right">

							<span class="label-text forgot"><a href="javascript:void(0)" id="forgot_mdl_btn">Forgot Password</a> </span>

						</div>
					</div>

					<div class="form-group">
						<button type="submit" data-loading-text="Please wait..." id="login_btn" class="login-btn btn">Login</button>
					</div>


					<div class="form-group">
						<p class="divider-text">
							<span class="bg-light">OR</span>
						</p>
						<p>
							<a href="<?php echo fb_login(); ?>" class="btn btn-block btn-facebook"> <i class="fa fa-facebook fb"></i> Login with facebook</a>	
						</p>
					</div>

				</form>
			</div>

			<div class="modal-footer text-center">
				<p class="pull-left">Don’t have an account?</p>
				<a href="javascript:void(0)" id="signup_mdl_btn" class="btn sign-btn pull-right">Sign up</a>
			</div>

		</div>
	</div>
</div>

<!-- Login Popup End -->


<!-- SignUp Popup Model -->

<div class="modal fade login-popup sign-pop centered-modal" id="signModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close close-login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Sign Up</h4>
			</div>

			<div class="modal-body">
				<form id="registration_form" action="" method="post">

					<div class="input-group" style="width:100%;">
						<span><i class="fa fa-envelope lock-icon"></i></span>
						<input type="email" class="form-control" id="register_email"  name="email" placeholder="Email Address" required>
					</div> 


					<div class="input-group" style="width:100%;">	
						<span><i class="fa fa-lock lock-icon"></i></span>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					</div>

					<div class="input-group" style="width:100%;">	
						<span><i class="fa fa-lock lock-icon"></i></span>
						<input type="password" name="c_password" class="form-control" placeholder="Confirm Password" required>
					</div>

					<div class="forgot-outer">
						<div class="form-check pull-left" style="margin-left: -17px;">
							<label>
								<input type="checkbox" name="check_policy" id="check_policy"> <span class="label-text" > </span><span class="remb">I accept the <a href="<?php echo base_url(); ?>terms_and_conditions" target="_blank"> Terms of Use </a> & <a href="<?php echo base_url(); ?>privacy_policy" target="_blank"> Privacy Policy </a> </span>
								<p id="confirm_error" class="text-danger"></p>
							</label>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" data-loading-text="Please wait..." id="registration_btn" class="signup-btn btn">Sign Up</button>
					</div>


					<div class="form-group">
						<p class="divider-text">
							<span class="bg-light">OR</span>
						</p>
						<p>
							<a href="<?php echo fb_login(); ?>" class="btn btn-block btn-facebook"> <i class="fa fa-facebook fb"></i> Login with facebook</a>	
						</p>
					</div>


				</form>
			</div>

			<div class="modal-footer text-center">
				<p class="pull-left">Already have an account?</p>
				<a href="javascript:void(0)" class="btn sign-btn pull-right" id="login_mdl_btn">Log in</a>
			</div>


		</div>
	</div>
</div>

<!-- SignUp Popup End -->


<!-- ====== FOOTER ====== -->
<footer id="footer" class="position-md-absolute">
	<div class="container">
		<div class="row footer-body">
			<!-- Footer Brand Column -->
			<div class="col-md-4 col-sm-6 footer-column">
				<a href="<?php echo base_url(); ?>" id="footer-brand" class="footer-brand">
					<img src="<?php echo base_url(); ?>assets/images/footer_logo.png" alt="dorage Property">
				</a>
				<p><?php echo get_section_content('home' , 'footer_text'); ?></p>
			</div>

			<!-- Usefull Link Column -->
			<div class="col-md-2 col-sm-6 footer-column">
				<h3 class="footer-title">Usefull link</h3>
				<ul class="footer-menu">

					<li><a href="<?php echo base_url(); ?>about_us">About Us</a></li>
					<li><a href="<?php echo base_url(); ?>careers">Careers</a></li>
					<li><a href="<?php echo base_url(); ?>policies">Policies</a></li>
					<li><a href="<?php echo base_url(); ?>help">Help</a></li>

				</ul>
			</div>
			<!-- Information Column -->	
			<div class="col-md-2 col-sm-6 footer-column">
				<h3 class="footer-title">Information</h3>
				<ul class="footer-menu">
					<li><a href="<?php echo base_url(); ?>contact_us">Contact Us</a></li>
					<li><a href="<?php echo base_url(); ?>terms_and_conditions">Term & conditions</a></li>
					<li><a href="<?php echo base_url(); ?>privacy_policy">Privacy policy</a></li>
				</ul>
			</div>
			<!-- Contact Us Column -->
			<div class="col-md-4 col-sm-6 footer-column footer-icon">
				<h3 class="footer-title">Contact Us</h3>
				
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-12">
						<i class="fa fa-map-marker fa-2x"></i>
					</div>	
					<div class="col-md-11 col-sm-11 col-xs-12">
						<p class="item-text"><?php echo get_section_content('contactus' , 'contactus_address'); ?></p> 
					</div>
				</div>	

				<div class="row" style="margin-bottom: 10px;">
					<div class="col-md-1 col-sm-1 col-xs-12">
						<i class="fa fa-phone fa-2x"></i>
					</div>	
					<div class="col-md-11 col-sm-11 col-xs-12">
						<p class="item-text"> <a href="tel:<?php echo get_section_content('contactus' , 'contactus_phone'); ?>"> <?php echo get_section_content('contactus' , 'contactus_phone'); ?> </a> <br> <a href="mailto:<?php echo get_section_content('contactus' , 'contactus_email'); ?>"><?php echo get_section_content('contactus' , 'contactus_email'); ?></a> </p> 
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 social-icon">
						<ul class="social-network social-circle">
							<li><a href="<?php echo get_section_content('social_links' , 'facebook'); ?>" class="icoFacebook"  target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="<?php echo get_section_content('social_links' , 'twitter'); ?>" class="icoTwitter" target="_blank"  title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="<?php echo get_section_content('social_links' , 'instagram'); ?>"  class="icoInsta"  target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>

						</ul>

					</div>	
					
				</div>

			</div>
		</div>
	</div>

	<!-- Copyright -->
	<div class="copyright">
		<div class="container clearfix">
			<p>Copyright &copy; <?php echo date('Y'); ?> - All Rights Reserved By Dorage</p>

		</div>
	</div>

	<div class="scroll-top-wrapper">
		<span class="scroll-top-inner">
			<i class="fa fa-2x fa-angle-double-up"></i>
		</span>
	</div>
</footer>
<div class="opc" ></div>

<div id="customizer" class="">
	<div id="customizer-panel" style="display: block;">
		<span class="icon-panel"><i class="fa fa-search" aria-hidden="true"></i></span>
	</div>
	<div class="customizer-body">
		<div id="close-customizer">
			<a>
				<i class="fa fa-times-circle" aria-hidden="true"></i>	
			</a>
		</div>
		<div id="setting-body">
			<h3 class="customizer-title">Search Property</h3>

			<section class="option-box option-header">

				<form method="get" action="<?php echo base_url(); ?>storages/search" autocomplete="off">
					
					<div class="form-group">
						<label>Storage State</label>
						<select class="form-control index-control" name="list_state" id="list_state" required>
							<option value="">Select State</option>
							<?php foreach (get_states() as $state) { ?>
							<option value="<?php echo $state['id']; ?>" <?php if(@$_GET['list_state'] == $state['id']){ ?> selected <?php } ?>> <?php echo $state['name']; ?> </option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Storage Location</label>
						
						<input type="text" name="place" class="form-control" id="property_loc1" placeholder="Enter Location" value="<?php echo @$_GET['place']; ?>" onkeydown="if($('.pac-container').is(':visible') && event.keyCode == 13) {event.preventDefault();}" required="required">

						<input name="lat_long" id="property_lat_long1" value="<?php echo @$_GET['lat_long']; ?>" type="hidden">

					</div>
					<div class="form-group form-group--date">
						<label>Check-in/out date</label>
						
						<input name="search_startdate" id="checkin_date1" class="form-control" placeholder="Check-in/out Date" value="<?php echo @$_GET['search_startdate']; ?>">

					</div>
					
					<div class="form-group">
						<label>Any Type</label>
						<select name="storage_size_type" class="form-control">
							<option value="">Select space</option>


							
							<?php foreach (get_storage_size_types() as $sttype) { ?>

							<option value="<?php echo $sttype['id']; ?>" <?php if(@$_GET['storage_size_type'] == $sttype['id']){ ?> selected <?php } ?> > <?php echo $sttype['name']; ?> </option>

							<?php } ?>
							
						</select>
					</div>
					<div class="form-group submit-column">
						<button type="submit" style="width:100%;" class="btn btn-primary btn-submit"><i class="fa fa-search" ></i> Search</button>
					</div>
				</form>
			</section>
			
		</div>
	</div>
</div>


<div id="sidebar-compare" class="">
	<div class="sidebar-wrapper">
		<a href="#" class="compare-toggle heart-toggle"><i class="fa fa-heart"></i></a>
		<header class="heading-bar">
			<h3 class="heading-title">Wishlist</h3>

		</header>
		<ul class="compare-body">

			<?php $wish_list = get_favourite(); ?>

			<?php if(empty($wish_list)): ?>
				<li style="color: red;"> Your wishlist is empty.</li>
			<?php endif; ?>
			
			<?php foreach ($wish_list as $flist) {?>

			<li class="compare-item" id="favouriteitme_<?php echo $flist['id']; ?>">
				<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($flist['id']); ?>" alt="Property 1">
				<h4 class="property-title">

					<a href="<?php echo base_url(); ?>details/storage/<?php echo $flist['unique_id'].'/'.dorage_url_title($flist['title'])."/".md5($flist['title']); ?>"><?php echo $flist['title']; ?></a>

				</h4>
				<strong class="property-price">$<?php echo $flist['price']; ?></strong>
				<a href="javascript:void(0)" data-id="<?php echo $flist['id']; ?>" class="remove removefitme"><i class="fa fa-trash-o"></i></a>
			</li>

			<?php } ?>
			
			
		</ul>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.gritter.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/apps.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fullcalendar.js"></script>

<!-- ------------------------ -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-year-calendar.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<!-- ------------------------ -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.filer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.barrating.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/isotope.pkgd.min.js"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
	$('.js-example-basic-multiple').select2();
	$(document).on('keyup', "#property_loc", function() {
		document.getElementById("property_lat_long").value = "";
	});
	$(document).on('keyup', "#property_loc1", function() {
		document.getElementById("property_lat_long1").value = "";
	});

	$('.listingRating').each(function(index, el) {
		var $El = $(el);
		$El.barrating({
			theme: 'fontawesome-stars-o',
			readonly: true,
			initialRating: $El.attr('data-current-rating') 
		});
	});
	
	$(document).on('keydown', '#checkin_date,#checkin_date1', function(e) {
		e.preventDefault();
	});
	

	$(document).on('click', "#signup_mdl_btn", function() {
		$('#loginModal').modal('hide');
		$('#loginModal').one('hidden.bs.modal', function () {
			$('#signModal').modal('show');
		});
	});


	$(document).on('click', "#login_mdl_btn", function() {
		$('#signModal').modal('hide');
		$('#signModal').one('hidden.bs.modal', function () {
			$('#loginModal').modal('show');
		});
	});


	$(document).on('click', "#forgot_mdl_btn", function() {
		$('#loginModal').modal('hide');
		$('#loginModal').one('hidden.bs.modal', function () {
			$('#forgotModal').modal('show');
		});
	});

	$('#back_to_login_mdl').click(function(){
		$('#forgotModal').modal('hide');
		$('#forgotModal').one('hidden.bs.modal', function () {
			$('#loginModal').modal('show');
		});
	});

	// $('#retrieve_password').click(function(){
		$('#retrieve_password_form').on('submit', function(event) {
			event.preventDefault();
		// var btn = $(this);

		$("#retrieve_password").button('loading');
		var value = $("#retrieve_password_form").serialize();
		$.ajax({
			url:'<?php echo base_url(); ?>forgot_password/retrieve_password',
			type:'post',
			data:value,
			dataType:'json',
			success:function(status){
				$("#retrieve_password").button('reset');
				if(status.msg=='success'){
					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});
					$('#forgotModal').modal('hide');
					$('#forgotModal').one('hidden.bs.modal', function () {
						$('#loginModal').modal('show');
					});
				}
				else if(status.msg == 'error'){
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});
				}
			}
		});

	});

		$('body').on('click', '#submit_list_details', function (event) {
			var btn = $(this);
			$(btn).button('loading');
			var value = $("#list_details").serialize();
			$.ajax({
				url:'<?php echo base_url(); ?>listing/storage/submit_data',
				type:'post',
				data:value,
				dataType:'json',
				success:function(status){
					if(status.msg=='success'){

						$("#ajax_wrapper").fadeOut(function(){$("#ajax_wrapper").html(status.response).fadeIn();}); 

						var stateObj = {};
						history.pushState(stateObj, "page 2", status.new_url);
					}
					else if(status.msg == 'not_login'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-error'
						});
						$(btn).button('reset');
						$('#loginModal').modal('show');
					}else if(status.msg == 'error'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-error'
						});
						$(btn).button('reset');

					}else{
						$(btn).button('reset');
					}
				}
			});
		});


		$('body').on('click', '#submit_mover_details', function (event) {
			var btn = $(this);
			$(btn).button('loading');
			var value = new FormData($("#mover_details")[0]);
			$.ajax({
				url:'<?php echo base_url(); ?>listing/mover/submit_data',
				type:'post',
				data:value,
				dataType:'json',
				contentType: false,
				enctype: 'multipart/form-data',
				processData: false,
				success:function(status){
					if(status.msg=='success'){

						$("#ajax_wrapper").fadeOut(function(){$("#ajax_wrapper").html(status.response).fadeIn();}); 

						var stateObj = {};
						history.pushState(stateObj, "page 2", status.new_url);
					}
					else if(status.msg == 'not_login'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-error'
						});
						$(btn).button('reset');
						$('#loginModal').modal('show');
					}else if(status.msg == 'error'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-error'
						});
						$(btn).button('reset');

					}else{
						$(btn).button('reset');
					}
				}
			});
		});

		$('body').on('click', '#save_edit_form_data', function (event) {
			var btn = $(this);
			$(btn).button('loading');
			var save_edited_step = $(this).attr('data-id');

			var value = $("#"+save_edited_step+"_form").serialize();
			$.ajax({
				url:'<?php echo base_url(); ?>listing/storage/'+save_edited_step,
				type:'post',
				data:value,
				dataType:'json',
				success:function(status){
					if(status.msg=='success'){

						$.gritter.add({
							title: 'Success!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-success'
						});

						$(btn).button('reset');

					} else if(status.msg == 'error'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-error'
						});
						$(btn).button('reset');

					}else{
						$(btn).button('reset');
					}
				}
			});
		});

		$('body').on('click', '#save_edit_mover_form_data', function (event) {
			var btn = $(this);
			$(btn).button('loading');
			var save_edited_step = $(this).attr('data-id');

			var value = new FormData($("#"+save_edited_step+"_form")[0]);
			$.ajax({
				url:'<?php echo base_url(); ?>listing/mover/'+save_edited_step,
				type:'post',
				data:value,
				dataType:'json',
				processData: false,
				contentType: false,
				success:function(status){
					if(status.msg=='success'){

						$.gritter.add({
							title: 'Success!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-success'
						});

						$(btn).button('reset');

					} else if(status.msg == 'error'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-error'
						});
						$(btn).button('reset');

					}else{
						$(btn).button('reset');
					}
				}
			});
		});

	</script>


	<script>
		$(document).on('click', '.number-spinner button', function () {    
			var btn = $(this);
			oldValue = btn.closest('.number-spinner').find('input').val().trim();

			if (oldValue == '') {
				oldValue = 0;
			}

			newVal = 0;

			if (btn.attr('data-dir') == 'up') {
				newVal = parseInt(oldValue) + 1;
			} else {
				if (oldValue > 1) {
					newVal = parseInt(oldValue) - 1;
				} else {
					newVal = 1;
				}
			}
			btn.closest('.number-spinner').find('input').val(newVal);
		});
	</script>

	<script> 
		$(document).on('click', '.add-bed-btn', function(){  
			var text = $(this).text();
			if (text == "Done") {
				$(this).text('Add beds');
			}else{
				$(this).text('Done');
			}
			$(this).parent().parent().find('.show-detail').toggle();
		});

		$(document).on('click', '.businessCheckbox', function(){
			var check = $('.businessCheckbox').is(":checked");
			if (check) {
				$(".reg-add").css("display","none");
			}else{
				$(".reg-add").css("display","block");
			}
		});


		$(document).on('click', '.add-req', function(){  
			$('.guest-show-check').slideDown();
			$('.add-req').addClass('add-req-change');
		});

		$(document).on('click', '.ins-yes', function(){

			if($('#insurance_check').is(":checked")) {
				$('#insurance_input').val('1');
			} else {
				$('#insurance_input').val('0');
			}

			$('.insurance-bullet').slideToggle();

		});

		$(document).on('click', '.mov-yes', function(){

			if($('#package_check').is(':checked')){
				$('#mover_needed').val('1');
			} else {
				$('#mover_needed').val('0');
				$('#selected_mover_id').val('');
				$('#movers_ajax').html('');

				var values = $('#payment_form').serialize();

				$.ajax({
					url:'<?php echo base_url(); ?>booking/get_detail',
					type:'post',
					data:values,
					dataType:'json',
					success:function(status){
						if(status.msg=='success'){
							$(".detials_ajax").html(status.response);
						}
					}
				});
			}

			$('.moving-listing').slideToggle();

		});


		$(document).on('click', '.open-nav', function(){  
			$('.opc').show();

		});

		$(document).on('click', '.closebtn', function(){  
			$('.opc').hide();

		});


	</script>


	<script>
		function openNav() {
			document.getElementById("mySidenav").style.width = "280px";
			document.getElementById("main").style.marginLeft = "0px";

		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft= "0";
		}

	</script>

	<script>
		var checker = document.getElementById('checkme');
		var sendbtn = document.getElementById('submit');
		checker.onchange = function() {
			sendbtn.disabled = !!this.checked;
		};
	</script>

	<script>

		$(document).ready(function(){

			$(function(){

				$(document).on( 'scroll', function(){

					if ($(window).scrollTop() > 100) {
						$('.scroll-top-wrapper').addClass('show');
					} else {
						$('.scroll-top-wrapper').removeClass('show');
					}
				});

				$('.scroll-top-wrapper').on('click', scrollToTop);
			});

			function scrollToTop() {
				verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
				element = $('body');
				offset = element.offset();
				offsetTop = offset.top;
				$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
			}

		});

	</script>


	<script type="text/javascript">
		function upload_div() {

			$('#input2').filer({
				limit: null,
				maxSize: null,
				extensions: null,
				changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag & Drop file here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse File</a></div></div>',
				showThumbs: true,
				appendTo: null,
				theme: "dragdropbox",
				templates: {
					box: '<ul class="jFiler-item-list"></ul>',
					item: '<li class="jFiler-item">\
					<div class="jFiler-item-container">\
					<div class="jFiler-item-inner">\
					<div class="jFiler-item-thumb">\
					<div class="jFiler-item-status"></div>\
					<div class="jFiler-item-info">\
					<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
					</div>\
					{{fi-image}}\
					</div>\
					<div class="jFiler-item-assets jFiler-row">\
					<ul class="list-inline pull-left">\
					<li>{{fi-progressBar}}</li>\
					</ul>\
					</div>\
					</div>\
					</div>\
					</li>',
					itemAppend: '<li class="jFiler-item">\
					<div class="jFiler-item-container">\
					<div class="jFiler-item-inner">\
					<div class="jFiler-item-thumb">\
					<div class="jFiler-item-status"></div>\
					<div class="jFiler-item-info">\
					<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
					</div>\
					{{fi-image}}\
					</div>\
					<div class="jFiler-item-assets jFiler-row">\
					<ul class="list-inline pull-left">\
					<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
					</ul>\
					</div>\
					</div>\
					</div>\
					</li>',
					progressBar: '<div class="bar"></div>',
					itemAppendToEnd: false,
					removeConfirmation: false,
					_selectors: {
						list: '.jFiler-item-list',
						item: '.jFiler-item',
						progressBar: '.bar',
						remove: '.jFiler-item-trash-action',
					}
				},
				uploadFile: {
					url: "<?php echo base_url(); ?>listing/storage/upload_storage_picture",
					data:{},
					type: 'POST',
					dataType:'json',
					enctype: 'multipart/form-data',
					beforeSend: function(){},
					success: function(data, el){

						var obj = JSON.parse(data);


						if(obj.msg == 'success') {

							var parent = el.find(".jFiler-jProgressBar").parent();
							el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
								$("<div class=\"jFiler-item-others text-success\"> <a href=\"javascript:void(0)\" class=\"delete_picture jFiler-item-trash-action\" data-id=\""+obj.image_id+"\" > <i class=\"fa fa-times-circle fa-2x image_remove\" title=\"Remove\"></i></a><input type=\"number\" class=\"form-control imageorder\" min=\"1\" name=\"image_order["+obj.image_id+"]\" placeholder=\"Image order#\" style=\"width: 192px;\"></div>").hide().appendTo(parent).fadeIn("slow");    
							});
							$.gritter.add({
								title: 'Success!',
								sticky: false,
								time: '5000',
								before_open: function(){
									if($('.gritter-item-wrapper').length >= 3)
									{
										return false;
									}
								},
								text: obj.response,
								class_name: 'gritter-success'
							});


						} else {
							$.gritter.add({
								title: 'Error!',
								sticky: false,
								time: '5000',
								before_open: function(){
									if($('.gritter-item-wrapper').length >= 3)
									{
										return false;
									}
								},
								text: obj.response,
								class_name: 'gritter-error'
							});

							var parent = el.find(".jFiler-jProgressBar").parent();
							el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
								$("<div class=\"jFiler-item-others text-success\"> <a href=\"javascript:void(0)\" class=\" jFiler-item-trash-action\" data-id=\""+obj.image_id+"\" > <i class=\"icon-jfi-check-circle\"></i> Failed to upload click to remove </a> </div>").hide().appendTo(parent).fadeIn("slow");    
							});

						}
					},
					statusCode: {},
					onProgress: function(){},
				},
				dragDrop: {
					dragEnter: function(){},
					dragLeave: function(){},
					drop: function(){},
				},
				addMore: true,
				clipBoardPaste: true,
				excludeName: null,
				beforeShow: function(){return true},
				onSelect: function(){},
				afterShow: function(){},
				onRemove: function(){},
				onEmpty: function(){},
				captions: {
					button: "Choose Files",
					feedback: "Choose files To Upload",
					feedback2: "files were chosen",
					drop: "Drop file here to Upload",
					removeConfirmation: "Are you sure you want to remove this file?",
					errors: {
						filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
						filesType: "Only Images are allowed to be uploaded.",
						filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
						filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
					}
				}
			});
}

upload_div();


$(".imageorder").on("keypress keyup blur",function (event) {    
	$(this).val($(this).val().replace(/[^\d].+/, ""));
	if ((event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});


$('body').on('click', '.delete_picture', function (event) {

	var image_id = $(this).attr('data-id');

	$.ajax({
		url:'<?php echo base_url(); ?>listing/storage/delete_storage_picture',
		type:'post',
		data:{image_id : image_id},
		dataType:'json',
		success:function(status){
			if(status.msg=='success'){
				$.gritter.add({
					title: 'Success!',
					sticky: false,
					time: '5000',
					before_open: function(){
						if($('.gritter-item-wrapper').length >= 3)
						{
							return false;
						}
					},
					text: status.response,
					class_name: 'gritter-success'
				});
				$("#siimagedelete_"+image_id).hide();
			} else if(status.msg == 'error'){
				$.gritter.add({
					title: 'Error!',
					sticky: false,
					time: '5000',
					before_open: function(){
						if($('.gritter-item-wrapper').length >= 3)
						{
							return false;
						}
					},
					text: status.response,
					class_name: 'gritter-error'
				});
			}
		}
	});
});

</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBHtMus_lrs1jrXwK9QkltUaAP5rr3UoX0&libraries=places"></script>


</body>
</html>

<style type="text/css">
#map > div > div > div:nth-child(1) > div:nth-child(4) > div:nth-child(4) > div > img {
	right: 45px !important;
	top: 7px !important;
	background-image:url("<?php echo base_url(); ?>assets/images/close.png") !important;
}
</style>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>  

<script type="text/javascript">


	$("#login_form").validate({
		errorElement: 'div',
		errorClass: 'text-danger',
		focusInvalid: true,
		ignore: "",
		rules: {
			login_email: {
				required: true,
				email: true
			},
			login_password: {
				required: true,
			},
		},
		messages: {
			login_email: {
				required: "Please enter email.",
				email: "Please enter a valid email.",
			},
			login_password: {
				required: "Please enter password.",
			},
		},
		highlight: function (e) {
			$(e).closest('.input-group').removeClass('has-info').addClass('has-error');
		},
		success: function (e) {
            $(e).closest('.input-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
        	if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
        		var controls = element.closest('div[class*="col-"]');
        		if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
        		else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        	}
        	else if(element.is('.select2')) {
        		error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        	}
        	else if(element.is('.chosen-select')) {
        		error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
        	}
        	else error.insertBefore(element.parent());
        },
        submitHandler: function (form) {
        },
        invalidHandler: function (form , validator) {

        	if (!validator.numberOfInvalids())
        		return;

        	$('html, body').animate({
        		scrollTop: $(validator.errorList[0].element).offset().top - 300
        	}, 1000);
        }
    });


	// $('#login_btn').click(function(){
		$('#login_form').on('submit', function(event) {
			event.preventDefault();

			if($("#login_form").valid()){

				var btn = $(this);
				$("#login_btn").button('loading');
				var value = $("#login_form").serialize();
				$.ajax({
					url:'<?php echo base_url(); ?>login/login_verify',
					type:'post',
					data:value,
					dataType:'json',
					success:function(status){
						$("#login_btn").button('reset');
						if(status.msg=='success'){
							$.gritter.add({
								title: 'Success!',
								sticky: false,
								time: '5000',
								before_open: function(){
									if($('.gritter-item-wrapper').length >= 3)
									{
										return false;
									}
								},
								text: "Successfully loggedin.",
								class_name: 'gritter-success'
							});
							$("#loginModal").modal('hide');
							location.reload();
						} else if(status.msg == 'error'){

							$.gritter.add({
								title: 'Error!',
								sticky: false,
								time: '5000',
								before_open: function(){
									if($('.gritter-item-wrapper').length >= 3)
									{
										return false;
									}
								},
								text: status.response,
								class_name: 'gritter-error'
							});
							
						} else if(status.msg == 'error_verification') {
							$("#verification_success").hide();
							$("#verification_error").html(status.response).show();
							resendfun();
						}
					}
				});
			}
		});


		$("#registration_form").validate({
			errorElement: 'span',
			errorClass: 'text-danger',
			focusInvalid: true,
			ignore: "",
			rules: {
				email: {
					required: true,
					email: true,
					remote: {
						url : '<?php echo base_url(); ?>register/check_email',
						type: "post"
					}
				},
				password: {

					required: true,
					minlength: 6

				},
				c_password: {

					required: true,
					equalTo: "#password"

				},

			},
			messages: {

				email: {

					required: "Please enter email.",
					email: "Please enter a valid email.",
					email: "Please enter a valid email.",
					remote: jQuery.validator.format('This email is already associated with another account.')

				},
				password: {
					required: "Please password",
					minlength: jQuery.validator.format("Enter at least {0} characters")
				},
				c_password: {
					required: "Repeat your password",
					equalTo: "Enter the same password as above"
				},

			},


			highlight: function (e) {

				$(e).closest('.input-group').removeClass('has-info').addClass('has-error');

			},



			success: function (e) {

            $(e).closest('.input-group').removeClass('has-error');//.addClass('has-info');

            $(e).remove();

        },



        errorPlacement: function (error, element) {

        	if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {

        		var controls = element.closest('div[class*="col-"]');

        		if(controls.find(':checkbox,:radio').length > 1) controls.append(error);

        		else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));

        	}

        	else if(element.is('.select2')) {

        		error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));

        	}

        	else if(element.is('.chosen-select')) {

        		error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));

        	}

        	else error.insertBefore(element.parent());

        },



        submitHandler: function (form) {

        },

        invalidHandler: function (form , validator) {

        	if (!validator.numberOfInvalids())
        		return;

        	$('html, body').animate({
        		scrollTop: $(validator.errorList[0].element).offset().top - 300
        	}, 1000);
        }
    });

	// $('#registration_btn').click(function(){

		$('#registration_form').on('submit', function(event) {
			event.preventDefault();

			if($("#registration_form").valid()){

				var confirm_1 = $('#check_policy').prop("checked");
				if(confirm_1 == false){

					$('.remb').css('color' , 'red');
					return false;
				}else{
					$('.remb').css('color' , '');
				}

			// var btn = $(this);

			$("#registration_btn").button('loading');
			var value = $("#registration_form").serialize();

			$.ajax({

				url:'<?php echo base_url(); ?>register/submit_user',

				type:'post',

				data:value,

				dataType:'json',

				success:function(status){

					$("#registration_btn").button('reset');

					if(status.msg=='success'){

						$.gritter.add({

							title: 'Success!',

							sticky: false,

							time: '3000',

							before_open: function(){

								if($('.gritter-item-wrapper').length >= 3)

								{

									return false;

								}

							},

							text: "Thanks for Registering. Please check your email for account activation.",

							class_name: 'gritter-success'

						});

						$("#registration_form")[0].reset();

						$("#signModal").modal('hide');
					}
					else if(status.msg == 'error'){
						$.gritter.add({

							title: 'Error!',

							sticky: false,

							time: '5000',

							before_open: function(){

								if($('.gritter-item-wrapper').length >= 3)

								{

									return false;

								}

							},

							text: status.response,

							class_name: 'gritter-error'

						});
						
					}

				}

			});

		}

	});

</script>

<?php if(!empty($this->session->flashdata('activation_succ_status'))) { ?>

<script type="text/javascript">

	$.gritter.add({
		title: 'Success!',
		sticky: false,
		time: '3000',
		before_open: function(){
			if($('.gritter-item-wrapper').length >= 3){
				return false;
			}
		},
		text: '<?php echo $this->session->flashdata('activation_succ_status'); ?>',
		class_name: 'gritter-success'
	});
</script>

<?php } ?>

<?php if(!empty($this->session->flashdata('activation_error_status'))) { ?>

<script type="text/javascript">

	$.gritter.add({
		title: 'Error!',
		sticky: false,
		time: '3000',
		before_open: function(){
			if($('.gritter-item-wrapper').length >= 3){
				return false;
			}
		},
		text: '<?php echo $this->session->flashdata('activation_error_status'); ?>',
		class_name: 'gritter-error'
	});
</script>

<?php } ?>

<script type="text/javascript">

	function resendfun() {
		$('#resend').click(function(){
			var btn = $(this);
			btn.button('loading');
			var email = $(this).attr('data-id');
			$.ajax({
				url:'<?php echo base_url(); ?>activation/resend',
				type:'post',
				data:{email : email},
				dataType:'json',
				success:function(status){
					if(status.msg=='success'){
						$("#verification_error").hide();
						$("#verification_success").html(status.response).show();
						btn.button('reset');
					}
					else if(status.msg=='error'){
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '3000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: status.response,
							class_name: 'gritter-danger'
						});
						btn.button('reset');
					}
				}
			});
		});
	}
</script>

<script type="text/javascript">
	function initialize() {                     
		var input2 = /** @type {HTMLInputElement} */(
			document.getElementById("property_loc"));
		var cntry = 'NZ';
		var options = {
         // componentRestrictions: {country: cntry}
     };
     var autocomplete2 = new google.maps.places.Autocomplete(input2, options);

     google.maps.event.addListener(autocomplete2, "place_changed", function() {

      //infowindow.close();
      //marker.setVisible(false);
      var place = autocomplete2.getPlace();
      if (!place.geometry) {
      	return;
      }
      // get lat
      var lat = place.geometry.location.lat();
      // get lng
      var lng = place.geometry.location.lng();
      //var point = marker.getPosition();
      //map.panTo(point);
      document.getElementById("property_lat_long").value=lat+", "+lng;
  });
 }
 initialize();

 function initialize1() {                     
 	var input2 = /** @type {HTMLInputElement} */(
 		document.getElementById("property_loc1"));
 	var cntry = 'NZ';
 	var options = {
         // componentRestrictions: {country: cntry}
     };
     var autocomplete2 = new google.maps.places.Autocomplete(input2, options);

     google.maps.event.addListener(autocomplete2, "place_changed", function() {

      //infowindow.close();
      //marker.setVisible(false);
      var place = autocomplete2.getPlace();
      if (!place.geometry) {
      	return;
      }
      // get lat
      var lat = place.geometry.location.lat();
      // get lng
      var lng = place.geometry.location.lng();
      //var point = marker.getPosition();
      //map.panTo(point);
      document.getElementById("property_lat_long1").value=lat+", "+lng;
  });
 }
 initialize1();

 $(".pac-container").removeClass("pac-logo");

</script>

<script type="text/javascript">
	$('body').on('change', '#storage_size_type', function (event) {
		var storage_id = $(this).val();
		$.ajax({
			url:'<?php echo base_url(); ?>home/get_storage_types',
			type:'post',
			data:{ storage_id : storage_id },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$("#space_storage_types").html(status.response);
				}
			}
		});
	});


	$('body').on('change', '.storage_type', function (event) {
		var values = $("#seach_form").serialize();
		$.ajax({
			url:'<?php echo base_url(); ?>home/get_space_characters',
			type:'post',
			data:values,
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$("#room_space_character").html(status.response);
				}
			}
		});
	});


	$('body').on('click', '.addfavourite', function (event) {
		var thisbtn = $(this);
		var list_id = thisbtn.attr('data-id');
		$.ajax({
			url:'<?php echo base_url(); ?>home/addfavourite',
			type:'post',
			data:{listings_id : list_id},
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
								{return false;}
						},
						text: status.response,
						class_name: 'gritter-success'
					});
					thisbtn.addClass('removefavourite active').removeClass('addfavourite').attr('title','Remove favourite');
				} else {

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
								{return false;}
						},
						text: status.response,
						class_name: 'gritter-error'
					});

				}
			}
		});
	});


	$('body').on('click', '.removefavourite', function (event) {
		var thisbtn = $(this);
		var list_id = thisbtn.attr('data-id');
		$.ajax({
			url:'<?php echo base_url(); ?>home/removefavourite',
			type:'post',
			data:{listings_id : list_id},
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
								{return false;}
						},
						text: status.response,
						class_name: 'gritter-success'
					});
					thisbtn.addClass('addfavourite').removeClass('removefavourite active').attr('title','Add to favourite');
				} else {

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
								{return false;}
						},
						text: status.response,
						class_name: 'gritter-error'
					});

				}
			}
		});
	});

	$('body').on('click', '.removefitme', function (event) {
		var thisbtn = $(this);
		var list_id = thisbtn.attr('data-id');
		$.ajax({
			url:'<?php echo base_url(); ?>home/removefavourite',
			type:'post',
			data:{listings_id : list_id},
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$("#favouriteitme_"+list_id).hide();
				} else {

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
								{return false;}
						},
						text: status.response,
						class_name: 'gritter-error'
					});
				}
			}
		});
	});

	function initializeMapLoc() {
		var lati = $("#lati").val();
		var longi = $("#longi").val();

		var latlng = new google.maps.LatLng(lati, longi);
		var mapOptions = {
			center: latlng,
			zoom: 10,
			panControl: true,
			zoomControl: true,
			scaleControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"),
			mapOptions);
		google.maps.event.addDomListener(window, "resize", function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center); 
		});
		var input = /** @type {HTMLInputElement} */(
			document.getElementById("location"));
		var types = document.getElementById("type-selector");
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo("bounds", map);
		var infowindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker({
			map: map,
			draggable:true,
			country: "USA",
			position: latlng
		});
		google.maps.event.addListener(autocomplete, "place_changed", function() {
			infowindow.close();
			marker.setVisible(false);
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				return;
			}
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(10); 
			}
			marker.setPosition(place.geometry.location);
			marker.setVisible(true);
			var point = marker.getPosition();

			map.panTo(point);
			document.getElementById("lat_long").value=point.lat()+", "+point.lng();
			document.getElementById("lati").value=point.lat();
			document.getElementById("longi").value=point.lng();
		});
		google.maps.event.addListener(marker, "dragend", function() {
		// Get the Current position, where the pointer was dropped
		var point = marker.getPosition();
		// Center the map at given point
		map.panTo(point);  
		// Update the textbox
		document.getElementById("lat_long").value=point.lat()+", "+point.lng();
		document.getElementById("lati").value=point.lat();
		document.getElementById("longi").value=point.lng();
		var geocoder = new google.maps.Geocoder;
		var input = document.getElementById('lat_long').value;
		var latlngStr = input.split(',', 2);
		var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === 'OK') {
    			//alert(results[0].formatted_address);
    			document.getElementById("location").value=results[0].formatted_address;
    		} else {
    			window.alert('Geocoder failed due to: ' + status);
    		}
    	});
	});
	}
	initializeMapLoc();
</script>