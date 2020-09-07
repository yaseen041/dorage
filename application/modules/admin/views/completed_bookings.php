<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Completed Bookings</h4>
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
                    <th>Booking Days</th>
                    <th>Price/day</th>
                    <th>Storage Amount</th>
                    <th>Insurance Charges</th>
                    <th>Tax Charges</th>
                    <th>Mover Needed</th>
                    <th>Trans ID</th>
                    <th>Paid Amount</th>
                    <th>Payer Email</th>
                    <th>Payment Status</th>

                    <th>Booking Date</th>
                    <th>Comment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($bookings as $book) { ?>
                  <tr <?php if(!empty($book['booking_review'])){ ?> style="background-color: #BDB1AA;" <?php } ?>>
                    <td><?php echo $book['id']; ?></td>
                    <td>

                      <?php echo list_title($book['listings_id']); ?>

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
                      $<?php echo $book['tax_amount']; ?>
                    </td>
                    <td>
                      <?php if($book['mover_needed']){ ?>
                      <label class="label label-success"> Yes </label>
                      <?php } else { ?>
                      <label class="label label-danger"> No </label>
                      <?php  } ?>
                    </td>

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
                      <?php echo formatted_date_time($book['booking_date']); ?>
                    </td>
                    <td> <?php echo (!empty($book['booking_review']))?nl2br($book['booking_review']):"No Comment"; ?> </td>
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
                    <th>Storage Amount</th>
                    <th>Insurance Charges</th>
                    <th>Tax Charges</th>
                    <th>Mover Needed</th>
                    <th>Trans ID</th>
                    <th>Paid Amount</th>
                    <th>Payer Email</th>
                    <th>Payment Status</th>

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