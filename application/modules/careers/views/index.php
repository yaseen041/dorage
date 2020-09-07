<?php $this->load->view('common/header'); ?>

<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Careers</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Careers</li>
		</ul>
	</div>
</section>
<section class="page-section section-padd-bottom">
	<div class="container">
		<!-- Section Title -->
		<?php echo get_section_content('careers' , 'careers'); ?>
	</div>
</section>
<?php $this->load->view('common/footer'); ?>