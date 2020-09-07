<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Loading | Paypal</title>
</head>
<body>
  <!-- <p>Please wait While We are connecting you to PayPal Secure Server.</p> -->
  
<div class="product">            
<div class="btn">
<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' name='frmPayPal1' class="paypals" style="display:none">
  <input type='hidden' name='business' value='contact@kiwitokiwi.co.nz'> 
  <input type='hidden' name='cmd' value='_xclick'>
  <input type='hidden' name='item_name' value='<?php echo $booking_detail['title']; ?>'>
     
  <input type='hidden' name='amount' value='<?php echo $booking_detail['total_amount']; ?>'>
  <input type='hidden' name='currency_code' value='USD'>

  <input type='hidden' name='cancel_return' value='<?php echo base_url();?>make_payment/cancel_paypal/'>
  <input type='hidden' name='return' value='<?php echo base_url();?>make_payment/result_paypal'>

  <input type="hidden" name="notify_url" value="<?php echo base_url();?>make_payment/result_paypal">
  <input type='hidden' name='rm' value='2'>

  <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>



</div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>           
<script>


$(document).ready(function() {
    // $(".loader").show(); 
    $('.paypals').submit();
});
</script>