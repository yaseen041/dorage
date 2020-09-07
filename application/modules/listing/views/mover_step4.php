<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">

	<section class="logistic-l4 section-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
					<h2>Reminder<br>
					
						<h5 class="step">Step 4</h5>

						<form id="mover_details" action="" method="post">
						<input type="hidden" name="form_id" value="mover_step4" />
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
						
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 padd-top">
								<div class="row">

									<div class="col-md-12 padd-top">
										<label> Confirm with clients with phone or message with their loading and unloading service time range.</label>
										
									</div>
								</div>
								<div>
									<hr>
									<div class="form-group pull-left">
										<button id="back_to_step3" type="button" class="btn back-btn">Go Back</button>
									</div>
									<div class="form-group pull-right">
										<a href="javascript:void(0)" id="submit_mover_details" class="btn next-btn">Finish & Review</a>
									</div>
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
		$("#back_to_step3").click(function() {
			$.ajax({
				url:'<?php echo base_url(); ?>listing/mover/back_to_step3',
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