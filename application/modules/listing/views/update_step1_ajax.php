

<h2>Hi, <?php echo get_session('username')." !"; ?> Let’s get started listing your space.</h2>
<p class="dark-sky">STEP 1</p>
<h3>What kind of space do you have?</h3>

<form id="update_step1_form" method="post">
	<div class="row">
		<input type="hidden" name="form_id" value="step1" />
		<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<select class="form-control" name="posted_data[storage_size_type]" id="storage_size_type">
					<option value="">Storage size type</option>
					<?php foreach ($sizeTypes as $sizeType) { ?>
					<option value="<?php echo $sizeType['id']; ?>" <?php echo get_meta_value('storage_size_type' , @$stp_detail['id']) == $sizeType["id"] ? "selected" : ""; ?>> <?php echo $sizeType['name']; ?> </option>
					<?php } ?>
				</select> 
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group" id="storage_type_option">
				<?php if (!empty($storage_types)) { ?>
				<select name="posted_data[space_storage_type]" id="space_storage_type" class="form-control">
					<option value="">Now choose a space storage type</option>
					<?php foreach ($storage_types as $option) { ?>
					<option value="<?php echo $option['id']; ?>" <?php echo  get_meta_value('space_storage_type' , @$stp_detail['id']) == $option["id"] ? "selected" : ""; ?>> <?php echo $option['name']; ?> </option>
					<?php } ?>
				</select>
				<?php } else { ?> 
				<select class="form-control" name="posted_data[storage_type]" required>
					<option value="">Space storage type</option>
				</select>
				<?php } ?>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<input type="text" class="form-control" name="place" id="location" placeholder="Lahore" value="<?php echo @$stp_detail['place']; ?>">
				<input type="hidden" name="lat_long" id="lat_long" value="<?php echo @$stp_detail['latitude'].",".@$stp_detail['longitude']; ?>">
				
				<input type="hidden" id="lati" value="<?php echo @$stp_detail['latitude']; ?>">
				
				<input type="hidden" id="longi" value="<?php echo @$stp_detail['longitude']; ?>">
			</div>
		</div>

		<div class="col-md-12">
			<div id="map_canvas" style="height: 400px; width: 100%; margin-bottom: 15px;">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step1" class="btn next-btn btn-block">Save</a>
			</div>
		</div>

	</div>
</form>


<script type="text/javascript">
	initializeMapLoc();
</script>

<script type="text/javascript">
	$("#storage_size_type").change(function() {
		var storage_id = $(this).val();
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/get_storage_types',
			type:'post',
			data:{ storage_id : storage_id },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$("#storage_type_option").html(status.response);
				}
			}
		});
	});
</script>