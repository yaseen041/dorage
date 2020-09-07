
<!-- Become Space Provider -->

<section class="guest-req section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
				<div class="col-md-12">
					<h2 class="padd-top">Review Dorage’s customer requirements</h2>
					<h4>All Dorage guests must provide:</h4>	
					<ul class="list-unstyled">
						
						<?php foreach ($basic_requirments as $ba_requirment) { ?>
						<li><img width="20" src="<?php echo base_url(); ?>assets/images/true.png"> &nbsp; <?php echo $ba_requirment['name']; ?></li>
						<?php } ?>

						<hr>

						<h4 class="padd-top">Before booking your home, each customer must:</h4>	

						<?php foreach ($before_requirments as $bef_requirment) { ?>
						<li><img width="20" src="<?php echo base_url(); ?>assets/images/true.png"> &nbsp; <?php echo $bef_requirment['name']; ?>
						</li>
						<?php } ?>

						
					</div>

					<div class="col-md-12">
						<hr>
						<div class="form-group pull-left">
							<button id="back_to_step2" type="button" class="btn back-btn">Go Back</button>
						</div>
						<div class="form-group pull-right">
							<a href="javascript:void(0)" id="goto_step3_1" class="btn next-btn">Next Step</a>
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
				url:'<?php echo base_url(); ?>listing/storage/back_to_step2_complete',
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

		$("#goto_step3_1").click(function() {
			$.ajax({
				url:'<?php echo base_url(); ?>listing/storage/goto_step3_1',
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