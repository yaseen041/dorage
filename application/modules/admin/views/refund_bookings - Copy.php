<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Refunded Bookings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>bookings" class="btn btn-primary">Back to Bookings</a>
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
                    <th>Price/day</th>
                    <th>Insurance Charges</th>
                    <th>Mover Title</th>
                    <th>Mover Charges</th>
                    <th>Total Amount</th>
                    <th>Trans ID</th>
                    <th>Paid Amount</th>
                    <th>Payer Email</th>
                    <th>Payment Status</th>
                    <th>Booking Status</th>
                    <th>Booking Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($bookings as $book) { ?>
                  <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo list_title($book['listings_id']); ?></td>

                    <td>
                      <label class="label label-success"><?php echo date("m/d/Y" , strtotime($book['booking_start'])); ?></label>/
                      <label class="label label-danger"><?php echo date("m/d/Y" , strtotime($book['booking_end'])); ?></label>
                    </td>

                    <td>$<?php echo $book['list_price']; ?></td>
                    <td>
                      <?php if($book['insurance_needed']){ echo "$".$book['insurance_amount']; } else{ ?> $0 <?php  } ?>
                    </td>
                    <td>
                      <?php if($book['mover_needed']){ echo list_title($book['mover_id']); } else{ ?> --- <?php  } ?>
                    </td>
                    <td>
                      <?php if($book['mover_needed']){ echo "$".$book['mover_price']; } else{ ?> $0 <?php  } ?>
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

                      <label class="label label-danger">
                        Refunded
                      </label>

                    </td>
                    <td>
                      <?php echo $book['booking_date']; ?>
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
                    <th>Price/day</th>
                    <th>Insurance Charges</th>
                    <th>Mover Title</th>
                    <th>Mover Charges</th>
                    <th>Total Amount</th>
                    <th>Trans ID</th>
                    <th>Paid Amount</th>
                    <th>Payer Email</th>
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
<div class="modal fade" id="refundBookingModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Refund Payment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="refundBookingForm">
          <div class="form-group">
            <label>Transaction ID:</label>
            <input type="text" name="tran_id" class="form-control" placeholder="Enter trx id here">
          </div>
          <input type="hidden" name="booking_unique_id" value="" id="booking_unique_id">
          <div class="form-group">
            <label>Refund Amount:</label>
            <input type="number" name="amount" class="form-control" min="1" placeholder="Enter refund amount here">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger submitRefundBooking">Submit</button>
      </div>
      
    </div>
  </div>
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
  $(document).on('click', '.refundBooking', function(){
    var booking_id = $(this).attr('data-id');
    $('#booking_unique_id').val(booking_id);
    $("#refundBookingModal").modal('show');
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
          swal("Success", res.response, "success");
          $("#refundBookingModal").modal('hide');
          setTimeout(function(){
            location.reload(true);
          },1000)
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