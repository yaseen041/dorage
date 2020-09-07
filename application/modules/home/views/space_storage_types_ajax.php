
<label>Spaces</label>
<ul class="checklist-box">
	<?php if (empty($storage_types)) { ?>
	<p class="remb_li_space">
		<span> Please select "Storage Size Type" first </span>
	</p>
	<?php } ?>
	
	<?php foreach ($storage_types as $storage_type) { ?>

	<li>
		<div class="form-check pull-left" style="margin-left: -17px;">
			<label>
				<input type="checkbox" class="storage_type" name="storage_type[]" value="<?php echo $storage_type['id']; ?>"> <span class="label-text"> </span><span class="remb_li_space"> <?php echo $storage_type['name']; ?> </span>
			</label>
		</div>
	</li>

	<?php } ?>

</ul>