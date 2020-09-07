<section class="become-space section-bg house-rule">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
				<h2>How much you charge per crew, per car for per hour?</h2>
				<h5 class="step">Step 2
				</h5>
				<form id="mover_details" action="" method="post">
					<input type="hidden" name="form_id" value="mover_step2" />
					<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12 padd-top">

							<div class="form-group">

								<div class="form-group">

									<label> Crew charges per hour? </label>

									<input type="text" class="form-control" name="posted_data[crew_charges]" placeholder="Enter Crew charges per hour" value="<?php echo get_meta_value('crew_charges' , @$stp_detail['id']); ?>">

								</div>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 padd-top">
							<hr>
							<div>

								<div class="form-group pull-left">
									<button id="back_to_step1" type="button" class="btn back-btn">Go Back
									</button>
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
	$("#back_to_step1").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/mover/back_to_step1',
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