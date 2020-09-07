<h2>Where’s your space located?</h2>

<form id="update_step3_3_form" method="post">
	<div class="row">

		<input type="hidden" name="form_id" value="step3_3">
		<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label>Day Min</label>
				<div class="input-group number-spinner">
					<span class="input-group-btn">
						<button type="button" class="btn number-btn-left" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
					</span>
					<input type="text" name="posted_data[booking_min_day]" value="<?php echo get_meta_value('booking_min_day' , @$stp_detail['id']); ?>" class="form-control text-center">
					<span class="input-group-btn">
						<button type="button" class="btn number-btn-right" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
					</span>
				</div>
			</div>

			<div class="form-group">
				<label>Day Max</label>
				<div class="input-group number-spinner">
					<span class="input-group-btn">
						<button type="button" class="btn number-btn-left" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
					</span>
				
					<input type="text" name="posted_data[booking_max_day]" class="form-control text-center" value="<?php echo get_meta_value('booking_max_day' , @$stp_detail['id']); ?>">
					<span class="input-group-btn">
						<button type="button" class="btn number-btn-right" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
					</span>
				</div>
			</div>
		</div>

		<div class="col-md-12">	
			<p class="padd-top"><span class="dark-sky"><b>Tip:</b></span> Your maximum booking length setting is set to 1 day. To book stays one week and longer, change this to 7 days or more.</p>

		</div>
		<div class="col-md-12">
			<hr>

			<div class="form-group">
				<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step3_3" class="btn next-btn btn-block">Save</a>
			</div>
		</div>

	</div>
</form>

