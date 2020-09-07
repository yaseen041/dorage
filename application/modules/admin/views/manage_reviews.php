<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Reviews</h4>
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

                    <th>List Title</th>
                    <th>Review By</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Review Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($reviews as $review) { ?>
                  <tr>
                    <td>
                      <?php echo orignal_list_title($review['orignal_list_id']); ?>
                    </td>
                    <td><?php echo $review['username']; ?></td>
                    <td><?php echo $review['review']; ?></td>
                    <td>
                      <div class="rating">
                        <div class="stars">
                          <select class="listingRating" name="rating" data-current-rating="<?php echo $review['stars']; ?>" autocomplete="off" style="display: none;">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                      </div>
                    </td>
                    <td>
                      <?php echo formatted_date_time($review['date_added']); ?>
                    </td>
                    <td>
                      <?php if($review['status']) { ?>
                      <label class="label label-success">
                        Approved
                      </label>
                      <?php } else { ?>
                      <label class="label label-danger">
                        Disapproved
                      </label>
                      <?php } ?>
                    </td>
                    
                    <td>
                      <?php if($review['status'] == 0) { ?>
                      <label class="btn btn-success btn-sm approve_review" data-review-id="<?php echo $review['id']; ?>"> Approve </label>
                      <?php } else { ?>
                      <label class="btn btn-danger btn-sm disapprove_review" data-review-id="<?php echo $review['id']; ?>"> Disapprove </label>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>

                </tbody>
                <tfoot>
                  <tr>

                    <th>List Title</th>
                    <th>Review By</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Review Date</th>
                    <th>Status</th>
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


<div class="modal fade" id="confirm-approve-review" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Confirm Approve Review</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are about to approve a review.</p>
        <p>Do you want to proceed?</p>
        <input type="hidden" id="approve_review_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button class="btn btn-danger review_approve_now">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-disapprove-review" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Confirm Disapprove Review</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are about to disapprove a review.</p>
        <p>Do you want to proceed?</p>
        <input type="hidden" id="disapprove_review_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button class="btn btn-danger review_disapprove_now">Yes</button>
      </div>
    </div>
  </div>
</div>



<?php $this->load->view('common/admin_footer'); ?>

<script type="text/javascript">


  $('.listingRating').each(function(index, el) {
    var $El = $(el);
    $El.barrating({
      theme: 'fontawesome-stars-o',
      readonly: true,
      initialRating: $El.attr('data-current-rating') 
    });
  });


  $(document).on('click', '.approve_review' , function(e) {
    $("#approve_review_id").val($(this).attr('data-review-id'));
    $("#confirm-approve-review").modal('show');
  });

  $(document).on('click', '.disapprove_review' , function(e) {
   $("#disapprove_review_id").val($(this).attr('data-review-id'));
   $("#confirm-disapprove-review").modal('show');
 });


  $(document).on('click', '.review_approve_now' , function(e) {
    var review_id = $("#approve_review_id").val();

    $.ajax({
     url:'<?php echo admin_url(); ?>bookings/review_approve',
     type:'post',
     data:{ review_id : review_id },
     dataType:'json',
     success:function(status){

      if(status.msg=='success'){
        $("#confirm-approve-review").modal('hide');
        if(status.msg == 'success'){
          swal({title: "Approved!", text: status.response, type: "success"},
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




  $(document).on('click', '.review_disapprove_now' , function(e) {
   var review_id = $("#disapprove_review_id").val();
   $.ajax({
    url:'<?php echo admin_url(); ?>bookings/review_disapprove',
    type:'post',
    data:{ review_id : review_id },
    dataType:'json',
    success:function(status){

      if(status.msg=='success'){

        $("#confirm-disapprove-review").modal('hide');

        swal({title: "Disapproved!", text: status.response, type: "success"},
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