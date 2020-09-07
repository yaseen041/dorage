<?php $this->load->view('common/header'); ?>
<!-- Term & Conditions -->

<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Terms & Conditions </h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Terms & Conditions</li>
		</ul>
</section>
<section class="page-section section-padd-bottom">
	<div class="container">
		<!-- Section Title -->
		<?php echo get_section_content('termconditions' , 'termconditions'); ?>
	</div>
</section>
<!-- Term & Conditions End -->
<?php $this->load->view('common/footer'); ?>