<?php $this->load->view('common/header'); ?>

<!-- ====== SINGLE PROPERTY PAGE HEADER ====== -->
<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">About Us</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">About Us</li>
		</ul>
	</div>
</section>

<!-- ====== ADVANTAGES ====== -->
<section class="page-section section-padd-bottom">
	<div class="container">
		<!-- Section Title -->
		<?php echo get_section_content('aboutus' , 'about_us'); ?>
	</div>
</section>

<?php $this->load->view('common/footer'); ?>