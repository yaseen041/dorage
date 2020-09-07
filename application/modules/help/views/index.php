<?php $this->load->view('common/header'); ?>


<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Help</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Help</li>
		</ul>
	</div>
</section>

<section class="page-section section-padd-bottom">
	<div class="container">
		<!-- Section Title -->
		<?php echo get_section_content('help' , 'help'); ?>
	</div>
</section>


<?php $this->load->view('common/footer'); ?>