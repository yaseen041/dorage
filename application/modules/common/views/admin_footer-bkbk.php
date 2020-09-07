
    <!-- Required Jqurey -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/tether/dist/js/tether.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>
    <!-- classie js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/classie/classie.js"></script>

    <!-- datatable js -->
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- notification js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/js/bootstrap-growl.min.js"></script>

    <!-- Morris Chart js -->
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/bower_components/morris.js/morris.js"></script>
    <!-- Horizontal-Timeline js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/pages/dashboard/horizontal-timeline/js/main.js"></script>
    <!-- amchart js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/pages/dashboard/amchart/js/amcharts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/pages/dashboard/amchart/js/serial.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/pages/dashboard/amchart/js/light.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/pages/dashboard/amchart/js/custom-amchart.js"></script>

    <!-- sweet alert js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/sweetalert/dist/sweetalert.min.js"></script>

    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/i18next/i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admin_assets/js/script.js"></script>
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
