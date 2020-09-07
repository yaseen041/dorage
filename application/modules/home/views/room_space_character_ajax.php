

<label>SPECIAL NEEDS</label>

<ul class="checklist-box">

	<?php foreach ($space_characters as $space_char) { ?>
	<li>
		<div class="form-check pull-left" style="margin-left: -17px;">
			<label>
				<input type="checkbox" class="space_character" name="space_character[]" value="<?php echo $space_char['id']; ?>"> <span class="label-text"> </span><span class="remb_li_space"><?php echo $space_char['name']; ?></span>

			</label>
		</div>
	</li>

	<?php } ?>
</ul>