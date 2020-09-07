<?php $this->load->view('common/header'); ?>  

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">
  <section class="become-space section-bg">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-md-offset-3">

          <h2>Reset Password</h2>
          <span class="remb">Use the form below to change your password.</span>
          <form id="reset_password_form" action="" method="post">

            <input type="hidden" name="email" value="<?php echo $email; ?>" />

            <input type="hidden" name="forgot_pass_key" value="<?php echo $forgot_pass_key; ?>" />

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="New password">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <input type="password" class="form-control" name="c_password" placeholder="Confirm password">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" id="reset_password" data-loading-text="Please wait..." class="btn cont-btn">Reset</button>
                </div>
              </div>

            </div>
          </form>
        </div>

      </div>
    </div>    
  </section>
</div>
<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
  setTimeout(function(){ $('.activation_message').hide(); }, 3000);
</script>

<script type="text/javascript">
  // $('#reset_password').click(function(){
  $('#reset_password_form').on('submit', function(event) {
    event.preventDefault();

    $("#reset_password").button('loading');

    var value = $("#reset_password_form").serialize();

    $.ajax({
      url:'<?php echo base_url(); ?>forgot_password/set_new_password',
      type:'post',
      data:value,
      dataType:'json',
      success:function(status){
        
        $("#reset_password").button('reset');

        if(status.msg=='success'){
          $.gritter.add({
            title: 'Success!',
            sticky: false,
            time: '5000',
            before_open: function(){
              if($('.gritter-item-wrapper').length >= 3)
              {
                return false;
              }
            },
            text: status.response,
            class_name: 'gritter-success'
          });
          setTimeout(function(){ window.location = '<?php echo base_url(); ?>login'; },2000);
        }
        else if(status.msg == 'error'){
          $.gritter.add({
            title: 'Error!',
            sticky: false,
            time: '5000',
            before_open: function(){
              if($('.gritter-item-wrapper').length >= 3)
              {
                return false;
              }
            },
            text: status.response,
            class_name: 'gritter-error'
          });
          $(btn).button('reset');
        }
      }
    });
  });
</script>