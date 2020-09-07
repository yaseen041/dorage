<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">
	<section class="location_map section-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
					<div class="col-md-12">
						<h2>What amenities do you offer?</h2>


						<form id="list_details" action="" method="">

							<input type="hidden" name="form_id" value="step1_2">
							<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

							<?php foreach ($basic_amenities as $basic_amenity) { ?>

							<div class="form-check">

								<label>
									
									<input type="checkbox" name="amenity[]" value="<?php echo $basic_amenity['id']; ?>" <?php echo in_array( $basic_amenity["id"] , @$amenities) ? "checked" : ""; ?>> 

									<span class="label-text"> </span><span class="remb"> <?php echo $basic_amenity['name']; ?> </span>

								</label>
								
								<p class="check-padd"><?php echo $basic_amenity['description']; ?></p>
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
								
								<p class="check-padd"><?php echo $safety_amenity['description']; ?></p>
							</div>

							<?php } ?>


						</form>
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
			</div>
		</div>		
	</section>
</div>
<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
	$("#back_to_step2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step1_1',
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