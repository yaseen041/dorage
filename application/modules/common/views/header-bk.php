<!DOCTYPE html>
<html lang="en"> 
<head>
	<title>Dorage</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="shortcut icon" type='image/x-icon' href="<?php echo base_url(); ?>assets/images/favicon.ico">
	<meta name="viewport" content="initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.gritter.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/gritter.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css">


</head>
<body class="header-1 page-header-1">
	<!-- ====== CUSTOMIZER ====== -->
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a href="#">About Us</a>
	  <a href="<?php echo base_url(); ?>listing/storage">Become Space Provider</a>
	  <a href="<?php echo base_url(); ?>listing/type">Add Listing</a>
	  <a href="<?php echo base_url(); ?>policies_cancellation">Policies & Cancellation</a>
	  <a href="<?php echo base_url(); ?>terms_and_conditions">Term & Conditions</a>
	  <a href="#">Contact Us</a>

</div>

	<!-- ====== BEGIN HEADER ====== -->
	<header id="header">


		<!-- Main Menu Header -->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Navbar Brand -->
				<div class="navbar-header">
					<a href="<?php echo base_url(); ?>" id="navbar-brand main" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/images/header-logo-default.png" alt="Dorage Property"></a>

					<button type="button" onclick="openNav()" class="open-nav navbar-toggle collapsed" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>


				</div>
				<!-- Navbar Menu -->
				<nav id="navbar" class="navbar navbar-right navbar-collapse collapse">

					<a href="<?php echo base_url(); ?>listing/storage" class="btn btn-primary navbar-btn host-btn">Become Space Provider</a>

					<?php if(get_session('user_logged_in') !== true){ ?>

					<button class="btn btn-primary navbar-btn border-btns" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in"></i>&nbsp;Login</button>

					<button class="btn btn-primary navbar-btn border-btns" data-toggle="modal" data-target="#signModal"><i class="fa fa-user"></i>&nbsp;Sign Up</button>

					<?php } ?>

					<ul class="nav navbar-nav pull-right">

						<?php if(get_session('user_logged_in') == true){ ?>
						<!-- Dropdown Menu -->
						<li class="dropdown user-dropdown">
							<a href="javascript:void(0)"><img class="usr" src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo get_session('profile_pic'); ?>" alt="user"></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>user/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></li>
								<li><a href="<?php echo base_url(); ?>user/my_bookings"><i class="fa fa-cart-arrow-down"></i> Bookings</a></li>
								<li><a href="<?php echo base_url(); ?>user/profile"> <i class="fa fa-user"> </i> Profile</a></li>
								<li><a href="#"><i class="fa fa-credit-card"> </i> Payment method</a></li>
								<li><a href="<?php echo base_url(); ?>user/settings"> <i class="fa fa-cog"></i> Account Settings</a></li>
								<li><a href="<?php echo base_url(); ?>user/listings"><i class="fa fa-list"></i> Listings</a></li>
								<li><a href="<?php echo base_url(); ?>logout"> <i class="fa fa-sign-out"> </i> Logout</a></li>
							</ul>
						</li>

						<?php } ?>

						<li id="main">
							<a class="open-nav" style="font-size:30px; cursor:pointer" onclick="openNav()">&#9776; </a>
						</li>

					</ul>	

				</nav>
			</div>
		</nav>
	</header>	<!-- ====== END HEADER ====== -->