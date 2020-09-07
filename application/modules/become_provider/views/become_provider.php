<?php $this->load->view('common/header'); ?>

<!-- Become Space Provider -->

<section class="become-space section-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-6 col-md-offset-3">

				<h2 class="text-center">Which listing do you want to provide?</h2>

				<div class="col-md-12">
					<div class="form-group">
						<a href="<?php echo base_url(); ?>listing/storage/step1" class="btn btn-block list-btn next-btn"> Space Provider </a>
					</div>
				</div>

				<?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>

				<div class="col-md-12">
					<div class="form-group">
						<a href="<?php echo base_url(); ?>listing/mover/step1" class="btn btn-block list-btn back-btn"> Mover </a>
					</div>
				</div>

				<?php } ?>
				
			</div>

		</div>
	</div>		
</section>

<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>