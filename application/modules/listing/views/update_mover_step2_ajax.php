

<h2>How much you charge per crew, per car for per hour?</h2>
<h5 class="step">Step 2
</h5>
<form id="update_step2_form" method="post">
	<input type="hidden" name="form_id" value="mover_step2" />
	<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12 padd-top">

			<div class="form-group">

				<div class="form-group">

					<label> Crew charges per hour? </label>

					<input type="text" class="form-control" name="posted_data[crew_charges]" placeholder="Enter Crew charges per hour" value="<?php echo get_meta_value('crew_charges' , @$stp_detail['id']); ?>">

				</div>
			</div>
		</div>

		<div class="col-md-12">
			<hr>

			<div class="form-group">
				<a href="javascript:void(0)" id="save_edit_mover_form_data" data-id="update_step2" class="btn next-btn btn-block">Save</a>
			</div>
		</div>
	</div>
</form>