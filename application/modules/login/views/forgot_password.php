<?php $this->load->view('common/header'); ?>

<div class="s-trapeze  login-block">
    <!-- section background image -->
    <div class="s-trapeze-img" data-interchange=""></div>
    <!-- <div class="s-trapeze-cover"><div class="s-trapeze-cover-inner"></div></div> -->
    <section class="section s-line-secondary">
        <div class="row">
            <div class="column small-12 medium-12 large-7" style="background: #eeeeee;padding-top: 23px;">
                <header class="s-header">
                    <h2 class="s-headline">Forgot Password<span class="s-headline-decor"></span></h2>
                </header>
            </div>

            <div class="column small-12 medium-12 large-7 large-order-1 services-buttons-column" style="background: #eeeeee;">
                <aside class="sidebar card block-shadow" style="margin-bottom: 0px;">
                    <!-- <div class="bg-secondary card-divider">
                            <h3 class="h4 headline">Request more information</h3>
                        </div> -->
                        <div class="card-section">
                            <p>Please enter your email.</p>

                            <form class="text-center" data-abide="" id="retrieve_password_form" novalidate="" data-e="sm5453-e">
                                <label>
                                    <span class="input-group">
                                        <span class="input-group-label zmdi zmdi-email"></span>
                                        <input class="input-group-field" name="email" placeholder="Email address" required="" type="email">
                                    </span>
                                </label>
                                
                                <button class="button expanded" data-loading-text="Please wait..." id="retrieve_password" type="submit"><i class="zmdi zmdi-mail-send"></i>
                                    <span>Retrieve Password</span>
                                </button>
                            </form>

                        </div><!-- /end .card-section -->
                    </aside>
                    <!-- Service item buttons-->
                    <!-- /end #js-services-button-list -->
                </div><!-- /end .column -->
                <!-- /end .column -->
            </div>
        </section><!-- /end .section -->
    </div><!-- /end .s-trapeze -->

    <?php $this->load->view('common/footer'); ?>

    <script type="text/javascript">
        $('#retrieve_password').click(function(){

          var value = $("#retrieve_password_form").serialize();

          $.ajax({

              url:'<?php echo base_url(); ?>forgot_password/retrieve_password',

              type:'post',

              data:value,

              dataType:'json',

              success:function(status){

                console.log(status);

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
                  // $(btn).button('reset');
                  setTimeout(function() { window.location = '<?php echo base_url();?>login'; },2000); 

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

            }

        }

    });

      });

  </script>