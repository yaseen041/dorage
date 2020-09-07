<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Storage Bookings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>bookings/completed" class="btn btn-primary">Completed Bookings</a>
        <a href="<?php echo admin_url(); ?>bookings/cancelled" class="btn btn-primary">Cancelled Bookings</a>
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
                    <th>Booking Start/End</th>
                    <th>Booking Days</th>
                    <th>Price/day</th>
                    <th>Storage Amount</th>
                    <th>Insurance Charges</th>
                    <th>Mover Needed</th>
                    <th>Total Amount</th>
                    <th>Trans ID</th>
                    <th>Paid Amount</th>
                    <th>Payer Email</th>
                    <th>Payment Status</th>
                    <th>Booking Status</th>
                    <th>Booking Date</th>
                    <th>Comment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($bookings as $book) { ?>
                  <tr <?php if(!empty($book['booking_review'])){ ?> style="background-color: #BDB1AA;" <?php } ?>>
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
                    <td>$<?php echo $book['list_total']; ?></td>
                    <td>
                      <?php if($book['insurance_needed']){ echo "$".$book['insurance_amount']; } else{ ?> $0 <?php  } ?>
                    </td>
                    <td>
                      <?php if($book['mover_needed'] == 1){ ?>
                      <label class="label label-success"> Yes </label>
                      <?php } elseif($book['mover_needed'] == 2){ ?>
                      <label class="label label-info"> Cancelled </label>
                      <?php  } else { ?>
                      <label class="label label-danger"> No </label>
                      <?php } ?>
                    </td>
                    <td class="font-weight-bold">$<?php echo $book['total_amount']; ?></td>
                    <td><?php echo $book['trx_id']; ?></td>
                    <td class="font-weight-bold">$<?php echo $book['paid_amount']; ?></td>
                    <td><?php echo $book['payer_email']; ?></td>

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
                    <td> <?php echo (!empty($book['booking_review']))?nl2br($book['booking_review']):"No Comment"; ?> </td>
                    <td>

                      <label class="btn btn-info btn-sm view_detail" data-id="<?php echo $book['unique_id']; ?>"> View Details </label>
                      
                      <label class="btn btn-success btn-sm markascomplete" data-id="<?php echo $book['unique_id']; ?>"> Mark as completed </label>

                      <label class="btn btn-danger btn-sm cancel_booking" data-id="<?php echo $book['id']; ?>" data-list-id="<?php echo $book['listings_id']; ?>"> Cancel Booking </label>

                      <?php if($book['mover_needed'] == 1 && check_mover_status($book['id']) == 1){ ?>

                      <label class="btn btn-danger btn-sm cancel_mover_booking" data-id="<?php echo $book['id']; ?>"> Cancel Mover </label>

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
                    <th>Booking Days</th>
                    <th>Price/day</th>
                    <th>Storage Amount</th>
                    <th>Insurance Charges</th>
                    <th>Mover Needed</th>
                    <th>Total Amount</th>
                    <th>Trans ID</th>
                    <th>Paid Amount</th>
                    <th>Payer Email</th>
                    <th>Payment Status</th>
                    <th>Booking Status</th>
                    <th>Booking Date</th>
                    <th>Comment</th>
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

<!-- large modal -->
<div class="modal fade" id="confirm-cancel" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
    url:"<?php echo admin_url(); ?>bookings/getMoverPaymentModal",
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
    url:"<?php echo admin_url(); ?>bookings/getCustomerPaymentModal",
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


 $(document).on('click','.submitReleasePaymentStorage', function(){
  var btn = $(this);
  var form = $('#releasePaymentStorageForm').serialize();
  $.ajax({
    url:"<?php echo admin_url(); ?>bookings/releasePaymentTostorage",
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


 $(document).on('click','.submitReleasePaymentMover ', function(){
  var btn = $(this);
  var form = $('#releasePaymentMoverForm').serialize();
  $.ajax({
    url:"<?php echo admin_url(); ?>bookings/releasePaymentTomover",
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

     swal("Error", res.response, "error");
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

        swal("Error", res.response, "error");

      }
    }
  });

});

</script>