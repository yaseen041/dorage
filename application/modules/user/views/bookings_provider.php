

<?php $this->load->view('common/header'); ?>
<!-- Edit Profile -->
<section class="panel-bg">
   <div class="container">
      <div class="row">
         <?php $this->load->view('common/dashboard_sidebar'); ?>
         <div class="col-md-9">
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
                              </ul>
                           </div>
                           <div class="panel-body">
                              <div class="tab-content">
                                 <div class="tab-pane fade in active bookings_list" id="storagetab1">
                                    <?php if (empty($comp_bookings)): ?>
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
                                                         <?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
                                                         <a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Customer Detail" data-trigger="hover">Customer Detail</a>
                                                      </div>
                                                      <div class="col-md-12">
                                                         <h3 class="property-title">
                                                            <?php echo $list['title']; ?>
                                                            <span class="label label-success">
                                                               <?php echo get_storage_type(get_booked_meta_value('space_storage_type', @$list['listings_id'])); ?>
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
                                                   <p>
                                                      Booking Days

                                                      <?php 

                                                      $date1 = date_create($list['booking_start']);
                                                      $date2 = date_create($list['booking_end']);

                                                      //difference between two dates
                                                      $diff = date_diff($date1,$date2);

                                                      //count days
                                                      $booking_days = $diff->format("%a") + 1;

                                                      ?>
                                                      <span class="label label-success"><?php echo $booking_days; ?>

                                                      </span>
                                                   </p>
                                                   <div class="row">
                                                      <div class="col-md-8">
                                                         <p>
                                                            <span>
                                                               Storage Charges :$<?php echo $list['list_total']; ?>
                                                            </span>
                                                         </p>
                                                         <?php $time_dif = get_time_difference($list['booking_date']);
                                                         $cancel_time = get_cancellation_policy(get_booked_meta_value('cancellation_policy' , @$list['listings_id']));
                                                         if($time_dif < $cancel_time) { ?> 
                                                         <span class="property-label">
                                                            <a href="javascript:void(0)" class="btn btn-danger cancel_booking" data-id="<?php echo $list['booking_id']; ?>" data-list-id="<?php echo $list['listings_id']; ?>"> Cancel Booking </a>
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
                                    <?php if (empty($completed_bookings)): ?>
                                       <p> Booking not found. </p>
                                       <?php
                                       endif; ?>
                                       <?php foreach ($completed_bookings as $list): ?>
                                          <div class="property-item booking-item booking_item_<?php echo $list['booking_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
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
                                                            <?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
                                                            <a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Customer Detail" data-trigger="hover">Customer Detail</a>
                                                         </div>
                                                         <div class="col-md-12">
                                                            <h3 class="property-title">
                                                               <?php echo $list['title']; ?>
                                                               <span class="label label-success">
                                                                  <?php echo get_storage_type(get_booked_meta_value('space_storage_type', @$list['listings_id'])); ?>
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
                                                      <p>
                                                         Booking Days

                                                         <?php 

                                                         $date1 = date_create($list['booking_start']);
                                                         $date2 = date_create($list['booking_end']);

                                                      //difference between two dates
                                                         $diff = date_diff($date1,$date2);

                                                      //count days
                                                         $booking_days = $diff->format("%a") + 1;

                                                         ?>
                                                         <span class="label label-success"><?php echo $booking_days; ?>

                                                         </span>
                                                      </p>
                                                      <div class="row">
                                                         <div class="col-md-8">
                                                            <p>
                                                               <span>
                                                                  Storage Charges : $<?php echo $list['list_total']; ?>
                                                               </span>
                                                            </p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       <?php endforeach; ?>
                                    </div>

                                    <div class="tab-pane fade bookings_list" id="storagetab3">
                                       <?php if (empty($cancel_bookings)): ?>
                                          <p> Booking not found. </p>
                                          <?php
                                          endif; ?>
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
                                                                  Booking REF #<?php echo $list['booking_id']; ?>
                                                               </h5>
                                                            </div>
                                                            <div class="col-md-6 popover-txt-right">
                                                               <?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
                                                               <a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Customer Detail" data-trigger="hover">Customer Detail</a>
                                                            </div>
                                                            <div class="col-md-12">
                                                               <h3 class="property-title">
                                                                  <?php echo $list['title']; ?>
                                                                  <span class="label label-success">
                                                                     <?php echo get_storage_type(get_booked_meta_value('space_storage_type', @$list['listings_id'])); ?>
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

                                                         <p>
                                                            Booking Days

                                                            <?php 

                                                            $date1 = date_create($list['booking_start']);
                                                            $date2 = date_create($list['booking_end']);

                                                      //difference between two dates
                                                            $diff = date_diff($date1,$date2);

                                                      //count days
                                                            $booking_days = $diff->format("%a") + 1;

                                                            ?>
                                                            <span class="label label-success"><?php echo $booking_days; ?>

                                                            </span>
                                                         </p>

                                                         <div class="row">
                                                            <div class="col-md-8">
                                                               <p>
                                                                  <span>
                                                                     Storage Charges : $<?php echo $list['list_total']; ?>
                                                                  </span>
                                                               </p>
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

                                    </ul>
                                 </div>
                                 <div class="panel-body">
                                    <div class="tab-content">

         <div class="tab-pane fade bookings_list active in" id="moverbookingtab1">
            <?php if (empty($mover_active)): ?>
               <p> Booking not found. </p>
               <?php
               endif; ?>
               <?php foreach ($mover_active as $list): ?>
                  <div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
                     <div class="row">
                        <div class="col-lg-5">
                           <a href="javascript:void(0)" class="property-image listing-property-img">
                              <div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;">
                              </div>
                           </a>
                        </div>
                        <div class="col-lg-7">
                           <div class="property-content listing-content">
                              <div class="row">
                                 <div class="col-md-6">
                                    <h5 class="property-title">
                                       Booking REF #
                                       <?php if($list['parent_id'] > 0) { ?> 
                                       <?php echo $list['parent_id']; ?>
                                       <?php } else { ?>
                                       <?php echo $list['booking_id']; ?>
                                       <?php } ?>
                                       
                                    </h5>
                                 </div>
                                 <div class="col-md-6 popover-txt-right">
                                    <?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
                                    <a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Customer Detail" data-trigger="hover">Customer Detail</a>
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
                                 <h5>Total Amount : <span class="label label-info">$<?php echo $list['mover_price']; ?></span> </h5>
                              </p>
                              
                              <?php if(cancel_mover_status($list['booking_id'])) { ?> 

                              <span class="property-label">
                                 <a href="javascript:void(0)" class="btn btn-danger cancel_mover_booking" data-id="<?php echo $list['booking_id']; ?>" data-mover-id="<?php echo $list['mover_id']; ?>"> Cancel Booking </a>
                              </span>

                              <?php } ?>

                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                  endforeach; ?>
               </div>

               <div class="tab-pane fade bookings_list" id="moverbookingtab2">
                  <?php if (empty($mover_completed)): ?>
                     <p> Booking not found. </p>
                     <?php
                     endif; ?>
                     <?php foreach ($mover_completed as $list): ?>
                        <div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
                           <div class="row">
                              <div class="col-lg-5">
                                 <a href="javascript:void(0)" class="property-image listing-property-img">
                                    <div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;">
                              </div>

                                 </a>
                              </div>
                              <div class="col-lg-7">
                                 <div class="property-content listing-content">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <h5 class="property-title">
                                             Booking REF #<?php if($list['parent_id'] > 0) { ?> 
                                             <?php echo $list['parent_id']; ?>
                                             <?php } else { ?>
                                             <?php echo $list['booking_id']; ?>
                                             <?php } ?>
                                          </h5>
                                       </div>
                                       <div class="col-md-6 popover-txt-right">
                                          <?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
                                          <a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Customer Detail" data-trigger="hover">Customer Detail</a>
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
                                       <h5>Total Amount : <span class="label label-info">$<?php echo $list['mover_price']; ?></span> </h5>
                                    </p>
                                    
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
                        endforeach; ?>
                     </div>

                     <div class="tab-pane fade bookings_list" id="moverbookingtab3">
                        <?php if (empty($mover_cancelled)): ?>
                           <p> Booking not found. </p>
                           <?php
                           endif; ?>
                           <?php foreach ($mover_cancelled as $list): ?>
                              <div class="property-item booking-item booking_item_<?php echo $list['mover_id']; ?> property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
                                 <div class="row">
                                    <div class="col-lg-5">
                                       <a href="javascript:void(0)" class="property-image listing-property-img">

                                          <div style="background-image: url('<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($list['mover_id']); ?>'); background-size: cover; background-position: center; height:270px; width:100%;background-repeat: no-repeat;">
                                          </div>

                                       </a>
                                    </div>
                                    <div class="col-lg-7">
                                       <div class="property-content listing-content">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <h5 class="property-title">
                                                   Booking REF #<?php if($list['parent_id'] > 0) { ?> 
                                                   <?php echo $list['parent_id']; ?>
                                                   <?php } else { ?>
                                                   <?php echo $list['booking_id']; ?>
                                                   <?php } ?>
                                                </h5>
                                             </div>
                                             <div class="col-md-6 popover-txt-right">
                                                <?php $customer = "Name : " . $list['first_name'] . " " . $list['last_name'] . "<br> Phone : " . $list['phone'] . "<br> Email : " . $list['email']; ?>
                                                <a class="popoverData" href="javascript:void(0)" data-content="<?php echo $customer; ?>" rel="popover" data-placement="bottom" data-html="true" data-original-title="Customer Detail" data-trigger="hover">Customer Detail</a>
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
                                             <h5>Total Amount : <span class="label label-info">$<?php echo $list['mover_price']; ?></span> </h5>
                                          </p>

                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php
                              endforeach; ?>
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
                                    <input type="hidden" name="cancel_booking_id" id="cancel_booking_id">
                                    <input type="hidden" name="cancel_list_id" id="cancel_list_id">
                                    <textarea name="cancell_reason" id="cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button class="btn btn-danger cancel_now">Yes</button>
                                 </div>
                              </div>
                           </div>
                        </div>


                        <div class="modal fade" id="confirm-mover-cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <input type="hidden" id="cancel_mover_id">
                                    <textarea name="mover_cancell_reason" id="mover_cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button class="btn btn-danger mover_cancel_now">Yes</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Edit Profile End-->
                        <?php $this
                        ->load
                        ->view('common/footer'); ?>
                        <script type="text/javascript">
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
                            $("#cancel_list_id").val($(this).attr('data-list-id'));
                            $("#confirm-cancel").modal('show');
                         });

                           $(document).on('click', '.cancel_mover_booking' , function(e) {
                            $("#cancel_booking_id").val($(this).attr('data-id'));
                            $("#cancel_mover_id").val($(this).attr('data-mover-id'));
                            $("#confirm-mover-cancel").modal('show');
                         });

                           $(document).on('click', '.cancel_now' , function(e) {
                            var booking_id = $("#cancel_booking_id").val();
                            var list_id = $("#cancel_list_id").val();

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
                             url:'<?php echo base_url(); ?>user/owner_cancel_booking',
                             type:'post',
                             data:{ booking_id : booking_id , list_id : list_id , cancell_reason : $("#cancell_reason").val()},
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



                           $(document).on('click', '.mover_cancel_now' , function(e) {
                            var booking_id = $("#cancel_booking_id").val();
                            var mover_id = $("#cancel_mover_id").val();

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
                             url:'<?php echo base_url(); ?>user/owner_cancel_mover_booking',
                             type:'post',
                             data:{ booking_id : booking_id , mover_id : mover_id , cancell_reason : $("#mover_cancell_reason").val()},
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

                               $(".booking_item_"+mover_id).hide();

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

