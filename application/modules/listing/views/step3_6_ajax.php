
<!-- Become Space Provider -->
<section class="local-laws section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-6 col-sm-8 col-xs-12 col-sm-offset-2 col-md-offset-3">
				<div class="col-md-12">

					<h2>Your local laws and taxes</h2>
					<h4>Make sure you familiarize yourself with your local laws, as well as </h4>

					<p>Please educate yourself about the laws in your jurisdiction before listing your space.</p>

					<p>Most cities have rules covering homesharing, and the specific codes and ordinances can appear in many places (such as zoning, building, licensing or tax codes). In most places, you must register, get a permit, or obtain a license before you list your property or accept guests. You may also be responsible for collecting and remitting certain taxes. In some places, short-term rentals could be prohibited altogether.</p>

					<p>Since you are responsible for your own decision to list or book, you should get comfortable with the applicable rules before listing on Dorage. To get you started, we offer some helpful resources under “Your City Laws.”</p>

					<p>By accepting our Terms of Service and listing your space, you certify that you will follow applicable laws and regulations.</p>
					
				</div>

				<form id="list_details" action="" method="">

					<input type="hidden" name="form_id" value="step3_6">
					<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>">
				</form>

				<div class="col-md-12">
					<hr>
					<div class="form-group pull-left">
						<button id="back_to_step3_5" type="button" class="btn back-btn">Go Back</button>
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
	$("#back_to_step3_5").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step3_5',
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