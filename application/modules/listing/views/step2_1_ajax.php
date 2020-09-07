
<!-- Become Space Provider -->
<section class="section-bg">
	<div class="container">
		<div class="row">


			<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
				<div class="col-md-12">
					<form id="list_details" action="" method="">

						<input type="hidden" name="form_id" value="step2_1">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
						<h2>Name your space</h2>

						<div class="form-group">
							<input type="text" class="form-control" name="storage_title" placeholder="Storage space title" value="<?php echo @$stp_detail['title']; ?>">
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" rows="5" placeholder="Describe your storage space..."><?php echo @$stp_detail['description']; ?></textarea>
						</div>
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

<!-- Become Space Provider End-->

<script type="text/javascript">
	$("#back_to_step2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step2',
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