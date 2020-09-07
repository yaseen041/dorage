<h2>What type of space and size your listing has?</h2>

<form id="update_step1_1_form" method="post">
	<div class="row">
		<input type="hidden" name="form_id" value="step1_1" />
		<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
		<div class="col-md-12">
			<div class="form-group">
				<label>Room space character</label>
				<br />
				<select style="width:100%;" class="form-control js-example-basic-multiple" name="room_space_character[]" multiple="multiple">
					<?php foreach ($space_characteristics as $space_character) { ?>
					<option value="<?php echo $space_character['id']; ?>" <?php if(in_array($space_character['id'], $selected_character)){?> selected="selected" <?php } ?>><?php echo $space_character['name']; ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label>Space height</label>
				<input type="text" class="form-control" name="posted_data[space_height]" placeholder="Please enter your space height such as XX feet" value="<?php echo get_meta_value('space_height' , @$stp_detail['id']); ?>">
			</div>

			<div class="form-group">
				<label>Space width</label>
				<input type="text" class="form-control" name="posted_data[space_width]" placeholder="Please enter your space width such as XX feet" value="<?php echo get_meta_value('space_width' , @$stp_detail['id']); ?>">
			</div>	

			<div class="form-group">
				<label>Space length</label>
				<input type="text" class="form-control" name="posted_data[space_length]" placeholder="Please enter your space length such as XX feet" value="<?php echo get_meta_value('space_length' , @$stp_detail['id']); ?>">
			</div>			

		</div>


		<div class="col-md-12 radio-btn">
			<p>Cancellation Policy</p>
			<?php foreach ($cancellation_policies as $policy) {?>

			<div class="form-check">
				<label>
					<input type="radio" name="posted_data[cancellation_policy]" value="<?php echo $policy["id"]; ?>" <?php echo get_meta_value('cancellation_policy' , @$stp_detail['id']) == $policy["id"] ? "checked" : ""; ?>> <span class="label-text"><?php echo $policy['name']; ?> hours</span>
				</label>
			</div>

			<?php } ?>
		</div>		

		<div class="col-md-12">
			<p class="thyg-p"><span class="dark-sky">Note: </span><?php echo $policy_note['meta_value']; ?></p>
		</div>		

		<div class="col-md-12">
			<hr>

			<div class="form-group">
				<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step1_1" class="btn next-btn btn-block">Save</a>
			</div>
		</div>

	</div>
</form>
<script type="text/javascript">
	$('.js-example-basic-multiple').select2();
</script>