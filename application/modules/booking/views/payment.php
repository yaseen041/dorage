<?php $this->load->view('common/header'); ?>	
<!-- ====== NEW BOOKING PAGE HEADER ====== -->
<section class="page-header">
   <div class="container">
      <h1 class="page-header-title">Payment</h1>
      <ul class="breadcrumb">
         <li><a href="<?php echo base_url(); ?>">Home</a></li>
         <li class="active">Payment</li>
      </ul>
   </div>
</section>
<!-- ====== NEW BOOKING CONTENT ====== -->
<section id="new-booking-page" class="page-section payment-form">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <!-- Content -->
            <div id="content">
               <!-- New Booking Box -->
               <div class="nb-box">
                  <!-- Info Detail Property -->
                  <h2 class="dark-sky" style="margin-top: 0px;">Booking Summary</h2>
                  <div class="nb-property-detail">
                     <div class="nb-property-image">
                        <img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($booking_detail['listings_id']); ?>" alt="Post list 1">
                     </div>
                     <div class="nb-property-info">
                        <h5 class="nb-property-name"> <?php echo strtoupper($booking_detail['title']); ?> </h5>
                        <strong class="nb-property-price">$<?php echo $booking_detail['list_price']; ?> <small>/day</small></strong>
                     </div>
                  </div>
                  <!-- Form New Booking -->
                  <div class="nb-form">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-12 col-sm-12">
                              <h3>Booking Dates</h3>
                              <span class="label label-success"><?php echo date("m/d/Y" , strtotime($booking_detail['booking_start'])); ?></span> to 
                              <span class="label label-danger"><?php echo date("m/d/Y" , strtotime($booking_detail['booking_end'])); ?></span> 
                              <h3 class="padd-top">Cancellation Policy</h3>
                              <ul class="list-unstyled">
                                 <p> cancellation within <?php echo get_cancellation_policy(get_meta_value('cancellation_policy' , @$booking_detail['listings_id'])); ?> hours.  </p>
                              </ul>
                              <?php if(get_section_content('insurance' , 'insurance_provide') == '1'){ ?>
                              <div class="row padd-top">
                                 <div class="col-md-8 col-sm-8 col-xs-6">
                                    <h4>Do you want to add an insurance to protect your goods?</h4>
                                    <a href="<?php echo base_url(); ?>insurance_detail" target="_blank"> More Detail <i class="fa fa-exclamation-circle"></i> </a>
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="btn-group" id="status" data-toggle="buttons" style="margin-top: 5px;">
                                       <span class="ins-yes choose_insurance">
                                          <input class="btn_toggle btn-xs" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox" id="insurance_check">
                                       </span>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <ul class="insurance-bullet" type="square">
                                       <p> <?php echo get_section_content('insurance' , 'insurance_statement'); ?> </p>
                                    </ul>
                                 </div>
                              </div>
                              <?php } ?>
                              <?php if(get_section_content('mover' , 'mover_provide') == '1'){ ?>
                              <div class="row padd-top">
                                 <div class="col-md-8 col-sm-8 col-xs-6">
                                    <h4>Needs help for moving? </h4>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">More Detail <i class="fa fa-exclamation-circle"></i></a>
                                 </div>
                                 <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="btn-group" id="status" data-toggle="buttons" style="margin-top: 5px;">
                                       <span class="mov-yes">
                                          <input class="btn_toggle btn-xs" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" type="checkbox" id="package_check">
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <div class="row moving-listing padd-top">
                                 <div class="col-md-12">
                                    <div class="tab-content">
                                       <div class="tab-pane fade in active" id="tab1default">
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

                                                         <label>Service Date:</label>
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
            </div>
         </div>
         <div class="col-md-4">
            <div class="nav nav-pills nav-stacked">
               <!-- widget Booking -->
               <div class="widget widget-booking">
                  <!-- Panel Box -->
                  <div class="panel-box">
                     <!-- Panel Header / Title -->
                     <div class="panel-header" id="price_summary_head">
                        <h3 class="panel-title">Price Summary</h3>
                     </div>
                     <!-- Panel Body -->
                     <div class="panel-body" id="payment_from_ajax">
                        <form id="payment_form" method="post" action="">
                           <div class="form-group">
                              <input type="hidden" id="booking_unique_id" name="booking_id" value="<?php echo $booking_detail['unique_id']; ?>">
                              <input type="hidden" name="insurance" id="insurance_input" value="0">
                              <input type="hidden" name="mover_needed" id="mover_needed" value="0">
                              <input type="hidden" name="package" id="package_input">
                              <input type="hidden" name="availability_dates" id="availability_dates" value="">
                              <input type="hidden" name="selected_crews" id="selected_crews" value="1">
                              <input type="hidden" name="selected_hours" id="selected_hours" value="1">
                              <input type="hidden" name="selected_mover_id" id="selected_mover_id" value="">
                              <div class="detials_ajax">
                                 <p class="form-control-static">Days<span class="value">
                                    <?php echo $booking_days; ?>
                                 </span>
                              </p>
                              <p class="form-control-static">Price/day <span class="value">$<?php echo $booking_detail['list_price']; ?></span>
                              </p>
                              <p class="form-control-static">Sales Tax <span class="value">$<?php echo $booking_detail['tax_amount']; ?></span></p>
                              <p class="form-control-static">Total Amount <span class="value">$<?php echo $booking_detail['total_amount']; ?> </span>
                              </p>
                              <input type="hidden" name="insurance_amount" value="0">
                              <input type="hidden" name="mover_package" value="0">
                              <input type="hidden" name="total_amount" value="<?php echo $booking_detail['total_amount']; ?>">
                           </div>
                           <hr>
                        </div>
                        <div class="form-group">
                           <button type="button" id="proceed_payment" class="btn btn-primary">Proceed to payment</button>
                        </div>
                     </form>
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
<?php
$this->load->view('common/footer');
?>
<script type="text/javascript">
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
   	startDate: new Date(),
   });
   $(document).on('click', '.search-btn-payment', function(){
   	var btn = $(this);
   	$('#availability_dates').val($('#datepickermover').val());
   	$('#selected_mover_id').val('');
   	$(btn).button('loading');
   	var value1 = $("#moverFormData").serialize();
      var value2 = $('#payment_form').serialize();
   	// console.log(form);
   	$.ajax({
   		url:"<?php echo base_url(); ?>booking/getMovers",
   		type:"post",
   		data:value1+"&"+value2,
   		dataType:"json",
   		success: function(status){
   			if (status.msg == "success") {

   				$("#movers_ajax").html(status.response);
               $(".detials_ajax").html(status.response2);

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
   
   $('body').on('change', '.moving_help', function(){ 
   	var mover_help = $(this).data('id');

   	$.ajax({
   		url:'<?php echo base_url(); ?>booking/get_movers',
   		type:'post',
   		data:{mover_help : mover_help},
   		dataType:'json',
   		success:function(status){
   			if(status.msg == 'success'){
   				$("#movers_ajax").html(status.response);

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
        }
     });
   });
   
   $('body').on('click' , '.choose_insurance' , function() {

   	var package = '';

   	if($('#package_check').is(":checked")) {
   		package = $("#package_input").val();
   	}

   	var insurance = '';

   	if($('#insurance_check').is(":checked")) {
   		insurance = '0';
   	} else {
   		insurance = '1';
   	}

   	$("#insurance_input").val(insurance);


   	var values = $('#payment_form').serialize();

   	$.ajax({
   		url:'<?php echo base_url(); ?>booking/get_detail',
   		type:'post',

   		data:values,

   		dataType:'json',
   		success:function(status){
   			if(status.msg=='success'){
   				$(".detials_ajax").html(status.response);
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
   		}
   	});
   });
   
   
   
   $('body').on('click' , '.choose_package' , function() {
   	
   	var package = $(this).val();

   	var insurance = '';

   	if($('#insurance_check').is(":checked")) {
   		insurance = '1';
   	} else {
   		insurance = '0';
   	}

   	$("#package_input").val(package);

   });
   $(document).on('click' , '.apply_mover_details' , function() {
   	var mover_id = $(this).attr('data-mover-id');
   	$('#selected_mover_id').val(mover_id);
   	var values = $('#payment_form').serialize();
      var thiss = $(this);
      $.ajax({
       url:'<?php echo base_url(); ?>booking/get_detail',
       type:'post',
       data:values,
       dataType:'json',
       success:function(status){
         if(status.msg=='success'){
           $(".detials_ajax").html(status.response);
           $(thiss).text('Deselect');
           $(".remove_mover_details").toggleClass('apply_mover_details remove_mover_details').text("Select");
           $(thiss).toggleClass('apply_mover_details remove_mover_details');

           $.gritter.add({
            title: 'Success!',
            sticky: false,
            time: '5000',
            before_open: function(){
               if($('.gritter-item-wrapper').length >= 3)
               {
                  return false;
               }
            },
            text: "Successfully selected.",
            class_name: 'gritter-success'
         });

           $([document.documentElement, document.body]).animate({
             scrollTop: $("#price_summary_head").offset().top
          }, 1000);


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
     }
  });
   });


   $(document).on('click' , '.remove_mover_details' , function() {
      $('#selected_mover_id').val('');
      var values = $('#payment_form').serialize();
      var thiss = $(this);
      $.ajax({
         url:'<?php echo base_url(); ?>booking/get_detail',
         type:'post',
         data:values,
         dataType:'json',
         success:function(status){
            if(status.msg=='success'){
               $(".detials_ajax").html(status.response);
               $(thiss).text('Select');
               $(thiss).toggleClass('apply_mover_details remove_mover_details');

              //  $([document.documentElement, document.body]).animate({
              //    scrollTop: $("#price_summary_head").offset().top
              // }, 1000);


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
        }
     });
   });
   
   
   // $(document).on('click' , '.apply_mover_details' , function() {

   // 	var package = $("#package_input").val();
   // 	var insurance = $("#insurance_input").val();
   
   // 	if( $('.mover_help_type:checked').attr('data-id') !== "0" ) {


   // 		if( $("#estimated_miles").val() === undefined || $("#estimated_miles").val() === null || $("#estimated_miles").val() === '' ) {
   // 			$.gritter.add({
   // 				title: 'Error!',
   // 				sticky: false,
   // 				time: '5000',
   // 				before_open: function(){
   // 					if($('.gritter-item-wrapper').length >= 3)
   // 					{
   // 						return false;
   // 					}
   // 				},
   // 				text: "Please enter estimated miles.",
   // 				class_name: 'gritter-error'
   // 			});
   // 			return false;
   // 		}
   
   
   // 	}
   
   // 	$.ajax({
   // 		url:'<?php echo base_url(); ?>booking/get_detail',
   // 		type:'post',
   // 		data:{package : package , insurance : insurance, unique_id : '<?php echo $booking_detail['unique_id']; ?>'},
   // 		dataType:'json',
   // 		success:function(status){
   // 			if(status.msg=='success'){
   // 				$(".detials_ajax").html(status.response);
   // 			} else if(status.msg == 'error'){
   // 				$.gritter.add({
   // 					title: 'Error!',
   // 					sticky: false,
   // 					time: '5000',
   // 					before_open: function(){
   // 						if($('.gritter-item-wrapper').length >= 3)
   // 						{
   // 							return false;
   // 						}
   // 					},
   // 					text: status.response,
   // 					class_name: 'gritter-error'
   // 				});
   // 			}
   // 		}
   // 	});
   
   // });
   
   $('body').on('click' , '#proceed_payment' , function() {

   	var values = $("#payment_form").serialize();

   	$.ajax({
   		url:'<?php echo base_url(); ?>booking/proceed_payment',
   		type:'post',
   		data:values,
   		dataType:'json',
   		success:function(status){
   			if(status.msg=='success'){
   				location.href = status.response;
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
   		}
   	});
   });
   
</script>

