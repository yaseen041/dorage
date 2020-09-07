


<!-- ====== SINGLE PROPERTY PAGE HEADER ====== -->
<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Review your listing</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Review your listing</li>
		</ul>
	</div>
</section>

<!-- ====== SINGLE PROPERTY CONTENT ====== -->
<section class="page-section">
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Content -->
				<div id="content">
					<?php if($mover_detail['status'] == 0): ?>
						<h4 class="label-warning text-center" style="color: white; padding: 5px 0px;"> Your mover listing is under review. </h4>
						<br>
					<?php endif; ?>
					<!-- Property Single Detail / Description -->
					<article class="post property-item">
						<div class="post-property-header">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<h3 class="post-title"><a href="javascript:void(0)"><?php echo $mover_detail['title']; ?></a></h3>
								</div>
								<div class="col-md-4 col-sm-4 text-right">
									<?php if($mover_detail['status'] == 0) { ?>

									<a href="<?php echo base_url(); ?>listing/mover/step1/<?php echo $mover_detail['unique_id']; ?>" class="btn back-btn review-edit">Edit</a>
									
									<?php } else { ?>
									
									<a href="<?php echo base_url(); ?>listing/mover/edit_mover/<?php echo $mover_detail['unique_id']; ?>" class="btn back-btn review-edit">Edit</a>
									
									<?php } ?>
									
								</div>

							</div>
							<div class="property-address">
								<?php echo $mover_detail['place']; ?>
							</div>

						</div>
						<hr>
						<!-- Property Gallery Slider -->
						<div class="property-image">
							<div id="property-slider" class="property-slider">
								<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_mover_banner($mover_detail['id']); ?>">

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
								<p> <b>Member/s :</b><?php echo get_meta_value('how_many_crews' , @$mover_detail['id'])."<br><b> Charges :</b>  $".get_meta_value('crew_charges' , @$mover_detail['id']); ?>/hour</p>
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-3"><h3 class="heading-title">Service within:</h3></div>
							<div class="col-md-9 col-sm-9">
								<p><?php echo get_meta_value('within_miles' , @$mover_detail['id']); ?> Miles</p>
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-3"><h3 class="heading-title">Description</h3></div>
							<div class="col-md-9 col-sm-9">
								<p><?php echo $mover_detail['description']; ?></p>
							</div>
						</div>
						<!-- Availability Section -->

					</article>

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
		</div>
	</div>
</section>