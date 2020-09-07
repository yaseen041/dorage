<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Mover Cancelled Bookings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>bookings/mover_bookings" class="btn btn-primary">Active Bookings</a>
        <a href="<?php echo admin_url(); ?>bookings/mover_completed" class="btn btn-primary">Completed Bookings</a>
      </div>
    </div>
    <div class="page-body">
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
                    <th>Refundable Amount</th>
                    <th>Paid Amount</th>
                    <th>Storage</th>
                    <th>Payment Status</th>
                    <th>Booking Date</th>
                    <th>Comment</th>
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
                    <td>$<?php if($book['parent_id'] > 0) { ?><?php echo $book['mover_price']; ?><?php } else { ?><?php echo $book['total_amount']; ?><?php } ?>
                      
                    </td>
                    <td>$<?php echo $book['refundable_mover']; ?></td>
                    <td>$<?php if($book['parent_id'] > 0) { ?><?php echo $book['mover_price'] + $book['refundable_mover']; ?><?php } else { ?><?php echo $book['total_amount']; ?><?php } ?>
                      
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
                  <th>Service Date</th>
                  <th>No. of Crews</th>
                  <th>Crew Charges</th>
                  <th>No. of Hours</th>
                  <th>Total Amount</th>
                  <th>Refundable Amount</th>
                  <th>Paid Amount</th>
                  <th>Storage</th>
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


</script>