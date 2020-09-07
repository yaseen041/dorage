<?php $this->load->view('common/header'); ?>	

<section id="property-search-result" class="sidebar-map">
	<div class="sidebar-map-content">
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
								<h4 class="panel-title"><a href="#collapse1" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" class="collapsed">  <i class="fa fa-search"></i> &nbsp; Search your property</a></h4>
							</div>
						</div>
						<!-- Tabmenu Body / Content -->
						<div id="collapse1" class="panel-collapse collapse" aria-expanded="false" role="group" style="height: 0px;">
							<div class="panel-body" style="padding:5px;">
								<div class="tabmenu-body">
									<div class="tab-content">
										<!-- Tabmenu Content 1 / Property For SALE -->
										<div role="tabpanel" class="tab-pane active" id="for-sale">
											<form action="#">
												<div class="form-body">
													<!-- Property for Sale Content Row 1 -->
													<div class="row">
														<div class="col-md-6 col-lg-3 form-group">
															<label for="sale-location">Property Location</label>
															<div class="form-group">
																<input type="text" class="form-control" placeholder="Any Location">
															</div>
														</div>
														<div class="col-md-6 col-lg-3 form-group">
															<label for="sale-type">Check-in Date</label>
															<div class="form-group form-group--date">
																<input id="nb-start-date" name="search_startdate" class="form-control" placeholder="Check-in Date">
															</div>	
														</div>
														<div class="col-md-6 col-lg-3 form-group">
															<label for="sale-bedroom">Check-out Date</label>
															<div class="form-group form-group--date">
																<input id="nb-end-date" name="search_enddate" class="form-control" placeholder="Check-out Date">
															</div>
														</div>
														<div class="col-md-6 col-lg-3 form-group">
															<label for="sale-bathroom">Any Type</label>
															<select class="form-control" id="sale-bathroom">
																<option>Select Space</option>
																<option>Small</option>
																<option>Medium</option>
																<option>Large</option>
															</select>
														</div>
													</div>

													<div class="advanced-search">
														<label>Small Space</label>
														<ul class="checklist-box">

															<li><div class="form-check pull-left" style="margin-left: -17px;">
																<label>
																	<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Room</span>
																</label>
															</div></li>

															<li><div class="form-check pull-left" style="margin-left: -17px;">
																<label>
																	<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Balcony</span>
																</label>
															</div></li>

														</ul>
													</div>

													<div class="advanced-search">
														<label>Special Needs</label>
														<ul class="checklist-box">

															<li>
																<div class="form-check pull-left" style="margin-left: -17px;">
																	<label>
																		<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Temperture 31 <sup>o</sup>F</span>
																	</label>
																</div>
															</li>

															<li>
																<div class="form-check pull-left" style="margin-left: -17px;">
																	<label>
																		<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Wet</span>
																	</label>
																</div>
															</li>

															<li>
																<div class="form-check pull-left" style="margin-left: -17px;">
																	<label>
																		<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Dry</span>
																	</label>
																</div>
															</li>

															<li>
																<div class="form-check pull-left" style="margin-left: -17px;">
																	<label>
																		<input type="checkbox" name="check"> <span class="label-text"> </span><span class="remb">Hight Security</span>
																	</label>
																</div>
															</li>

														</ul>
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
						<h4 class="filter-title pull-left">60 Matches Found</h4>
						<form action="#" class="form-inline pull-right">
							<div class="form-group">
								<label>Sort By:</label>
								<select class="form-control">
									<option value="1">By Price</option>
									<option value="2">By Rating</option>
									<option value="3">By Distance</option>

								</select>
							</div>
						</form>
					</div>
				</div>

				<div class="property-list archive-flex archive-with-footer">
					<div class="row" id="markers_info">
						<div class="col-lg-6 col-md-6 col-sm-6 marker">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$550/day</span>
									<a href="single-property.php" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
								</div>
								<div class="img-box">
									<div class="property-label">
										<a href="#" class="property-label__type">Medium</a>

									</div>
									<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
									<a href="single-property.php" class="img-box__image"><img src="assets/images/balcony.jpg" alt="Property" class="img-responsive"></a>
								</div>
								<div class="property-content">
									<a href="single-property.php" class="property-title">Eos laudantium dicta</a>
									<div class="property-address">
										2096 Monroe Street, Houston, 77030 USA
									</div>
									<div class="rating">
										<div class="stars pull-right">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span>115</span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 marker">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$122.00 / per day</span>
									<a href="single-property.php" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
								</div>
								<div class="img-box">
									<div class="property-label">
										<a href="#" class="property-label__type">Large</a>

									</div>
									<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
									<a href="single-property.php" class="img-box__image"><img src="assets/images/basement.jpg" alt="Property" class="img-responsive"></a>
								</div>
								<div class="property-content">
									<a href="single-property.php" class="property-title">Dicta omnis facere</a>
									<div class="property-address">
										2096 Monroe Street, Houston, 77030 USA
									</div>
									<div class="rating">
										<div class="stars pull-right">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span>115</span>
										</div>
									</div>
								
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$200.00 / per day</span>
									<a href="single-property.php" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
								</div>
								<div class="img-box">
									<div class="property-label">
										<a href="#" class="property-label__type">Small</a>
										
									</div>
									<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
									<a href="single-property.php" class="img-box__image"><img src="assets/images/garage_2.jpg" alt="Property" class="img-responsive"></a>
								</div>
								<div class="property-content">
									<a href="single-property.php" class="property-title">Quae ipsum porro</a>
									<div class="property-address">
										2096 Monroe Street, Houston, 77030 USA
									</div>
									<div class="rating">
										<div class="stars pull-right">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span>115</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$400.00 / per day</span>
									<a href="single-property.php" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
								</div>
								<div class="img-box">
									<div class="property-label">
										<a href="#" class="property-label__type">Large</a>
										
									</div>
									<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
									<a href="single-property.php" class="img-box__image"><img src="assets/images/cold-storage.jpg" alt="Property" class="img-responsive"></a>
								</div>
								<div class="property-content">
									<a href="single-property.php" class="property-title">Dicta omnis facere</a>
									<div class="property-address">
										2096 Monroe Street, Houston, 77030 USA
									</div>
									<div class="rating">
										<div class="stars pull-right">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span>115</span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$400.00 / per day</span>
									<a href="single-property.php" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
								</div>
								<div class="img-box">
									<div class="property-label">
										<a href="#" class="property-label__type">Small</a>
										
									</div>
									<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
									<a href="single-property.php" class="img-box__image"><img src="assets/images/small-balcony.jpg" alt="Property" class="img-responsive"></a>
								</div>
								<div class="property-content">
									<a href="single-property.php" class="property-title">Quae ipsum porro</a>
									<div class="property-address">
										2096 Monroe Street, Houston, 77030 USA
									</div>
									<div class="rating">
										<div class="stars pull-right">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span>115</span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<!-- Property Item -->
							<div class="property-item">
								<div class="property-heading">
									<span class="item-price">$400.00 / per day</span>
									<a href="single-property.php" class="item-detail btn">Detail <i class="fi flaticon-detail"></i></a>
								</div>
								<div class="img-box">
									<div class="property-label">
										<a href="#" class="property-label__type">Medium</a>
										
									</div>
									<a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a>
									<a href="single-property.php" class="img-box__image"><img src="assets/images/storage_5.jpg" alt="Property" class="img-responsive"></a>
								</div>
								<div class="property-content">
									<a href="single-property.php" class="property-title">Quae ipsum porro</a>
									<div class="property-address">
										2096 Monroe Street, Houston, 77030 USA
									</div>
									<div class="rating">
										<div class="stars pull-right">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span>115</span>
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="pagination">
					<a href="#" class="prev"></a>
					<span class="current">1</span>
					<a href="#" class="page">2</a>
					<a href="#" class="page">3</a>
					<a href="#" class="page">4</a>
					<a href="#" class="page">5</a>
					<a href="#" class="next"></a>
				</div>
			</div>

		</div>
	</div>

</section>
<?php $this->load->view('common/footer'); ?>	