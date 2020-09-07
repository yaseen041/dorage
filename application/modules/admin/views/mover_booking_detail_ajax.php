<div class="row">

  <div class="col-md-6">
    <h5 class="font-weight-bold"> Mover Details </h5> <br>
    <img src="<?php echo base_url(); ?>assets/storage_images/<?php echo get_booked_list_image($mover_detail['mover_id']); ?>" style="width: 100%;">
  </div>

  <div class="col-md-6">
    <hr>
    <h5 class="font-weight-bold"> <?php echo $list_detail['title']; ?>  </h5><br>
    <p> <i class="ti-location-pin"></i> <?php echo $list_detail['place']; ?> </p>

    <p>
      <h5>Service Date</h5>
      <span class="label label-success"><?php echo formatted_date($mover_detail['booking_start']); ?></span> 
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
   Total Amount <span class="label label-info">$<?php echo $mover_detail['mover_price']; ?></span>
 </p>

 <p>
   Refundable Amount <span class="label label-info">$<?php echo $mover_detail['refundable_mover']; ?></span>
 </p>

 <p>
   Paid Amount <span class="label label-info">$<?php echo $mover_detail['mover_price']+$mover_detail['refundable_mover']; ?></span>
 </p>

</div>

<div class="col-md-6">
  <hr>
  <h5 class="font-weight-bold"> Customer Information </h5> <br>

  <p> Owner Name : <b> <?php echo $mover_detail['first_name']." ".$mover_detail['last_name']; ?> </b></p>
  <p> Phone : <b> <a href="tel:<?php echo $mover_detail['phone']; ?>"><?php echo $mover_detail['phone']; ?> </a> </b></p>
  <p> Email : <b> <a href="mailto:<?php echo $mover_detail['email']; ?>"> <?php echo $mover_detail['email']; ?> </a> </b></p>

  </div>

  <div class="col-md-6">
    <hr>
  <h5 class="font-weight-bold"> Owner Information </h5> <br>

  <p> Name : <b> <?php echo $list_detail['first_name']." ".$list_detail['last_name']; ?> </b></p>
  <p> Phone : <b> <a href="tel:<?php echo $list_detail['phone']; ?>"><?php echo $list_detail['phone']; ?> </a> </b></p>
  <p> Email : <b> <a href="mailto:<?php echo $list_detail['email']; ?>"> <?php echo $list_detail['email']; ?> </a> </b></p>

</div>
</div>