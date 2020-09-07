<?php $this->load->view('common/header'); ?>

<!-- Privacy Policy -->

<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Privacy Policy</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Privacy Policy</li>
		</ul>
	</div>
</section>
<section class="page-section section-padd-bottom">
	<div class="container">
		<!-- Section Title -->
		<?php echo get_section_content('privacypolicy' , 'privacypolicy'); ?>
	</div>
</section>
<?php $this->load->view('common/footer'); ?>