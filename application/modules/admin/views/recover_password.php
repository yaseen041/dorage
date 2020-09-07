<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recover Password | Dorage</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords" content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <!-- Favicon icon -->
    
    <link rel="icon" href="<?php echo base_url(); ?>admin_assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/icon/icofont/css/icofont.css">

    <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/pages/notification/notification.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/css/style.css">
    <!--color css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin_assets/css/color/color-1.css" id="color" />
</head>

<body class="menu-static">
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body">
                        <form class="md-float-material" id="forgot_form" method="post" action="">
                           
                            <div class="auth-box">
                                <div class="text-center">
                                    <img class="img-fluid" src="<?php echo base_url(); ?>assets/images/header-logo-default.png" alt="Dorage" />
                                </div>
                                <hr/>
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h4 class="text-left forgot_heading">You forgot your Password? </h4>
                                        <h4 class="text-left forgot_heading">Don't worry.</h4>
                                    </div>
                                </div>
                                <p class="text-inverse b-b-default text-right">Back to <a href="<?php echo admin_url(); ?>login">Login.</a></p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Your Email Address" name="email" id="email" required>
                                    <span class="md-line"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" id="forgot_btn" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset and send me a new Password</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/tether/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>
    <!-- classie js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/classie/classie.js"></script>


    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/js/script.js"></script>

    <!-- notification js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/js/bootstrap-growl.min.js"></script>

</body>

</html>

<script type="text/javascript">
    
    function notify(title, message, type){
        $.growl({
            title : title,
            message: message
        },{
            type: type,
            allow_dismiss: false,
            label: 'Cancel',
            className: 'btn-xs btn-inverse',
            placement: {
                from: 'top',
                align: 'right'
            },
            delay: 2500,
            animate: {
                    enter: 'animated fadeInRight',
                    exit: 'animated fadeOutRight'
            },
            offset: {
                x: 30,
                y: 30
            }
        });
    }

</script>
<script>

  $('#forgot_btn').click(function(){

      if($("#email").val() == ''){
        notify('Error! ', 'Email field is required.', 'danger');
        return false;
      }
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#forgot_form").serialize();

      $.ajax({

        url:'<?php echo admin_url(); ?>recover_password/retrieve_password',

        type:'post',

        data:value,

        dataType:'json',

        success:function(status){

          console.log(status);

          if(status.msg=='success'){
        
            notify('Success! ', status.response, 'success');
            $(btn).button('reset');

        }

        else if(status.msg == 'error'){
            notify('Error! ', status.response, 'danger');
            $(btn).button('reset');
        }

    }

});

  });
</script>