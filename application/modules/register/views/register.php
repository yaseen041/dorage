<?php $this->load->view('common/header'); ?>

<section class="become-space section-bg">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-md-offset-3 login-popup sign-pop">

          <h2>Registration</h2>
          
          <form id="registration_form" action="" method="post">

            <div class="input-group" style="width:100%;">
                <span><i class="fa fa-envelope lock-icon"></i></span>
                <input type="email" class="form-control" id="register_email"  name="email" placeholder="Email Address" required>
            </div> 


            <div class="input-group" style="width:100%;">   
                <span><i class="fa fa-lock lock-icon"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="input-group" style="width:100%;">   
                <span><i class="fa fa-lock lock-icon"></i></span>
                <input type="password" name="c_password" class="form-control" placeholder="Confirm Password" required>
            </div>

            <div class="forgot-outer">
                <div class="form-check pull-left" style="margin-left: -17px;">
                    <label>
                        <input type="checkbox" name="check_policy" id="check_policy"> <span class="label-text" > </span><span class="remb">I accept the <a href="<?php echo base_url(); ?>terms_and_conditions" target="_blank"> Terms of Use </a> & <a href="<?php echo base_url(); ?>privacy_policy" target="_blank"> Privacy Policy </a></span>
                        <p id="confirm_error" class="text-danger"></p>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" data-loading-text="Please wait..." id="registration_btn" class="signup-btn btn">Sign Up</button>
            </div>


            <div class="form-group">
                <p class="divider-text div-text">
                    <span class="bg-light divider-span">OR</span>
                </p>
                <p>
                    <a href="<?php echo fb_login(); ?>" class="btn btn-block btn-facebook"> <i class="fa fa-facebook fb"></i> Continue with facebook</a>   
                </p>
            </div>

            <div class="text-center">
                <p class="pull-left">Already have an account?</p>
                <a href="<?php echo base_url(); ?>login" class="btn sign-btn pull-right">Log in</a>
            </div>


        </form>
    </div>



</div>
</div>    
</section>

<?php $this->load->view('common/footer'); ?>