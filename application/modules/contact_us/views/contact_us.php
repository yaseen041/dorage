<?php $this->load->view('common/header'); ?>

<!-- ====== CONTACT PAGE HEADER ====== -->
<section class="page-header">
	<div class="container">
		<h1 class="page-header-title">Contact</h1>
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">Contact</li>
		</ul>
	</div>
</section>

<!-- ====== CONTACT PAGE CONTENT ====== -->
<section class="page-section" style="margin-top: 40px;">
	<div class="container">
		<div id="content">

			<!-- Contact Panel Icon Section -->
			<section class="section-row col-merge">
				<div class="row">
					<div class="col-md-4">
						<!-- Panel Box Icon -->
						<div class="panel-box icon-box">
							<span class="icon-item"><i class="fa fa-home"></i></span>
							<h3 class="icon-title">Address</h3>
							<p class="icon-description"><?php echo get_section_content('contactus' , 'contactus_address'); ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<!-- Panel Box Icon -->
						<div class="panel-box icon-box">
							<span class="icon-item"><i class="fa fa-phone"></i></span>
							<h3 class="icon-title">Phone</h3>
							<p class="icon-description"><?php echo get_section_content('contactus' , 'contactus_phone'); ?></p>
						</div>
					</div>
					<div class="col-md-4">
						<!-- Panel Box Icon -->
						<div class="panel-box icon-box">
							<span class="icon-item"><i class="fa fa-paper-plane"></i></span>
							<h3 class="icon-title">Email</h3>
							<p class="icon-description"><?php echo get_section_content('contactus' , 'contactus_email'); ?></p>
						</div>
					</div>
				</div>
			</section>	

			<!-- Google Maps Location Section -->
			<section class="section-row padd-top">
				<div class="panel-box">
					<div class="panel-header">
						<h3 class="panel-title">Google Maps</h3>
					</div>
					<div class="panel-body">
						<div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=<?php echo dorage_url_title(get_section_content('contactus','contactus_address')); ?>+(Dorage)&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><br />
					</div>
				</div>
			</section>

			<!-- Messages Form Section -->
			<section class="section-row padd-top">
				<div class="panel-box">
					<div class="panel-header">
						<h3 class="panel-title">Leave Message</h3>
					</div>
					<div class="panel-body">
						<div class="alert alert-danger error_msg" style="display: none; text-align: left;"></div>
						<div class="alert alert-success success_msg" style="display: none; text-align: left;"></div>
						<form class="form" id="contact_form" role="form" method="post">
							<div class="row">
								<div class="form-group col-md-4">
									<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Name">
								</div>

								<div class="form-group col-md-4">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email">
								</div>

								<div class="form-group col-md-4">
									<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
								</div>								

							</div>
							<div class="form-group">
								<textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
							</div>
							<div class="form-group">
								<button type="button" id="send_message" class="btn-submit btn-primary btn">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>


<?php $this->load->view('common/footer'); ?>


<script type="text/javascript">
	$('#send_message').click(function(event){      
		event.preventDefault();
		var value = $("#contact_form" ).serialize();

		$.ajax({
			url:'<?php echo base_url(); ?>contact_us/send_contact_email',
			type:'post',
			data:value,
			dataType:'json',
      //processData: false,
      //contentType: false,
      success:function(status){
      	console.log(status);
      	if(status.msg=='success'){
      		$('.error_msg').hide();
      		$('.success_msg').html(status.response);
      		$('.success_msg').show();
      		$("#contact_form" )[0].reset();
      	}
      	else if(status.msg == 'error'){  
      		$('.error_msg').html(status.response);
      		$('.error_msg').show();
      		$('.success_msg').hide();

      	}

      }

  });
	});
</script>
