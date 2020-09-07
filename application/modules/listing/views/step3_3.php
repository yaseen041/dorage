<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">

	<section class="section-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-3">

					
					<h2>How long customer can book?</h2>
					
					<form id="list_details" action="" method="">

						<input type="hidden" name="form_id" value="step3_3">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label>Day Min</label>
									<div class="input-group number-spinner">
										<span class="input-group-btn">
											<button type="button" class="btn number-btn-left" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
										</span>
										<input type="text" name="posted_data[booking_min_day]" value="<?php echo get_meta_value('booking_min_day' , @$stp_detail['id']); ?>" class="form-control text-center" value="">
										<span class="input-group-btn">
											<button type="button" class="btn number-btn-right" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
										</span>
									</div>
								</div>

								<div class="form-group">
									<label>Day Max</label>
									<div class="input-group number-spinner">
										<span class="input-group-btn">
											<button type="button" class="btn number-btn-left" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
										</span>
										<input type="text" name="posted_data[booking_max_day]" class="form-control text-center" value="<?php echo get_meta_value('booking_max_day' , @$stp_detail['id']); ?>">
										<span class="input-group-btn">
											<button type="button" class="btn number-btn-right" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
										</span>
									</div>
								</div>
							</div>

							<div class="col-md-12">	
								<p class="padd-top"><span class="dark-sky"><b>Tip:</b></span> Your maximum booking length setting is set to 1 day. To book stays one week and longer, change this to 7 days or more.</p>
								
							</div>

							<div class="col-md-12">
								<hr>
								<div class="form-group pull-left">
									<button id="back_to_step3_2" type="button" class="btn back-btn">Go Back</button>
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


</div>
<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
	$("#back_to_step3_2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step3_2',
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