<?php $this->load->view('common/header'); ?>	
<!-- Edit Profile -->

<section class="panel-bg">
	<div class="container">
		<div class="row">

			<div class="col-md-3">
				<div class="list-group user-dashboard">
					<a href="<?php echo base_url(); ?>user/dashboard" class="list-group-item">
						<i  class="fa fa-tachometer"></i>Dashboard
					</a>
					<a href="<?php echo base_url(); ?>user/my_bookings" class="list-group-item"><i class="fa fa-cart-arrow-down"></i>Bookings</a>

					<a href="#" class="list-group-item"><i class="fa fa-inbox"></i>Inbox</a>

					<a href="<?php echo base_url(); ?>user/profile" class="list-group-item"><i class="fa fa-user"></i>Profile</a>

					<a href="<?php echo base_url(); ?>user/settings" class="list-group-item"><i class="fa fa-wrench"></i>Settings</a>
					
					<a href="<?php echo base_url(); ?>user/listings" class="list-group-item active"><i class="fa fa-list"></i>Listings</a>

				</div>

			</div>


			<div class="col-md-9">
				<div class="panel with-nav-tabs panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1default" data-toggle="tab">Storage Listings</a></li>

							<li><a href="#tab2default" data-toggle="tab">Logistic Listings</a></li>
							<a href="<?php echo base_url(); ?>listing/type" class="btn btn-primary btn-listing  pull-right">Add New Listing</a>
						</ul>

					</div>

					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1default">
								<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
									<div class="row">
										<div class="col-lg-5">
											<a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>" class="property-image">
												<img src="<?php echo base_url(); ?>assets/images/index_5_property_1.png" alt="Post list 1">
											</a>
											<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
										</div>
										<div class="col-lg-7">
											<div class="property-content">
												<h3 class="property-title"><a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>">Stunning new 4 bedroom must see villa in brawa</a></h3>
												<p>
													<span class="property-price">$ 200.000.000</span>
													<span class="property-label">
														<a href="#" class="property-label__type">Villa For Sale</a>
														<a href="#" class="property-label__status">Available</a>
													</span>
												</p>
												<div class="property-address">
													2096 Monroe Street, Houston, 77030 USA
												</div>
												<p class="property-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti sit quos mollitia omnis fuga, nihil suscipit, pariatur iusto dolore architecto labore consequatur minima molestias provident adipisci reiciendis officia, aspernatur dignissimos?</p>
												<div class="property-footer">
													<div class="item-wide"><span class="fi flaticon-wide"></span> 720</div>
													<div class="item-room"><span class="fi flaticon-room"></span> 10</div>
													<div class="item-bathroom"><span class="fi flaticon-bathroom"></span> 10</div>
													<div class="item-garage"><span class="fi flaticon-garage"></span> 1</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
									<div class="row">
										<div class="col-lg-5">
											<a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>" class="property-image">
												<img src="<?php echo base_url(); ?>assets/images/index_5_property_1.png" alt="Post list 1">
											</a>
											<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
										</div>
										<div class="col-lg-7">
											<div class="property-content">
												<h3 class="property-title"><a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>">Stunning new 4 bedroom must see villa in brawa</a></h3>
												<p>
													<span class="property-price">$ 200.000.000</span>
													<span class="property-label">
														<a href="#" class="property-label__type">Villa For Sale</a>
														<a href="#" class="property-label__status">Available</a>
													</span>
												</p>
												<div class="property-address">
													2096 Monroe Street, Houston, 77030 USA
												</div>
												<p class="property-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti sit quos mollitia omnis fuga, nihil suscipit, pariatur iusto dolore architecto labore consequatur minima molestias provident adipisci reiciendis officia, aspernatur dignissimos?</p>
												<div class="property-footer">
													<div class="item-wide"><span class="fi flaticon-wide"></span> 720</div>
													<div class="item-room"><span class="fi flaticon-room"></span> 10</div>
													<div class="item-bathroom"><span class="fi flaticon-bathroom"></span> 10</div>
													<div class="item-garage"><span class="fi flaticon-garage"></span> 1</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
									<div class="row">
										<div class="col-lg-5">
											<a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>" class="property-image">
												<img src="<?php echo base_url(); ?>assets/images/index_5_property_1.png" alt="Post list 1">
											</a>
											<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
										</div>
										<div class="col-lg-7">
											<div class="property-content">
												<h3 class="property-title"><a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>">Stunning new 4 bedroom must see villa in brawa</a></h3>
												<p>
													<span class="property-price">$ 200.000.000</span>
													<span class="property-label">
														<a href="#" class="property-label__type">Villa For Sale</a>
														<a href="#" class="property-label__status">Available</a>
													</span>
												</p>
												<div class="property-address">
													2096 Monroe Street, Houston, 77030 USA
												</div>
												<p class="property-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti sit quos mollitia omnis fuga, nihil suscipit, pariatur iusto dolore architecto labore consequatur minima molestias provident adipisci reiciendis officia, aspernatur dignissimos?</p>
												<div class="property-footer">
													<div class="item-wide"><span class="fi flaticon-wide"></span> 720</div>
													<div class="item-room"><span class="fi flaticon-room"></span> 10</div>
													<div class="item-bathroom"><span class="fi flaticon-bathroom"></span> 10</div>
													<div class="item-garage"><span class="fi flaticon-garage"></span> 1</div>
												</div>
											</div>
										</div>
									</div>
								</div>


							</div>


							<div class="tab-pane fade" id="tab2default">	

								<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
									<div class="row">
										<div class="col-lg-5">
											<a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>" class="property-image">
												<img src="<?php echo base_url(); ?>assets/images/index_5_property_1.png" alt="Post list 1">
											</a>
											<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
										</div>
										<div class="col-lg-7">
											<div class="property-content">
												<h3 class="property-title"><a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>">Stunning new 4 bedroom must see villa in brawa</a></h3>
												<p>
													<span class="property-price">$ 200.000.000</span>
													<span class="property-label">
														<a href="#" class="property-label__type">Villa For Sale</a>
														<a href="#" class="property-label__status">Available</a>
													</span>
												</p>
												<div class="property-address">
													2096 Monroe Street, Houston, 77030 USA
												</div>
												<p class="property-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti sit quos mollitia omnis fuga, nihil suscipit, pariatur iusto dolore architecto labore consequatur minima molestias provident adipisci reiciendis officia, aspernatur dignissimos?</p>
												<div class="property-footer">
													<div class="item-wide"><span class="fi flaticon-wide"></span> 720</div>
													<div class="item-room"><span class="fi flaticon-room"></span> 10</div>
													<div class="item-bathroom"><span class="fi flaticon-bathroom"></span> 10</div>
													<div class="item-garage"><span class="fi flaticon-garage"></span> 1</div>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
									<div class="row">
										<div class="col-lg-5">
											<a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>" class="property-image">
												<img src="<?php echo base_url(); ?>assets/images/index_5_property_1.png" alt="Post list 1">
											</a>
											<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
										</div>
										<div class="col-lg-7">
											<div class="property-content">
												<h3 class="property-title"><a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>">Stunning new 4 bedroom must see villa in brawa</a></h3>
												<p>
													<span class="property-price">$ 200.000.000</span>
													<span class="property-label">
														<a href="#" class="property-label__type">Villa For Sale</a>
														<a href="#" class="property-label__status">Available</a>
													</span>
												</p>
												<div class="property-address">
													2096 Monroe Street, Houston, 77030 USA
												</div>
												<p class="property-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti sit quos mollitia omnis fuga, nihil suscipit, pariatur iusto dolore architecto labore consequatur minima molestias provident adipisci reiciendis officia, aspernatur dignissimos?</p>
												<div class="property-footer">
													<div class="item-wide"><span class="fi flaticon-wide"></span> 720</div>
													<div class="item-room"><span class="fi flaticon-room"></span> 10</div>
													<div class="item-bathroom"><span class="fi flaticon-bathroom"></span> 10</div>
													<div class="item-garage"><span class="fi flaticon-garage"></span> 1</div>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
									<div class="row">
										<div class="col-lg-5">
											<a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>" class="property-image">
												<img src="<?php echo base_url(); ?>assets/images/index_5_property_1.png" alt="Post list 1">
											</a>
											<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
										</div>
										<div class="col-lg-7">
											<div class="property-content">
												<h3 class="property-title"><a href="<?php echo base_url(); ?>details/rooms/<?php echo 'dsfds23fsadf213135fd21f'.'/'.dorage_url_title('Villa For Sale'); ?>">Stunning new 4 bedroom must see villa in brawa</a></h3>
												<p>
													<span class="property-price">$ 200.000.000</span>
													<span class="property-label">
														<a href="#" class="property-label__type">Villa For Sale</a>
														<a href="#" class="property-label__status">Available</a>
													</span>
												</p>
												<div class="property-address">
													2096 Monroe Street, Houston, 77030 USA
												</div>
												<p class="property-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti sit quos mollitia omnis fuga, nihil suscipit, pariatur iusto dolore architecto labore consequatur minima molestias provident adipisci reiciendis officia, aspernatur dignissimos?</p>
												<div class="property-footer">
													<div class="item-wide"><span class="fi flaticon-wide"></span> 720</div>
													<div class="item-room"><span class="fi flaticon-room"></span> 10</div>
													<div class="item-bathroom"><span class="fi flaticon-bathroom"></span> 10</div>
													<div class="item-garage"><span class="fi flaticon-garage"></span> 1</div>
												</div>
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</section>
<!-- Edit Profile End-->
<?php $this->load->view('common/footer'); ?>