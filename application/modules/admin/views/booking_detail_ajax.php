
<div class="row">
  <div class="col-md-6">
    <img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($booking_detail['listings_id']); ?>" style="width: 100%;">
  </div>

  <div class="col-md-6">

    <h5 class="font-weight-bold"> <?php echo $list_detail['title']; ?>  </h5><br>
    <p> <i class="ti-location-pin"></i> <?php echo $list_detail['place']; ?> </p>
    
    <p> Storage Size Type : <b> <?php echo get_size_type(get_booked_meta_value('storage_size_type' , @$booking_detail['listings_id'])); ?> </b> </p>
    
    <p> Space Storage Type : <b> <?php echo get_storage_type(get_booked_meta_value('space_storage_type' , @$booking_detail['listings_id'])); ?> </b> </p> 

    <p>Room space character: <strong><?php echo get_room_space_character(get_booked_meta_value('room_space_character' , @$booking_detail['listings_id'])); ?> </strong></p>


    <p>Space height: <strong><?php echo get_booked_meta_value('space_height' , @$booking_detail['listings_id']); ?> feet</strong></p>
    <p>Space width: <strong><?php echo get_booked_meta_value('space_width' , @$booking_detail['listings_id']); ?> feet</strong></p>
    <p>Space length: <strong><?php echo get_booked_meta_value('space_length' , @$booking_detail['listings_id']); ?> feet</strong></p>

    <p> Cancellation policy : <strong class="label label-info"> Less than <?php echo get_cancellation_policy(get_booked_meta_value('cancellation_policy' , @$list_detail['id'])); ?> hours </strong> </p>
  </div>

  <div class="col-md-6">
    <hr>
    <h5 class="font-weight-bold"> Payment Information </h5> <br>

    <p> Booking Dates : <label class="label label-success"> <?php echo formatted_date($booking_detail['booking_start']); ?> </label> To  <label class="label label-danger"> <?php echo formatted_date($booking_detail['booking_end']); ?> </label> </p>

    <p> Price/day : <b> $<?php echo $booking_detail['list_price']; ?> </b></p>

    <?php if($booking_detail['insurance_needed']) {?>
    <p> Insurance Charges : <b> $<?php echo $booking_detail['insurance_amount']; ?> </b></p>
    <?php } ?>

    <p> Total Amount : <b> $<?php echo $booking_detail['total_amount']; ?> </b></p>

    <p> Paid Amount : <b> $<?php echo $booking_detail['paid_amount']; ?> </b></p>
    <p> Transaction ID : <b> <?php echo $booking_detail['trx_id']; ?> </b></p>
    <p> Payer Email : <b> <?php echo $booking_detail['payer_email']; ?> </b></p>
    <p> Payment Status : 
      <b> 
        <?php if($booking_detail['booking_status'] == 1) { ?>
        <label class="label label-success">
          Success
        </label>
        <?php } else if($booking_detail['booking_status'] == 0) { ?>
        <label class="label label-warning">
          Pending
        </label>
        <?php } ?> 
      </b>
    </p>
  </div>

  <div class="col-md-6">
    <hr>
    <h5 class="font-weight-bold"> Storage Owner Information </h5> <br>

    <p> Name : <b> <?php echo $list_detail['first_name']." ".$list_detail['last_name']; ?> </b></p>
    <p> Phone : <b> <a href="tel:<?php echo $list_detail['phone']; ?>"><?php echo $list_detail['phone']; ?> </a> </b></p>
    <p> Email : <b> <a href="mailto:<?php echo $list_detail['email']; ?>"> <?php echo $list_detail['email']; ?> </a> </b></p>

    <hr>
    <h5 class="font-weight-bold"> Customer Information </h5> <br>
    <p> Name : <b> <?php echo $booking_detail['first_name']." ".$booking_detail['last_name']; ?> </b></p>
    <p> Phone : <b> <a href="tel:<?php echo $booking_detail['phone']; ?>"><?php echo $booking_detail['phone']; ?> </a> </b></p>
    <p> Email : <b> <a href="mailto:<?php echo $booking_detail['email']; ?>"> <?php echo $booking_detail['email']; ?> </a> </b></p>
  </div>

  <?php if($booking_detail['mover_needed']) { ?>

  <div class="col-md-6">
    <hr>
    <h5 class="font-weight-bold"> Mover Details </h5> <br>
    <img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($mover_detail['mover_id']); ?>" style="width: 100%;">
  </div>

  <div class="col-md-6">
    <hr>
    <h5 class="font-weight-bold"> <?php echo $mover_detail['title']; ?>  </h5><br>
    <p> <i class="ti-location-pin"></i> <?php echo $mover_detail['place']; ?> </p>

    <p>
      <h5>Service Date</h5>
      <span class="label label-success"><?php echo formatted_date($booking_detail['booking_start']); ?></span>
    </p>
    <p>
     No. of crews <span class="label label-info"><?php echo $mover_detail['no_crews']; ?></span>
   </p>
   <p>
     Crew charges/hour <span class="label label-info">$<?php echo $mover_detail['crew_charges']; ?></span>
   </p>
   <p>
    No. of hours <span class="label label-info"><?php echo $mover_detail['no_hours']; ?></span>
  </p>
  <p>
   Total Amount <span class="label label-info">$<?php echo $mover_detail['mover_price']+$mover_detail['refundable_mover']; ?></span>
 </p>
 <p>
   Refundable Amount <span class="label label-info">$<?php echo $mover_detail['refundable_mover']; ?></span>
 </p>

 <p> Owner Name : <b> <?php echo $mover_detail['first_name']." ".$mover_detail['last_name']; ?> </b></p>
 <p> Phone : <b> <a href="tel:<?php echo $mover_detail['phone']; ?>"><?php echo $mover_detail['phone']; ?> </a> </b></p>
 <p> Email : <b> <a href="mailto:<?php echo $mover_detail['email']; ?>"> <?php echo $mover_detail['email']; ?> </a> </b></p>

 <?php if($booking_detail['mover_needed'] == 2) { ?>

 <p class="label label-info col-md-2"> Cancelled </p>

 <?php } ?>


</div>



<?php } ?>

<div class="col-md-12">
  <hr>
  <strong>Comment: </strong>
  <?php echo (!empty($booking_detail['booking_review']))?nl2br($booking_detail['booking_review']):"No Comments"; ?>
</div>

<?php $reviews = getUserReviewForAdmin($booking_detail['id']); ?>

<?php if(!empty($reviews)) { ?>
<div class="col-md-12">
  <hr>
  <strong>Reviews</strong>
  <div class="row">
    <?php foreach ($reviews as $review) { ?>
    <div>
      <div class="comment-body row" style="padding:15px;">
        <div class="comment-avatar col-md-4"><img src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $review['profile_dp']; ?>" alt="User Image"></div>
        <div class="comment-content col-md-8">
          <div class="comment-author">
            <strong><?php echo ucwords($review['username']); ?></strong>
            <span class="comment-date">
              <?php echo get_timeago(strtotime($review['date_added'])); ?>
              
              <div class="user-rating">
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
            </span>
          </div>
          <p><?php echo $review['review']; ?></p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php } ?>

</div>
<script type="text/javascript">
  $('.listingRating').each(function(index, el) {
    var $El = $(el);
    $El.barrating({
      theme: 'fontawesome-stars-o',
      readonly: true,
      initialRating: $El.attr('data-current-rating') 
    });
  });
</script>