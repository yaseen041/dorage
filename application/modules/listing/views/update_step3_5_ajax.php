<div class="col-md-12">

	<h2>Pricing</h2>

	<?php if(empty(@$stp_detail['price'])): ?>

		<h4><?php echo get_section_content('pricing' , 'pricing_heading'); ?></h4>
		<p class="gray-color"><?php echo get_section_content('pricing' , 'pricing_statement'); ?></p>

		<form id="update_step3_5_form" method="post">
			<input type="hidden" name="form_id" value="step3_5">
			<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

			<div class="input-group" style="width:100%;">
				<label>Minimum</label>
				<span class="dollar">$</span>
				<input type="number" class="form-control" name="posted_data[price_min_day]" placeholder="Per day" value="<?php echo get_meta_value('price_min_day' , @$stp_detail['id']); ?>" min="1">
			</div><br>

			<div class="input-group" style="width:100%;">
				<label>Maximum</label>
				<span class="dollar">$</span>
				<input type="number" class="form-control" name="posted_data[price_max_day]" placeholder="Per day" value="<?php echo get_meta_value('price_max_day' , @$stp_detail['id']); ?>" min="1">
			</div>

		</form>

	<?php else: ?>

		<h4><?php echo get_section_content('pricing' , 'update_pricing_heading'); ?></h4>
		<p class="alert alert-warning">
			<?php echo get_section_content('pricing' , 'update_pricing_statement'); ?>
		</p>

		<p class="gray-color">Current price/day : $<?php echo @$stp_detail['price']; ?> </p>

		<form id="update_orignal_price_form" method="post">

			<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
			<div class="input-group" style="width:100%;">
				<label>New Price/day</label>
				<span class="dollar">$</span>
				<input type="number" class="form-control" name="new_price" placeholder="Per day" value="<?php echo @$stp_detail['new_price']; ?>" min="1">
			</div><br>

		</form>


	<?php endif; ?>

</div>

<div class="col-md-12">
	<hr>

	<?php if(empty(@$stp_detail['price'])): ?>

		<div class="form-group">
			<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step3_5" class="btn next-btn btn-block">Save</a>
		</div>

	<?php else: ?>

		<div class="form-group">
			<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_orignal_price" class="btn next-btn btn-block">Save</a>
		</div>

	<?php endif; ?>

</div>