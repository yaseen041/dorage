<?php $this->load->view('common/header'); ?>
<!-- Edit Profile -->

<section class="panel-bg profile_pg">
	<div class="container">
		<div class="row">

			<?php $this->load->view('common/dashboard_sidebar'); ?>


			<div class="col-md-9">
				<div class="panel with-nav-tabs panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li><a><i class="fa fa-user-circle"></i> Edit Profile</a></li>

						</ul>
					</div>

					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1default">

								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<form id="profile_dp_form">
											<label class="btn-bs-file btn  btn-primary pull-right">
												<img src="<?php echo base_url(); ?>assets/images/photo-camera.png"> Change Profile Picture
												<input type="file" name="profile_dp" id="profile_dp" accept="image/*" />
											</label>
										</form>
									</div>
								</div>

								<form id="update_user" method="post" action="" novalidate>
									<h4 class="dark-sky">Personal Information</h4>
									<hr />
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" class="form-control" placeholder="Enter first name" name="first_name" value="<?php echo $user_detail['first_name']; ?>" required>
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" class="form-control" name="last_name" placeholder="Enter last name" value="<?php echo $user_detail['last_name']; ?>" required>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Gender</label>
												<select name="gender" class="form-control" required>
													<option <?php if ($user_detail['gender'] == 'Male') { ?> selected  <?php } ?> value="Male"> Male </option>
													<option <?php if ($user_detail['gender'] == 'Female') { ?> selected  <?php } ?> value="Female"> Female </option>
													<option <?php if ($user_detail['gender'] == 'Other') { ?> selected  <?php } ?> value="Other"> Other </option>
												</select>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group form-group--date">
												<label>Date of Birth</label>
												<?php 
												if(!empty($user_detail['dob'])) {

													$dob = date("m/d/Y" , strtotime($user_detail['dob']));

												} else {
													$dob = '';
												}?>


												<input name="dob" id="user_dob" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo $dob; ?>" required>
											</div>
										</div>
									</div>	
									<br/>
									<h4 class="dark-sky">Payment Information</h4>
									<hr>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Paypal Email</label>
												<input type="email" class="form-control" name="paypal_email" value="<?php echo $user_detail['paypal_email']; ?>" placeholder="Enter paypal email here">
											</div>	
										</div>
									</div>
									<h4 class="dark-sky">Contact Information</h4>
									<hr/>	
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" name="email" value="<?php echo $user_detail['email']; ?>" placeholder="Enter email" readonly>
											</div>	
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" class="form-control" placeholder="Enter phone number" name="phone" value="<?php echo $user_detail['phone']; ?>" id="phone_number" required>
											</div>	
										</div>
									</div>  	
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Street Address Line 1</label>
												<input type="text" class="form-control" name="address1" placeholder="339 Lenape Way" value="<?php echo $user_detail['address1']; ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Street Address Line 2</label>
												<input type="text" class="form-control" name="address2" placeholder="Line 2 (optional)" value="<?php echo $user_detail['address2']; ?>">
											</div>
										</div>
									</div> 

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control" name="city" placeholder="Claymont" value="<?php echo $user_detail['city']; ?>" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>State</label>
												<input type="text" class="form-control" name="state" placeholder="Delware" value="<?php echo $user_detail['state']; ?>">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Zip</label>
												<input type="text" class="form-control" name="zip" placeholder="19703" value="<?php echo $user_detail['zip']; ?>">
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Describe Yourself</label>
												<textarea class="form-control" rows="5" placeholder="Describe yourself" name="about"><?php echo $user_detail['about']; ?></textarea>
											</div>
										</div>

									</div>

									<div class="form-group text-left">
										<button type="button" class="btn back-btn cont-btn submit">Submit</button>
									</div> 
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</section>
<!-- Edit Profile End-->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"
	type="text/javascript"></script>

	<script type="text/javascript">

		$('.submit').click(function(e){
			
			var btn = $(this);

			$(btn).button('loading');
			var value = $("#update_user").serialize();

			$.ajax({
				url:'<?php echo base_url(); ?>user/update_user',
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
							setTimeout(function(){ window.location = "<?php echo base_url().'user/profile'; ?>"; },1000);
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
		});

	</script>


	<script>

		$("#profile_dp").on("change", function (e) { 

			var file, img;
			var _URL = window.URL || window.webkitURL;
			var img_valid = true;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
                //alert(this.width + "*" + this.height);
                if (this.width > 600 || this.height > 600) {
                	$.gritter.add({
                		title: 'Error!',
                		sticky: false,
                		time: '5000',
                		before_open: function() {
                			if ($('.gritter-item-wrapper').length >= 3) {
                				return false;
                			}
                		},
                		text: "The image you are attempting to upload doesn't fit into the allowed dimensions. Image size must be less than or equal to 600X600. Current image size is "+this.width+"X"+this.height+".",
                		class_name: 'gritter-error'
                	});
                }else{
                	var formData = new FormData($("#profile_dp_form")[0]);
                	$.ajax({
                		url: '<?php echo base_url(); ?>user/update_dp',
                		type: 'POST',
                		data: formData,
                		async: false,
                		cache: false,
                		dataType:'json',
                		contentType: false,
                		enctype: 'multipart/form-data',
                		processData: false,
                		success: function (status) {
                			if (status.msg == 'success') {
                				$.gritter.add({
                					title: 'Success!',
                					sticky: false,
                					time: '5000',
                					before_open: function() {
                						if ($('.gritter-item-wrapper').length >= 3) {
                							return false;
                						}
                					},
                					text: status.response,
                					class_name: 'gritter-success'
                				});
                				setTimeout(function(){ location.reload(); },2000);
                			} else if (status.msg == 'error') {
                				$.gritter.add({
                					title: 'Error!',
                					sticky: false,
                					time: '5000',
                					before_open: function() {
                						if ($('.gritter-item-wrapper').length >= 3) {
                							return false;
                						}
                					},
                					text: status.response,
                					class_name: 'gritter-error'
                				});
                			}
                		}
                	});
                	return false;
                }
            };
            img.src = _URL.createObjectURL(file);
        }

    });


</script>

<script src="https://rawgit.com/RobinHerbots/Inputmask/4.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    //$('#user_dob').mask('9999/999/99','YYYY/MMM/dd' , {placeholder:"1990/Jan/02"});

    $('#user_dob').inputmask({mask: '99/99/9999'});

    $('#phone_number').inputmask({mask: '(999) 999-9999'});


</script>