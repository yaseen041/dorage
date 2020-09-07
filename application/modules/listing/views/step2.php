<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">
	<section class="section-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
					<div class="col-md-12">
						<h2>Show customers what your space looks like</h2>

						<div class="alert alert-info">
							<strong>Info!</strong> <br /> 
							Maximum file size: <b> 5MB </b>. <br />
							Maximum Dimension (W X H):<b> 2050 X 1050 . ( Best dimension 750 x 431 ) </b><br />
							Allowed image types: <b>'jpg | jpeg | png | gif'</b>.
						</div>
						
						<form id="list_details" action="" method="">

							<input type="hidden" name="form_id" value="step2">
							<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>" />
							<div style="background: #f7f8fa;">
								<input type="file" name="files['<?php echo @$stp_detail['id']; ?>']" id="input2"> 
							</div>

							<?php if(!empty($images)) { ?>

							<div class="jFiler-items jFiler-row">
								<ul class="jFiler-item-list">
									<?php $i=0; foreach ($images as $image) { ?>
									
									<li class="jFiler-item" id="siimagedelete_<?php echo $image['id']; ?>"data-jfiler-index="<?php echo $i; $i++; ?>" style="">
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
</div>

<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
	$("#back_to_step2").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step1_complete',
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