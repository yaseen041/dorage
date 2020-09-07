<?php $this->load->view('common/header'); ?>	
<!-- ====== NEW BOOKING PAGE HEADER ====== -->
<section class="page-header">
   <div class="container">
      <h1 class="page-header-title">Mover Booking Detail</h1>
      <ul class="breadcrumb">
         <li><a href="<?php echo base_url(); ?>">Home</a></li>
         <li class="active">Mover Booking Detail</li>
      </ul>
   </div>
</section>
<!-- ====== NEW BOOKING CONTENT ====== -->
<section id="new-booking-page" class="page-section payment-form">
   <div class="container">
      <div class="property-item booking-item property-archive col-lg-12 col-md-6 col-sm-6 no-padding">
         <div class="row">
            <div class="col-md-8 col-md-offset-2">
               <!-- Content -->
               <div id="content">
                  <!-- New Booking Box -->
                  <div class="nb-box">
                     <!-- Info Detail Property -->
                     <h2 class="dark-sky" style="margin-top: 0px;">Booking Details</h2>
                     <!-- <h2 class="dark-sky" style="margin-top: 0px;">Booking REF # <?php //echo $booking_detail['id']; ?></h2> -->
                     <!-- <small class="text-small"></small> -->
                     <!-- Form New Booking -->
                     
                     <div class="tab-pane row fade in nb-form bookings_list" id="tab1default">
                        <div class="property-item form-body booking-item booking_item_5 property-archive col-lg-12 col-md-6 col-sm-6 no-padding">

                           <div class="row">
                              <div class="col-lg-5">
                                 <a href="<?php echo base_url(); ?>details/mover/<?php echo $booking_detail['listings_unique_id'].'/'.dorage_url_title($booking_detail['title']); ?>" class="property-image listing-property-img" target="_blank">
                                    <img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($booking_detail['mover_id']); ?>" alt="Post list 1">
                                 </a>
                                 <!-- <a href="#" class="btn-compare" title="Add to favourite"><i class="fa fa-heart"></i></a> -->
                              </div>
                              <div class="col-lg-7">
                                 <div class="property-content listing-content">
                                    <h3 class="property-title">

                                       <a href="<?php echo base_url(); ?>details/mover/<?php echo $booking_detail['listings_unique_id'].'/'.dorage_url_title($booking_detail['title']); ?>" class="pull-left" target="_blank"><?php echo $booking_detail['title']; ?></a>

                                    </h3>

                                    <div class="row">
                                       <div class="col-md-6 text-center">
                                          <img src="<?php echo base_url(); ?>assets/images/worker-loading-boxes.png"> &nbsp;Loading
                                       </div>

                                       <div class="col-md-6">
                                          <img src="<?php echo base_url(); ?>assets/images/moving-truck.png"> &nbsp;Moving
                                       </div>
                                    </div> <br>
                                    <div class="property-address">
                                       <?php echo $booking_detail['place']; ?>
                                    </div>
                                    <div class="rating">
                                       <?php $listingReviews = getapprovedListingRating($booking_detail['orignal_list_id'], 'mover'); ?>
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
                                    <p class="property-description">
                                       <?php echo $booking_detail['description']; ?>
                                    </p>
                                    
                                    <p>
                                       <strong>Selected Hours:</strong> <?php echo $booking_detail['no_hours']; ?>
                                       <br>
                                       
                                       <?php $charge = $booking_detail['crew_charges']; ?>

                                       <strong>Charge Per Crew:</strong> $<?php echo $charge; ?>/hour
                                       <br>
                                       <strong>Total Charges: </strong> $<?php echo $charge*$booking_detail['no_crews']*($booking_detail['no_hours']+1); ?> 
                                       <br>

                                       <strong>Refundable Amount: </strong> $<?php echo $charge*$booking_detail['no_crews']; ?> 
                                    </p>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-check">
                                       <a href="<?php echo base_url(); ?>make_payment/mover_paypal/<?php echo $booking_detail['unique_id']; ?>" style="margin-top: 15px;" class="btn btn-info btn-sm  pull-right"> Proceed to payment </a>
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
<!-- Modal -->
<div id="myModal" class="modal fade table-popup" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Mover Price Calculation Information</h4>
         </div>
         <div class="modal-body">
            <p class="text-center">
               <b>
                  Below table is to give you an idea of how many Crew members you will need & how many hours it will take to shift your storage.
               </b>
            </p>
            <div class="table-responsive">
               <table class="table" id="border_1"> 
                  <thead class="tabl_head">
                     <tr class="row-head">
                        <th class="column-1"><p class="text-center">sq.ft</p></th>
                        <th class="column-2"><p class="text-center">2 Persons</p></th>
                        <th class="column-3"><p class="text-center">3 Persons</p></th>
                        <th class="column-4"><p class="text-center">4 Persons</p></th>
                     </tr>
                  </thead>
                  <tbody class="row-hover">
                     <tr class="row-2 even" role="row">
                        <td class="column-1"><p class="text-center">Under 300</p></td>
                        <td class="column-2"><p class="text-center">1 hour</p></td>
                        <td class="column-3"><p class="text-center">1 hour</p></td>
                        <td class="column-4"><p class="text-center">N/A</p></td>
                     </tr>
                     <tr class="row-3 odd" role="row">
                        <td class="column-1"><p class="text-center">300-800</p></td>
                        <td class="column-2"><p class="text-center">2 hours</p></td>
                        <td class="column-3"><p class="text-center">2 hours</p></td>
                        <td class="column-4"><p class="text-center">N/A</p></td>
                     </tr>
                     <tr class="row-4 even" role="row">
                        <td class="column-1"><p class="text-center">800-1000</p></td>
                        <td class="column-2"><p class="text-center">2 hours</p></td>
                        <td class="column-3"><p class="text-center">2 hours</p></td>
                        <td class="column-4"><p class="text-center">N/A</p></td>
                     </tr>
                     <tr class="row-5 odd" role="row">
                        <td class="column-1"><p class="text-center">1000-1500</p></td>
                        <td class="column-2"><p class="text-center">3 hours</p></td>
                        <td class="column-3"><p class="text-center">2-3 hours</p></td>
                        <td class="column-4"><p class="text-center">2 hours</p></td>
                     </tr>
                     <tr class="row-6 even" role="row">
                        <td class="column-1"><p class="text-center">1500-2000</p></td>
                        <td class="column-2"><p class="text-center">4 hours</p></td>
                        <td class="column-3"><p class="text-center">3-4 hours</p></td>
                        <td class="column-4"><p class="text-center">2-3 hours</p></td>
                     </tr>
                     <tr class="row-7 odd" role="row">
                        <td class="column-1"><p class="text-center">2000-3000</p></td>
                        <td class="column-2"><p class="text-center">6 hours</p></td>
                        <td class="column-3"><p class="text-center">4-5 hours</p></td>
                        <td class="column-4"><p class="text-center">3-4 hours</p></td>
                     </tr>
                     <tr class="row-8 even" role="row">
                        <td class="column-1"><p class="text-center">3000-4000</p></td>
                        <td class="column-2"><p class="text-center">6-8 hours</p></td>
                        <td class="column-3"><p class="text-center">5-6 hours</p></td>
                        <td class="column-4"><p class="text-center">4-5 hours</p></td>
                     </tr>
                     <tr class="row-9 odd" role="row">
                        <td class="column-1"><p class="text-center">4000+</p></td>
                        <td class="column-2"><p class="text-center">10+ hours</p></td>
                        <td class="column-3"><p class="text-center">8-10 hours</p></td>
                        <td class="column-4"><p class="text-center">6-8 hours</p></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <p class="text-center">
               <b>
                  If a Mover needs to drive from your first location to your second location you will need to figure drive time into your requested hours.
               </b>  
            </p>  
            <table class="table" id="border_2">
               <thead class="tabl_head">
                  <tr>
                     <th class="column-1" id="width"><p class="text-center">Distance</p></th>
                     <th><p class="text-center">Time</p></th>
                  </tr>
               </thead>
               <tr class="row-1 even">
                  <td class="column-1" id="width"><p class="text-center">10-40 Miles</p></td>
                  <td class="column-2"><p class="text-center"><small>1/2</small> Hours</p></td>
               </tr> 
               <tr class="row-2 odd">
                  <td class="column-1" id="width"><p class="text-center">40-75 Miles</p></td>
                  <td class="column-2"><p class="text-center">1-2 Hours</p></td>
               </tr> 
               <tr class="row-3 even">
                  <td class="column-1" id="width"><p class="text-center">75-100 Miles</p></td>
                  <td class="column-2"><p class="text-center">2-3 Hours</p></td>
               </tr>  
            </table>   
            <p class="text-center">
               <b>
                  Distance from your place to the mover vehicle factors into the time needed to complete the job.
               </b>
            </p> 
            <table class="table" id="border_3">
               <thead class="tabl_head">
                  <tr>
                     <th class="column-1" id="width"><p class="text-center">Distance</p></th>
                     <th><p class="text-center">Time</p></th>
                  </tr>
               </thead>
               <tr class="row-1 even">
                  <td class="column-1" id="width"><p class="text-center">Under 20 ft</p></td>
                  <td class="column-2"><p class="text-center">0 Hours</p></td>
               </tr> 
               <tr class="row-2 odd">
                  <td class="column-1" id="width"><p class="text-center">20-50 ft</p></td>
                  <td class="column-2"><p class="text-center"><small>1/2</small>-1 Hours</p></td>
               </tr> 
               <tr class="row-3 even">
                  <td class="column-1" id="width"><p class="text-center">50+ ft</p></td>
                  <td class="column-2"><p class="text-center">1-2 Hours</p></td>
               </tr>  
            </table> 
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="confirm-booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Proceed to booking</h4>
         </div>

         <div class="modal-body">
            <p>Are you sure you want to proceed to booking with selected mover company?</p>
         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-default cancelBookingProceed" data-dismiss="modal">No</button>
            <button class="btn btn-danger proceedBooking">Yes</button>
         </div>
      </div>
   </div>
</div>
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
   var globalMoverID = 0;
   $(document).on('change', '#number_of_hours', function(){
      $('#selected_hours').val($("#number_of_hours").val());
   });
   $(document).on('change', '#number_of_people', function(){
      $('#selected_crews').val($("#number_of_people").val());
   });
   $("#datepickermover").dateRangePicker({
      format: "YYYY-MM-DD",
      autoClose: !0,
      showShortcuts: !1,
      singleMonth: !0,
      startDate: date
   });
   $(document).on('click', '.search-btn-payment', function(){
      var btn = $(this);
      $(btn).button('loading');
      var form = $("#moverFormData").serialize();
      $.ajax({
         url:"<?php echo base_url(); ?>movers/getMovers",
         type:"post",
         data:form,
         dataType:"json",
         success: function(status){
            if (status.msg == "success") {
               $("#movers_ajax").html(status.response);
            }else{
               $.gritter.add({
                  title: 'Error!',
                  sticky: false,
                  time: '5000',
                  before_open: function(){
                     if($('.gritter-item-wrapper').length >= 3)
                     {
                        return false;
                     }
                  },
                  text: status.response,
                  class_name: 'gritter-error'
               });
            }
            $(btn).button('reset');
         }
      });
   });

   $(document).on('click' , '.apply_mover_details' , function() {
      globalMoverID = $(this).attr('data-mover-id');
      $('#confirm-booking').modal('show');
   });
   $(document).on('click','.cancelBookingProceed', function(){
      globalMoverID = 0;
   });
   $(document).on('click','.proceedBooking', function(){
      var btn = $(this);
      $(btn).button('loading');
      var mover_id = globalMoverID;
      var form = $("#moverFormData").serialize();
      $.ajax({
         url:'<?php echo base_url(); ?>movers/createBooking',
         type:'post',
         data:"listing_id="+mover_id+"&"+form,
         dataType:'json',
         success:function(status){
            if(status.msg=='success'){
               window.location = status.response;
            } else if(status.msg == 'error'){
               $.gritter.add({
                  title: 'Error!',
                  sticky: false,
                  time: '5000',
                  before_open: function(){
                     if($('.gritter-item-wrapper').length >= 3)
                     {
                        return false;
                     }
                  },
                  text: status.response,
                  class_name: 'gritter-error'
               });
            }
            $(btn).button('reset');
         }
      });
   });
</script>
