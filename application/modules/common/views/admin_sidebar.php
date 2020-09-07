<?php  $url = $_SERVER['REQUEST_URI']; ?>

<!-- Menu aside start -->
<div class="main-menu">
  <div class="main-menu-header">
    <img class="img-40" src="<?php echo base_url(); ?>admin_assets/images/user.png" alt="User-Profile-Image">
    <div class="user-details">
      <span> <?php echo get_session('admin_username'); ?> </span>
    </div>
  </div>
  <div class="main-menu-content">
    <ul class="main-navigation">
      <li class="nav-title" data-i18n="nav.category.navigation">
        <i class="ti-line-dashed"></i>
        <span>Navigation</span>
      </li>
      <li class="nav-item single-item <?php if (preg_match("/dashboard/i", $url )) { ?> has-class open <?php } ?>">
        <a href="<?php echo admin_url(); ?>">
          <i class="ti-home"></i>
          <span data-i18n="nav.dash.main">Dashboard</span>
        </a>
      </li>
      <li class="nav-item <?php if (preg_match("/users/i", $url )) { ?> has-class <?php } ?>">
        <a href="javascript:void(0)">
          <i class="fa fa-users"></i>
          <span data-i18n="nav.bootstrap-users.main">Users</span>
        </a>
        <ul class="tree-1 <?php if (preg_match("/users/i", $url )) { ?> open <?php } ?>">

          <li class="<?php if (preg_match("/users/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>users/add_user" data-i18n="nav.bootstrap-users.add_user">Add users</a>
          </li>
          
          <li class="<?php if (preg_match("/users/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>users" data-i18n="nav.bootstrap-users.list_users">List of users</a>
          </li>

        </ul>
      </li>

      <li class="nav-item <?php if (preg_match("/preference/i", $url )) { ?> has-class <?php } ?>">
        <a href="javascript:void(0)">
          <i class="ti-settings"></i>
          <span data-i18n="nav.bootstrap-preference.main">Prefrences</span>
        </a>
        <ul class="tree-1 <?php if (preg_match("/preference/i", $url )) { ?> open <?php } ?>">

          <li class="<?php if (preg_match("/storage_size_types/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/storage_size_types" data-i18n="nav.bootstrap-preference.storage_size_types">Storage Size Types</a>
          </li>

          <li class="<?php if (preg_match("/space_storage_types/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/space_storage_types" data-i18n="nav.bootstrap-preference.space_storage_types">Space Storage Types</a>
          </li>

          <li class="<?php if (preg_match("/room_space_characteristic/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/room_space_characteristics" data-i18n="nav.bootstrap-preference.room_space_characteristic">Room space characteristics</a>
          </li>

          <li class="<?php if (preg_match("/customer_requirements/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/customer_requirements" data-i18n="nav.bootstrap-preference.customer_requirements">Customer Requirements</a>
          </li>

          <li class="<?php if (preg_match("/cancellation_policies/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/cancellation_policies" data-i18n="nav.bootstrap-preference.cancellation_policies">Cancellation Policies</a>
          </li>

          <li class="<?php if (preg_match("/amenities/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/amenities" data-i18n="nav.bootstrap-preference.amenities">Amenities</a>
          </li>

          <li class="<?php if (preg_match("/space_rules/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/space_rules" data-i18n="nav.bootstrap-preference.space_rules">Space Rules</a>
          </li>

          <li class="<?php if (preg_match("/taxes/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>preference/taxes" data-i18n="nav.bootstrap-preference.taxes">Taxes</a>
          </li>

        </ul>
      </li>

      <li class="nav-item <?php if (preg_match("/listings/i", $url )) { ?> has-class <?php } ?>">
        <a href="javascript:void(0)">
          <i class="ti-layers-alt"></i>
          <span data-i18n="nav.bootstrap-listings.main">Listings</span>
        </a>
        <ul class="tree-1 <?php if (preg_match("/listings/", $url )) { ?> open <?php } ?>">

          <li class="<?php if (preg_match("/storage/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>listings/storage" data-i18n="nav.bootstrap-listings.storage">Storage</a>
          </li>
          
          <li class="<?php if (preg_match("/mover/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>listings/mover" data-i18n="nav.bootstrap-listings.mover">Mover</a>
          </li>


          <li class="<?php if (preg_match("/reviews/i", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>listings/reviews" data-i18n="nav.bootstrap-listings.review">Listing Reviews
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item single-item <?php if (preg_match("/bookings/", $url )) { ?> has-class <?php } ?>">
        <a href="javascript:void(0)">
          <i class="ti-book"></i>
          <span data-i18n="nav.bootstrap-bookings.main">Bookings</span>
        </a>
        <ul class="tree-1 <?php if (preg_match("/bookings/", $url )) { ?> open <?php } ?>">
          <li class="<?php if ($this->router->fetch_class() == 'bookings' && $this->router->fetch_method() == 'index') { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings" data-i18n="nav.bootstrap-listings.storage">Active Bookings</a>
          </li>
          <li class="<?php if (preg_match("/completed/", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings/completed" data-i18n="nav.bootstrap-listings.storage">Completed Bookings</a>
          </li>
          <li class="<?php if (preg_match("/cancelled/", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings/cancelled" data-i18n="nav.bootstrap-listings.storage">Cancelled Bookings</a>
          </li>
          <li class="<?php if (preg_match("/refund/", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings/refunded" data-i18n="nav.bootstrap-listings.storage">Refunded Bookings</a>
          </li>

          <li class="<?php if (preg_match("/released/", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings/released" data-i18n="nav.bootstrap-listings.storage">Released Bookings</a>
          </li>

          <li class="<?php if (preg_match("/mover_bookings/", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings/mover_bookings" data-i18n="nav.bootstrap-listings.mover_bookings">Mover Bookings</a>
          </li>

          <li class="<?php if (preg_match("/payment_to_be_released/", $url )) { ?>active<?php } ?>">
            <a href="<?php echo admin_url(); ?>bookings/payment_to_be_released" data-i18n="nav.bootstrap-listings.payment_to_be_released">Payment to Be Released</a>
          </li>


        </ul>
      </li>

      <li class="nav-item single-item <?php if(preg_match("/payments/i", $url )){ ?> has-class <?php } ?>">
        <a href="<?php echo admin_url(); ?>payments">
          <i class="fa fa-dollar-sign"></i>
          <span data-i18n="nav.bootstrap-bookings.main">Released Payments</span>
        </a>
      </li>

      <li class="nav-item <?php if (preg_match("/settings/i", $url )) { ?> has-class <?php } ?>">
        <a href="<?php echo admin_url(); ?>settings">
          <i class="ti-settings"></i>
          <span data-i18n="nav.bootstrap-settings.main">Settings</span>
        </a>
      </li>
    </ul>
  </div>
</div>
    <!-- Menu aside end -->