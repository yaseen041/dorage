<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<!-- Main-body start-->
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="page-header-title">
                <h4>Dashboard</h4>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-md-12 col-xl-6">
                    <!-- table card start -->
                    <div class="card table-card">
                        <div class="">
                            <div class="row-table">
                                <div class="col-sm-6 card-block-big br">
                                    <a href="<?php echo admin_url(); ?>users">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-users text-success"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_count_users('1'); ?>
                                                </h5>
                                                <span>Active Users</span>
                                            </div>
                                        </div>
                                    </a>       
                                </div>
                                <div class="col-sm-6 card-block-big br">
                                    <a href="<?php echo admin_url(); ?>users/inactive_users">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-users text-danger"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_count_users('0'); ?>
                                                </h5>
                                                <span>Inactive Users</span>
                                            </div>
                                        </div>
                                    </a>       
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row-table">
                                <div class="col-sm-6 card-block-big br">
                                    <a href="<?php echo admin_url(); ?>listings/inactive_storage">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="ti-layers-alt text-danger"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_inactive_lists(); ?></h5>
                                                <span>Inactive Storage Listings</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 card-block-big">
                                    <a href="<?php echo admin_url(); ?>listings/storage">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="ti-layers-alt text-info"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_active_lists(); ?></h5>
                                                <span>Active Storage Listings</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row-table">
                                <div class="col-sm-6 card-block-big br">
                                    <a href="<?php echo admin_url(); ?>listings/inactive_mover">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="ti-layers-alt text-danger"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_inactive_movers(); ?></h5>
                                                <span>Inactive Mover Listings</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 card-block-big">
                                    <a href="<?php echo admin_url(); ?>listings/mover">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="ti-layers-alt text-info"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_active_movers(); ?></h5>
                                                <span>Active Mover Listings</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- table card end -->
                </div>
                <div class="col-md-12 col-xl-6">
                    <!-- table card start -->
                    <div class="card table-card">
                        <div class="">
                            <div class="row-table">
                                <div class="col-sm-6 card-block-big br">
                                    <a href="<?php echo admin_url(); ?>bookings">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="ti-book"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_active_bookings(); ?></h5>
                                                <span>Active storage bookings</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-6 card-block-big">
                                    <a href="<?php echo admin_url(); ?>bookings/completed">
                                        <div class="row ">
                                            <div class="col-sm-4">
                                                <i class="ti-book text-success"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo get_completed_bookings(); ?></h5>
                                                <span>Completed storage bookings</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row-table">
                                <div class="col-sm-6 card-block-big br">
                                    <a href="<?php echo admin_url(); ?>bookings/cancelled">
                                        <div class="row ">
                                            <div class="col-sm-4">
                                             <i class="ti-book text-danger"></i>
                                         </div>
                                         <div class="col-sm-8 text-center">
                                            <h5><?php echo get_cancelled_bookings(); ?></h5>
                                            <span>Cancelled storage bookings</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 card-block-big">
                                <a href="<?php echo admin_url(); ?>bookings/refunded">
                                    <div class="row ">

                                        <div class="col-sm-4">
                                            <i class="ti-book text-success"></i>
                                        </div>
                                        <div class="col-sm-8 text-center">
                                            <h5><?php echo get_refunded_bookings(); ?></h5>
                                            <span>Refunded storage bookings</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row-table">
                            <div class="col-sm-6 card-block-big br">
                                <a href="<?php echo admin_url(); ?>bookings/mover_bookings">
                                    <div class="row ">
                                        <div class="col-sm-4">
                                            <i class="ti-book text-danger"></i>
                                        </div>
                                        <div class="col-sm-8 text-center">
                                            <h5><?php echo get_active_mover_bookings(); ?></h5>
                                            <span>Active mover bookings</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 card-block-big">
                                <a href="<?php echo admin_url(); ?>bookings/mover_cancelled">
                                    <div class="row ">

                                        <div class="col-sm-4">
                                            <i class="ti-book text-success"></i>
                                        </div>
                                        <div class="col-sm-8 text-center">
                                            <h5><?php echo get_cancelled_mover_bookings(); ?></h5>
                                            <span>Cancelled mover bookings</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table card end -->
            </div>




            <!-- <div class="col-md-6 col-xl-3">
                <div class="card social-widget-card">
                    <div class="card-block-big bg-facebook">
                        <h3>1165 +</h3>
                        <span class="m-t-10">Facebook Users</span>
                        <i class="icofont icofont-social-facebook"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card social-widget-card">
                    <div class="card-block-big bg-twitter">
                        <h3>780 +</h3>
                        <span class="m-t-10">Twitter Users</span>
                        <i class="icofont icofont-social-twitter"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card social-widget-card">
                    <div class="card-block-big bg-linkein">
                        <h3>998 +</h3>
                        <span class="m-t-10">Linked In Users</span>
                        <i class="icofont icofont-brand-linkedin"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card social-widget-card">
                    <div class="card-block-big bg-google-plus">
                        <h3>650 +</h3>
                        <span class="m-t-10">Google Plus Users</span>
                        <i class="icofont icofont-social-google-plus"></i>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>
</div>
<!-- Main-body end-->
<?php $this->load->view('common/admin_footer'); ?>