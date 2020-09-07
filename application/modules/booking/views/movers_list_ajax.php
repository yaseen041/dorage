<?php foreach ($movers as $mover_list): ?>

	<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
		<div class="row">
			<div class="col-lg-5">
				<a href="<?php echo base_url(); ?>details/mover/<?php echo $mover_list['unique_id'].'/'.dorage_url_title($mover_list['title']); ?>" class="property-image listing-property-img" target="_blank">
					<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_mover_banner($mover_list['id']); ?>" alt="Post list 1">
				</a>
				<!-- <a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a> -->
			</div>
			<div class="col-lg-7">
				<div class="property-content listing-content">
					<h3 class="property-title">

						<a href="<?php echo base_url(); ?>details/mover/<?php echo $mover_list['unique_id'].'/'.dorage_url_title($mover_list['title']); ?>" class="pull-left" target="_blank"><?php echo $mover_list['title']; ?></a>

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
						<?php echo $mover_list['place']; ?>
					</div>
					<div class="rating">
						<?php 
						$listingReviews = getapprovedListingRating($mover_list['id'], 'mover'); ?>
						<div class="stars no-padding">
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
					<?php $charge = (empty(get_meta_value('crew_charges', $mover_list['id'])))?0:get_meta_value('crew_charges', $mover_list['id']); ?>
					<p>
						<strong>Charge Per Helper:</strong> $<?php echo $charge; ?>
						<br>
						<strong>Total Charges: </strong> $<?php echo $charge*$number_of_people*($number_of_hours+1); ?> 
					</p>

					<?php $vehicles = getMoverVehicle($mover_list['id']); ?>
					<div class="col-lg-12">
						<?php if($mover_list['users_id'] != get_session('user_id')): ?>
							<div class="form-check">
								<button type="button" style="margin-top: 15px;" class="btn btn-sm apply_mover_details pull-right" data-mover-id="<?php echo $mover_list['id']; ?>"> Select </button>
							</div>
						<?php else: ?>
							<p class="label label-danger pull-right"> You can't create booking against your own listing.</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endforeach; ?>
<?php if (empty($movers)) {
	echo "<hr> <p style='color:red;'>No movers found!</p>";
} ?>
<script type="text/javascript">
	$('.listingRating').each(function(index, el) {
		var $El = $(el);
		$El.barrating({
			theme: 'fontawesome-stars-o',
			readonly: true,
			initialRating: $El.attr('data-current-rating') 
		});
	});
</script>