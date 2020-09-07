
<!-- Become Space Provider -->

<section class="show-space section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
				<div class="col-md-12">
					<h2>Great progress, <?php echo get_session('username'); ?>!</h2>
					<p class="gray-color">Now let’s get some details about your space.</p>	
					<h4 class="step">Step 1 <span class="label label-success">
					Completed</span></h4>
					<h3>Basic Detail</h3>

					<p>Tell us about the space you’re listing and what amenities you’ll offer.</p>
					<p class="dark-sky change-p"><a href="javascript:void(0)" id="edit_step1">Change</a></p>
					<hr>
					<h4 class="step">Step 2 <span class="label label-danger">Pending</span>	</h4>
					<h3>Upload space picture</h3>
					<p>Upload pictures and describe your place to potential customer.</p><br>
					<a href="javascript:void(0)" id="goto_step2" class="btn next-btn">Continue</a>
					<hr>	
					<h4 class="step">Step 3 <span class="label label-danger">Pending</span></h4>
					<h3>Get ready for earning</h3>
					<p>Set up your price, calendar, and booking settings.</p>

				</div>


			</div>
		</div>
	</div>		
</section>

<!-- Become Space Provider End-->

<script type="text/javascript">
	$("#back_to_step3").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step1_3',
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


<script type="text/javascript">
	$("#goto_step2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/goto_step2',
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


<script type="text/javascript">
	$("#edit_step1").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/goto_edit_step1',
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