
<!-- Become Space Provider -->

<section class="price-range section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-6 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-3">
				<form id="list_details" action="" method="">

					<div class="col-md-12">

						<h2>Pricing</h2>
						<input type="hidden" name="form_id" value="step3_5">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>">
						<h4><?php echo get_section_content('pricing' , 'pricing_heading'); ?></h4>
						<p class="gray-color"><?php echo get_section_content('pricing' , 'pricing_statement'); ?></p>

						<div class="input-group" style="width:100%;">
							<label>Minimum</label>
							<span class="dollar">$</span>
							<input type="number" class="form-control" name="posted_data[price_min_day]" placeholder="Per day" value="<?php echo get_meta_value('price_min_day' , @$stp_detail['id']); ?>" min="1">
						</div><br>

						<div class="input-group" style="width:100%;">
							<label>Maximum</label>
							<span class="dollar">$</span>
							<input type="number" class="form-control" name="posted_data[price_max_day]" placeholder="Per day" value="<?php echo get_meta_value('price_max_day' , @$stp_detail['id']); ?>" min="1">
						</div>

					</div>

					<div class="col-md-12">
						<hr>
						<div class="form-group pull-left">
							<button id="back_to_step3_4" type="button" class="btn back-btn">Go Back</button>
						</div>
						<div class="form-group pull-right">
							<a href="javascript:void(0)" id="submit_list_details" class="btn next-btn">Next Step</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</section>

<!-- Become Space Provider End-->

<script type="text/javascript">
	$("#back_to_step3_4").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step3_4',
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