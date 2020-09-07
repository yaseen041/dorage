<?php $this->load->view('common/header'); ?>	
<!-- ====== NEW BOOKING PAGE HEADER ====== -->
<section class="page-header">
   <div class="container">
      <h1 class="page-header-title">Search Movers</h1>
      <ul class="breadcrumb">
         <li><a href="<?php echo base_url(); ?>">Home</a></li>
         <li class="active">Search Movers</li>
      </ul>
   </div>
</section>
<!-- ====== NEW BOOKING CONTENT ====== -->
<section id="new-booking-page" class="page-section payment-form">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <!-- Content -->
            <div id="content">
               <!-- New Booking Box -->
               <div class="nb-box">
                  <!-- Info Detail Property -->
                  <h2 class="dark-sky" style="margin-top: 0px;">Search Movers</h2>
                  <p>To get detail of how many mover helpers you need <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal"> Click here. </a></p>
                  <!-- Form New Booking -->
                  <div class="nb-form">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-12 col-sm-12">
                              <div class="row">
                                 <div class="col-md-12">
                                    <form class="form-horizontal" id="moverFormData" action="" method="post">
                                       <div class="form-group">

                                          <div class="col-md-6">
                                             <label>State:</label>

                                             <select class="form-control index-control" name="mover_state" id="mover_state" required>
                                                <option value="">Select State</option>
                                                <?php foreach (get_states() as $state) { ?>
                                                <option value="<?php echo $state['id']; ?>"> <?php echo $state['name']; ?> </option>
                                                <?php } ?>
                                             </select> 
                                          </div>
                                          <div class="col-md-6">
                                             <label>Location:</label>
                                             <input type="text" id="property_loc" name="location" class="form-control" value="" placeholder="Enter a Location (optional)">
                                             <input name="lat_long" id="property_lat_long" type="hidden" value="">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <div class="col-md-4">
                                             <label>Availability:</label>
                                             <input type="text" id="datepickermover" name="mover_date" class="form-control" placeholder="Enter date">
                                          </div>
                                          <div class="col-md-4">
                                             <label>Number of Crew:</label>
                                             <select class="form-control" name="number_of_people" id="number_of_people">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5+">5+</option>
                                             </select>
                                             <!-- <input type="number" id="number_of_people" name="number_of_people" min="1" class="form-control" placeholder="Crew members"> -->
                                          </div>
                                          <div class="col-md-4">
                                             <label>Number of Hours:</label>
                                             <select class="form-control" id="number_of_hours" name="number_of_hours">
                                                <?php for ($i=1; $i <= 20 ; $i++) { ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                          <div class="col-md-12">
                                             <button class="search-btn-payment btn pull-right m-t-10" type="button"><i class="fa fa-search"></i> Search</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div id="movers_ajax">
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
      format: "MM/DD/YYYY",
      autoClose: !0,
      singleDate: true,
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
