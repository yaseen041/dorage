<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Released Bookings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>bookings" class="btn btn-primary">Back to Bookings</a>
      </div>
    </div>
    <div class="page-body">

      <hr>
      <div class="col-lg-12 col-xl-12">                                  
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs setting-tabs" role="tablist">
          <li class="nav-item col-lg-6">
            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Storage</a>
          </li>
          <li class="nav-item col-lg-6">
            <a class="nav-link" data-toggle="tab" id="mover_tab" href="#profile3" role="tab">Mover</a>
          </li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content card-block">
          <div class="tab-pane active" id="home3" role="tabpanel" aria-expanded="true">
            <div class="card">
              <div class="card-block">
                <div class="table-content crm-table1">
                  <div class="project-table">
                    <table id="crm-contact" class="table table-striped dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>List Title</th>
                          <th>Booking Start/End</th>
                          <th>Booking Days</th>
                          <th>Price/day</th>
                          <th>Insurance Charges</th>
                          <th>Mover Needed</th>
                          <th>Total Amount</th>
                          <th>Trans ID</th>
                          <th>Paid Amount</th>
                          <th>Payer Email</th>
                          <th>Payment Status</th>

                          <th>Cancelled By</th>
                          <th>Reason</th>
                          <th>Booking Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php if(empty($bookings)) { ?>
                        <tr>
                          <td colspan="15" style="color: red;">Bookings not found.</td>
                        </tr>
                        <?php } ?>

                        <?php foreach ($bookings as $book) {  ?>

                        <tr>
                          <td><?php echo $book['id']; ?></td>
                          <td><?php echo list_title($book['listings_id']); ?></td>

                          <td>
                            <label class="label label-success"><?php echo formatted_date($book['booking_start']); ?></label>/
                            <label class="label label-danger"><?php echo formatted_date($book['booking_end']); ?></label>
                          </td>
                          <td>
                            <?php
                            $date1 = date_create($book['booking_start']);
                            $date2 = date_create($book['booking_end']);

                      //difference between two dates
                            $diff = date_diff($date1,$date2);

                      //count days
                            $booking_days = $diff->format("%a") + 1;
                            echo $booking_days;
                            ?>
                          </td>

                          <td>$<?php echo $book['list_price']; ?></td>
                          <td>
                            <?php if($book['insurance_needed']){ echo "$".$book['insurance_amount']; } else{ ?> $0 <?php  } ?>
                          </td>
                          <td>
                            <?php if($book['mover_needed']){ ?>
                            <label class="label label-success"> Yes </label>
                            <?php } else { ?>
                            <label class="label label-danger"> No </label>
                            <?php  } ?>
                          </td>
                          <td class="font-weight-bold">$<?php echo $book['total_amount']; ?></td>
                          <td><?php echo $book['trx_id']; ?></td>
                          <td class="font-weight-bold">$<?php echo $book['paid_amount']; ?></td>
                          <td><?php echo $book['payer_email']; ?></td>

                          <td>
                            <label class="label label-success">
                              Released
                            </label>
                          </td>
                          
                          <td>

                            <?php if(!empty($book['cancelled_by'])) { if($book['cancelled_by'] == 0 ) { ?>
                            <label class="label label-success">
                              Provider
                            </label>
                            <?php } elseif($book['cancelled_by'] == 1) { ?>
                            <label class="label label-info">
                              Needer
                            </label>
                            <?php } elseif($book['cancelled_by'] == 2) { ?>
                            <label class="label label-danger">
                              Admin
                            </label>
                            <?php } } ?>


                          </td>
                          <td>
                            <?php echo wordwrap($book['cancell_reason'] , 200, "<br />\n");?>
                          </td>
                          <td>
                            <?php echo formatted_date_time($book['booking_date']); ?>
                          </td>
                          <td>

                            <label class="btn btn-info btn-sm view_detail" data-id="<?php echo $book['unique_id']; ?>"> View Details </label>

                          </td>
                        </tr>

                        <?php } ?>

                      </tbody>
                      <tfoot>
                        <tr>
                          <th>ID</th>
                          <th>List Title</th>
                          <th>Booking Start/End</th>
                          <th>Booking Days</th>
                          <th>Price/day</th>
                          <th>Insurance Charges</th>
                          <th>Mover Needed</th>
                          <th>Total Amount</th>
                          <th>Trans ID</th>
                          <th>Paid Amount</th>
                          <th>Payer Email</th>
                          <th>Payment Status</th>

                          <th>Cancelled By</th>
                          <th>Reason</th>
                          <th>Booking Date</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>


          </div>
          <div class="tab-pane" id="profile3" role="tabpanel" aria-expanded="false">

            <div class="card">
              <div class="card-block">
                <div class="table-content crm-table">
                  <div class="project-table">
                    <table id="crm-contact1" class="table table-striped dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>List Title</th>
                          <th>Service Date</th>
                          <th>No. of Crews</th>
                          <th>Crew Charges</th>
                          <th>No. of Hours</th>
                          <th>Total Amount</th>
                          <th>Paid Amount</th>
                          <th>Storage</th>
                          <th>Payment Status</th>
                          
                          <th>Booking Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>


                        <?php foreach ($mover_bookings as $book) { ?>
                        <tr>
                          <td>
                            <?php if($book['parent_id'] > 0) { ?> 
                            <?php echo $book['parent_id']; ?>
                            <?php } else { ?>
                            <?php echo $book['id']; ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?php echo list_title($book['mover_id']); ?>
                            <?php if($book['booking_status'] == 1) { ?>
                            <label class="label label-success">
                              Success
                            </label>
                            <?php } else if($book['booking_status'] == 2) { ?>
                            <label class="label label-info">
                              Completed
                            </label>
                            <?php } else if($book['booking_status'] == 3) { ?>
                            <label class="label label-danger">
                              Cancelled

                              <?php if($book['cancelled_by'] == 0) { ?>
                              By Provider
                              <?php } elseif($book['cancelled_by'] == 1) { ?>
                              By Needer
                              <?php } elseif($book['cancelled_by'] == 2) { ?>
                              By Admin
                              <?php } ?>
                            </label>
                            <?php } else if($book['booking_status'] == 0) { ?>
                            <label class="label label-warning">
                              Pending
                            </label>
                            <?php } ?>


                          </td>

                          <td>
                            <label class="label label-success"><?php echo formatted_date($book['booking_start']); ?></label>
                          </td>

                          <td><?php echo $book['no_crews']; ?></td>
                          <td>
                            <?php echo "$".$book['crew_charges']; ?>/hour
                          </td>

                          <td class="font-weight-bold"><?php echo $book['no_hours']; ?></td>
                          <td>$<?php echo $book['mover_price']; ?></td>
                          <td class="font-weight-bold">$<?php echo $book['mover_price']; ?></td>
                          <td>
                           <?php if($book['parent_id'] > 0) { ?>
                           <label class="label label-primary">
                             Linked
                           </label>
                           <?php } else { ?>
                           <label class="label label-danger">
                             NA
                           </label>
                           <?php } ?>
                         </td>

                         <td>

                          <label class="label label-success">
                            Released
                          </label>

                        </td>
                        
                        <td>
                          <?php echo formatted_date_time($book['booking_date']); ?>
                        </td>
                        <td>
                          <label class="btn btn-info btn-sm mover_view_detail" data-id="<?php echo $book['unique_id']; ?>"> View Details </label>

                        </td>
                      </tr>
                      <?php } ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>List Title</th>
                        <th>Service Date</th>
                        <th>No. of Crews</th>
                        <th>Crew Charges</th>
                        <th>No. of Hours</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Storage</th>
                        <th>Payment Status</th>

                        <th>Booking Date</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Container-fluid ends -->
  </div>
</div>
</div>


<!-- large modal -->
<div class="modal fade" id="releasePaymentModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">

</div>

<!-- large modal -->
<div class="modal fade" id="bookingDetailModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Booking Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="booking_detail">


      </div>
      
    </div>
  </div>
</div>

<?php $this->load->view('common/admin_footer'); ?>

<script type="text/javascript">

  $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
    $.fn.dataTable.tables( {visible: true, api: true, responsive: true } ).responsive.recalc();
  });

  $("#crm-contact1").css("width", "100%");

  $(document).on('click', '.releasePaymentToCustomer', function(){
    var booking_id = $(this).attr('data-id');
    $.ajax({
      url:"<?php echo admin_url(); ?>bookings/getCustomerrefundPaymentModal",
      data:{ booking_id : booking_id },
      type:"post",
      dataType:"json",
      success:function(res){
        if(res.msg == 'success'){
          $("#releasePaymentModal").html(res.response).modal('show');
        }
      }
    });
  });


  $(document).on('click', ".mover_view_detail", function(e) {
    var booking_id = $(this).attr('data-id');

    $.ajax({
      url:'<?php echo admin_url(); ?>bookings/mover_booking_detail',
      type:'post',
      dataType: 'json',
      data:{ booking_id : booking_id },
      success:function(res){ 
        if(res.msg == 'success'){
          $("#booking_detail").html(res.response);
          $("#bookingDetailModal").modal('show');
        }else if (res.msg = 'error'){
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
          text: res.response,
          class_name: 'gritter-error'
        });
       }
     }
   });

  });
  

  $(document).on('click','.submitReleasePaymentCustomer ', function(){
    var btn = $(this);
    var form = $('#releasePaymentCustomerForm').serialize();
    $.ajax({
      url:"<?php echo admin_url(); ?>bookings/releasePaymentTocustomer",
      data:form,
      type:"post",
      dataType:"json",
      success:function(res){
        if(res.msg == 'success'){
          $("#releasePaymentModal").modal('hide');
          swal({title: "Success!", text: res.response, type: "success"},
           function(){ 
             location.reload();
           });
        }else if (res.msg = 'error'){
          $("#releasePaymentModal").modal('hide');
          swal({
            html:true,
            title:"Error",
            text: res.response,
            type: "error"
          });
        }
      }
    });
  });


  $(document).on('click','.submitRefundBooking', function(){
    var btn = $(this);
    var form = $('#refundBookingForm').serialize();
    $.ajax({
      url:"<?php echo base_url(); ?>admin/bookings/refundBooking",
      data:form,
      type:"post",
      dataType:"json",
      success:function(res){
        if(res.msg == 'success'){
          $("#refundBookingModal").modal('hide');
          swal({title: "Success!", text: res.response, type: "success"},
           function(){ 
             location.reload();
           });
        }else if (res.msg = 'error'){
          $("#refundBookingModal").modal('hide');
          swal({
            html:true,
            title:"Error",
            text: res.response,
            type: "error"
          });
        }
      }
    })
  });

  $(document).on('click', ".view_detail", function(e) {
    var booking_id = $(this).attr('data-id');

    $.ajax({
      url:'<?php echo admin_url(); ?>bookings/booking_detail',
      type:'post',
      dataType: 'json',
      data:{ booking_id : booking_id },
      success:function(res){ 
        if(res.msg == 'success'){
          $("#booking_detail").html(res.response);
          $("#bookingDetailModal").modal('show');
        }else if (res.msg = 'error'){
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
          text: res.response,
          class_name: 'gritter-error'
        });
       }
     }
   });

  });

</script>