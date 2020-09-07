<select name="posted_data[space_storage_type]" id="space_storage_type" class="form-control">
	<option value="">Now choose a space storage type</option>
	<?php foreach ($storage_types as $option) { ?>
	<option value="<?php echo $option['id']; ?>"> <?php echo $option['name']; ?> </option>
	<?php } ?>
</select>