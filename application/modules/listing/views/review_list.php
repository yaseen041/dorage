<?php $this->load->view('common/header'); ?>	


<!-- ====== SINGLE PROPERTY PAGE HEADER ====== -->
<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Review Storage Listing</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>user/listings">Home</a></li>
			<li class="active">Review your listing</li>
		</ul>
	</div>
</section>

<!-- ====== SINGLE PROPERTY CONTENT ====== -->
<section class="page-section" style="padding-top:50px;">
	<div class="container">
		<div class="row"> 
			<div class="col-md-8 col-md-offset-2">
				<!-- Content -->
				<div id="content">
					<?php if($list_detail['status'] == 0): ?>
						<h4 class="label-warning text-center" style="color: white; padding: 5px 0px;"> Your storage space is under review. </h4>
						<br>
					<?php endif; ?>
					<!-- Property Single Detail / Description -->
					<article class="post property-item">
						<div class="post-property-header">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<h3 class="post-title"><a href="#"><?php echo $list_detail['title']; ?></a></h3>
								</div>
								<div class="col-md-4 col-sm-4 text-right">

									<a href="<?php echo base_url(); ?>listing/storage/step3_complete/<?php echo $list_detail['unique_id']; ?>" class="btn back-btn review-edit">Edit</a>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<div class="property-address">
										<?php echo @$list_detail['place']; ?>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 text-right">
									<span class="property-price">$<?php echo @$list_detail['price']; ?>/day</span>

								</div>
							</div>
							<hr>

						</div>

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
									<li>Space type: <strong><?php echo get_size_type(get_meta_value('storage_size_type' , @$list_detail['id'])); ?></strong></li>
									
									<li>Storage space type: <strong><?php echo get_storage_type(get_meta_value('space_storage_type' , @$list_detail['id'])); ?></strong></li>
									
									<li>Room space character:
										<strong>
											
											<?php foreach (get_space_characters(@$list_detail['id']) as $key => $value) { ?>
											
											<h4 class="label label-info"><?php echo $value; ?></h4>

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
									<li>Less than
										<?php echo get_cancellation_policy(get_meta_value('cancellation_policy' , @$list_detail['id'])); ?> hours</li>
									</ul>
								</div>
							</div>
							<!-- Facilities Section -->
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3"><h3 class="heading-title">Amenities </h3></div>
								<div class="col-md-9 col-sm-9">
									<ul class="feature-list">
										<?php if(empty($basic_amenities)) {?>
										<li> Not found </li>
										<?php } ?>
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
										<?php if(empty($safety_amenities)) {?>
										<li> Not found </li>
										<?php } ?>
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
										<?php if(empty($additional_rules)) {?>
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

										<?php if(empty($extra_space_rules)) {?>
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
									<?php echo nl2br($list_detail['description']); ?>
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
	</section>

	<?php $this->load->view('common/footer'); ?>

	<script type="text/javascript">
		$("#storage_publish").click(function() {

			var publish_unpublish = $(this).attr('data-id');
			$.ajax({
				url:'<?php echo base_url(); ?>listing/storage/'+publish_unpublish,
				type:'post',
				data:{ unique_id : '<?php echo $list_detail['unique_id']; ?>' },
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
					} else if(status.msg=='error'){
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