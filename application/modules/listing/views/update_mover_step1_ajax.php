

<h2>Let’s started mover listing

</h2>

<h5 class="step">Step 1

</h5>

<br>

<form id="update_step1_form" method="post">

	<input type="hidden" name="form_id" value="mover_step1" />

	<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="form-group">

				<div class="form-group">

					<label>Title

					</label>

					<input type="text" class="form-control" name="mover_title" placeholder="" value="<?php echo @$stp_detail['title']; ?>">

				</div>

				<div class="form-group">

					<label>Description

					</label>

					<textarea class="form-control" name="mover_description" placeholder=""><?php echo @$stp_detail['description']; ?></textarea>

				</div>

				<div class="alert alert-info">
					<strong>Info!</strong> <br /> 
					Maximum file size: <b> 5MB </b>. <br />
					Maximum Dimension (W X H):<b> 2050 X 1050 . ( Best dimension 750 x 431 ) </b><br />
					Allowed image types: <b>'jpg | jpeg | png | gif'</b>.
				</div>

				<div class="form-group padd-top text-center">
					<label class="btn-bs-file btn btn btn-block btn-primary" style="color:#fff;">

						<i class="fa fa-upload">

						</i>

						Upload Banner image

						<input type="file" name="mover_image" id="mover_image" accept="image/*" />
					</label>
				</div>

				<div class="form-group text-center">
					<img id="blah" class="img-responsive" src="<?php echo base_url(); ?>assets/storage_images/<?php echo @get_mover_list_banner($stp_detail['id']); ?>" alt="" style="width: 550px;" />
				</div>

				<label>
					How many crews you have?
				</label>

				<div class="form-group">

					<select class="form-control" name="posted_data[how_many_crews]">

						<option value="1" 

						<?php echo get_meta_value('how_many_crews' , @$stp_detail['id']) == '1' ? "selected" : ""; ?>>1

					</option>

					<option value="2" 

					<?php echo get_meta_value('how_many_crews' , @$stp_detail['id']) == '2' ? "selected" : ""; ?>>2

				</option>

				<option value="3" 

				<?php echo get_meta_value('how_many_crews' , @$stp_detail['id']) == '3' ? "selected" : ""; ?>>3

			</option>

			<option value="4" 

			<?php echo get_meta_value('how_many_crews' , @$stp_detail['id']) == '4' ? "selected" : ""; ?>>4

		</option>

		<option value="5+" 

		<?php echo get_meta_value('how_many_crews' , @$stp_detail['id']) == '5+' ? "selected" : ""; ?>>5+

	</option>

</select>

</div>
<label>State</label>
<div class="form-group">

	<select class="form-control" name="posted_data[state]" id="state">
		<option value="">Select State</option>
		<?php foreach (get_states() as $state) { ?>
		<option value="<?php echo $state['id']; ?>" <?php echo get_meta_value('state' , @$stp_detail['id']) == $state["id"] ? "selected" : ""; ?>> 
			<?php echo $state['name']; ?>
		</option>
		<?php } ?>
	</select>

</div>
<label>Zip Code</label>
<div class="form-group">

	<input type="text" class="form-control"  name="place" id="location" placeholder="Enter zip code" value="<?php echo @$stp_detail['place']; ?>">

	<input type="hidden" name="lat_long" id="lat_long" value="<?php echo @$stp_detail['latitude'].",".@$stp_detail['longitude']; ?>">

	<input type="hidden" id="lati" value="<?php echo @$stp_detail['latitude']; ?>">

	<input type="hidden" id="longi" value="<?php echo @$stp_detail['longitude']; ?>">

</div>

<div>
	<div id="map_canvas" style="height: 400px; width: 100%; margin-bottom: 15px;">
	</div>
</div>

<label>Within miles</label>
<div class="form-group">
	<div class="form-group">
		<select class="form-control" name="posted_data[within_miles]">
			<option value="5" <?php echo get_meta_value('within_miles' , @$stp_detail['id']) == '5' ? "selected" : ""; ?>>5</option>
			<option value="10" <?php echo get_meta_value('within_miles' , @$stp_detail['id']) == '10' ? "selected" : ""; ?>>10</option>
			<option value="25" <?php echo get_meta_value('within_miles' , @$stp_detail['id']) == '25' ? "selected" : ""; ?>>25</option>
			<option value="50" <?php echo get_meta_value('within_miles' , @$stp_detail['id'])== '50' ? "selected" : ""; ?>>50</option>
			<option value="100" <?php echo get_meta_value('within_miles' , @$stp_detail['id'])== '100' ? "selected" : ""; ?>>100+</option>
		</select>
	</div>
</div>



</div>

<hr>

<div class="form-group">

	<a href="javascript:void(0)" id="save_edit_mover_form_data" data-id="update_step1" class="btn next-btn btn-block">Save</a>

</div>

</div>

</div>

</form>

<script type="text/javascript">
	initializeMapLoc();
</script>

<script type="text/javascript">
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#mover_image").change(function(){
		readURL(this);
	});

</script>