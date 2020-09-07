<?php $this->load->view('common/header'); ?>

<section class="panel-bg">
	<div class="container">
		<div class="row">

			<?php $this->load->view('common/dashboard_sidebar'); ?>


			<div class="col-md-9">
				<div class="panel with-nav-tabs panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1default" data-toggle="tab">Storage Listings</a></li>

							<?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>
							<li><a href="#tab2default" data-toggle="tab">Mover Listings</a></li>
							<?php } ?>

							<a href="<?php echo base_url(); ?>become_provider" class="btn btn-primary btn-listing  pull-right">Add New Listing</a>
						</ul>

					</div>

					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1default">

								<?php if(empty($storage_listings)): ?>
									<p> You have no listings. </p>
								<?php endif; ?>


								<?php foreach ($storage_listings as $list): ?>

									<div class="property-item booking-item booking-padd-top property-archive col-lg-12 col-md-6 col-sm-12 no-padding">
										<div class="row">
											<div class="col-lg-5">

												<?php if($list['status'] && $list['is_published']):
												$url = base_url().'details/storage/'.$list['unique_id'].'/'.dorage_url_title($list['title']);
											else: 

												$url = base_url().'listing/storage/review_list/'.$list['unique_id'];

												endif; ?>

												<a href="<?php echo $url; ?>" class="property-image listing-property-img">

													<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($list['id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>

												</a>
											</div>
											<div class="col-lg-7">
												<div class="property-content listing-content">
													<div class="list-btn-outer">
														<?php if($list['is_published'] == 0 && $list['status'] == 1): ?>

															<button class="btn set_price_publish sign-btn delete-btn pull-right btn-primary" data-id="<?php echo $list['unique_id']; ?>">Set price and publish</button>

														<?php elseif($list['is_published'] == '0' && $list['status'] == '0' && $list['step_completed'] == '3'): ?>

															<button class="btn sign-btn delete-btn pull-right btn-primary" data-id="<?php echo $list['unique_id']; ?>">Publish</button>

														<?php endif; ?>

														<?php if($list['is_banned'] == 0): ?>

															<?php if($list['step_completed'] == 3): ?>

																<a href="<?php echo base_url(); ?>listing/storage/step3_complete/<?php echo $list['unique_id']; ?>" class="btn pull-right signin-btn edit-btn btn-primary">Edit</a>


															<?php elseif($list['step_completed'] == 2): ?>

																<a href="<?php echo base_url(); ?>listing/storage/step2_complete/<?php echo $list['unique_id']; ?>" class="btn pull-right signin-btn edit-btn btn-primary">Edit</a>

															<?php elseif($list['step_completed'] == 1): ?>

																<a href="<?php echo base_url(); ?>listing/storage/step1_complete/<?php echo $list['unique_id']; ?>" class="btn pull-right signin-btn edit-btn btn-primary">Edit</a>

															<?php else: ?>

																<a href="<?php echo base_url(); ?>listing/storage/step1/<?php echo $list['unique_id']; ?>" class="btn pull-right signin-btn edit-btn btn-primary">Edit</a>

															<?php endif; ?>

															<?php if($list['status'] == 1): ?>
																<button data-id="<?php echo $list['unique_id']; ?>" class="btn pull-right signin-btn deactive-btn edit-btn btn-info" style="margin-right: 5px;">Deactive</button>
															<?php endif; ?>


														<?php else: ?>
															<button type="button" class="btn pull-right signin-btn edit-btn btn-warning"> Banned </button>
														<?php endif; ?>



														<?php if($list['is_deleted'] == 0): ?>
															<button data-id="<?php echo $list['unique_id']; ?>" class="btn pull-right signin-btn delete-btn edit-btn btn-danger" style="margin-right: 5px;">Delete</button>
														<?php endif; ?>

													</div>
													<?php if($list['status'] == 0): ?>
														<h5 class="label-warning text-center" style="color: white; padding: 5px 0px;"> Your storage space is under review. </h5>
													<?php endif; ?>
													<h3 class="property-title">
														<a href="<?php echo $url; ?>" class="pull-left"><?php echo $list['title']; ?></a>
													</h3>
													<p>
														<span class="property-price">$<?php echo @$list['price'] == '' ? '0' : @$list['price']; ?></span>
														<span class="property-label">
															<a href="#" class="property-label__type"><?php echo get_size_type(get_meta_value('storage_size_type' , @$list['id'])); ?></a>
														</span>
													</p>
													<div class="property-address">
														<?php echo @$list['place']; ?>
													</div>
													<div class="rating" style="padding-bottom: 8px !important;">
														<?php $listingReviews = getapprovedListingRating($list['id']); ?>
														<div class="stars" style="padding: 5px 0px 0px 0px !important;">
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
													<p class="property-description">
														<?php echo $list['description']; ?>
													</p>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach; ?>


							</div>

							<?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>
							<div class="tab-pane fade" id="tab2default">	

								<?php if(empty($mover_listings)): ?>
									<p> You have no listings. </p>
								<?php endif; ?>

								<?php foreach ($mover_listings as $mover_list): ?>

									

									<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-12 no-padding" style="margin-top: 20px;">
										<div class="row">
											<div class="col-lg-5">

												<?php if($mover_list['status'] && $mover_list['is_published']):
												$url2 = base_url().'details/mover/'.$mover_list['unique_id'].'/'.dorage_url_title($mover_list['title']);
											else: 

												$url2 = base_url().'listing/mover/mover_review/'.$mover_list['unique_id'];

												endif; ?>

												<a href="<?php echo $url2; ?>" class="property-image listing-property-img">
												

													<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_mover_banner($mover_list['id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>

												</a>
												<!-- <a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a> -->
											</div>
											<div class="col-lg-7">

												<div class="property-content listing-content">

													<div class="list-btn-outer">
														<?php if($mover_list['is_banned'] == 0): ?>
										
										<a href="<?php echo base_url(); ?>listing/mover/edit_mover/<?php echo $mover_list['unique_id']; ?>" class="btn pull-right signin-btn edit-btn btn-primary">Edit</a>

										<?php if($mover_list['status'] == 1): ?>
											<button data-id="<?php echo $mover_list['unique_id']; ?>" class="btn pull-right signin-btn deactive-btn edit-btn btn-info" style="margin-right: 5px;">Deactive</button>
										<?php endif; ?>

									<?php else: ?>
										<button type="button" class="btn pull-right signin-btn edit-btn btn-warning"> Banned </button>
									<?php endif; ?>

									<?php if($mover_list['is_deleted'] == 0): ?>
										<button data-id="<?php echo $mover_list['unique_id']; ?>" class="btn pull-right signin-btn delete-btn edit-btn btn-danger" style="margin-right: 5px;">Delete</button>
									<?php endif; ?>
													</div>

													<?php if($mover_list['status'] == 0): ?>
														<h5 class="label-warning text-center" style="color: white; padding: 5px 0px;"> Your storage space is under review. </h5>
													<?php endif; ?>
													<h3 class="property-title">

														<a href="<?php echo $url2; ?>" class="pull-left"><?php echo $mover_list['title']; ?></a>

													</h3>

													<div class="row">
														<div class="col-md-6 text-center">
															<img src="<?php echo base_url(); ?>assets/images/worker-loading-boxes.png"> &nbsp;Loading
														</div>

														<div class="col-md-6">
															<img src="<?php echo base_url(); ?>assets/images/moving-truck.png"> &nbsp;Moving
														</div>
													</div> <br>

													<div class="property-address">
														<?php echo @$mover_list['place'];  ?>
													</div>
													<div class="rating" style="padding-bottom: 8px !important;">
														<?php $listingReviews = getapprovedListingRating($list['id']); ?>
														<div class="stars" style="padding: 5px 0px 0px 0px !important;">
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
													<p class="property-description">
														<?php echo $mover_list['description']; ?>
													</p>

												</div>
											</div>
										</div>
									</div>

								<?php endforeach; ?>

							</div>
							<?php } ?>

							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</section>

<!-- Modal HTML -->
<div id="deactive-confirm" class="modal fade">
	<div class="modal-dialog modal-confirm modal-sm">
		<div class="modal-content">
			<div class="modal-header">				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-body">
				<p>Do you really want to deactive this list?</p>
				<input type="hidden" name="deactive_list_id" id="deactive_list_id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-sm btn-danger" id="deactive-confirm-btn">Deactive</button>
			</div>
		</div>
	</div>
</div> 


<!-- Modal HTML -->
<div id="delete-confirm" class="modal fade">
	<div class="modal-dialog modal-confirm modal-sm">
		<div class="modal-content">
			<div class="modal-header">				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete this list?</p>
				<input type="hidden" name="delete_list_id" id="delete_list_id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-sm btn-danger" id="delete-confirm-btn">Delete</button>
			</div>
		</div>
	</div>
</div> 


<div class="modal fade login-popup centered-modal" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close close-login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Set Price and Publish</h4>
			</div>

			<div class="modal-body">
				<form id="set_price_form" action="" method="post" novalidate>
					<p>Price</p>
					<div class="input-group" style="width:100%;">
						<span><i class="fa fa-dollar mail-icon"></i></span>
						<input type="hidden" name="unique_id" id="price_unique_id">
						<input type="text" class="form-control" id="price" name="price" placeholder="">
					</div>
				</form>
			</div>
			<div class="modal-footer text-center">
				<button type="button" id="set_now_price" class="btn next-btn pull-right">Publish</button>
			</div>

		</div>
	</div>
</div>

<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">

	$('body').on('click' , '.set_price_publish' , function() {

		var unique_id = $(this).attr('data-id');

		$('#price_unique_id').val(unique_id);

		$('#priceModal').modal('show');

	});

	$('body').on('click' , '.deactive-btn' , function() {

		var unique_id = $(this).attr('data-id');

		$('#deactive_list_id').val(unique_id);

		$('#deactive-confirm').modal('show');

	});
	
	$('body').on('click' , '.delete-btn' , function() {

		var unique_id = $(this).attr('data-id');

		$('#delete_list_id').val(unique_id);

		$('#delete-confirm').modal('show');

	});


	$('body').on('click' , '#set_now_price' , function() {

		var values = $('#set_price_form').serialize();

		if($('#price').val() == ''){
			$.gritter.add({
				title: 'Error!',
				sticky: false,
				time: '5000',
				before_open: function () {
					if ($('.gritter-item-wrapper').length >= 3)
					{
						return false;
					}
				},
				text: "Price is required.",
				class_name: 'gritter-error'
			});
			return false;
		}

		$.ajax({
			url: '<?php echo base_url(); ?>user/set_price_publish',
			type: 'post',
			data: values,
			dataType: 'json',
			success: function (status) {

				if (status.msg == 'success') {

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

					$('#priceModal').modal('hide');

				} else if (status.msg == 'error') {
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
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


	$('body').on('click' , '#deactive-confirm-btn' , function() {

		var list_id = $('#deactive_list_id').val();

		$.ajax({
			url: '<?php echo base_url(); ?>user/deactive_list',
			type: 'post',
			data: { list_id : list_id},
			dataType: 'json',
			success: function (status) {

				if (status.msg == 'success') {

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

					$('#deactive-confirm').modal('hide');



				} else if (status.msg == 'error') {
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
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

	$('#deactive-confirm').on('hide.bs.modal', function () {
		location.reload();
	});

	$('body').on('click' , '#delete-confirm-btn' , function() {

		var list_id = $('#delete_list_id').val();

		$.ajax({
			url: '<?php echo base_url(); ?>user/delete_list',
			type: 'post',
			data: { list_id : list_id},
			dataType: 'json',
			success: function (status) {

				if (status.msg == 'success') {

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

					$('#delete-confirm').modal('hide');

				} else if (status.msg == 'error') {
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
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


	$('#delete-confirm').on('hide.bs.modal', function () {
		location.reload();
	});

</script>