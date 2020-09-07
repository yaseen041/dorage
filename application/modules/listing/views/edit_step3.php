<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">
	<section class="house-rule price-range section-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-3 col-sm-4">
					<div class="list-group policy-list edit-list" id="update-list">

						<a href="javascript:void(0)" data-id="update_step3_1_ajax" class="list-group-item goto_to_step active">
							Storage space rules
						</a>

						<a href="javascript:void(0)" data-id="update_step3_3_ajax" class="list-group-item goto_to_step"> How long customer can book </a>

						<a href="javascript:void(0)" data-id="update_step3_4_ajax" class="list-group-item goto_to_step"> Calender </a>

						<a href="javascript:void(0)" data-id="update_step3_5_ajax" class="list-group-item goto_to_step"> Pricing </a>

						<a href="<?php echo base_url(); ?>listing/storage/step3_complete/<?php echo @$unique_id; ?>" class="list-group-item"> <i style="display:block;" class="fa fa-long-arrow-left"></i> Go back</a>

					</div>
				</div>

				<div class="col-md-6 col-sm-8 col-xs-12" id="update_section_wrap">
					<form id="update_step3_1_form" method="post">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
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
								<div class="form-group">
									<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step3_1" class="btn next-btn btn-block">Save</a>
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
		$(".goto_to_step").click(function() {

			var element = $(this);
			var goto_to_step = $(this).attr('data-id');

			$.ajax({
				url:'<?php echo base_url(); ?>listing/storage/'+goto_to_step,
				type:'post',
				data:{ unique_id : '<?php echo @$unique_id; ?>' },
				dataType:'json',
				success:function(status){
					if(status.msg=='success'){

						$("#update_section_wrap").fadeOut(function(){$("#update_section_wrap").html(status.response).fadeIn();}); 

						$('#update-list>a.active').removeClass("active");
						element.addClass("active");
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

	<script>
		$(function() {

			$('.btn_toggle').bootstrapToggle();
		})
	</script>