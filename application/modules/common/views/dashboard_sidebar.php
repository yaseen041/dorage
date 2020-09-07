<?php  $url = $_SERVER['REQUEST_URI']; ?>

<div class="col-md-3">
  <div class="list-group user-dashboard">
    <a href="<?php echo base_url(); ?>user/dashboard" class="list-group-item <?php if (preg_match("/dashboard/i", $url )) { ?> active <?php } ?>">
      <i  class="fa fa-tachometer"></i>Dashboard
    </a>

    <a href="<?php echo base_url(); ?>user/bookings_provider" class="list-group-item <?php if (preg_match("/bookings_provider/i", $url )) { ?> active <?php } ?>"><i class="fa fa-cart-arrow-down"></i>Bookings <span class="label label-info pull-right">Provider</span></a>

    <a href="<?php echo base_url(); ?>user/bookings_needer" class="list-group-item <?php if (preg_match("/bookings_needer/i", $url )) { ?> active <?php } ?>"><i class="fa fa-cart-arrow-down"></i>Bookings <span class="label label-success pull-right">Needer</span></a>
    

    <a href="<?php echo base_url(); ?>user/inbox" class="list-group-item <?php if (preg_match("/inbox/i", $url )) { ?> active <?php } ?>"><i class="fa fa-inbox"></i>Inbox <span class="badge badge-pill badge-dark notificationCount"><?php echo getUnreadMessagesCount(); ?></span></a>

    <a href="<?php echo base_url(); ?>user/profile" class="list-group-item <?php if (preg_match("/profile/i", $url )) { ?> active <?php } ?>"><i class="fa fa-user"></i>Profile</a>

    <a href="<?php echo base_url(); ?>user/settings" class="list-group-item <?php if (preg_match("/settings/i", $url )) { ?> active <?php } ?>"><i class="fa fa-wrench"></i>Settings</a>

    <a href="<?php echo base_url(); ?>user/listings" class="list-group-item <?php if (preg_match("/listings/i", $url )) { ?> active <?php } ?>"><i class="fa fa-list"></i>Listings</a>
  </div>
</div>