<!-- Become Space Provider -->
<section class="section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-3 col-sm-4 col-xs-12">

				<div class="list-group policy-list edit-list" id="update-list">

					<a href="javascript:void(0)" data-id="update_step2_ajax" class="list-group-item goto_to_step active"> Upload pictures </a>

					<a href="javascript:void(0)" data-id="update_step2_1_ajax" class="list-group-item goto_to_step"> Storage space title </a>

					<a href="<?php echo base_url(); ?>listing/storage/step2_complete/<?php echo @$unique_id; ?>" class="list-group-item"> <i style="display:block;" class="fa fa-long-arrow-left"></i> Go back </a>

				</div>

			</div>

			<div class="col-md-6 col-sm-8 col-xs-12" id="update_section_wrap">
				<div class="col-md-12" >
					<h2>Show customers what your space looks like</h2>
					
					<div class="alert alert-info">
						<strong>Info!</strong> <br /> 
						Maximum file size: <b> 5MB </b>. <br />
						Maximum Dimension (W X H):<b> 2050 X 1050 . ( Best dimension 750 x 431 ) </b><br />
						Allowed image types: <b>'jpg | jpeg | png | gif'</b>.
					</div>

					<form id="update_step2_form" method="post">
						<input type="hidden" name="form_id" value="step2" />
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />

						<div style="background: #f7f8fa;">
							<input type="file" name="files['<?php echo @$stp_detail['id']; ?>']" id="input2"> 
						</div>

						<?php if(!empty($images)) { ?>

						<div class="jFiler-items jFiler-row">
							<ul class="jFiler-item-list">
								<?php $i=0; foreach ($images as $image) { ?>

								<li class="jFiler-item" id="siimagedelete_<?php echo $image['id']; ?>" data-jfiler-index="<?php echo $i; $i++; ?>" style="">
									<div class="jFiler-item-container">
										<div class="jFiler-item-inner">
											<div class="jFiler-item-thumb">
												<div class="jFiler-item-status"></div>
												<div class="jFiler-item-info">
													<span class="jFiler-item-title">
														<b title="Image">Image</b>
													</span>
												</div>
												<div class="jFiler-item-thumb-image">
													<img src="<?php echo base_url(); ?>assets/storage_images/<?php echo $image['image']; ?>" draggable="false">
												</div>
											</div>
											<div class="jFiler-item-assets jFiler-row">
												<ul class="list-inline pull-left">
													<li>
														<div class="jFiler-jProgressBar" style="display: none;">
															<div class="bar" style="width: 100%;"></div>
														</div>
														<div class="jFiler-item-others text-success" style="">

															<a href="javascript:void(0)" class="delete_picture jFiler-item-trash-action" data-id="<?php echo $image['id']; ?>"> 
																<i class="icon-jfi-check-circle fa fa-times-circle fa-2x image_remove" title="Remove"></i>
															</a>
															<input type="number" class="form-control col-xs-2 imageorder" name="image_order[<?php echo $image['id']; ?>]" min="1" placeholder="Image order#" style="width: 192px;" value="<?php echo get_image_order($image['id']); ?>"> 

														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>

						<?php } ?>

						<div class="form-group">
							<label>Video URL</label>
							<input type="url" class="form-control" name="posted_data[video_url]" pattern="https?://.+" placeholder="Enter video URL include http://" value="<?php echo get_meta_value('video_url' , @$stp_detail['id']); ?>">
						</div>
					</form>	
				</div>

				<div class="col-md-12">
					<hr>
					<div class="form-group">
						<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step2" class="btn next-btn btn-block">Save</a>
					</div>
				</div>

			</div>
		</div>
	</div>		
</section>


<!-- Become Space Provider End-->
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

	upload_div();
</script>