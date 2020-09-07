<?php $this->load->view('common/header'); ?>
<!-- Edit Profile -->

<section class="panel-bg">
	<div class="container">
		<div class="row">

			<?php $this->load->view('common/dashboard_sidebar'); ?>

			<div class="col-md-9">
				<div id="content">
					<?php if($user_detail['profile_updated'] == '0'): ?>
						<div class="single-agent profile-box usr-profile">
							<p class="text-center text-danger"> Your profile is not completed yet. <a href="<?php echo base_url(); ?>user/profile"> click here </a> to update your profile. </p>
						</div>

					<?php else: ?>
						<div class="single-agent profile-box usr-profile">

							<div class="profile-content">
								<div class="profile-img" style="background-image:url(<?php echo base_url(); ?>assets/profile_pictures/<?php echo get_session('profile_pic'); ?>); height:250px; width:100%; background-size:cover; background-position: center center;"></div>
								<div class="content-wrapper">
									<a class="btn btn-info btn-xs float-right" href="<?php echo base_url(); ?>user/edit_profile"> Edit Profile </a>
									<h3 class="profile-name">
										<a href="#" class=""><?php echo $user_detail['first_name']." ".$user_detail['last_name']; ?></a>
										<small>Member Since <?php echo date("j F, Y" , strtotime($user_detail['created_at'])); ?></small>
									</h3>
									<ul class="profile-contact">
										<li>
											<label> Email : </label>
											<a href="mailto:<?php echo $user_detail['email']; ?>"><?php echo $user_detail['email']; ?></a>
										</li>
										<li>
											<label> Phone Number : </label>
											<a href="tel:<?php echo $user_detail['phone']; ?>"><?php echo $user_detail['phone']; ?></a>
										</li>
										<?php if(!empty($user_detail['gender'])){ ?>
										<li>
											<label> Gender : </label>
											<b><?php echo $user_detail['gender']; ?></b>
										</li>
										<?php } ?>

										<?php if(!empty($user_detail['dob'])){ ?>
										<li>
											<label> Date of Birth : </label>
											<b><?php echo date("m/d/Y" , strtotime($user_detail['dob'])); ?></b>
										</li>
										<?php } ?>

									</ul>
									<p>
										<label> Address : </label>
										<b><?php echo $user_detail['address1'].", "; ?><?php if(!empty($user_detail['address2'])){ ?><?php echo $user_detail['address2']." "; ?><?php } ?><?php echo $user_detail['city']." ".$user_detail['state']." ".$user_detail['zip']; ?></b>
									</p>
									<hr>
									<h3 class="profile-name">
										Paypal Information
									</h3>
									<?php if (empty($user_detail['paypal_email'])) { ?>
									<ul class="profile-contact">
										<li>Please update your paypal details.</li>
									</ul>
									<?php }else{ ?>
									<ul class="profile-contact">
										<li>
											<label> Paypal ID : </label>
											<a href="mailto:<?php echo $user_detail['paypal_email']; ?>"><?php echo $user_detail['paypal_email']; ?></a>
										</li>
									</ul>
									<?php } ?>
								</div>
							</div>
							<div class="profile-description">
								<h3> About </h3>
								<p><?php echo $user_detail['about']; ?></p>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>	


		</div>
	</div>		
</section>


<?php $this->load->view('common/footer'); ?>