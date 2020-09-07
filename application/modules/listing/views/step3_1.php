<?php $this->load->view('common/header'); ?>	
<!-- Become Space Provider -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<div id="ajax_wrapper" style="margin-top: 97px;">
	<section class="house-rule section-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
					<form id="list_details" action="" method="">
						<input type="hidden" name="form_id" value="step3_1">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>">
						<input type="hidden" name="listings_id" value="<?php echo @$stp_detail['id']; ?>">
						<div class="col-md-12">
							<h2>Set space rules for your customer</h2>

							<?php foreach ($basic_rules as $basic_rule) { ?>

							<div class="row">
								<div class="col-md-8 col-sm-8 col-xs-8">
									<p> <?php echo $basic_rule['name']; ?> </p>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4 text-right">
									<div class="btn-group" id="status" data-size="normal">
										<input name="space_rule[]" class="btn_toggle" value="<?php echo $basic_rule['id']; ?>" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox" <?php echo in_array( $basic_rule["id"] , @$rules) ? "checked" : ""; ?>>

									</div>
								</div>
							</div>

							<?php } ?>

						</div>


						<div class="col-md-12" id="add-rule">
							<div class="form-group">
								<label>Additional rules</label>

								<?php if(empty($additional_rules)){?>

								<div class="input-group add-form">
									<input type="text" name="additional_rule[]" class="form-control" id="exampleInputAmount" placeholder="Write here...">
									<div id="add_click" class="input-group-addon add-rule btn">Add</div>
								</div>

								<?php }?>

								<?php $i=0; foreach ($additional_rules as $additional) { 


									if($i == 0) { $i++; ?>

									<div class="input-group add-form">
										<input type="text" name="additional_rule[]" class="form-control" id="exampleInputAmount" placeholder="Write here..." value="<?php echo $additional['rule']; ?>">
										<div id="add_click" class="input-group-addon add-rule btn">Add</div>
									</div>

									<?php } else { ?>

									<div class="col-md-12 rule_append">
										<div class="row">
											<div class="form-group">
												<div class="input-group add-form">
													<input type="text" name="additional_rule[]" class="form-control" id="exampleInputAmount" placeholder="" value="<?php echo $additional['rule']; ?>">
													<div class="input-group-addon remove_rule btn btn-danger">Delete</div>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>

									<?php } ?>


								</div>
							</div>


							<div class="col-md-12">
								<h4>Details customers must know about your space</h4>


								<?php foreach ($extra_rules as $extra_rule) { ?>

								<div class="form-check">
									<label>
										<input type="checkbox" value="<?php echo $extra_rule['id']; ?>" name="space_rule[]" <?php echo in_array( $extra_rule["id"] , @$rules) ? "checked" : ""; ?>> <span class="label-text"> </span><span class="remb"> <?php echo $extra_rule['name']; ?> </span>
									</label>
								</div>

								<?php } ?>



							</div>
							<div class="col-md-12">
								<hr>
								<div class="form-group pull-left">
									<button id="back_to_step3" type="button" class="btn back-btn">Go Back</button>
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
	</div>

	<?php $this->load->view('common/footer'); ?>

	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<script type="text/javascript">
		$("#back_to_step3").click(function() {
			$.ajax({
				url:'<?php echo base_url(); ?>listing/storage/back_to_step3',
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
	<script>
		$(document).ready(function(){
			$('#add_click').click(function(){
				$("#add-rule").append('<div class="col-md-12 rule_append"><div class="row"><div class="form-group"><div class="input-group add-form"><input type="text" class="form-control" name="additional_rule[]" id="exampleInputAmount" placeholder=""><div class="input-group-addon remove_rule btn btn-danger">Delete</div></div></div></div></div>');
				remove_rule();

			});
			function remove_rule(){
				$('.remove_rule').click(function(){
					$(this).closest('.rule_append').fadeOut(function() { $(this).remove(); });
				});
			}
			remove_rule();

		});

	</script>