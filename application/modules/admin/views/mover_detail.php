<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
	<div class="page-wrapper">
		<div class="page-header">
			<div class="page-header-title">
				<h4>Mover Detail</h4>
			</div>

		</div>
		<div class="page-body">
			<div class="row">
				<div class="col-md-8 offset-md-2">
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
									<i class="fa fa-map-marker-alt"></i> 
									&nbsp;<?php echo $mover_detail['place']; ?>
								</div>

							</div>
							<hr>
							<!-- Property Gallery Slider -->
							<div class="property-image">
								<div id="property-slider" class="property-slider">
									<img class="mover-img" src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($mover_detail['id']); ?>">
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
							<!-- Description Section -->
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
								<iframe src="https://maps.google.com/maps?q=<?php echo @$mover_detail['latitude'].",".@$mover_detail['longitude']; ?>&z=15&output=embed" width="750" height="350" frameborder="0" style="border:0"></iframe>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('common/admin_footer'); ?>