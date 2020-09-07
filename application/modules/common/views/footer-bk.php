<!-- Forgot Password Popup Model -->

<div class="modal fade login-popup centered-modal" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close close-login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Reset Password</h4>
			</div>

			<div class="modal-body">
				<form id="retrieve_password_form" action="" method="post" novalidate>
					<p>Enter the email address associated with your account, and we’ll email you a link to reset your password.</p>
					<div class="input-group" style="width:100%;">
						<span><i class="fa fa-envelope mail-icon"></i></span>
						<input type="email" class="form-control" name="email" placeholder="Email Address">
					</div>


				</form>
			</div>

			<div class="modal-footer text-center">
				<p class="pull-left back-login"><a href="javascript:void(0)" id="back_to_login_mdl"><i class="fa fa-angle-left"></i> Back to Login </a> </p>
				<button type="button" id="retrieve_password" class="btn next-btn pull-right">Send Reset Link</button>
			</div>

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
						<button type="button" id="login_btn" class="login-btn btn">Login</button>
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
								<input type="checkbox" name="check_policy" id="check_policy"> <span class="label-text" > </span><span class="remb">I accept the Terms of Use & Privacy Policy</span>
								<p id="confirm_error" class="text-danger"></p>
							</label>
						</div>
					</div>

					<div class="form-group">
						<button type="button" id="registration_btn" class="signup-btn btn">Sign Up</button>
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
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
			</div>

			<!-- Usefull Link Column -->
			<div class="col-md-2 col-sm-6 footer-column">
				<h3 class="footer-title">Usefull link</h3>
				<ul class="footer-menu">
					
					<li><a href="#">Contact Us</a></li>
					<li><a href="<?php echo base_url(); ?>">Policies</a></li>
					<li><a href="<?php echo base_url(); ?>listing/storage">Storage Listing</a></li>

					<li><a href="<?php echo base_url(); ?>listing/logistic">Logistic Listing</a></li>

					<li><a href="<?php echo base_url(); ?>properties">Storage Search</a></li>
					
				</ul>
			</div>
			<!-- Information Column -->
			<div class="col-md-2 col-sm-6 footer-column">
				<h3 class="footer-title">Information</h3>
				<ul class="footer-menu">
					<li><a href="<?php echo base_url(); ?>">About Us</a></li>
					<li><a href="<?php echo base_url(); ?>">Payment Options</a></li>
					<li><a href="<?php echo base_url(); ?>">FAQ</a></li>
				</ul>
			</div>
			<!-- Contact Us Column -->
			<div class="col-md-4 col-sm-6 footer-column footer-icon">
				<h3 class="footer-title">Contact Us</h3>
				
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-12">
						<span class="item-icon fi flaticon-address"></span>
					</div>	
					<div class="col-md-11 col-sm-11 col-xs-12">
						<p class="item-text"> 774 Walker County Rd #241, Mountain View, WY, 82939</p> 
					</div>
				</div>	

				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-12">
						<span class="item-icon fi flaticon-clock"></span>
					</div>	
					<div class="col-md-11 col-sm-11 col-xs-12">
						<p class="item-text">Monday-Friday : 9:00 AM to 7:00 PM <br>Saturday, Sunday : Closed</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-12">
						<span class="item-icon fi flaticon-phone"></span>
					</div>	
					<div class="col-md-11 col-sm-11 col-xs-12">
						<p class="item-text">(307) 786-2619 <br>hello@dorage.com</p> 
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<!-- Copyright -->
	<div class="copyright">
		<div class="container clearfix">
			<p>Copyright &copy; <?php echo date('Y'); ?> - All Rights Reserved By Dorage</p>
			<a href="<?php echo base_url(); ?>"> Dorage.com </a>
		</div>
	</div>
	<div class="scroll-top-wrapper ">
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
			<a href="javascript:void(0)">
				<i class="fa fa-times-circle" aria-hidden="true"></i>	
			</a>
		</div>
		<div id="setting-body">
			<h3 class="customizer-title">Search Property</h3>
			
			<section class="option-box option-header">
				
				<form action="#">
					<div class="form-group">
						<label>Location</label>
						<input type="text" class="form-control"  placeholder="Any Location">
					</div>
					<div class="form-group form-group--date">
						<label>Check-in date</label>
						<input id="nb-start-date" name="search_startdate" class="form-control" placeholder="Check-in Date">
					</div>
					<div class="form-group form-group--date">
						<label>Check-out date</label>

						<input id="nb-end-date" name="search_enddate" class="form-control" placeholder="Check-out Date">
					</div>
					<div class="form-group">
						<label>Number of guest</label>
						<select name="search_guest" class="form-control">
							<option value="">Guest</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
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

		<a href="javascript:void(0)" class="compare-toggle heart-toggle"><i class="fa fa-heart"></i></a>
		<header class="heading-bar">
			<h3 class="heading-title">Wish List</h3>

		</header>
		<ul class="compare-body">
			<li class="compare-item">
				<img src="<?php echo base_url(); ?>assets/images/single-property/img_slider_1.jpg" alt="Property 1">
				<h4 class="property-title">Stuning New 4 Bedroom Must Villa</h4>
				<strong class="property-price">USD 176,969</strong>
				<a href="#" class="remove"><i class="fa fa-trash-o"></i></a>
			</li>
			<li class="compare-item">
				<img src="<?php echo base_url(); ?>assets/images/single-property/img_slider_2.jpg" alt="Property 1">
				<h4 class="property-title">Stuning New 4 Bedroom Must Villa</h4>
				<strong class="property-price">USD 176,969</strong>
				<a href="#" class="remove"><i class="fa fa-trash-o"></i></a>
			</li>
			<li class="compare-item">
				<img src="<?php echo base_url(); ?>assets/images/single-property/img_slider_3.jpg" alt="Property 1">
				<h4 class="property-title">Stuning New 4 Bedroom Must Villa</h4>
				<strong class="property-price">USD 176,969</strong>
				<a href="#" class="remove"><i class="fa fa-trash-o"></i></a>
			</li>
			<li class="compare-item">
				<img src="<?php echo base_url(); ?>assets/images/single-property/img_slider_4.jpg" alt="Property 1">
				<h4 class="property-title">Stuning New 4 Bedroom Must Villa</h4>
				<strong class="property-price">USD 176,969</strong>
				<a href="#" class="remove"><i class="fa fa-trash-o"></i></a>
			</li>
		</ul>
	</div>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.daterangepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.gritter.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/apps.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fullcalendar.js"></script>


<script type="text/javascript">
	$('#signup_mdl_btn').click(function(){
		$('#loginModal').modal('hide');
		$('#loginModal').one('hidden.bs.modal', function () {
			$('#signModal').modal('show');
		});
	});

	$('#login_mdl_btn').click(function(){
		$('#signModal').modal('hide');
		$('#signModal').one('hidden.bs.modal', function () {
			$('#loginModal').modal('show');
		});
	});


	$('#forgot_mdl_btn').click(function(){
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

	$('#retrieve_password').click(function(){
		var value = $("#retrieve_password_form").serialize();
		$.ajax({
			url:'<?php echo base_url(); ?>forgot_password/retrieve_password',
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
</script>

<script type="text/javascript">
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
</script>


<script>
	$(document).on('click', '.number-spinner button', function () {    
		var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
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


	$(document).on('click', '.add-req', function(){  
		$('.guest-show-check').slideDown();
		$('.add-req').addClass('add-req-change');


	});

	$(document).on('click', '.ins-yes', function(){  
		$('.insurance-bullet').slideDown();

	});

	$(document).on('click', '.ins-no', function(){  
		$('.insurance-bullet').slideUp();
		
	});

	$(document).on('click', '.mov-yes', function(){  
		$('.moving-listing').slideDown();

	});

	$(document).on('click', '.mov-no', function(){  
		$('.moving-listing').slideUp();
		
	});

	$(document).on('click', '.open-nav', function(){  
		$('.opc').show();
		
	});

	$(document).on('click', '.closebtn', function(){  
		$('.opc').hide();
		
	});


</script>

<script>
		// File Upload
// 
function ekUpload(){
	function Init() {

		console.log("Upload Initialised");

		var fileSelect    = document.getElementById('file-upload'),
		fileDrag      = document.getElementById('file-drag'),
		submitButton  = document.getElementById('submit-button');

		fileSelect.addEventListener('change', fileSelectHandler, false);

    // Is XHR2 available?
    var xhr = new XMLHttpRequest();
    if (xhr.upload) {
      // File Drop
      fileDrag.addEventListener('dragover', fileDragHover, false);
      fileDrag.addEventListener('dragleave', fileDragHover, false);
      fileDrag.addEventListener('drop', fileSelectHandler, false);
  }
}

function fileDragHover(e) {
	var fileDrag = document.getElementById('file-drag');

	e.stopPropagation();
	e.preventDefault();

	fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
}

function fileSelectHandler(e) {
    // Fetch FileList object
    var files = e.target.files || e.dataTransfer.files;

    // Cancel event and hover styling
    fileDragHover(e);

    // Process all File objects
    for (var i = 0, f; f = files[i]; i++) {
    	parseFile(f);
    	uploadFile(f);
    }
}

  // Output
  function output(msg) {
    // Response
    var m = document.getElementById('messages');
    m.innerHTML = msg;
}

function parseFile(file) {

	console.log(file.name);
	output(
		'<strong>' + encodeURI(file.name) + '</strong>'
		);

    // var fileType = file.type;
    // console.log(fileType);
    var imageName = file.name;

    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
    if (isGood) {
    	document.getElementById('start').classList.add("hidden");
    	document.getElementById('response').classList.remove("hidden");
    	document.getElementById('notimage').classList.add("hidden");
      // Thumbnail Preview
      document.getElementById('file-image').classList.remove("hidden");
      document.getElementById('file-image').src = URL.createObjectURL(file);
  }
  else {
  	document.getElementById('file-image').classList.add("hidden");
  	document.getElementById('notimage').classList.remove("hidden");
  	document.getElementById('start').classList.remove("hidden");
  	document.getElementById('response').classList.add("hidden");
  	document.getElementById("file-upload-form").reset();
  }
}

function setProgressMaxValue(e) {
	var pBar = document.getElementById('file-progress');

	if (e.lengthComputable) {
		pBar.max = e.total;
	}
}

function updateFileProgress(e) {
	var pBar = document.getElementById('file-progress');

	if (e.lengthComputable) {
		pBar.value = e.loaded;
	}
}

function uploadFile(file) {

	var xhr = new XMLHttpRequest(),
	fileInput = document.getElementById('class-roster-file'),
	pBar = document.getElementById('file-progress'),
      fileSizeLimit = 1024; // In MB
      if (xhr.upload) {
      // Check if file is less than x MB
      if (file.size <= fileSizeLimit * 1024 * 1024) {
        // Progress bar
        pBar.style.display = 'inline';
        xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
        xhr.upload.addEventListener('progress', updateFileProgress, false);

        // File received / failed
        xhr.onreadystatechange = function(e) {
        	if (xhr.readyState == 4) {
            // Everything is good!

            // progress.className = (xhr.status == 200 ? "success" : "failure");
            // document.location.reload(true);
        }
    };

        // Start upload
        xhr.open('POST', document.getElementById('file-upload-form').action, true);
        xhr.setRequestHeader('X-File-Name', file.name);
        xhr.setRequestHeader('X-File-Size', file.size);
        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.send(file);
    } else {
    	output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
    }
}
}

  // Check for the various File API support.
  if (window.File && window.FileList && window.FileReader) {
  	Init();
  } else {
  	document.getElementById('file-drag').style.display = 'none';
  }
}
ekUpload();
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBHtMus_lrs1jrXwK9QkltUaAP5rr3UoX0&libraries=places"></script>
</body>
</html>

<script>
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 16,
			scrollwheel: false,
			center: new google.maps.LatLng(-33.868898, 151.211208),
		});

		var iconBase = '<?php echo base_url(); ?>assets/images/';
		var icons = {
			property: {
				icon: iconBase + 'icon_marker.png'
			},
		};

		function addMarker(feature) {
			var marker = new google.maps.Marker({
				position: feature.position,
				icon: icons[feature.type].icon,
				map: map
			});
		}

		var features = [
		{
			position: new google.maps.LatLng(-33.871059, 151.221364),
			type: 'property'
		}, {
			position: new google.maps.LatLng(-33.866214, 151.211144),
			type: 'property'
		}, {
			position: new google.maps.LatLng(-33.869764, 151.209213),
			type: 'property'
		}, {
			position: new google.maps.LatLng(-33.870533, 151.214816),
			type: 'property'
		}, {
			position: new google.maps.LatLng(-33.871177, 151.217252),
			type: 'property'
		}, {
			position: new google.maps.LatLng(-33.868930, 151.191901),
			type: 'property'
		}, {
			position: new google.maps.LatLng(-33.858028, 151.203870),
			type: 'property'
		},
		];

		for (var i = 0, feature; feature = features[i]; i++) {
			addMarker(feature);
		}
	}

	initMap();
</script>


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


	$('#login_btn').click(function(){

		if($("#login_form").valid()){

			var btn = $(this);
			$(btn).button('loading');
			var value = $("#login_form").serialize();
			$.ajax({
				url:'<?php echo base_url(); ?>login/login_verify',
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
						resendfun();
						$(btn).button('reset');
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
				remote: jQuery.validator.format('This email already taken.')

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

	$('#registration_btn').click(function(){

		if($("#registration_form").valid()){

			var confirm_1 = $('#check_policy').prop("checked");
			if(confirm_1 == false){
				console.log("here");
				$('.remb').css('color' , 'red');
				return false;
			}else{
				$('.remb').css('color' , '');
			}

			var btn = $(this);

			$(btn).button('loading');
			var value = $("#registration_form").serialize();

			$.ajax({

				url:'<?php echo base_url(); ?>register/submit_user',

				type:'post',

				data:value,

				dataType:'json',

				success:function(status){

					

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
						$(btn).button('reset');

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
						$(btn).button('reset');
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
							text: status.response,
							class_name: 'gritter-success'
						});
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


 $(".pac-container").removeClass("pac-logo");

</script>
<style type="text/css">
.pac-logo::after {background-image: url('');}
</style>


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