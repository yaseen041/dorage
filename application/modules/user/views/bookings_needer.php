<?php $this->load->view('common/header'); ?>
<!-- Edit Profile -->
<section class="panel-bg">
	<div class="container">
		<div class="row">
			<?php $this->load->view('common/dashboard_sidebar'); ?>
			<div class="col-md-9">
				<?php if(!empty(get_session('booking_success'))) { ?>
				<div class="alert alert-success">
					<b>THANK YOU FOR BOOKING WITH US</b><br>
					<?php echo get_session('booking_success'); ?>
				</div>
				<?php unset_session('booking_success'); } ?>
				<div class="panel with-nav-tabs panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1default" data-toggle="tab">Storage Bookings</a></li>
							<?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>
							<li><a href="#tab2default" data-toggle="tab">Mover Bookings</a></li>
							<?php } ?>
						</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active bookings_list" id="tab1default">

								<div class="panel with-nav-tabs panel-default">
									<div class="panel-heading">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#storagetab1" data-toggle="tab">Active</a></li>
											<li><a href="#storagetab2" data-toggle="tab">Completed</a></li>
											<li><a href="#storagetab3" data-toggle="tab">Cancelled</a></li>
											<li><a href="#storagetab4" data-toggle="tab">Refunded</a></li>
										</ul>
									</div>
									<div class="panel-body">
										<div class="tab-content">

		<div class="tab-pane fade in active bookings_list" id="storagetab1">
			<?php if(empty($comp_bookings)): ?>
				<p> Booking not found. </p>
			<?php endif; ?>
			<?php foreach ($comp_bookings as $list): ?>
				<div class="property-item booking-item booking_item_<?php echo $list['booking_id']; ?> property-archive col-lg-12 col-md-6 col-sm-12 no-padding">
					<div class="row">
						<div class="col-lg-5">
							<a href="javascript:void(0)" class="property-image listing-property-img">
								<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['listings_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
							</a>
						</div>
						<div class="col-lg-7">
							<div class="property-content listing-content">
								<div class="row">
									<div class="col-md-6">
										<h5 class="property-title">
											Booking REF #<?php echo $list['booking_id']; ?>
										</h5>
									</div>
									<div class="col-md-6 popover-txt-right">
										<?php $customer = "Name : ".$list['first_name']." ".$list['last_name']."<br> Phone : ".$list['phone']."<br> Email : ".$list['email']; ?>
										<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
									</div>
									<div class="col-md-12">
										<h3 class="property-title">
											<?php echo $list['title']; ?>
											<span class="label label-success">
												<?php echo get_storage_type(get_booked_meta_value('space_storage_type' , @$list['listings_id'])); ?>
											</span>
										</h3>
									</div>
								</div>
								<div class="property-address">
									<p>
										<?php echo $list['place']; ?>
									</p>
								</div>
								<p>
									Booking From
									<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span> to 
									<span class="label label-danger">
										<?php echo date("m/d/Y" , strtotime($list['booking_end'])); ?>
									</span>
								</p>
								<div class="row">
									<div class="col-md-6">
										<p>
											<span>
												Paid amount : $<?php echo $list['total_amount']; ?>
											</span>
										</p>
									</div>
									<div class="col-md-6">
										<?php if($list['insurance_needed']){ ?>
										<p>
											<span>Insurance charges : $<?php echo $list['insurance_amount']; ?>
											</span>
										</p>
										<?php } ?>
									</div>
								</div>                                       
								<div class="row">
									<div class="col-md-12">
										<?php if($list['mover_needed'] == 1 && check_mover_status($list['booking_id']) == 1){ ?>
										<span class="property-label">
											<a href="javascript:void(0)" class="btn btn-info get_mover_detail" data-booking-id="<?php echo $list['booking_id']; ?>" style="font-size: 9px;">
												Mover Details
											</a>
										</span>
										<?php } ?>
										<?php $time_dif = get_time_difference($list['booking_date']);
										$cancel_time = get_cancellation_policy(get_booked_meta_value('cancellation_policy' , @$list['listings_id']));

										if($time_dif < $cancel_time) { ?> 

										<?php if($list['mover_needed'] == 1 && check_mover_status($list['booking_id']) == 1 && cancel_status($list['booking_id'])){ ?>

										<span class="property-label">
											<a href="javascript:void(0)" class="btn btn-danger cancel_mover_booking" data-id="<?php echo $list['booking_id']; ?>" data-list-id="<?php echo $list['listings_id']; ?>" style="font-size: 9px;"> Cancel Mover  </a>
										</span>

										<?php } ?>

										<span class="property-label">
											<a href="javascript:void(0)" class="btn btn-danger cancel_booking" data-id="<?php echo $list['booking_id']; ?>" style="font-size: 9px;"> Cancel Storage </a>
										</span>


										<span class="property-label">
											<a href="javascript:void(0)" class="btn btn-info storageReview" data-id="<?php echo $list['booking_id']; ?>" style="font-size: 9px;"> Storage Comment </a>
										</span>

										<?php } ?>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>


					<div class="tab-pane fade bookings_list" id="storagetab2">

						<?php if(empty($completed_bookings)): ?>
							<p> Booking not found. </p>
						<?php endif; ?>

						<?php foreach ($completed_bookings as $list): ?>
							<div class="property-item booking-item booking_item_<?php echo $list['booking_id']; ?> property-archive col-lg-12 col-md-6 col-sm-12 no-padding">
								<div class="row">
									<div class="col-lg-5">
										<a href="javascript:void(0)" class="property-image listing-property-img">
											<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['listings_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
										</a>
									</div>
									<div class="col-lg-7">
										<div class="property-content listing-content">
											<div class="row">
												<div class="col-md-6">
													<h5 class="property-title">
														Booking REF #<?php echo $list['booking_id']; ?>
													</h5>
												</div>
												<div class="col-md-6 popover-txt-right">
													<?php $customer = "Name : ".$list['first_name']." ".$list['last_name']."<br> Phone : ".$list['phone']."<br> Email : ".$list['email']; ?>
													<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
												</div>
												<div class="col-md-12">
													<h3 class="property-title">
														<?php echo $list['title']; ?>
														<span class="label label-success">
															<?php echo get_storage_type(get_booked_meta_value('space_storage_type' , @$list['listings_id'])); ?>
														</span>
													</h3>
												</div>
											</div>
											<div class="property-address">
												<p>
													<?php echo $list['place']; ?>
												</p>
											</div>
											<p>
												Booking From
												<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span> to 
												<span class="label label-danger">
													<?php echo date("m/d/Y" , strtotime($list['booking_end'])); ?>
												</span>
											</p>
											<div class="row">
												<div class="col-md-6">
													<p>
														<span>
															Paid amount : $<?php echo $list['total_amount']; ?>
														</span>
													</p>
												</div>
												<div class="col-md-6">
													<?php if($list['insurance_needed']){ ?>
													<p>
														<span>Insurance charges : $<?php echo $list['insurance_amount']; ?>
														</span>
													</p>
													<?php } ?>
												</div>
											</div>                                       
											<div class="row">
												<div class="col-md-12">
													<?php if($list['mover_needed']){ ?>
													<span class="property-label">
														<a href="javascript:void(0)" class="btn btn-info get_mover_detail" data-booking-id="<?php echo $list['booking_id']; ?>">
															Mover Details
														</a>
													</span>
													<?php } ?>

													<?php $review = getUserReview($list['booking_id']);
													if (empty($review)) { ?>

													<span class="property-label">
														<a href="javascript:void(0)" class="btn btn-success bookingReview" data-id="<?php echo $list['booking_id']; ?>" data-orignal-id="<?php echo $list['orignal_list_id']; ?>">
															Leave Booking Review
														</a>
													</span>
													<?php }else{ ?>
													<br>
													<strong>Your Review:</strong>
													<br>
													<select class="reviewStars">
														<option <?php echo ($review['stars'] == 1)?"selected":""; ?> value="1">1</option>
														<option <?php echo ($review['stars'] == 2)?"selected":""; ?> value="2">2</option>
														<option <?php echo ($review['stars'] == 3)?"selected":""; ?> value="3">3</option>
														<option <?php echo ($review['stars'] == 4)?"selected":""; ?> value="4">4</option>
														<option <?php echo ($review['stars'] == 5)?"selected":""; ?> value="5">5</option>
													</select>
													<p class="more"><?php echo nl2br($review['review']); ?></p>
													<?php } ?>

												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>


					</div>


											<div class="tab-pane fade bookings_list" id="storagetab3">

												<?php if(empty($cancel_bookings)): ?>
													<p> Booking not found. </p>
												<?php endif; ?>
												<?php foreach ($cancel_bookings as $list): ?>
													<div class="property-item booking-item booking_item_<?php echo $list['booking_id']; ?> property-archive col-lg-12 col-md-6 col-sm-12 no-padding">
														<div class="row">
															<div class="col-lg-5">
																<a href="javascript:void(0)" class="property-image listing-property-img">
																	
																	<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['listings_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
																</a>
															</div>
															<div class="col-lg-7">
																<div class="property-content listing-content">
																	<div class="row">
																		<div class="col-md-6">
																			<h5 class="property-title">
																				Booking REF # <?php echo $list['booking_id']; ?>
																			</h5>
																		</div>
																		<div class="col-md-6 popover-txt-right">
																			<?php $customer = "Name : ".$list['first_name']." ".$list['last_name']."<br> Phone : ".$list['phone']."<br> Email : ".$list['email']; ?>
																			<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>

																		</div>
																		<div class="col-md-12">
																			<h3 class="property-title">
																				<?php echo $list['title']; ?>
																				<span class="label label-success">
																					<?php echo get_storage_type(get_booked_meta_value('space_storage_type' , @$list['listings_id'])); ?>
																				</span>
																			</h3>
																		</div>
																	</div>
																	<div class="property-address">
																		<p>
																			<?php echo $list['place']; ?>
																		</p>
																	</div>
																	<p>
																		Booking From
																		<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?> </span> to 
																		<span class="label label-danger">
																			<?php echo date("m/d/Y" , strtotime($list['booking_end'])); ?>
																		</span>
																	</p>
																	<div class="row">
																		<div class="col-md-6">
																			<p>
																				<span>
																					Paid amount : $<?php echo $list['total_amount']; ?>
																				</span>
																			</p>
																		</div>
																		<div class="col-md-6">
																			<?php if($list['insurance_needed']){ ?>
																			<p>
																				<span>Insurance charges : $<?php echo $list['insurance_amount']; ?>
																				</span>
																			</p>
																			<?php } ?>
																		</div>
																	</div>                          
																	<div class="row">
																		<div class="col-md-12">
																			<?php if($list['mover_needed']){ ?>
																			<span class="property-label">
																				<a href="javascript:void(0)" class="btn btn-info get_mover_detail" data-booking-id="<?php echo $list['booking_id']; ?>">
																					Mover Details
																				</a>
																			</span>
																			<?php } ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php endforeach; ?>

											</div>

											<div class="tab-pane fade bookings_list" id="storagetab4">

												<?php if(empty($refund_bookings)): ?>
													<p> Booking not found. </p>
												<?php endif; ?>

												<?php foreach ($refund_bookings as $list): ?>
													<div class="property-item booking-item booking_item_<?php echo $list['booking_id']; ?> property-archive col-lg-12 col-md-6 col-sm- no-padding">
														<div class="row">
															<div class="col-lg-5">
																<a href="javascript:void(0)" class="property-image listing-property-img">
																	<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['listings_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
																</a>
															</div>
															<div class="col-lg-7">
																<div class="property-content listing-content">
																	<div class="row">
																		<div class="col-md-6">
																			<h5 class="property-title">
																				Booking REF #<?php echo $list['booking_id']; ?>
																			</h5>
																		</div>
																		<div class="col-md-6 popover-txt-right">
																			<?php $customer = "Name : ".$list['first_name']." ".$list['last_name']."<br> Phone : ".$list['phone']."<br> Email : ".$list['email']; ?>
																			<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
																		</div>
																		<div class="col-md-12">
																			<h3 class="property-title">
																				<?php echo $list['title']; ?>
																				<span class="label label-success">
																					<?php echo get_storage_type(get_booked_meta_value('space_storage_type' , @$list['listings_id'])); ?>
																				</span>
																			</h3>
																		</div>
																	</div>
																	<div class="property-address">
																		<p>
																			<?php echo $list['place']; ?>
																		</p>
																	</div>
																	<p>
																		Booking From
																		<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span> to 
																		<span class="label label-danger">
																			<?php echo date("m/d/Y" , strtotime($list['booking_end'])); ?>
																		</span>
																	</p>
																	<div class="row">
																		<div class="col-md-6">
																			<p>
																				<span>
																					Paid amount : $<?php echo $list['total_amount']; ?>
																				</span>
																			</p>
																		</div>
																		<div class="col-md-6">
																			<?php if($list['insurance_needed']){ ?>
																			<p>
																				<span>Insurance charges : $<?php echo $list['insurance_amount']; ?>
																				</span>
																			</p>
																			<?php } ?>
																		</div>
																	</div>                                       
																	<div class="row">
																		<div class="col-md-12">
																			<?php if($list['mover_needed']){ ?>
																			<span class="property-label">
																				<a href="javascript:void(0)" class="btn btn-info get_mover_detail" data-booking-id="<?php echo $list['booking_id']; ?>">
																					Mover Details
																				</a>
																			</span>
																			<?php } ?>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php endforeach; ?>

											</div>

										</div>
									</div>
								</div>

							</div>
							<?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>
							<div class="tab-pane fade bookings_list" id="tab2default">

								<div class="panel with-nav-tabs panel-default">
									<div class="panel-heading">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#moverbookingtab1" data-toggle="tab">Active</a></li>
											<li><a href="#moverbookingtab2" data-toggle="tab">Completed</a></li>
											<li><a href="#moverbookingtab3" data-toggle="tab">Cancelled</a></li>
											<li><a href="#moverbookingtab4" data-toggle="tab">Refunded</a></li>

										</ul>
									</div>
									<div class="panel-body">
										<div class="tab-content">

					<div class="tab-pane fade bookings_list active in" id="moverbookingtab1">

						<?php if(empty($mover_bookings)): ?>
							<p> Booking not found. </p>
						<?php endif; ?>

						<?php foreach ($mover_bookings as $list): ?>
							<div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
								<div class="row">
									<div class="col-lg-5">
										<a href="javascript:void(0)" class="property-image listing-property-img">

											<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
										</a>
									</div>
									<div class="col-lg-7">
										<div class="property-content listing-content">
											<div class="row">
												<div class="col-md-6">
													<h5 class="property-title">
														Booking REF #
														<?php if(!empty($list['parent_id'])){

															echo $list['parent_id'];

														} else {
															echo $list['booking_id'];
														}  ?>
													</h5>
												</div>
												<div class="col-md-6 popover-txt-right">
													<?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
													<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
												</div>
											</div>
											<h3 class="property-title">
												<?php echo $list['title']; ?>
											</h3>
											<p>
												Service Date
												<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span> 

											</p>
											<p>
												<h5>No. of crews : <span class="label label-info"><?php echo $list['no_crews']; ?></span></h5>
											</p>
											<p>
												<h5>Crew charges/hour : <span class="label label-info">$<?php echo $list['crew_charges']; ?></span> </h5>
											</p>
											<p>
												<h5>No. of hours : <span class="label label-info"><?php echo $list['no_hours']; ?></span> </h5>
											</p>
											<p>
												<h5>Total Amount : <span class="label label-info">$<?php if(!empty($list['parent_id'])){

													echo $list['mover_price']+$list['refundable_mover'];

												} else {

													echo $list['total_amount'];

												}  ?>

											</span> </h5>
										</p>

										<p>
											<h5>Refundable Amount : <span class="label label-info">$<?php echo $list['refundable_mover']; ?></span> </h5>
										</p>

										<?php if(cancel_mover_status($list['booking_id'])) { ?> 

										<span class="property-label">
											<a href="javascript:void(0)" class="btn btn-danger cancel_mover_only_booking" data-id="<?php echo $list['booking_id']; ?>" data-mover-id="<?php echo $list['mover_id']; ?>"> Cancel Booking </a>
										</span>

										<?php } ?>


									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

				</div>

										<div class="tab-pane fade bookings_list" id="moverbookingtab2">

											<?php if(empty($completed_mover_bookings)): ?>
												<p> Booking not found. </p>
											<?php endif; ?>

											<?php foreach ($completed_mover_bookings as $list): ?>


												<div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
													<div class="row">
														<div class="col-lg-5">
															<a href="javascript:void(0)" class="property-image listing-property-img">
																
																<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>

															</a>
														</div>
														<div class="col-lg-7">
															<div class="property-content listing-content">
																<div class="row">
																	<div class="col-md-6">
																		<h5 class="property-title">
																			Booking REF #
																			<?php if(!empty($list['parent_id'])){

																				echo $list['parent_id'];

																			} else {
																				echo $list['booking_id'];
																			}  ?>
																		</h5>
																	</div>
																	<div class="col-md-6 popover-txt-right">
																		<?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
																		<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
																	</div>
																</div>
																<h3 class="property-title">
																	<?php echo $list['title']; ?>
																</h3>
																<p>
																	Service Date
																	<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span>
																</p>
																<p>
																	<h5>No. of crews : <span class="label label-info"><?php echo $list['no_crews']; ?></span></h5>
																</p>
																<p>
																	<h5>Crew charges/hour : <span class="label label-info">$<?php echo $list['crew_charges']; ?></span> </h5>
																</p>
																<p>
																	<h5>No. of hours : <span class="label label-info"><?php echo $list['no_hours']; ?></span> </h5>
																</p>
																<p>
																	<h5>Total Amount : <span class="label label-info">$<?php if(!empty($list['parent_id'])){

																		echo $list['mover_price']+$list['refundable_mover'];

																	} else {

																		echo $list['total_amount'];

																	}  ?>

																</span> </h5>
															</p>

															<p>
																<h5>Refundable Amount : <span class="label label-info">$<?php echo $list['refundable_mover']; ?></span> </h5>
															</p>

															<?php $review = getUserReview($list['booking_id']);
															if (empty($review)) { ?>
															<a href="javascript:void(0)" class="label label-success bookingReview" data-id="<?php echo $list['booking_id']; ?>" data-orignal-id="<?php echo $list['orignal_list_id']; ?>">Leave Booking Review</a>
															<?php }else{ ?>
															<strong>Your Review:</strong>
															<select class="reviewStars">
																<option <?php echo ($review['stars'] == 1)?"selected":""; ?> value="1">1</option>
																<option <?php echo ($review['stars'] == 2)?"selected":""; ?> value="2">2</option>
																<option <?php echo ($review['stars'] == 3)?"selected":""; ?> value="3">3</option>
																<option <?php echo ($review['stars'] == 4)?"selected":""; ?> value="4">4</option>
																<option <?php echo ($review['stars'] == 5)?"selected":""; ?> value="5">5</option>
															</select>
															<p class="more"><?php echo nl2br($review['review']); ?></p>
															<?php } ?>


														</div>
													</div>
												</div>
											</div>


										<?php endforeach; ?>

									</div>

									<div class="tab-pane fade bookings_list" id="moverbookingtab3">

										<?php if(empty($mover_cancelled)): ?>
											<p> Booking not found. </p>
										<?php endif; ?>

										<?php foreach ($mover_cancelled as $list): ?>
											<div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
												<div class="row">
													<div class="col-lg-5">
														<a href="javascript:void(0)" class="property-image listing-property-img">
															
															<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
														</a>
													</div>
													<div class="col-lg-7">
														<div class="property-content listing-content">
															<div class="row">
																<div class="col-md-6">
																	<h5 class="property-title">
																		Booking REF #
																		<?php if(!empty($list['parent_id'])){

																			echo $list['parent_id'];

																		} else {
																			echo $list['booking_id'];
																		}  ?>
																	</h5>
																</div>
																<div class="col-md-6 popover-txt-right">
																	<?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
																	<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
																</div>
															</div>
															<h3 class="property-title">
																<?php echo $list['title']; ?>
															</h3>
															<p>
																Service Date
																<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span> 

															</p>
															<p>
																<h5>No. of crews : <span class="label label-info"><?php echo $list['no_crews']; ?></span></h5>
															</p>
															<p>
																<h5>Crew charges/hour : <span class="label label-info">$<?php echo $list['crew_charges']; ?></span> </h5>
															</p>
															<p>
																<h5>No. of hours : <span class="label label-info"><?php echo $list['no_hours']; ?></span> </h5>
															</p>
															<p>
																<h5>Refundable Amount : <span class="label label-info">$<?php if(!empty($list['parent_id'])){
																	echo $list['mover_price']+$list['refundable_mover'];
																} else {
																	echo $list['total_amount'];
																}  ?> 
															</span> </h5>
														</p>

													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>


								</div>

								<div class="tab-pane fade bookings_list" id="moverbookingtab4">


									<?php if(empty($refunded_mover_bookings)): ?>
										<p> Booking not found. </p>
									<?php endif; ?>

									<?php foreach ($refunded_mover_bookings as $list): ?>
										<div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
											<div class="row">
												<div class="col-lg-5">
													<a href="javascript:void(0)" class="property-image listing-property-img">
														
														<div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;"></div>
													</a>
												</div>
												<div class="col-lg-7">
													<div class="property-content listing-content">
														<div class="row">
															<div class="col-md-6">
																<h5 class="property-title">
																	Booking REF #
																	<?php if(!empty($list['parent_id'])){

																		echo $list['parent_id'];

																	} else {
																		echo $list['booking_id'];
																	}  ?>
																</h5>
															</div>
															<div class="col-md-6 popover-txt-right">
																<?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
																<a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Owner Detail" data-trigger="hover">Owner Detail</a>
															</div>
														</div>
														<h3 class="property-title">
															<?php echo $list['title']; ?>
														</h3>
														<p>
															Service Date
															<span class="label label-success"><?php echo date("m/d/Y" , strtotime($list['booking_start'])); ?></span>

														</p>
														<p>
															<h5>No. of crews : <span class="label label-info"><?php echo $list['no_crews']; ?></span></h5>
														</p>
														<p>
															<h5>Crew charges/hour : <span class="label label-info">$<?php echo $list['crew_charges']; ?></span> </h5>
														</p>
														<p>
															<h5>No. of hours : <span class="label label-info"><?php echo $list['no_hours']; ?></span> </h5>
														</p>
														<p>
															<h5>Total Amount : <span class="label label-info">$<?php echo $list['mover_price']+$list['refundable_mover']; ?></span> </h5>
														</p>

													</div>
												</div>
											</div>
										</div>
									<?php endforeach; ?>


								</div>

							</div>
						</div>
					</div>

				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</div>
</div>		
</section>
<!-- Modal -->
<div class="modal fade" id="moverDetailModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close close-login" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Mover Details</h4>
			</div>
			<div class="modal-body mover_detail_ajax">
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirm-mover-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirm Cancel Mover Booking</h4>
			</div>
			<div class="modal-body">
				<p>You are about to cancel mover booking, this procedure is irreversible.</p>
				<p>Do you want to proceed?</p>
				<input type="hidden" id="cancel_mover_booking_id">
				<textarea name="mover_cancell_reason" id="mover_cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-danger cancel_mover_now">Yes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirm-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirm Cancel Booking</h4>
			</div>
			<div class="modal-body">
				<p>You are about to cancel one booking, this procedure is irreversible.</p>
				<p>Do you want to proceed?</p>
				<input type="hidden" id="cancel_booking_id">
				<textarea name="cancell_reason" id="cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-danger cancel_now">Yes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="storage_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Storage Review</h4>
			</div>
			<div class="modal-body">
				<form id="reviewForm">
					<div class="form-group">
						<textarea class="form-control" placeholder="Enter your review" name="review"></textarea>
					</div>
					<div class="form-group">
						<span class="text-muted text-small" style="font-size: 12px">Note: If you have any issue related to storage, you can enter your review for admins. Admin will not release the payment until your issue is clear.</span>
					</div>
					<input type="hidden" id="booking_id" name="booking_id">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default closeReview" data-dismiss="modal">Close</button>
				<button class="btn btn-danger submitReview">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="booking_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Booking Review</h4>
			</div>
			<div class="modal-body">
				<form id="bookingReviewForm">
					<div class="form-group">
						<label>Rating</label>
						<select id="stars" name="stars">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="form-group">
						<label>Review</label>
						<textarea class="form-control" placeholder="Enter your review" name="review"></textarea>
					</div>
					<input type="hidden" id="booking_id_2" name="booking_id">
					<input type="hidden" id="orignal_list_id" name="orignal_list_id">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default closeBookingReview" data-dismiss="modal">Close</button>
				<button class="btn btn-danger submitBookingReview">Submit</button>
			</div>
		</div>
	</div>
</div>




<div class="modal fade" id="confirm-only-mover-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirm Cancel Booking</h4>
			</div>
			<div class="modal-body">
				<p>You are about to cancel one booking, this procedure is irreversible.</p>
				<p>Do you want to proceed?</p>  
				<input type="hidden" name="cancel_only_mover_booking" id="cancel_only_mover_booking">
				<input type="hidden"  name="cancel_only_mover_id" id="cancel_only_mover_id">
				<textarea name="mover_only_cancell_reason" id="mover_only_cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button class="btn btn-danger only_mover_cancel_now">Yes</button>
			</div>
		</div>
	</div>
</div>



<!-- Edit Profile End-->
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
	var showChar = 100;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();
		if(content.length > showChar) {
			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);
			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
			$(this).html(html);
		}
	});
	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
	$('#stars').barrating({
		theme: 'css-stars'
	});
	$('.reviewStars').barrating({
		theme: 'css-stars',
		readonly: true
	});
	$('.popoverData').popover();
	$(document).on('click', '.get_mover_detail', function(){
		var booking_id = $(this).attr('data-booking-id');
		$.ajax({
			url:'<?php echo base_url(); ?>user/get_mover_detail',
			type:'post',
			data:{ booking_id : booking_id },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$(".mover_detail_ajax").html(status.response);
					$("#moverDetailModal").modal('show');
				}
				else if(status.msg == 'error'){
				}
			}
		});
	});

	$(document).on('click', '.cancel_booking' , function(e) {
		$("#cancel_booking_id").val($(this).attr('data-id'));
		$("#confirm-cancel").modal('show');

	});

	$(document).on('click', '.cancel_mover_booking' , function(e) {
		$("#cancel_mover_booking_id").val($(this).attr('data-id'));
		$("#confirm-mover-cancel").modal('show');
	});


	$(document).on('click', '.cancel_mover_only_booking' , function(e) {
		$("#cancel_only_mover_booking").val($(this).attr('data-id'));
		$("#cancel_only_mover_id").val($(this).attr('data-mover-id'));
		$("#confirm-only-mover-cancel").modal('show');
	});

	
	$(document).on('click', '.cancel_booking' , function(e) {
		$("#cancel_booking_id").val($(this).attr('data-id'));
		$("#cancel_list_id").val($(this).attr('data-list-id'));
		$("#confirm-cancel").modal('show');

	});
	
	$(document).on('click', '.storageReview' , function(e) {
		$("#booking_id").val($(this).attr('data-id'));
		$("#storage_review").modal('show');
	});
	
	$(document).on('click', '.bookingReview' , function(e) {
		$("#booking_id_2").val($(this).attr('data-id'));
		$("#orignal_list_id").val($(this).attr('data-orignal-id'));
		$("#booking_review").modal('show');
	});
	
	$(document).on('click', '.closeReview' , function(e) {
		$('#reviewForm')[0].reset();
	});
	
	$(document).on('click', '.closeBookingReview' , function(e) {
		$('#bookingReviewForm')[0].reset();
	});
	
	$(document).on('click', '.submitBookingReview' , function(e) {
		var form = $('#bookingReviewForm').serialize();
		$.ajax({
			url:'<?php echo base_url(); ?>user/bookingRating',
			type:'post',
			data:form,
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});
					$("#booking_review").modal('hide');
					$('#bookingReviewForm')[0].reset();
					setTimeout(function(){
						location.reload(true);
					},1000);
				}
				else if(status.msg == 'error'){
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});
				}
			}
		});
	});
	$(document).on('click', '.submitReview' , function(e) {
		var form = $('#reviewForm').serialize();
		$.ajax({
			url:'<?php echo base_url(); ?>user/bookingReview',
			type:'post',
			data:form,
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});
					$("#storage_review").modal('hide');
					$('#reviewForm')[0].reset();
				}
				else if(status.msg == 'error'){
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});
				}
			}
		});
	});

	$(document).on('click', '.cancel_now' , function(e) {
		var booking_id = $("#cancel_booking_id").val();

		if($("#cancell_reason").val() == ''){
			$.gritter.add({
				title: 'Error!',
				sticky: false,
				time: '5000',
				before_open: function () {
					if ($('.gritter-item-wrapper').length >= 3)
					{
						return false;
					}
				},
				text: "Please specify a reason of booking cancellation.",
				class_name: 'gritter-error'
			});

			return false;
		}

		$.ajax({
			url:'<?php echo base_url(); ?>user/needer_cancel_booking',
			type:'post',
			data:{ booking_id : booking_id , cancell_reason : $("#cancell_reason").val()},
			dataType:'json',
			success:function(status){

				if(status.msg=='success'){

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

					$("#confirm-cancel").modal('hide');

					$(".booking_item_"+booking_id).hide();

					setTimeout(function(){
						location.reload(true);
					},1000);
					
				}

				else if(status.msg == 'error'){

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});

				}
			}
		});
	});

	$(document).on('click', '.cancel_mover_now' , function(e) {
		var booking_id = $("#cancel_mover_booking_id").val();

		if($("#mover_cancell_reason").val() == ''){
			$.gritter.add({
				title: 'Error!',
				sticky: false,
				time: '5000',
				before_open: function () {
					if ($('.gritter-item-wrapper').length >= 3)
					{
						return false;
					}
				},
				text: "Please specify a reason of booking cancellation.",
				class_name: 'gritter-error'
			});

			return false;
		}

		$.ajax({
			url:'<?php echo base_url(); ?>user/needer_cancel_mover_booking',
			type:'post',
			data:{ booking_id : booking_id , cancell_reason : $("#mover_cancell_reason").val()},
			dataType:'json',
			success:function(status){

				if(status.msg=='success'){

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

					$("#confirm-mover-cancel").modal('hide');

					setTimeout(function(){
						location.reload(true);
					},1000);

					// $(".booking_item_"+booking_id).hide();
				}

				else if(status.msg == 'error'){

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});

				}
			}
		});
	});




	$(document).on('click', '.only_mover_cancel_now' , function(e) {
		var booking_id = $("#cancel_only_mover_booking").val();
		var mover_id = $("#cancel_only_mover_id").val();

		if($("#mover_only_cancell_reason").val() == ''){
			$.gritter.add({
				title: 'Error!',
				sticky: false,
				time: '5000',
				before_open: function () {
					if ($('.gritter-item-wrapper').length >= 3)
					{
						return false;
					}
				},
				text: "Please specify a reason of booking cancellation.",
				class_name: 'gritter-error'
			});

			return false;
		}

		$.ajax({
			url:'<?php echo base_url(); ?>user/needer_cancel_only_mover_booking',
			type:'post',
			data:{ booking_id : booking_id , mover_id : mover_id , cancell_reason : $("#mover_only_cancell_reason").val()},
			dataType:'json',
			success:function(status){

				if(status.msg=='success'){

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

					$("#confirm-only-mover-cancel").modal('hide');

					// $(".booking_item_"+booking_id).hide();
					setTimeout(function(){
						location.reload(true);
					},1000);
				}

				else if(status.msg == 'error'){

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '5000',
						before_open: function () {
							if ($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});

				}
			}
		});

	});


</script>