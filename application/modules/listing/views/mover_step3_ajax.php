<section class="section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
				<h2>What’s your Paypal information?</h2>	
				<h5 class="step">Step 3</h5>
				<form id="mover_details" action="" method="post">
					<input type="hidden" name="form_id" value="mover_step3" />
					<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 padd-top">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12 col-sm-6 col-xs-12">
											<label>Paypal information for receiving payment from us</label>
											<div class="form-group">

												<input type="text" class="form-control"  name="paypal_email" placeholder="Enter paypal email" value="<?php echo get_paypal_email(); ?>">

											</div>
										</div>

									</div>
								</div>


							</div>
							<div>
								<hr>
								<div class="form-group pull-left">
									
									<button id="back_to_step2" type="button" class="btn back-btn">Go Back</button>

								</div>
								<div class="form-group pull-right">
									<a href="javascript:void(0)" id="submit_mover_details" class="btn next-btn">Next Step
									</a>
								</div>
							</div>
						</div>

					</div>

				</form>
			</div>

		</div>
	</div>		
</section>

<script type="text/javascript">
	$("#back_to_step2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/mover/back_to_step2',
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