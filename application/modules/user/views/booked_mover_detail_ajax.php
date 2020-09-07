<div class="property-item booking-item property-archive">
	<div class="row">
		<div class="col-lg-6">
			<a href="javascript:void(0)" class="property-image listing-property-img">
				<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($mover_detail['mover_id']); ?>" alt="Image not found">
			</a>
		</div>
		<div class="col-lg-6">
			<div class="property-content listing-content">
				<h3 class="property-title"> <?php echo $mover_detail['title']; ?> </h3>
				<div class="property-address">
					<?php echo $mover_detail['place']; ?>
				</div>

				<p>
					<h5>Service Date</h5>
					<span class="label label-success"><?php echo formatted_date($mover_detail['booking_start']); ?></span> 
				</p>
				<p>
					<h5>No. of crews <span class="label label-info"><?php echo $mover_detail['no_crews']; ?></span></h5>
				</p>
				<p>
					<h5>Crew charges/hour <span class="label label-info">$<?php echo $mover_detail['crew_charges']; ?></span> </h5>
				</p>
				<p>
					<h5>No. of hours <span class="label label-info"><?php echo $mover_detail['no_hours']; ?></span> </h5>
				</p>
				<p>
					<h5>Total Amount <span class="label label-info">$<?php echo $mover_detail['mover_price']+$mover_detail['refundable_mover']; ?></span> </h5>
				</p>

				<div>
					<h4> Ower Information </h4>
					<?php $owner = get_owner_detail($mover_detail['owner_id']); ?>
					<p>Name: <span><?php echo $owner['first_name']." ".$owner['last_name']; ?> </span></p>
					<p>Phone: <span><?php echo $owner['phone']; ?> </span></p>
					<p>Email: <span><?php echo $owner['email']; ?></span></p>

				</div>

			</div>

			
		</div>
	</div>
</div>