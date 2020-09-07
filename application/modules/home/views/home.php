<?php $this->load->view('common/header'); ?>	

<!-- ====== PAGE BUILDER TEMPLATE ====== -->
<section id="page-builder" class="page-section">
	<!-- HERO IMAGE WITH SEARCH FORM -->
	<div class="row tpb-row header-index-bg" style="background-image: url('<?php echo base_url(); ?>/assets/images/<?php echo get_section_content('home' , 'banner_image'); ?>'); ">
		<div class="tpb tpb-property_simple_search col-md-12">
			<div class="property-simple-search">
				<div class="content-wrapper">
					<h1 class="title"><?php echo get_section_content('home' , 'welcome_text'); ?></h1>
					<p class="description">
						<?php echo get_section_content('home' , 'welcome_desc'); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<section id="property-search-result">
		<div class="search-tabmenu">
			<!-- Tabmenu Body / Content -->
			<div class="tabmenu-body">
				<div class="container">
					<div class="tab-content">
						<!-- Tabmenu Content 1 / Property For SALE -->
						<div role="tabpanel" class="tab-pane tab-pane-index active" id="for-sale">
							<form id="seach_form" method="get" action="<?php echo base_url(); ?>storages/search" autocomplete="off">
								<div class="form-body">
									<!-- Property for Sale Content Row 1 -->
									<div class="row adv-search">
										<div class="col-md-10 col-sm-10 col-xs-12 no-padd-left no-padd-right">
											<div class="col-md-3 col-sm-3 col-xs-12 form-group no-padd-left no-padd-right">

												<select class="form-control index-control" name="list_state" id="list_state" required>
													<option value="">Select State</option>
													<?php foreach ($states as $state) { ?>
													<option value="<?php echo $state['id']; ?>"> <?php echo $state['name']; ?> </option>
													<?php } ?>
												</select>

											</div>
											<div class="col-md-3 col-sm-3 col-xs-12 form-group no-padd-left no-padd-right">
												<input type="text" class="form-control index-control" placeholder="Enter Location" name="place" id="property_loc" onkeydown="if($('.pac-container').is(':visible') && event.keyCode == 13) {event.preventDefault();}" required>
												<input name="lat_long" id="property_lat_long" type="hidden">

											</div>
											<div class="col-md-3 col-sm-3 col-xs-12 form-group form-group--date no-padd-right no-padd-left">
												<input name="search_startdate" class="form-control index-control index-control" id="checkin_date" placeholder="Check-in/out Date">
											</div>

											<div class="col-md-3 col-sm-3 col-xs-12 form-group no-padd-left no-padd-right">

												<select class="form-control index-control" name="storage_size_type" id="storage_size_type">
													<option value="">Storage Size Type</option>
													<?php foreach ($sizeTypes as $sizeType) { ?>
													<option value="<?php echo $sizeType['id']; ?>"> <?php echo $sizeType['name']; ?> </option>
													<?php } ?>

												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-12 no-padd-left no-padd-right">
											<button class="btn btn-block btn-primary pull-right btn-submit search-btn" type="submit"><i class="fa fa-search" onclick= "validate()"></i> Search</button>						
										</div>	
									</div>

									<div class="advanced-search" style="display: none; margin-top: 25px;">
										<!-- Property for Sale Content Row 2 -->
										<div id="space_storage_types">
											<label>Spaces</label>
											<ul class="checklist-box">
												<p class="remb_li_space">
													<span> Please select "Storage Size Type" first </span>
												</p>
											</ul>
										</div>

										<div id="room_space_character">
											<label>SPECIAL NEEDS</label>
											<ul class="checklist-box">
												<?php foreach ($space_characters as $space_char) { ?>
												<li>
													<div class="form-check pull-left" style="margin-left: -17px;">
														<label>
															<input type="checkbox" class="space_character" name="space_character[]" value="<?php echo $space_char['id']; ?>"> <span class="label-text"> </span><span class="remb_li_space"><?php echo $space_char['name']; ?></span>

														</label>
													</div>
												</li>
												<?php } ?>
											</ul>
										</div>
									</div>

									<div class="submit-box">
										<a href="#" style="color:#fff;" class="btn-toggle-search index-adv-search">Advanced Search</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- BEST DEALS -->
	<section id="best-deals" class="page-section">
		<div class="container">

			<!-- Section Title -->
			<div class="section-header">
				<h2 class="section-title">Featured listings</h2>
			</div>

			<div class="featured-property-slider">

				<?php foreach ($featured_listings as $featured_list) { ?>

				<div class="property-item property-archive">
					<div class="row row-eq-height">
						<div class="col-md-6">
							<a href="<?php echo base_url(); ?>details/storage/<?php echo $featured_list['unique_id'].'/'.dorage_url_title($featured_list['title'])."/".md5($featured_list['title']); ?>" class="property-image">
								
								<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($featured_list['id']); ?>'); background-size: cover; background-position: center; height:350px; width:100%;background-repeat: no-repeat;" class="img-responsive"></div>
							</a>

							<?php if (get_session('user_logged_in') == TRUE && get_session('user_id') != $featured_list['users_id'] ): ?>

								<?php if(is_favourite($featured_list['id'])): ?>

									<a href="javascript:void(0)" class="btn-compare-2 removefavourite active" title="Remove favourite" data-id="<?php echo $featured_list['id']; ?>"><i class="fa fa-heart"></i></a>

								<?php else: ?>

									<a href="javascript:void(0)" class="btn-compare-2 addfavourite" title="Add to favourite" data-id="<?php echo $featured_list['id']; ?>"><i class="fa fa-heart"></i></a>

								<?php endif; ?>

							<?php endif; ?>

						</div>
						<div class="col-md-6">
							<div class="property-content">
								<h3 class="property-title"><a href="<?php echo base_url(); ?>details/storage/<?php echo $featured_list['unique_id'].'/'.dorage_url_title($featured_list['title'])."/".md5($featured_list['title']); ?>"><?php echo $featured_list['title']; ?></a></h3>
								<p>
									<span class="property-price">$<?php echo $featured_list['price']; ?>/day</span>
									<span class="property-label">
										<a href="javascript:void(0)" class="property-label__type"><?php echo get_storage_type(get_meta_value('space_storage_type' , @$featured_list['id'])); ?></a>

									</span>
								</p>
								<div class="property-address">
									<?php echo $featured_list['place']; ?>
								</div>
								<div class="rating">
									<?php $listingReviews = getapprovedListingRating($featured_list['id']); ?>
									<div class="stars">
										<select class="listingRating" name="rating" data-current-rating="<?php echo $listingReviews['total_stars']; ?>" autocomplete="off" style="display: none;">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<span> <?php echo $listingReviews['total_reviews']; ?> Reviews</span>
									</div>
								</div>

								<p class="property-descriptio" style="height:80px;">
									<?php 
									$split = str_split($featured_list['description'], 150);
									$final = $split[0] . "...";
									echo $final;
									?>
								</p>

							</div>
						</div>
					</div>
				</div>

				<?php } ?>
			</div>
		</div>
	</section>



	<!-- ====== Latest Listings ====== -->
	<section id="featured-room" class="	" style="padding-bottom: 20px;">
		<div class="container">
			<!-- Section Header / Title with Column Slider Control / Add 'header-column' to use this style -->
			<div class="section-header header-column">
				<h2 class="section-title">Latest Listings</h2>
			</div>
			<div class="property-list archive-flex">
				<div class="row">

					<?php foreach ($listings as $list) { ?>

					<div class="col-lg-4 col-md-6 col-sm-6">
						<!-- Property Item -->
						<div class="property-item">
							<div class="property-heading">
								<span class="item-price">$<?php echo $list['price']; ?>/day</span>
								<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title'])."/".md5($list['title']); ?>" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
							</div>
							<div class="img-box">
								<div class="property-label">
									<a href="javascript:void(0)" class="property-label__type"><?php echo get_storage_type(get_meta_value('space_storage_type' , @$list['id'])); ?></a>

								</div>

								<?php if (get_session('user_logged_in') == TRUE && get_session('user_id') != $list['users_id'] ): ?>

									<?php if(is_favourite($list['id'])): ?>
										
										<a href="javascript:void(0)" class="btn-compare-2 removefavourite active" title="Remove favourite" data-id="<?php echo $list['id']; ?>"><i class="fa fa-heart"></i></a>

									<?php else: ?>

										<a href="javascript:void(0)" class="btn-compare-2 addfavourite" title="Add to favourite" data-id="<?php echo $list['id']; ?>"><i class="fa fa-heart"></i></a>

									<?php endif; ?>

								<?php endif; ?>

								<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($list['id']); ?>'); height:220px; background-size: cover; background-position: center;"></div>
								

							</div>
							<div class="property-content  padd-property">
								<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title'])."/".md5($list['title']); ?>" class="property-title"><?php echo $list['title']; ?></a>
								<div class="property-address pull-left">
									<?php echo $list['place']; ?>
								</div>

								<div class="rating pull-right">
									<?php $listingReviews = getapprovedListingRating($list['id']); ?>
									<div class="stars">
										<select class="listingRating" name="rating" data-current-rating="<?php echo $listingReviews['total_stars']; ?>" autocomplete="off" style="display: none;">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<span> <?php echo $listingReviews['total_reviews']; ?> Reviews</span>
									</div>
								</div>

							</div>
						</div>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</section>
</section>
<?php $this->load->view('common/footer'); ?>