<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Add cancellation policy</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/cancellation_policies" class="btn btn-primary">Back to cancellation policy</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Add Cancellation Policy</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="add_cancellation_policy" method="post" action="" novalidate>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Cancellation Policy</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cancellation_policy" class="form-control" placeholder="Enter hours" name="cancellation_policy" required>
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="c_policy_description" class="form-control" placeholder="Enter cancellation policy description" name="c_policy_description" required></textarea>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="submit" class="btn btn-primary m-b-0">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php $this->load->view('common/admin_footer'); ?>
<script src="<?php echo base_url(); ?>admin_assets/js/jquery.validate.min.js"
  type="text/javascript"></script>

  <script type="text/javascript">

    $("#add_cancellation_policy").validate({
      rules :{
        cancellation_policy: {
          required: true,
        }
        // ,c_policy_description: {
        //   required: true,
        // }
      },
      messages :{
        cancellation_policy: {
          required: "Please enter cancellation policy.",
        }
        //, c_policy_description: {
        //   required: "Please enter cancellation policy description.",
        // }

      }
    });



    $('#submit').click(function(e){

     if($("#add_cancellation_policy").valid()){
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#add_cancellation_policy").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>preference/insert_cancellation_policy',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $("#add_cancellation_policy")[0].reset();
            $(btn).button('reset');

          }

          else if(status.msg == 'error'){
            notify('Error! ', status.response, 'danger');
            $(btn).button('reset');
          }
        }
      });
    }
  });

    $('#cancellation_policy').keyup(function(e)
    {
      if (/\D/g.test(this.value))
      {
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
      }
    });

  </script>