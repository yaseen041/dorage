<?php $this->load->view('common/header'); ?>

<!-- Policies -->

<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Policies</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Policies</li>
		</ul>
	</div>
</section>

<section class="page-section section-padd-bottom">
	<div class="container">
		<!-- Section Title -->
		<?php echo get_section_content('policies' , 'policies'); ?>
	</div>
</section>
<?php $this->load->view('common/footer'); ?>