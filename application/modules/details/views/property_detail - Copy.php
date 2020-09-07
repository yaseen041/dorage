<?php $this->load->view('common/header'); ?>	

<!-- ====== SINGLE PROPERTY PAGE HEADER ====== -->
<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Storage Detail</h1>
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Storage Detail</li>
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
					<article class="post property-item">
						<div class="post-property-header">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<h3 class="post-title"><a href="#"><?php echo $list_detail['title']; ?></a></h3>
								</div>

								<?php

								if(!empty($list_detail['price'])) { ?>
								<div class="col-md-4 col-sm-4 text-right">
									<span class="property-price">$<?php echo number_format($list_detail['price']); ?>/day</span>
								</div>
								<?php } ?>
							</div>

							<div class="row">
								<div class="col-md-8 col-sm-8">
									<div class="property-address">
										<?php echo @$list_detail['place']; ?>
									</div>
								</div>

							</div>
							<hr>
							
							<!-- Property Gallery Slider -->
							<div class="property-image">
								<div id="property-slider" class="property-slider">
									<?php foreach ($list_images as $image) { ?>
									<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo $image['image']; ?>">
									<?php } ?>

								</div>
								<!-- Property Gallery Slider Navigation -->
								<div id="property-slider-nav" class="property-slider-nav">

									<?php foreach ($list_images as $image) { ?>
									<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo $image['image']; ?>">
									<?php } ?>

								</div>
							</div>
							<!-- Property facility Detail -->

							<!-- The Space Section -->
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">The Space</h3></div>
								<div class="col-md-9 col-sm-9">

									<ul class="feature-list">
										<li>Space size type: <strong><?php echo get_size_type(get_meta_value('storage_size_type' , @$list_detail['id'])); ?></strong></li>

										<li>Storage space type: <strong><?php echo get_storage_type(get_meta_value('space_storage_type' , @$list_detail['id'])); ?></strong></li>

										<li>Room space character: <strong><?php echo get_room_space_character(get_meta_value('room_space_character' , @$list_detail['id'])); ?> </strong></li>

										<li>Space height: <strong><?php echo get_meta_value('space_height' , @$list_detail['id']); ?> feet</strong></li>
										<li>Space width: <strong><?php echo get_meta_value('space_width' , @$list_detail['id']); ?> feet</strong></li>
										<li>Space length: <strong><?php echo get_meta_value('space_length' , @$list_detail['id']); ?> feet</strong></li>
									</ul>


								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Cancellation policy</h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<li>Less than <?php echo get_cancellation_policy(get_meta_value('cancellation_policy' , @$list_detail['id'])); ?> hours</li>
									</ul>
								</div>
							</div>
							<!-- Facilities Section -->
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Amenities </h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<?php foreach ($basic_amenities as $amenity) { ?>

										<li><i class="fa fa-check"></i><?php echo $amenity['amenity_name']; ?></li>

										<?php } ?>

									</ul>
								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Safety amenities </h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<?php foreach ($safety_amenities as $amenity) { ?>

										<li><i class="fa fa-check"></i><?php echo $amenity['amenity_name']; ?></li>

										<?php } ?>
									</ul>
								</div>
							</div>

							<!-- Description Section -->

							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Space rules </h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<?php foreach ($basic_space_rules as $basic_rule) { ?>
										<li> <?php echo $basic_rule['name']; ?> : 
											<?php if( in_array($basic_rule['id'] , $rules) ){ ?> 
											<strong> Yes </strong>
											<?php } else { ?> 
											<strong> No </strong>
											<?php } ?>

										</li>
										<?php } ?>

									</ul>
								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Additional rules </h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<?php if (empty($additional_rules)) { ?>
										<li> Not found </li>
										<?php } ?> 
										<?php foreach ($additional_rules as $add_rule) { ?>

										<li><i class="fa fa-star"></i><?php echo $add_rule['rule']; ?></li>

										<?php } ?>
									</ul>
								</div>
							</div>

							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Space details</h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">

										<?php if (empty($extra_space_rules)) { ?>
										<li> Not found </li>
										<?php } ?> 

										<?php foreach ($extra_space_rules as $extra_rule) { ?>

										<li>
											<i class="fa fa-check"></i>
											<?php echo $extra_rule['rule_name']; ?>
										</li>

										<?php } ?>

									</ul>
								</div>
							</div>


							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Booking limit</h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<li>Minimum days: <strong><?php echo get_meta_value('booking_min_day' , @$list_detail['id']); ?></strong></li>
										<li>Maximum days: <strong><?php echo get_meta_value('booking_max_day' , @$list_detail['id']); ?></strong></li>
									</ul>
								</div>
							</div>


							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Description</h3></div>
								<div class="col-md-9 col-sm-9">
									<p><?php echo $list_detail['description']; ?></p>
								</div>
							</div>

							<!-- Availability Section -->
							
						</article>

						<?php if(!empty(get_meta_value('video_url' , @$list_detail['id']))) { ?>

						<div class="property-location widget panel-box">
							<div class="panel-header">
								<h3 class="panel-title">Storage Space Video</h3>
							</div>
							<div class="panel-body no-padding">

								<?php 


								function convertYoutube($string) {
									$new_link = preg_replace(
										"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
										"<iframe width=\"750\" height=\"350\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
										$string
									);
									return $new_link;
								}

								?>

								<?php echo convertYoutube( get_meta_value('video_url' , @$list_detail['id']) ); ?>

							</div>
						</div>

						<?php } ?>

						
						<div class="property-location widget panel-box">
							<div class="panel-header">
								<h3 class="panel-title">Property Location</h3>
							</div>
							<div class="panel-body">
								<iframe src="http://maps.google.com/maps?q=<?php echo @$list_detail['latitude'].",".@$list_detail['longitude']; ?>&z=15&output=embed" width="750" height="350" frameborder="0" style="border:0"></iframe>
							</div>
						</div>


						
						<div id="comments" class="comments-area compact">
							
							<div class="entry-comments">
								<div class="comment-header">
									<h3 class="widget-title comment-title">
										Reviews
										<button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#reviewModal">Leave a Review</button>
									</h3>
								</div>
								<ol class="comment-list">
									<?php $reviews = getListingReviews($list_detail['id']); ?>
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
													<p><?php echo $review['review']; ?></p>
													<div class="reply"><a href="javascript:void(0)" class="comment-reply-link" data-review-id="<?php echo $review['id']; ?>">Reply</a></div>

												</div>
											</div>

											<!-- Comment Children 1  -->
											<?php if(!empty($review['reply'])){ ?>
											<ul class="children">
												<li class="comment">
													<?php foreach ($review['reply'] as $reply) { ?>
													<div class="comment-body">
														<div class="comment-avatar"><img src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $reply['profile_dp']; ?>" alt="User Image"></div>
														<div class="comment-content">
															<div class="comment-author">
																<strong><?php echo ucwords($reply['username']); ?></strong>
																<span class="comment-date"><?php echo get_timeago(strtotime($reply['date_added'])); ?></span>
																<select class="ratingDiv">
																	<option <?php echo ($reply['stars'] == 1)?"selected":""; ?> value="1">1</option>
																	<option <?php echo ($reply['stars'] == 2)?"selected":""; ?> value="2">2</option>
																	<option <?php echo ($reply['stars'] == 3)?"selected":""; ?> value="3">3</option>
																	<option <?php echo ($reply['stars'] == 4)?"selected":""; ?> value="4">4</option>
																	<option <?php echo ($reply['stars'] == 5)?"selected":""; ?> value="5">5</option>
																</select>
															</div>
															<p><?php echo $reply['review']; ?></p>
														</div>
													</div>
													<?php } ?>
												</li>
											</ul>
											<?php } ?>
										</li>
										<?php } 
									}else{
										echo "No Reviews Found!";
									} ?>
								</ol>
							</div>
						</div>

						<div class="section-header header-column">
							<h2 class="section-title">Similar Recommendations</h2>
						</div>

						<div class="property-list archive-flex">
							<div class="row">
								<!-- here similar posts -->
								<?php 


								$similar_lists = get_similar_lists($list_detail['id'] ,$list_detail['latitude'] ,$list_detail['longitude'] , get_size_type(get_meta_value('storage_size_type' , @$list_detail['id'])) , get_storage_type(get_meta_value('space_storage_type' , @$list_detail['id'])) , get_room_space_character(get_meta_value('room_space_character' , @$list_detail['id'])));

								if(empty($similar_lists)) { ?>

								<div class="col-lg-6 col-md-6 col-sm-6">

									<p style="padding-left: 25px;"> No similar storages found. </p>

								</div>

								<?php }

								foreach ($similar_lists as $list) { ?>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<!-- Property Item -->
									<div class="property-item">
										<div class="property-heading">
											<span class="item-price">$<?php echo number_format($list['price']); ?>/day</span>
											<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title'])."/".md5($list['title']); ?>" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
										</div>
										<div class="img-box">
											<div class="property-label">
												<a href="javascript:void(0)" class="property-label__type"><?php echo get_storage_type(get_meta_value('space_storage_type' , @$list['id'])); ?></a>

											</div>

											<?php if (get_session('user_logged_in') == TRUE && get_session('user_id') != $list['users_id'] ): ?>

												<?php if(is_favourite($list['id'])): ?>

													<a href="javascript:void(0)" class="btn-compare-2 removefavourite active" title="Remove favourite" data-id="<?php echo $list['id']; ?>"><i class="fa fa-heart"></i></a>

												<?php else: ?>

													<a href="javascript:void(0)" class="btn-compare-2 addfavourite" title="Add to favourite" data-id="<?php echo $list['id']; ?>"><i class="fa fa-heart"></i></a>

												<?php endif; ?>

											<?php endif; ?>



											<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title'])."/".md5($list['title']); ?>" class="img-box__image"><img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($list['id']); ?>" alt="" class="img-responsive"></a>
										</div>
										<div class="property-content  padd-property">
											<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title'])."/".md5($list['title']); ?>" class="property-title"><?php echo $list['title']; ?></a>
											<div class="property-address pull-left">
												<?php echo $list['place']; ?>
											</div>

											<div class="rating pull-right">
												<?php $listingReviews = getListingRating($list['id']); ?>
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
								</div>
								<?php } ?>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-4">

					<!-- Sidebar -->
					<div id="sidebar">

						<?php if($list_detail['is_published'] == 1 && $list_detail['status'] == 1){ ?>
						<!-- widget Booking -->
						<div class="widget widget-booking">
							<!-- Panel Box -->
							<div class="panel-box">
								<!-- Panel Header / Title -->
								<div class="panel-header">
									<h3 class="panel-title">Booking Now</h3>
								</div>
								<!-- Panel Body -->
								<div class="panel-body">

									<?php
									$parameter = get_session('search_parameters');
									?>

									<div id="booking-calendar" data-selected="<?php echo @$parameter['search_startdate']; ?>"></div>

									<form id="availability_form" action="" method="post">

										<input type="hidden" name="listings_id" value="<?php echo $list_detail['id']; ?>">

										<input type="hidden" name="booking_date" id="booking_date" value="<?php echo @$parameter['search_startdate']; ?>">

										<button type="button" class="btn btn-block next-btn" id="availability_btn" data-loading-text="Please wait..."> Check availability </button>

									</form>
									<div id="availability_detail">
										<?php echo @$availablity_detail; ?>
									</div>
								</div>
							</div>
						</div>

						<?php } ?>
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
											<div class="profile-img"><img src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $list_detail['profile_dp']; ?>"></div>
											<h5 class="profile-title"><?php echo $list_detail['first_name']." ".$list_detail['last_name']; ?></h5>
										</div>
										<ul class="profile-contact">
											<li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $list_detail['email']; ?>"><?php echo $list_detail['email']; ?></a></li>
											<li><i class="fa fa-phone"></i> <a href="tel:<?php echo $list_detail['phone']; ?>"><?php echo $list_detail['phone']; ?></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<!-- widget section Message -->
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
											<button type="button" class="btn-submit btn-primary btn chatMessageBtn" data-loading-text="Please wait..."> Submit </button>
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
	<div id="reviewModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<form class="form-horizontal starRatingFrom">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Leave a Review</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<label>Rating:</label>
								<select class="starRating form-control" name="rating">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<div class="col-md-12">
								<label>Review:</label>
								<textarea class="form-control" name="reviewMessage" rows="5" placeholder="Enter your review"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" data-listing="<?php echo $list_detail['unique_id']; ?>" class="btn btn-default sign-btn reviewBtn">Submit Review</button>
					</div>
				</form>
			</div>

		</div>
	</div>

	<div id="replyModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<form class="form-horizontal replyForm">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Leave a Reply</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<label>Rating:</label>
								<select class="starRating form-control" name="rating">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<input type="hidden" name="review_id" id="review_id" value="">
							<div class="col-md-12">
								<label>Reply:</label>
								<textarea class="form-control" name="replyMessage" rows="5" placeholder="Enter your reply"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default sign-btn replyBtn">Submit Reply</button>
					</div>
				</form>
			</div>

		</div>
	</div>
	<?php $this->load->view('common/footer'); ?>

	<script type="text/javascript">
		$('.starRating').barrating({
			theme: 'css-stars'
		});
		$('.ratingDiv').barrating({
			theme: 'css-stars',
			readonly: true
		});
		$(document).on('click','.comment-reply-link', function(){
			var review_id = $(this).attr('data-review-id');
			$('#review_id').val(review_id);
			$('#replyModal').modal('show');
		});
		$(document).on('click','.replyBtn', function(){
			var form = $('.replyForm').serialize();
			$.ajax({
				url:"<?php echo base_url(); ?>details/replyAgainstReview",
				type:"post",
				dataType:"json",
				data:form,
				success: function(status){
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
						setTimeout(function(){
							location.reload(true);
						}, 1000);
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
						$('.starRatingFrom')[0].reset();
					}
				}
			})
		});
		$(document).on('click','.reviewBtn', function(){
			var form = $('.starRatingFrom').serialize();
			var listing_id = $(this).attr('data-listing');
			$.ajax({
				url:"<?php echo base_url(); ?>details/reviewAgainstListing",
				type:"post",
				dataType:"json",
				data:form+"&listing_id="+listing_id,
				success: function(status){
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
						setTimeout(function(){
							location.reload(true);
						}, 1000);
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
						$('.starRatingFrom')[0].reset();
					}
				}
			})
		});
		$(document).on('click', '.chatMessageBtn', function(){
			
			var $btn = $(this);
			
			var message = $('#chat_message').val();
			var property = "<?php echo $list_detail['unique_id']; ?>";
			
			$btn.button('loading');

			$.ajax({
				url:"<?php echo base_url(); ?>details/chatMessage",
				type:"post",
				data:"message="+message+"&property="+property+"&stlink="+$(location).attr('href'),
				dataType:"json",
				success:function(status){
					$btn.button('reset');

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

		$('body').on('click', '#availability_btn', function (event) {
			var value = $("#availability_form").serialize();

			var $btn = $(this);

			$btn.button('loading');

			$.ajax({
				url:'<?php echo base_url(); ?>details/check_availability',
				type:'post',
				data:value,
				dataType:'json',
				success:function(status){
					$btn.button('reset');
					if(status.msg=='success'){
						$("#availability_detail").html(status.response);
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

		$('body').on('click', '#book_now_btn', function (event) {

			var value = $("#book_now_form").serialize();

			var $btn = $(this);

			$btn.button('loading');

			$.ajax({
				url:'<?php echo base_url(); ?>details/book_now',
				type:'post',
				data:value,
				dataType:'json',
				success:function(status){
					if(status.msg=='success'){

						window.location = status.response;

					} else if(status.msg == 'not_login'){

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

						$btn.button('reset');

						$('#loginModal').modal('show');

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

						$btn.button('reset');
					}
				}
			});
		});
	</script>