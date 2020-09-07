
<!-- Become Space Provider -->
<section class="room section-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">

				<h2>Where’s your space located?</h2>

				<form id="list_details" action="" method="">

					<input type="hidden" name="form_id" value="step1_3">
					<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
					<div class="row">
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
							<div class="form-group pull-left">
								<button id="back_to_step2" type="button" class="btn back-btn">Go Back</button>
							</div>
							<div class="form-group pull-right">
								<a href="javascript:void(0)" id="submit_list_details" class="btn next-btn">Next Step</a>
							</div>
						</div>

					</div>
				</form>

			</div>
		</div>
	</div>		
</section>
<!-- Become Space Provider End-->

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


	
	$("#back_to_step2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step1_2',
			type:'post',
			data:{ unique_id : '<?php echo @$unique_id; ?>' },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					
					$("#ajax_wrapper").fadeOut(function(){$("#ajax_wrapper").html(status.response).fadeIn();}); 
					
					var stateObj = {};
					history.pushState(stateObj, "page 2", status.new_url);
				}
			}
		});
	});
</script>