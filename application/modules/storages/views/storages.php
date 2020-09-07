<?php $this->load->view('common/header'); ?>	

<!-- ====== SEARCH RESULT PAGE HEADER ====== -->
<section id="property-search-result" class="sidebar-map">
	<div class="sidebar-map-content hidden-xs hidden-sm">
		<div class="map-wrapper">
			<div id="map"></div>
			<div class="loader">
				<div class="spinner">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="search-result-content">
		<!-- Tabmenu Container / Default Bootstrap Structure -->
		<div class="container">
			<div class="panel-group accordion slide-property">
				<div class="panel">
					<div class="search-tabmenu">
						<div class="tabmenu-header">
							<!-- Tabmenu Navigation -->
							<div class="panel-heading">
								<?php if(!empty($location_error)) { ?>
								<div class="alert alert-danger">
									<p> <?php echo $location_error; ?> </p>
								</div>
								<?php } ?>
								<h4 class="panel-title"><a href="#collapse1" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" class="collapsed">  <i class="fa fa-search"></i> &nbsp; Search your storage</a></h4>
							</div>
						</div>
						<!-- Tabmenu Body / Content -->
						<div id="collapse1" class="panel-collapse collapse" aria-expanded="false" role="group" style="height: 0px;">
							<div class="panel-body" style="padding:5px;">
								<div class="tabmenu-body">
									<div class="tab-content">
										<!-- Tabmenu Content 1 / Property For SALE -->
										<div role="tabpanel" class="tab-pane active" id="for-sale">
											<form id="seach_form" method="get" action="<?php echo base_url(); ?>storages/search" autocomplete="off">

												<div class="form-body">
													
					<div class="row">

						<div class="col-md-3 col-lg-3 form-group">

							<label for="sale-location">Storage State</label>
							<div class="form-group">
								<select class="form-control index-control" name="list_state" id="list_state" required>
									<option value="">Select State</option>
									<?php foreach ($states as $state) { ?>
									<option value="<?php echo $state['id']; ?>" <?php if(@$_GET['list_state'] == $state['id']){ ?> selected <?php } ?>> <?php echo $state['name']; ?> </option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-md-3 col-lg-3 form-group">
							<label for="sale-location">Storage Location</label>

							<div class="form-group">
								<input type="text" class="form-control index-control" placeholder="Enter Location" name="place" id="property_loc" value="<?php echo @$_GET['place']; ?>" required="required" onkeydown="if($('.pac-container').is(':visible') && event.keyCode == 13) {event.preventDefault();}">

								<input name="lat_long" id="property_lat_long" type="hidden" value="<?php echo @$_GET['lat_long']; ?>">

							</div>
						</div>
						<div class="col-md-3 col-lg-3 form-group">
							<label for="sale-type">Check-in/out Date</label>
							<div class="form-group form-group--date">
								<input name="search_startdate" id="checkin_date"  class=" form-control" placeholder="Check-in/out Date" value="<?php echo @$_GET['search_startdate']; ?>" data-selected="<?php echo @$_GET['search_startdate']; ?>">
							</div>	
						</div>
						
						<div class="col-md-3 col-lg-3 form-group">

							<label for="sale-bathroom">Any Type</label>

							<select class="form-control index-control" name="storage_size_type" id="storage_size_type">

								<option value="">Storage Size Type</option>

								<?php foreach ($sizeTypes as $sizeType) { ?>

								<option value="<?php echo $sizeType['id']; ?>" <?php if(@$_GET['storage_size_type'] == $sizeType['id']){ ?> selected <?php } ?> > <?php echo $sizeType['name']; ?> </option>

								<?php } ?>

							</select>
						</div>
					</div>

													<div class="advanced-search" id="space_storage_types">
														<label>Spaces</label>

														<?php if (empty($storage_types)) { ?>
														<p class="remb_li_space">
															<span> Please select "Storage Size Type" first </span>
														</p>
														<?php } ?>

														<?php if (!empty($storage_types)) { ?>
														<ul class="checklist-box">

															<?php foreach ($storage_types as $storage_type) { ?>

															<li>

																<div class="form-check pull-left" style="margin-left: -17px;">
																	<label>

																		<input type="checkbox" class="storage_type" name="storage_type[]" value="<?php echo $storage_type['id']; ?>" <?php echo in_array($storage_type['id'] , $storage_type_arr) ? 'checked' :''; ?> > 

																		<span class="label-text"> </span>

																		<span class="remb_li_space"> 
																			<?php echo $storage_type['name']; ?> 
																		</span>

																	</label>

																</div>

															</li>

															<?php } ?>

														</ul>
														<?php } ?>

													</div>

													<div class="advanced-search" id="room_space_character">
														<label>Special Needs</label>

														<?php if (!empty($space_characters)) { ?>
														<ul class="checklist-box">
															<?php foreach ($space_characters as $space_char) { ?>

															<li>
																<div class="form-check pull-left" style="margin-left: -17px;">
																	<label>
																		<input type="checkbox" class="space_character" name="space_character[]" value="<?php echo $space_char['id']; ?>" <?php echo in_array($space_char['id'] , $space_character_arr) ? 'checked' :''; ?>> <span class="label-text"> </span><span class="remb_li_space"><?php echo $space_char['name']; ?></span>

																	</label>
																</div>
															</li>

															<?php } ?>

														</ul>

														<?php } ?>
														
													</div>

													<div class="submit-box">

														<a href="#" class="btn-toggle-search pull-left">Advanced Search</a>

														<button class="btn btn-primary pull-right btn-submit" type="submit"><i class="fa fa-search"></i> Search</button>

													</div>
												</div>

											</form>

										</div>


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ====== PAGE CONTENT ====== -->
		<div class="page-section">

			<div class="container">

				<div class="panel filter-panel">
					<div class="panel-body">
						<h4 class="filter-title pull-left"><?php echo count($listings); ?> Matches Found</h4>
						<form action="#" class="form-inline pull-right">
							<div class="form-group">
								<label>Sort By:</label>
								<select class="form-control" id="sorts">
									<option value="price_sort">By Price</option>
									<option value="rating_sort">By Rating</option>
									<option value="distance_sort">By Distance</option>
								</select>
							</div>
						</form>
					</div>
				</div>

				<div class="property-list archive-flex archive-with-footer">
					<div class="row isotope" id="markers_info">
						
						<?php foreach ($listings as $list) { ?>

						<div class="col-lg-4 col-md-6 col-sm-6 marker element-item storage-list" data-price-sort="<?php echo $list['price']; ?>" data-distance-sort="<?php echo $list['distance']; ?>" data-rating-sort="<?php echo $list['list_rating']; ?>">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$<?php echo $list['price']; ?>/day</span>
									<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title']); ?>" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
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

									<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($list["id"]); ?>'); height:220px; background-size: cover; background-position: center;"></div>


								</div>
								<div class="property-content  padd-property">
									<a href="<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title']); ?>" class="property-title"><?php echo $list['title']; ?></a>
									<div class="property-address">
										<?php echo @$list['place']; ?>
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

				<?php if (!empty($links)): ?>
					<div class="pagination">
						<?php echo $links; ?>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>

</section>
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">

	$('.isotope').isotope({
		itemSelector: '.element-item',
		// layoutMode: 'fitRows',
		getSortData: {
			price_sort: '[data-price-sort] parseInt',
			rating_sort: '[data-rating-sort] parsefloat',
			distance_sort: '[data-distance-sort] parsefloat'
		}
	});
	$('#sorts').on( 'change', function() {
		var sortByValue = this.value;
		console.log(sortByValue);
		if (sortByValue == "rating_sort") {
			$('.isotope').isotope({ sortBy: sortByValue, sortAscending: false });
		}else{			
			$('.isotope').isotope({ sortBy: sortByValue, sortAscending:true });
		}
	});  

	var markers = [];
	var locations = [
		// [0 title , 1 latitude, 2 longitude , 3 index, 4 storage space type, 5 detail link, 6 image, 7 price, 8 place],
		<?php $i= 1; foreach ($listings as $list) { ?>
			['<?php echo $list["title"]; ?>', <?php echo $list["latitude"].",".$list["longitude"]; ?>,'<?php echo $i; $i++; ?>',"<?php echo get_storage_type(get_meta_value('space_storage_type' , @$list['id'])); ?>","<?php echo base_url(); ?>details/storage/<?php echo $list['unique_id'].'/'.dorage_url_title($list['title']); ?>" , "<?php echo base_url(); ?>assets/storage_images/<?php echo get_list_image($list['id']); ?>" ,"<?php echo (int)$list['price']; ?>","<?php echo get_meta_value('place' , @$list['id']); ?>"],
			<?php } ?>
			];

			<?php $latlong = explode(',', @$_GET['lat_long']); ?>
			function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 13,
					center: {lat: <?php echo @trim($latlong[0]); ?>, lng: <?php echo @trim($latlong[1]); ?>},
					streetViewControl: false,
					mapTypeControl : false,
					fullscreenControl: false,
					scrollwheel: true,
					zoomControl: true,
					panControl: false
				});

				setMarkers(map);
			}

			function getlength(number) {
				return number.toString().length;
			}

			function setMarkers(map) {


				for (var i = 0; i < locations.length; i++) {

					var location = locations[i];

					var locationInfowindow = new google.maps.InfoWindow({
					// [0 title , 1 latitude, 2 longitude , 3 index, 4 storage space type, 5 detail link, 6 image, 7 price, 8 place],
					content: '<div class="property-item" style="width: 300px;"><div class="img-box"><div class="property-label"><a href="'+location[5]+'" class="property-label__type">'+location[4]+'</a></div><a href="'+location[5]+'" class="img-box__image"><img src="'+location[6]+'" alt="Property" class="img-responsive"></a></div><div class="property-content"><a href="'+location[5]+'" class="property-title">'+location[0]+'</a><span class="item-price">$'+location[7]+'</span><div class="property-address">'+location[8]+'</div><div class="rating"style="padding-bottom: 15px;"><div class="stars pull-right"><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span>115</span></div></div></div></div>',
				});

			//a1 = 95; 
			//b1 = 995;

			var len = getlength(location[7]);
			if(len == 2 ){
				var ico = normalIcon2();
			}else{
				var ico = normalIcon3();
			}

			var marker = new google.maps.Marker({
				position: {lat: location[1], lng: location[2]},
				map: map,
				title: location[0],
				icon: ico,
				label: {
					text: "$"+location[7],
					color: "white",
					fontSize: "14px",
					fontWeight: "bold",

				},
				zIndex: google.maps.Marker.MAX_ZINDEX + 1,
				infowindow: locationInfowindow
			});

			markers.push(marker);

			google.maps.event.addListener(marker, 'click', function() {
				hideAllInfoWindows(map);
				this.infowindow.open(map, this);

			});
			google.maps.event.addListener(marker, 'mouseover', function() {
				console.log(marker);
				var lengt = getlength(this.label.text);
				this.label.color = 'black';
				if(lengt == 3) {
					this.setZIndex(100);
					this.setIcon(highlightedIcon2());
				} else {
					this.setZIndex(100);
					this.setIcon(highlightedIcon3());
				}
				//alert(lengt);
			});
			google.maps.event.addListener(marker, 'mouseout', function() {
				console.log(marker);
				var lengt = getlength(this.label.text);
				this.label.color = 'white';
				this.zIndex = '1';
				if(lengt == 3) {
					//this.setZIndex(99);
					this.setIcon(normalIcon2());
				} else {
					//this.setZIndex(99);
					this.setIcon(normalIcon3());
				}
				//alert(lengt);
			});

		}
	}

	function hideAllInfoWindows(map) {
		markers.forEach(function(marker) {
			marker.infowindow.close(map, marker);
		}); 
	}


	// make a .hover event
	$('#markers_info .marker').hover(

      // mouse in
      function () {

        // first we need to know which <div class="marker"></div> we hovered
        var index = $('#markers_info .marker').index(this);

        var leng = getlength(markers[index].label.text);
        markers[index].label.color = 'black';
        if(leng == 3) {
        	markers[index].setZIndex(100);
        	markers[index].setIcon(highlightedIcon2());
        } else {
        	markers[index].setZIndex(100);
        	markers[index].setIcon(highlightedIcon3());
        }
        
    },
      // mouse out
      function () {
        // first we need to know which <div class="marker"></div> we hovered
        var index = $('#markers_info .marker').index(this);

        var leng = getlength(markers[index].label.text);
        markers[index].label.color = 'white';
        markers[index].zIndex = '1';
        
        if(leng == 3) {
        	markers[index].setIcon(normalIcon2());
        	//markers[index].label.setZIndex(99);
        } else {
        	markers[index].setIcon(normalIcon3());
        	//markers[index].label.setZIndex(99);
        }
    } 

    );

	function normalIcon2() {
		return {
			url: '<?php echo base_url(); ?>assets/images/icon2.png',
			// scaledSize: new google.maps.Size(70, 80), 
			labelOrigin:  new google.maps.Point(20,15),
		};
	}

	function normalIcon3() {
		return {
			url: '<?php echo base_url(); ?>assets/images/icon2.png',
			// scaledSize: new google.maps.Size(70, 80), 
			labelOrigin:  new google.maps.Point(20,15),
		};
	}

	function highlightedIcon2() {
		return {
			url: '<?php echo base_url(); ?>assets/images/icon2_highlight.png',
			// scaledSize: new google.maps.Size(70, 80), 
			labelOrigin:  new google.maps.Point(20,15),
		};
	}

	function highlightedIcon3() {
		return {
			url: '<?php echo base_url(); ?>assets/images/icon2_highlight.png',
			// scaledSize: new google.maps.Size(70, 80), 
			labelOrigin:  new google.maps.Point(20,15),
		};
	}

	initMap();
</script>