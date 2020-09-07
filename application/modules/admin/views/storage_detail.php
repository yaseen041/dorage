<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title">
				<h4>Storage Detail</h4>
			</div>

		</div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<!-- Content -->
					<div id="content">
						<article class="post property-item">
							<div class="post-property-header">
								<div class="row">
									<div class="col-md-8 col-sm-8">
										<h3 class="post-title"><?php echo $list_detail['title']; ?></h3>
									</div>
									<div class="col-md-4 col-sm-4 text-right">
										<span class="property-price">$<?php echo $list_detail['price']; ?>/day</span>

									</div>
								</div>

								<div class="row">
									<div class="col-md-8 col-sm-8">
										<div class="property-address">
											<i class="fa fa-map-marker-alt"></i>&nbsp; <?php echo @$list_detail['place']; ?>
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
								</div>
								<!-- Property facility Detail -->

								<!-- The Space Section -->
								<hr>
								<div class="row">
									<div class="col-md-3 col-sm-3"><h3 class="heading-title">The Space</h3></div>
									<div class="col-md-9 col-sm-9">
										<ul class="feature-list">
											<li>Space type: <strong><?php echo get_size_type(get_meta_value('storage_size_type' , @$list_detail['id'])); ?></strong></li>
											<li>Storage space type: <strong><?php echo get_storage_type(get_meta_value('space_storage_type' , @$list_detail['id'])); ?></strong></li>
											<li>Room space character:
												<strong>
													<br />
													<?php foreach (get_space_characters(@$list_detail['id']) as $key => $value) { ?> 

													<span class="label label-info"><?php echo $value; ?></span>

													<?php } ?>

												</strong>
											</li>

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

											<?php if( empty($additional_rules)): ?>
												<li> Not found </li>
											<?php endif; ?>

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

											<?php if(empty($extra_space_rules)): ?>
												<li> Not found </li>
											<?php endif; ?>
											
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

							</div></article>

							<?php if(!empty(get_meta_value('video_url' , @$list_detail['id']))) { ?>

							<div class="property-location widget panel-box">
								<div class="panel-header">
									<h3 class="panel-title">Space Video</h3>
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

							<!-- Property Location / Map -->
							<div class="property-location widget panel-box">
								<div class="panel-header">
									<h3 class="panel-title">Property Location</h3>
								</div>
								<div class="panel-body">
									<iframe src="https://maps.google.com/maps?q=<?php echo @$list_detail['latitude'].",".@$list_detail['longitude']; ?>&z=15&output=embed" width="750" height="350" frameborder="0" style="border:0"></iframe>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('common/admin_footer'); ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>

	<script type="text/javascript">
		$('#property-slider').slick();
	</script>