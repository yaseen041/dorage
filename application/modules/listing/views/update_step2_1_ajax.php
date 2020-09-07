
<form id="update_step2_1_form" action="" method="">

	<input type="hidden" name="form_id" value="step2_1">
	<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
	<h2>Name your space</h2>

	<div class="form-group">
		<input type="text" class="form-control" name="storage_title" placeholder="Storage space title" value="<?php echo @$stp_detail['title']; ?>">
	</div>

	<div class="form-group">
		<label>Description</label>
		<textarea class="form-control" name="description" rows="5" placeholder="Describe your storage space..."><?php echo @$stp_detail['description']; ?></textarea>
	</div>

	<div>
		<hr>

		<div class="form-group">
			<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step2_1" class="btn next-btn btn-block">Save</a>
		</div>
	</div>

</form>