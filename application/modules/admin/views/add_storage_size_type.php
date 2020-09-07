<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Add Storage Size Type</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/storage_size_types" class="btn btn-primary">Back to Storage Size Types</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Add Storage Size Type</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="add_storage_type" method="post" action="" novalidate>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Storage Size Type</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="space_type" class="form-control" placeholder="Enter storage size type" name="space_type" required>
                  </div>
                </div>
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


    $('#add_storage_type').validate({
      errorElement: 'div',
      errorClass: 'text-danger',
      focusInvalid: true,
      ignore: "",
      rules: {
        space_type: {
          required: true,
        },
        messages: {
          space_type:{
           required : "Please enter storage size type.",
         },
       },
       highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
      },
      success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
          },


          errorPlacement: function (error, element) {

            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {

              var controls = element.closest('div[class*="col-"]');

              if(controls.find(':checkbox,:radio').length > 1) controls.append(error);

              else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));

            }

            else if(element.is('.select2')) {

              error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));

            }

            else if(element.is('.chosen-select')) {

              error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));

            }

            else error.insertAfter(element.parent());

          },


          submitHandler: function (form) {

          },

          invalidHandler: function (form) {

          }
        }

      });

    $('#submit').click(function(e){

     if($("#add_storage_type").valid()){
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#add_storage_type").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>preference/insert_space',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $("#add_storage_type")[0].reset();
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

</script>