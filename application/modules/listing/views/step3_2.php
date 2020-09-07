<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">

	<section class="house-rule section-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
					<div class="col-md-12">
						<h2>Successful booking starts with an accurate calendar</h2>

						<p>Customers will book available days instantly. Only get booked when your space is available by keeping your calendar and availability settings up-to-date.</p>

						<p class="padd-top">Canceling disrupts booking. If you cancel because your calendar is inaccurate, you’ll be charged a penalty fee and the dates won’t be available for anyone else to book.</p>

						<form id="list_details" action="" method="">

						<input type="hidden" name="form_id" value="step3_2">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>">

						<div class="form-check pull-left" style="margin-left: -17px;">
							<label>
								<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Got it! I’ll keep my calendar up to date.</span>
							</label>
						</div>

						</form>

					</div>

					<div class="col-md-12">
						<hr>
						<div class="form-group pull-left">
							<button id="back_to_step3_1" type="button" class="btn back-btn">Go Back</button>
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
	$("#back_to_step3_1").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step3_1',
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