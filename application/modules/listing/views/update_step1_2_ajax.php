
<div class="col-md-12">
	<h2>What amenities do you offer?</h2>

	<form id="update_step1_2_form" method="post">
		<input type="hidden" name="form_id" value="step1_2" />
		<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

		<?php foreach ($basic_amenities as $basic_amenity) { ?>

		<div class="form-check">

			<label>

				<input type="checkbox" name="amenity[]" value="<?php echo $basic_amenity['id']; ?>" <?php echo in_array( $basic_amenity["id"] , @$amenities) ? "checked" : ""; ?>> 

				<span class="label-text"> </span><span class="remb"> <?php echo $basic_amenity['name']; ?> </span>

			</label>

			<p class="check-padd" style="font-weight: normal;"> <small> <?php echo $basic_amenity['description']; ?> </small></p>
		</div>


		<?php } ?>



		<h4>Safety amenities</h4>

		<?php foreach ($safety_amenities as $safety_amenity) { ?>

		<div class="form-check">
			<label>

				<input type="checkbox" name="amenity[]" value="<?php echo $safety_amenity['id']; ?>" <?php echo in_array( $safety_amenity["id"] , @$amenities) ? "checked" : ""; ?>>

				<span class="label-text"></span>
				<span class="remb"><?php echo $safety_amenity['name']; ?></span>

			</label>

			<p class="check-padd" style="font-weight: normal;"> <small> <?php echo $safety_amenity['description']; ?> </small> </p>
		</div>

		<?php } ?>


	</form>
</div>

<div class="col-md-12">
	<hr>
	<div class="form-group">
		<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step1_2" class="btn next-btn btn-block">Save</a>
	</div>
</div>	