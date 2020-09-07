<?php $this->load->view('common/header'); ?>	
<!-- Edit Profile -->

<section class="panel-bg profile_pg">
	<div class="container">
		<div class="row">

			<div class="col-md-3">
				<div class="list-group user-dashboard">
					<a href="<?php echo base_url(); ?>user/dashboard" class="list-group-item">
						<i  class="fa fa-tachometer"></i>Dashboard
					</a>
					<a href="<?php echo base_url(); ?>user/my_bookings" class="list-group-item"><i class="fa fa-cart-arrow-down"></i>Bookings</a>

					<a href="#" class="list-group-item"><i class="fa fa-inbox"></i>Inbox</a>

					<a href="<?php echo base_url(); ?>user/profile" class="list-group-item"><i class="fa fa-user"></i>Profile</a>

					<a href="<?php echo base_url(); ?>user/settings" class="list-group-item active"><i class="fa fa-wrench"></i>Settings</a>
					
					<a href="<?php echo base_url(); ?>user/listings" class="list-group-item"><i class="fa fa-list"></i>Listings</a>

				</div>

			</div>


			<div class="col-md-9">
				<div class="panel with-nav-tabs panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1default" data-toggle="tab"><i class="fa fa-cogs"></i> Account Settings</a></li>
							<li><a href="#tab2default" data-toggle="tab"><i class="fa fa-envelope"></i> Notification Settings</a></li>

						</ul>
					</div>

					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1default">
								<form action="#" method="">
									<h4 class="dark-sky">Provide your legal business details to help us confirm you’re part of a company.</h4>
									<hr>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Company Name</label>
												<input type="text" class="form-control" name="company_name" placeholder="">
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Street</label>
												<input type="text" class="form-control" name="street" placeholder="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control" name="city" placeholder="">
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>State</label>
												<input type="text" class="form-control" name="state" placeholder="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Country</label>
												<select class="form-control">
													<option> Select Country</option>
													<option value="United States">United States</option> 
													<option value="United Kingdom">United Kingdom</option> 
													<option value="Afghanistan">Afghanistan</option> 
													<option value="Albania">Albania</option> 
													<option value="Algeria">Algeria</option> 
													<option value="American Samoa">American Samoa</option> 
													<option value="Andorra">Andorra</option> 
													<option value="Angola">Angola</option> 
													<option value="Anguilla">Anguilla</option> 
													<option value="Antarctica">Antarctica</option> 
													<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
													<option value="Argentina">Argentina</option> 
													<option value="Armenia">Armenia</option> 
													<option value="Aruba">Aruba</option> 
													<option value="Australia">Australia</option> 
													<option value="Austria">Austria</option> 
													<option value="Azerbaijan">Azerbaijan</option> 
													<option value="Bahamas">Bahamas</option> 
													<option value="Bahrain">Bahrain</option> 
													<option value="Bangladesh">Bangladesh</option> 
												</select>
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>ZIP code</label>
												<input type="text" class="form-control" name="zip_code" placeholder="">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" class="form-control" name="p_number" placeholder="">
											</div>	
										</div>

										<div class="col-md-12 col-sm-6 col-xs-12">
											<div class="form-check click-check pull-left" style="margin-left: -17px;">
												<label>
													<input type="checkbox" class="businessCheckbox" name="" checked> <span class="label-text"> </span><span class="remb">Business address and registered office address are the same</span>
												</label>
											</div>
										</div>
									</div>

									<div class="reg-add">
										<h4 class="dark-sky">Registered office address</h4>
										<hr>

										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="form-group">
													<label>Street</label>
													<input type="text" class="form-control" name="street" placeholder="">
												</div>
											</div>

										</div>

										<div class="row">

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control" name="city" placeholder="">
												</div>	
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>State</label>
													<input type="text" class="form-control" name="state" placeholder="">
												</div>
											</div>
										</div>


										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>Country</label>
													<select class="form-control">
														<option> Select Country</option>
														<option value="United States">United States</option> 
														<option value="United Kingdom">United Kingdom</option> 
														<option value="Afghanistan">Afghanistan</option> 
														<option value="Albania">Albania</option> 
														<option value="Algeria">Algeria</option> 
														<option value="American Samoa">American Samoa</option> 
														<option value="Andorra">Andorra</option> 
														<option value="Angola">Angola</option> 
														<option value="Anguilla">Anguilla</option> 
														<option value="Antarctica">Antarctica</option> 
														<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
														<option value="Argentina">Argentina</option> 
														<option value="Armenia">Armenia</option> 
														<option value="Aruba">Aruba</option> 
														<option value="Australia">Australia</option> 
														<option value="Austria">Austria</option> 
														<option value="Azerbaijan">Azerbaijan</option> 
														<option value="Bahamas">Bahamas</option> 
														<option value="Bahrain">Bahrain</option> 
														<option value="Bangladesh">Bangladesh</option> 
													</select>
												</div>	
											</div>

											<div class="col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label>ZIP code</label>
													<input type="text" class="form-control" name="zip_code" placeholder="">
												</div>
											</div>
										</div>
									</div>


									<h4 class="dark-sky">Legal representative</h4>
									<hr>

									<div class="row">		
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" class="form-control" name="f_name" placeholder="Salman">
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" class="form-control" name="l_name" placeholder="Javed">
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Email</label>
												<input type="email" class="form-control" name="email" placeholder="Salman">
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" class="form-control" name="phone_number" placeholder="12345678">
											</div>
										</div>
									</div>
									<hr>

									<div class="row">	
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Country of incorporation</label>
												<input type="text" class="form-control" name="country_incorp" placeholder="">
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group form-group--date">
												<label>Date of incorporation</label>
												<input id="nb-start-date" name="date_incorp" class="form-control" placeholder="Check-in Date">
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-md-12">
											<div class="form-group">
												<label>Registration Number</label>
												<input type="text" class="form-control" name="r_number" placeholder="">
											</div>	
										</div>

									</div>


									<h4 class="dark-sky">Company owner</h4>
									<hr>

									<div class="row">		
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" class="form-control" name="f_name" placeholder="Salman">
											</div>	
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" class="form-control" name="l_name" placeholder="Javed">
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group form-group--date">
												<label>Date of Birth</label>
												<input id="nb-start-date" name="date_birth" class="form-control" placeholder="Check-in Date">
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="form-group text-right">
												<button type="submit" class="btn next-btn submit account">Submit</button>
											</div>
										</div>
									</div>
									
								</form>
							</div>


							<div class="tab-pane fade" id="tab2default">	
								<div class="row padd-top">
									
									<div class="col-lg-6 col-lg-push-6 col-md-6 col-md-push-0 col-sm-6 col-sm-push-6">
										<div class="panel panel-inner">
											<div class="panel-heading">Contact Information</div>
											<div class="panel-body">
												<p>This information can be edited from your profile page. <a href="edit-profile.php">Edit Profile</a></p>
												<hr>

												<div class="row">
													<div class="col-md-3 col-sm-3 col-xs-3">
														<p style="margin-bottom: 4.5px;">Email</p>
													</div>
													<div class="col-md-9 col-sm-9 col-xs-9 text-right">
														<p style="margin-bottom: 4.5px;"">Exapmle@gmail.com</p>
													</div>
												</div>		

												<div class="row">
													<div class="col-md-6 col-sm-6 col-xs-6">
														<p>Phone number</p>
													</div>
													<div class="col-md-6 col-sm-6 col-xs-6 text-right">
														<p>123456</p>
													</div>
												</div>	
											</div>
										</div>
									</div>	

									<div class="col-lg-6 col-lg-pull-6 col-md-6 col-md-pull-0 col-sm-6 col-sm-pull-6">
										<form method="">
											<div class="panel panel-inner">
												<div class="panel-heading">Messages</div>
												<div class="panel-body">
													<p>Receive messages from hosts and guests, including booking requests.</p>
													<hr>
													<div class="form-check">
														<label>
															<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb"> Email</span>
														</label>
													</div>

													<div class="form-check">
														<label>
															<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb"> Text messages</span>
														</label>
													</div>
												</div>

											</div>

										</form>
										<button type="submit" class="btn cont-btn submit btn-block">Save</button>
										<br>
									</div>
								</div>	
								

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