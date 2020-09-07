<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">
	<section class="room section-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<h2>What type of space and size your listing has?</h2>

					<form id="list_details" action="" method="post">
						<div class="row">
							<input type="hidden" name="form_id" value="step1_1">
							<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

							<div class="col-md-12">
								<div class="form-group">
									<label>Room space character</label>
									<select class="form-control js-example-basic-multiple" name="room_space_character[]" multiple="multiple">
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
								<div class="form-group pull-left">
									<button id="back_to_step1" type="button" class="btn back-btn">Go Back</button>
								</div>
								<div class="form-group pull-right">
									<button id="submit_list_details" type="button" class="btn next-btn">Next Step</button>
								</div>
							</div>

						</div>
					</form>

				</div>
			</div>
		</div>		
	</section>
</div>
<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>


<script type="text/javascript">
	$("#back_to_step1").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step1',
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