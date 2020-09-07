<?php $this->load->view('common/header'); ?>

<section class="become-space section-bg">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-md-offset-3 login-popup sign-pop">

          <h2>Login</h2>
          
          <form id="login_form" action="" method="post">

            <div class="input-group" style="width:100%;">
                <span><i class="fa fa-envelope mail-icon"></i></span>
                <input class="form-control" name="login_email" placeholder="Email Address" required="" type="email">
            </div>


            <div class="input-group" style="width:100%;">   
                <span><i class="fa fa-lock lock-icon"></i></span>
                <input class="form-control" name="login_password" placeholder="Password" required="" type="password">
            </div>

            <div class="forgot-outer">
                <div class="form-check pull-left" style="margin-left: -17px;">
                    <label>
                        <input name="check" type="checkbox"> <span class="label-text"> </span><span class="remb">Remember me</span>
                    </label>
                </div>

                <div class="pull-right">

                    <span class="label-text forgot"><a href="<?php echo base_url(); ?>forgot_password">Forgot Password</a> </span>

                </div>
            </div>

            <div class="form-group">
                <button type="submit" id="login_btn" data-loading-text="Please wait..." class="login-btn btn">Login</button>
            </div>


            <div class="form-group">
                <p class="divider-text div-text">
                    <span class="bg-light divider-span">OR</span>
                </p>
                <p>
                    <a href="<?php echo fb_login(); ?>" class="btn btn-block btn-facebook"> <i class="fa fa-facebook fb"></i> Login with facebook</a>    
                </p>
            </div>
            <div class="text-center">
                <p class="pull-left">Don’t have an account?</p>
                <a href="<?php echo base_url(); ?>register" class="btn sign-btn pull-right">Sign up</a>
            </div>

        </form>
    </div>



</div>
</div>    
</section>

<?php $this->load->view('common/footer'); ?>