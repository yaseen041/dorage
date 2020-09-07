<?php $this->load->view('common/header'); ?>

<!-- Policies -->

<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Insurance Detail</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Insurance Detail</li>
		</ul>
	</div>
</section>

<section class="page-section section-padd-bottom">
	<div class="container">

		<!-- Section Title -->
		<div class="section-header">
			<h2 class="section-title">Insurance Detail</h2>
		</div>

		<!-- Section Content -->
		<div class="row">
			<div class="col-md-12">
				<?php echo get_section_content('insurance' , 'insurance_detail'); ?>
			</div>
		</div>
	</div><br> <br>
</section>
<?php $this->load->view('common/footer'); ?>