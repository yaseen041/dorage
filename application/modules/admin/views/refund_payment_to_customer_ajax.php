<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Refund Payment to Customer</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <div>
        <label>Paypal ID:<b><?php echo $booking_detail['paypal_email']; ?></b></label>
      </div>

      <div>
        <label>Refundable Amount:<b>$<?php echo $total_amount; ?></b></label>
      </div>

      <form id="releasePaymentCustomerForm">

        <div class="form-group">
          <label>Transaction ID:</label>

          <input type="text" name="tran_id" class="form-control" placeholder="Enter trx id here">

          <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">

          <input type="hidden" name="user_id" id="user_id" value="<?php echo $booking_detail['users_id']; ?>">

        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">

        </div>

        <input type="hidden" name="booking_id" id="booking_id" value="<?php echo $booking_id; ?>">

        <div class="form-group">
          <label>Amount Paid:</label>
          <input type="number" name="amount" class="form-control" min="1" placeholder="Enter paid amount here">
        </div>


      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-danger submitRefundPaymentCustomer">Submit</button>
    </div>

  </div>
</div>