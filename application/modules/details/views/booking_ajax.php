<form method="post" id="book_now_form">
	<div class="form-group">
		
		<input type="hidden" name="listings_id" value="<?php echo $listings_id; ?>">
		
		<input type="hidden" name="booking_startdate" value="<?php echo $start_date; ?>">
		
		<input type="hidden" name="booking_enddate" value="<?php echo $end_date; ?>">

		
		<?php $tax_amount = 0;
		$tax_amount = calculate_tax(get_meta_value('state' , $listings_id)) / 100 * $booking_days * $list_detail['price']; ?>

		<input type="hidden" name="tax_amount" value="<?php echo $tax_amount; ?>">

		<input type="hidden" name="perday_amount" value="<?php echo $list_detail['price']; ?>">
		
		<input type="hidden" name="total_amount" value="<?php echo $booking_days * $list_detail['price'] + $tax_amount; ?>">

		<p class="form-control-static"> Booking Dates <span class="value label label-success"><?php echo $start_date; ?> to <?php echo $end_date; ?></span></p>

		<p class="form-control-static"> Days <span class="value"><?php echo $booking_days; ?></span></p>

		<p class="form-control-static"> Price/day <span class="value">$<?php echo $list_detail['price']; ?></span></p>

		<p class="form-control-static">Sales Tax 
			<span class="value">$<?php echo $tax_amount;?>
			</span>
		</p>

		<p class="form-control-static">Total price<span class="value">$<?php echo $booking_days * $list_detail['price'] + $tax_amount; ?></span></p>
	</div>
	<div class="form-group">
		<button type="button" id="book_now_btn" data-loading-text="Please wait..." class="btn btn-primary">Proceed to booking</button>
	</div>
</form>