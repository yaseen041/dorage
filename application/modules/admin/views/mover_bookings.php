<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Mover Bookings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>bookings/mover_completed" class="btn btn-primary">Completed Bookings</a>
        <a href="<?php echo admin_url(); ?>bookings/mover_cancelled" class="btn btn-primary">Cancelled Bookings</a>
      </div>
    </div>
    <div class="page-body">
      <div class="card">

        <div class="card-block">
          <div class="table-content crm-table">
            <div class="project-table">
              <table id="crm-contact" class="table table-striped dt-responsive nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>List Title</th>
                    <th>Service Date</th>
                    <th>No. of Crews</th>
                    <th>Crew Charges</th>
                    <th>No. of Hours</th>
                    <th>Total Amount</th>
                    <th>Refundable Amount</th>
                    <th>Paid Amount</th>
                    <th>Storage</th>
                    <th>Payment Status</th>
                    <th>Booking Status</th>
                    <th>Booking Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>


                  <?php foreach ($bookings as $book) { ?>

                  <tr>
                    <td>
                      <?php if($book['parent_id'] > 0) { ?> 
                      <?php echo $book['parent_id']; ?>
                      <?php } else { ?>
                      <?php echo $book['id']; ?>
                      <?php } ?>
                    </td>
                    <td><?php echo list_title($book['mover_id']); ?></td>

                    <td>
                      <label class="label label-success"><?php echo formatted_date($book['booking_start']); ?></label>
                    </td>

                    <td><?php echo $book['no_crews']; ?></td>
                    <td>
                      <?php echo "$".$book['crew_charges']; ?>/hour
                    </td>

                    <td><?php echo $book['no_hours']; ?></td>
                    <td class="font-weight-bold">$<?php if($book['parent_id'] > 0) { ?><?php echo $book['mover_price']; ?><?php } else { ?><?php echo $book['total_amount']; ?>
                      <?php } ?>

                    </td>
                    <td class="font-weight-bold">$<?php echo $book['refundable_mover']; ?>
                   </td>
                   <td class="font-weight-bold">$<?php if($book['parent_id'] > 0) { ?><?php echo $book['mover_price']+$book['refundable_mover']; ?><?php } else { ?><?php echo $book['paid_amount']; ?><?php } ?>
                   </td>

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
                    <?php if($book['payment_status']) { ?>
                    <label class="label label-success">
                      Paid
                    </label>
                    <?php } else { ?>
                    <label class="label label-danger">
                      Not paid
                    </label>
                    <?php } ?>

                  </td>
                  <td>
                    <?php if($book['booking_status'] == 1) { ?>
                    <label class="label label-success">
                      Success
                    </label>
                    <?php } else if($book['booking_status'] == 0) { ?>
                    <label class="label label-warning">
                      Pending
                    </label>
                    <?php } ?>
                  </td>
                  <td>
                    <?php echo formatted_date_time($book['booking_date']); ?>
                  </td>
                  <td>
                    <label class="btn btn-info btn-sm view_detail" data-id="<?php echo $book['unique_id']; ?>"> View Details </label>

                         <?php /* if($book['mover_payment_release'] == 0) { ?>
                        <label class="btn btn-inverse btn-sm releasePaymentToMover" data-id="<?php echo $book['id']; ?>"> Release payment for mover </label>
                        <?php } ?>

                        <?php if($book['customer_refund'] == 0) { ?>
                        <label class="btn btn-primary btn-sm releasePaymentToCustomer" data-id="<?php echo $book['id']; ?>"> Refund to customer </label>
                        <?php } */ ?>

                        
                        <label class="btn btn-success btn-sm markascomplete" data-id="<?php echo $book['unique_id']; ?>"> Mark as completed </label>

                        <?php if($book['parent_id'] > 0) { ?>

                        <label class="btn btn-danger btn-sm cancel_mover_booking" data-id="<?php echo $book['parent_id']; ?>" data-list-id="<?php echo $book['mover_id']; ?>"> Cancel Booking </label>
                        
                        <?php } else { ?>
                        
                        <label class="btn btn-danger btn-sm cancel_booking" data-id="<?php echo $book['id']; ?>" data-list-id="<?php echo $book['mover_id']; ?>"> Cancel Booking </label>
                        
                        <?php } ?>

                      </td>
                    </tr>
                    <?php } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>List Title</th>
                      <th>Booking Start/End</th>
                      <th>No. of Crews</th>
                      <th>Crew Charges</th>
                      <th>No. of Hours</th>
                      <th>Total Amount</th>
                      <th>Refundable Amount</th>
                      <th>Paid Amount</th>
                      <th>Storage</th>
                      <th>Payment Status</th>
                      <th>Booking Status</th>
                      <th>Booking Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
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


  <div class="modal fade" id="confirm-mover-cancel" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirm Cancel Booking</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>You are about to cancel one booking, this procedure is irreversible.</p>
          <p>Do you want to proceed?</p>
          <input type="hidden" id="cancel_mover_booking_id">

          <textarea name="mover_cancell_reason" id="mover_cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
          <span id="mover_cancell_reason_error" style="color: red;"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button class="btn btn-danger mover_cancel_now">Yes</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="confirm-cancel"" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Confirm Cancel Booking</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>You are about to cancel one booking, this procedure is irreversible.</p>
          <p>Do you want to proceed?</p>
          <input type="hidden" id="cancel_booking_id">
          <input type="hidden" id="cancel_list_id">
          <textarea name="cancell_reason" id="cancell_reason" placeholder="Please specify a reason of booking cancellation." class="form-control"></textarea>
          <span id="cancell_reason_error" style="color: red;"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button class="btn btn-danger cancel_now">Yes</button>
        </div>
      </div>
    </div>
  </div>



  <?php $this->load->view('common/admin_footer'); ?>

  <script type="text/javascript">


    $(document).on('click', '.cancel_booking' , function(e) {
      $("#cancel_booking_id").val($(this).attr('data-id'));
      $("#cancel_list_id").val($(this).attr('data-list-id'));
      $("#confirm-cancel").modal('show');

    });


    $(document).on('click', '.cancel_mover_booking' , function(e) {
     $("#cancel_mover_booking_id").val($(this).attr('data-id'));
     $("#confirm-mover-cancel").modal('show');
   });


    $(document).on('click', '.cancel_now' , function(e) {
      var booking_id = $("#cancel_booking_id").val();
      var list_id = $("#cancel_list_id").val();

      if($("#cancell_reason").val() == ''){

        $("#cancell_reason_error").text("Please specify a reason of booking cancellation.");

        return false;
      } else {
        $("#cancell_reason_error").text("");
      }

      $.ajax({
       url:'<?php echo admin_url(); ?>bookings/cancel_booking',
       type:'post',
       data:{ booking_id : booking_id , list_id : list_id , cancell_reason : $("#cancell_reason").val()},
       dataType:'json',
       success:function(status){

        if(status.msg=='success'){
          $("#confirm-cancel").modal('hide');
          if(status.msg == 'success'){
            swal({title: "Completed!", text: status.response, type: "success"},
             function(){ 
               location.reload();
             });
          }else if (status.msg = 'error'){
           swal("Cancelled", status.response, "error");
         }
       }

       else if(status.msg == 'error'){

         swal("Error", status.response, "error");
       }
     }
   });


    });


    $(document).on('click', '.releasePaymentToStorage', function(){
      var booking_id = $(this).attr('data-id');
      $.ajax({
        url:"<?php echo admin_url(); ?>bookings/getStoragePaymentModal",
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

    $(document).on('click', '.releasePaymentToMover', function(){
      var booking_id = $(this).attr('data-id');
      $.ajax({
        url:"<?php echo admin_url(); ?>bookings/getSingleMoverPaymentModal",
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

    $(document).on('click', '.releasePaymentToCustomer', function(){
      var booking_id = $(this).attr('data-id');
      $.ajax({
        url:"<?php echo admin_url(); ?>bookings/getMoverCustomerPaymentModal",
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


    $(document).on('click', '.mover_cancel_now' , function(e) {
     var booking_id = $("#cancel_mover_booking_id").val();

     if($("#mover_cancell_reason").val() == ''){

      $("#mover_cancell_reason_error").text("Please specify a reason of booking cancellation.");
      return false;

    } else {

      $("#mover_cancell_reason_error").text("");

    }

    $.ajax({
      url:'<?php echo admin_url(); ?>bookings/cancel_list_mover_booking',
      type:'post',
      data:{ booking_id : booking_id , cancell_reason : $("#mover_cancell_reason").val()},
      dataType:'json',
      success:function(status){

        if(status.msg=='success'){

          $("#confirm-mover-cancel").modal('hide');

          swal({title: "Completed!", text: status.response, type: "success"},
           function(){ 
             location.reload();
           });
        }

        else if(status.msg == 'error'){

          swal("Error", status.response, "error");

        }
      }
    });

  });


    $(document).on('click','.submitReleasePaymentCustomer ', function(){
      var btn = $(this);
      var form = $('#releasePaymentCustomerForm').serialize();
      $.ajax({
        url:"<?php echo admin_url(); ?>bookings/releasePaymentToMovercustomer",
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


    $(document).on('click','.submitReleasePaymentMover ', function(){
      var btn = $(this);
      var form = $('#releasePaymentMoverForm').serialize();
      $.ajax({
        url:"<?php echo admin_url(); ?>bookings/releasePaymentToSinglemover",
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

    $('body').on('click', '.markascomplete', function (event) {

      var booking_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You want to mark as completed this booking!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, complete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url:'<?php echo admin_url(); ?>bookings/mark_completed',
            type:'post',
            dataType: 'json',
            data:{ booking_id : booking_id },
            success:function(res){ 
              if(res.msg == 'success'){
                swal({title: "Completed!", text: res.response, type: "success"},
                 function(){ 
                   location.reload();
                 });
              }else if (res.msg = 'error'){
               swal("Cancelled", res.response, "error");
             }
           }
         });
        } else {
          swal("Cancelled", "", "error");
        }
      });
    });

    $(document).on('click', ".view_detail", function(e) {
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

  </script>