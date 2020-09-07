<p class="form-control-static">Days<span class="value">
	<?php echo $booking_days; ?>
</span></p>

<p class="form-control-static">Price/day <span class="value">$<?php echo $booking_detail['list_price']; ?></span>
</p>

<input type="hidden" name="tax_amount" value="<?php echo $booking_detail['tax_amount']; ?>">

<p class="form-control-static">Sales Tax <span class="value">$<?php echo $booking_detail['tax_amount']; ?></span></p>

<?php if($insurance_amount != 0) { ?>

<p class="form-control-static">Insurance amount <span class="value">$<?php echo $insurance_amount; ?> </span>
</p>

<?php } ?>

<?php if(!empty($selected_mover_id)) { ?>

<p class="form-control-static">Selected crews <span class="value"><?php echo $selected_crews; ?> </span>
</p>

<p class="form-control-static"> Charges per crew per hour <span class="value">$<?php echo $crew_charge_hour; ?></span>
</p>

<input type="hidden" name="crew_charges" value="<?php echo $crew_charge_hour; ?>">

<p class="form-control-static">Selected hours <span class="value"><?php echo $selected_hours; ?></span>
</p>

<p class="form-control-static">Mover amount <span class="value">$<?php echo $mover_package; ?> </span>
</p>

<p class="form-control-static">Refundable amount<span class="value">$<?php echo $refundable; ?></span>
</p>


<?php } ?>

<p class="form-control-static">Total Amount <span class="value">$<?php echo $booking_detail['total_amount']; ?> </span>
</p>

<input type="hidden" name="insurance_amount" value="<?php echo $insurance_amount; ?>">
<input type="hidden" name="refundable" value="<?php echo @$refundable; ?>">
<input type="hidden" name="mover_package" value="<?php echo $mover_package; ?>">
<input type="hidden" name="total_amount" value="<?php echo $booking_detail['total_amount']; ?>">