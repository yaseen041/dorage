<h2>Where’s your space located?</h2>

<form id="update_step1_3_form" method="post">
	<div class="row">
		<input type="hidden" name="form_id" value="step1_3" />
		<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label>Country / Region</label>
				<input type="text" class="form-control" id="country" name="posted_data[country]" placeholder="United States" value="<?php echo get_meta_value('country' , @$stp_detail['id']); ?>">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>Street Address</label>
				<input type="text" class="form-control" id="street_address" name="posted_data[street_address]" placeholder="339 Lenape Way" value="<?php echo get_meta_value('street_address' , @$stp_detail['id']); ?>">
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>City</label>
				<input type="text" class="form-control" id="city" name="posted_data[city]" placeholder="Claymont" value="<?php echo get_meta_value('city' , @$stp_detail['id']); ?>">
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>State</label>
				<select class="form-control" name="posted_data[state]" id="state">
					<option value="">Select State</option>
					<?php foreach (get_states() as $state) { ?>
					<option value="<?php echo $state['id']; ?>" <?php echo get_meta_value('state' , @$stp_detail['id']) == $state["id"] ? "selected" : ""; ?>> <?php echo $state['name']; ?> </option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label>ZIP Code</label>
				<input type="text" class="form-control" name="posted_data[zip_code]" placeholder="Zip Code" value="<?php echo get_meta_value('zip_code' , @$stp_detail['id']); ?>">
			</div>
		</div>
		

		<div class="col-md-12">
			<hr>

			<div class="form-group">
				<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step1_3" class="btn next-btn btn-block">Save</a>
			</div>
		</div>

	</div>
</form>

<script type="text/javascript">
	$.ajax({ url:'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBHtMus_lrs1jrXwK9QkltUaAP5rr3UoX0&latlng=+<?php echo @$stp_detail['latitude'].",".@$stp_detail['longitude']; ?>+&sensor=true',
		success: function(data){

			if($("#street_address").val() == ''){
				$("#street_address").val(data.results[0].address_components[0].long_name+" "+data.results[0].address_components[1].long_name);
			}
			
			if($("#city").val() == ''){
				$("#city").val(data.results[0].address_components[2].long_name);
			}

			if($("#state").val() == ''){

				if ( $("#state option[text='" + data.results[0].address_components[3].long_name + "']") ){

					$("#state option[text='" + data.results[0].address_components[3].long_name +"']").attr("selected","selected");
				}
			} 

			if($("#country").val() == ''){
				$("#country").val(data.results[0].address_components[5].long_name);
			}
			if($("#zip_code").val() == ''){
				$("#zip_code").val(data.results[0].address_components[6].long_name);
			}
			/*or you could iterate the components for only the city and state*/
		} 
	});

</script>