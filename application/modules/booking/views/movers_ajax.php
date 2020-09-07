<?php foreach ($mover_listings as $mover_list): ?>

	<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
		<div class="row">
			<div class="col-lg-5">
				<a href="<?php echo base_url(); ?>details/mover/<?php echo $mover_list['unique_id'].'/'.dorage_url_title($mover_list['title']); ?>" class="property-image listing-property-img" target="_blank">
					<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($mover_list['id']); ?>" alt="Post list 1">
				</a>
				<!-- <a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a> -->
			</div>
			<div class="col-lg-7">

				<div class="property-content listing-content">
					<?php if($mover_list['status'] == 0): ?>
						<h5 class="label-warning text-center" style="color: white; padding: 5px 0px;"> Your storage space is under review. </h5>
					<?php endif; ?>
					<h3 class="property-title">

						<a href="<?php echo base_url(); ?>details/mover/<?php echo $mover_list['unique_id'].'/'.dorage_url_title($mover_list['title']); ?>" class="pull-left" target="_blank"><?php echo $mover_list['title']; ?></a>

					</h3>

					<div class="row">

						<?php if(get_meta_value('mover_help' , @$mover_list['id']) == 0){?>

						<div class="col-md-6 text-center">
							<img src="<?php echo base_url(); ?>assets/images/worker-loading-boxes.png"> &nbsp;Loading
						</div>


						<?php } elseif(get_meta_value('mover_help' , @$mover_list['id'])  == 1){?>

						<div class="col-md-6">
							<img src="<?php echo base_url(); ?>assets/images/moving-truck.png"> &nbsp;Moving
						</div>

						<?php } else { ?>

						<div class="col-md-6 text-center">
							<img src="<?php echo base_url(); ?>assets/images/worker-loading-boxes.png"> &nbsp;Loading
						</div>

						<div class="col-md-6">
							<img src="<?php echo base_url(); ?>assets/images/moving-truck.png"> &nbsp;Moving
						</div>

						<?php } ?>

					</div> <br>

					<div class="property-address">
						<?php echo get_meta_value('place' , @$mover_list['id']);  ?>
					</div>
					<div class="rating">
						<div class="stars">
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star"></span>
							<span class="fa fa-star"></span>
							<span>140</span>
						</div>
					</div>
					<p class="property-description">
						<?php echo $mover_list['description']; ?>
					</p>

					<?php 

					$mover_help = get_meta_value('mover_help' , @$mover_list['id']);
					$tooltip_small = '';
					$tooltip_medium = '';
					$tooltip_heavy = '';

					if($mover_help == 0) {

						$tooltip_small .= 'Loading Price: $'.get_meta_value('small_on_loading' , @$mover_list['id']).'/hours';
						$tooltip_medium .= 'Loading Price: $'.get_meta_value('medium_on_loading' , @$mover_list['id']).'/hours';
						$tooltip_heavy .= 'Loading Price: $'.get_meta_value('heavy_on_loading' , @$mover_list['id']).'/hours';

					} elseif($mover_help == 1) {

						$tooltip_small .= 'Moving Price: $'.get_meta_value('small_on_moving' , @$mover_list['id']).'/mile';
						$tooltip_medium .= 'Moving Price: $'.get_meta_value('medium_on_moving' , @$mover_list['id']).'/mile';
						$tooltip_heavy .= 'Moving Price: $'.get_meta_value('heavy_on_moving' , @$mover_list['id']).'/mile'; ?>


						<?php } else {


							$tooltip_small .= 'Loading Price: $'.get_meta_value('small_on_loading' , @$mover_list['id']).'/hours';
							$tooltip_medium .= 'Loading Price: $'.get_meta_value('medium_on_loading' , @$mover_list['id']).'/hours';
							$tooltip_heavy .= 'Loading Price: $'.get_meta_value('heavy_on_loading' , @$mover_list['id']).'/hours';


							$tooltip_small .= '&nbsp;Moving Price: $'.get_meta_value('small_on_moving' , @$mover_list['id']).'/mile';
							$tooltip_medium .= '&nbsp;Moving Price: $'.get_meta_value('medium_on_moving' , @$mover_list['id']).'/mile';
							$tooltip_heavy .= '&nbsp;Moving Price: $'.get_meta_value('heavy_on_moving' , @$mover_list['id']).'/mile'; ?>

							<?php } ?>

							<div class="col-lg-12">
								<div class="form-check">
									<label>
										<input name="choose_package" type="radio" value="<?php echo @$mover_list['id']."_".$mover_help; ?>_1" class="choose_package"> <span class="label-text" style="margin-left: -17px;">Small Load (<?php echo $tooltip_small; ?>) </span>
									</label>
								</div>

								<div class="form-check">
									<label>
										<input name="choose_package" type="radio" value="<?php echo @$mover_list['id']."_".$mover_help; ?>_2" class="choose_package"> <span class="label-text" style="margin-left: -17px;">Medium Load (<?php echo $tooltip_medium; ?>) </span>
									</label>
								</div>

								<div class="form-check">
									<label>
										<input name="choose_package" type="radio" value="<?php echo @$mover_list['id']."_".$mover_help; ?>_3" class="choose_package"> <span class="label-text" style="margin-left: -17px;">Heavy Load (<?php echo $tooltip_heavy; ?>) </span>
									</label>
								</div>

								<?php if($mover_help == 1 || $mover_help == 2 ) { ?>

								<div class="form-check">
									<label>
										<span> Estimated Miles </span>
									</label>

									<input name="estimated_miles" type="text" id="estimated_miles" class="form-control">

								</div>

								<?php } ?>


								<div class="form-check">

									<button type="button" style="margin-top: 15px;" class="btn btn-info btn-sm apply_mover_details pull-right"> Apply </button>

								</div>


							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	<?php endforeach; ?>