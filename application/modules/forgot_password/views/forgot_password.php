<?php $this->load->view('common/header'); ?>

<section class="become-space section-bg">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-md-offset-3 login-popup sign-pop">

          <h2>Forgot Password</h2>
          <span class="remb">
            Enter the email address associated with your account, and we’ll email you a link to reset your password.
        </span>
        <form id="retrieve_password_form" action="" method="post" class="padd-top" novalidate>

            <div class="input-group" style="width:100%;">
                <span>
                    <i class="fa fa-envelope mail-icon"></i>
                </span>
                <input type="email" class="form-control" name="email" placeholder="Email Address">
            </div>
            <div class="text-center">
                <p class="pull-left back-login"><a href="<?php echo base_url(); ?>login"><i class="fa fa-angle-left"></i> Back to Login </a> </p>
                <button type="button" id="retrieve_password" class="btn next-btn pull-right">Send Reset Link</button>
            </div>
        </form>

    </div>
    

</div>

</div>    
</section>

<?php $this->load->view('common/footer'); ?>