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
	
	<link href="<?php echo base_url(); ?>assets/css/jquery.filer.css" type="text/css" rel="stylesheet" />	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css">

	<!-- ------------------------ -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-year-calendar.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/css-stars.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fontawesome-stars-o.css">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


	<!-- ------------------------ -->

</head>
<body class="header-1 page-header-1">
	<!-- ====== CUSTOMIZER ====== -->
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

		<?php if(get_session('user_logged_in') == true){ ?>
		<a href="javascript:void(0)" class="visible-xs">
			<img class="usr" src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo get_session('profile_pic'); ?>" alt="user"> <?php echo get_session('username'); ?>
		</a>
		<a  class="visible-xs" href="<?php echo base_url(); ?>user/dashboard">Dashboard</a>	
		<?php } ?>
		<?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>
		<a href="<?php echo base_url(); ?>movers">Search Movers</a>
		<?php } ?>		
		<a href="<?php echo base_url(); ?>about_us">About Us</a>
		<a href="<?php echo base_url(); ?>become_provider">Become Provider</a> 
		<a href="<?php echo base_url(); ?>policies">Policies & Cancellation</a>
		<a href="<?php echo base_url(); ?>terms_and_conditions">Term & Conditions</a>
		<a href="<?php echo base_url(); ?>contact_us">Contact Us</a>

		<?php if(get_session('user_logged_in') !== true){ ?>
		
		<a class="mb-signup-btn" href="javascript:void(0)" data-toggle="modal" data-target="#signModal"><i class="fa fa-user"></i> Sign up</a>
		
		<a class="mb-signin-btn" href="javascript:void(0)" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in"></i> Login</a>

		<?php }else{ ?>
		<a class="visible-xs" href="<?php echo base_url(); ?>logout">Logout</a>
		<?php } ?>

	</div>

	<!-- ====== BEGIN HEADER ====== -->
	<header id="header">


		<!-- Main Menu Header -->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Navbar Brand -->
				<div class="navbar-header">
					<a href="<?php echo base_url(); ?>" id="navbar-brand main" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/images/header-logo-default.png" alt="Dorage"></a>

					<button type="button" onclick="openNav()" class="open-nav navbar-toggle collapsed" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>


				</div>
				<!-- Navbar Menu -->
				<nav id="navbar" class="navbar navbar-right navbar-collapse collapse">

					<a href="<?php echo base_url(); ?>become_provider" class="btn btn-primary navbar-btn host-btn">Become Provider</a>

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

								<li><a href="<?php echo base_url(); ?>user/bookings_needer"><i class="fa fa-cart-arrow-down"></i> Bookings</a></li>

								<li><a href="<?php echo base_url(); ?>user/profile"><i class="fa fa-user"></i> Profile</a></li>

								<li><a href="<?php echo base_url(); ?>user/settings"><i class="fa fa-wrench"></i> Account Settings</a></li>

								<li><a href="<?php echo base_url(); ?>user/listings"><i class="fa fa-list"></i> Listings</a></li>
								
								<li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
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
	</header>

	
	<!-- ====== END HEADER ====== -->