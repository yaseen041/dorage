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
											<input type="number" class="form-control imageorder col-xs-2" name="image_order[<?php echo $image['id']; ?>]" min="1" placeholder="Image order#" style="width: 192px;" value="<?php echo get_image_order($image['id']); ?>"> 

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
		<div>
			<hr>

			<div class="form-group">
				<a href="javascript:void(0)" id="save_edit_form_data" data-id="update_step2" class="btn next-btn btn-block">Save</a>
			</div>
		</div>

	</form>	
</div>



<script type="text/javascript">
	
	upload_div();

</script>