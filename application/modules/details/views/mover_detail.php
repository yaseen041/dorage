<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">

	
	<!-- ====== SINGLE PROPERTY PAGE HEADER ====== -->
	<section class="page-header">
		<div class="container">
			<h1 class="page-header-title">Mover details</h1>
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
				<li class="active">Mover details</li>
			</ul>
		</div>
	</section>

	<!-- ====== SINGLE PROPERTY CONTENT ====== -->
	<section class="page-section">
		<div class="container">

			<div class="row">
				<div class="col-md-8">
					<!-- Content -->
					<div id="content">
						<!-- Property Single Detail / Description -->
						<article class="post property-item">
							<div class="post-property-header">
								<div class="row">
									<div class="col-md-8 col-sm-8">
										<h3 class="post-title"><?php echo $mover_detail['title']; ?></h3>
									</div>
								</div>
								<div class="property-address">
									<?php echo $mover_detail['place']; ?>
								</div>
								<div class="col-md-12">
									<div class="rating">
										<?php $listingReviews = getapprovedListingRating($mover_detail['id'], 'mover'); ?>
										<div class="stars">
											<select class="listingRating" name="rating" data-current-rating="<?php echo $listingReviews['total_stars']; ?>" autocomplete="off" style="display: none;">
												<option value=""></option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
											<span> <?php echo $listingReviews['total_reviews']; ?> Reviews</span>
										</div>
									</div>
								</div>

							</div>
							<hr>
							<!-- Property Gallery Slider -->
							<div class="property-image">
								<div id="property-slider" class="property-slider alfax" style="width:100%;">
									<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_mover_banner($mover_detail['id']); ?>"  style="width:100%;">
								</div>

							</div>
							<!-- Property facility Detail -->
							<!-- Facilities Section -->
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Service</h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">


										<li><img src="<?php echo base_url(); ?>assets/images/worker-loading-boxes.png"> &nbsp;Loading</li>
										<li> <img src="<?php echo base_url(); ?>assets/images/moving-truck.png"> &nbsp;Moving</li>


									</ul>
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title"> Crew Detail </h3></div>
								<div class="col-md-9 col-sm-9">
									<p> <b>Member/s: </b><?php echo get_meta_value('how_many_crews' , @$mover_detail['id'])."<br><b> Charges :</b>  $".get_meta_value('crew_charges' , @$mover_detail['id']); ?>/hour</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Service within:</h3></div>
								<div class="col-md-9 col-sm-9">
									<p><?php echo get_meta_value('within_miles' , @$mover_detail['id']); ?> Miles</p>
								</div>
							</div>
							<!-- Description Section -->
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Description</h3></div>
								<div class="col-md-9 col-sm-9">
									<p><?php echo nl2br($mover_detail['description']); ?></p>
								</div>
							</div>
							<!-- Availability Section -->

						</article>

						<div id="comments" class="comments-area compact">
							
							<div class="entry-comments">
								<div class="comment-header">
									<h3 class="widget-title comment-title">
										Reviews
									</h3>
								</div>
								<ol class="comment-list">
									<?php $reviews = getappovedListingReviews($mover_detail['id'], 'mover'); ?>
									<!-- Comment Parent  -->
									<?php 
									if (!empty($reviews)) {
										foreach ($reviews as $review) { ?>
										<li class="comment">
											<div class="comment-body">
												<div class="comment-avatar"><img src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $review['profile_dp']; ?>" alt="User Image"></div>
												<div class="comment-content">
													<div class="comment-author">
														<strong><?php echo ucwords($review['username']); ?></strong>
														<span class="comment-date">
															<?php echo get_timeago(strtotime($review['date_added'])); ?>
															<select class="ratingDiv">
																<option <?php echo ($review['stars'] == 1)?"selected":""; ?> value="1">1</option>
																<option <?php echo ($review['stars'] == 2)?"selected":""; ?> value="2">2</option>
																<option <?php echo ($review['stars'] == 3)?"selected":""; ?> value="3">3</option>
																<option <?php echo ($review['stars'] == 4)?"selected":""; ?> value="4">4</option>
																<option <?php echo ($review['stars'] == 5)?"selected":""; ?> value="5">5</option>
															</select>
														</span>
													</div>
													<p><?php echo nl2br($review['review']); ?></p>

												</div>
											</div>
										</li>
										<?php } 
									}else{
										echo "No Reviews Found!";
									} ?>
								</ol>
							</div>
						</div>

						<!-- Property Location / Map -->
						<div class="property-location widget panel-box">
							<div class="panel-header">
								<h3 class="panel-title">Location</h3>
							</div>
							<div class="panel-body">
								<iframe src="https://maps.google.com/maps?q=<?php echo $mover_detail['latitude'].",".$mover_detail['longitude']; ?>&z=15&output=embed" width="750" height="350" frameborder="0" style="border:0"></iframe>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-4">

					<!-- Sidebar -->
					<div id="sidebar">

						<div class="widget">
							<!-- Panel Box -->
							<div class="panel-box">
								<!-- Panel Header / Title -->
								<div class="panel-header">
									<h3 class="panel-title">Owner Information</h3>
								</div>
								<!-- Panel Body -->
								<div class="panel-body">
									<div class="profile-box">
										<div class="profile-header">
											<div class="profile-img"><img src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $mover_detail['profile_dp']; ?>"></div>
											<h5 class="profile-title"><?php echo $mover_detail['first_name']." ".$mover_detail['last_name']; ?></h5>
										</div>
										<ul class="profile-contact">
											<li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $mover_detail['email']; ?>"><?php echo $mover_detail['email']; ?></a></li>
											<li><i class="fa fa-phone"></i> <a href="tel:<?php echo $mover_detail['phone']; ?>"><?php echo $mover_detail['phone']; ?></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<!-- widget section Message -->
						<?php if($mover_detail['users_id'] != get_session('user_id')): ?>
							<div class="widget">
								<div class="panel-box">
									<div class="panel-header">
										<h3 class="panel-title">Leave Message</h3>
									</div>
									<div class="panel-body">
										<form action="" method="post">

											<div class="form-group">
												<textarea name="chat_message" id="chat_message" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
											</div>
											<div class="form-group">
												<input type="button" data-loading-text="Please wait..." class="btn-submit btn-primary btn moverChatbtn" value="Submit">
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>


			</div>
		</div>
	</section>

</div>
<!-- Become Space Provider End-->

<?php $this->load->view('common/footer'); ?>


<script type="text/javascript">
	$('.ratingDiv').barrating({
		theme: 'css-stars',
		readonly: true
	});
	$(document).on('click', '.moverChatbtn', function(){
		var message = $('#chat_message').val();
		var property = "<?php echo $mover_detail['unique_id']; ?>";
		$.ajax({
			url:"<?php echo base_url(); ?>details/chatMessage",
			type:"post",
			data:"message="+message+"&property="+property+"&stlink="+$(location).attr('href'),
			dataType:"json",
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
					$('#chat_message').val('');
				}else if(status.msg=='error'){
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
				}else if(status.msg=='login_error'){
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
					$('#loginModal').modal('show');
				}
			}
		});
	});
</script>