<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Edit Customer Requirement</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/customer_requirements" class="btn btn-primary">Back to Customer Requirements</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Edit Customer Requirement</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="update_requirement" method="post" action="" novalidate>

                <input type="hidden" name="requirement_id" value="<?php echo $requirement_detail['id']; ?>">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Amenity Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="requirement_title" class="form-control" placeholder="Enter customer requirement title" name="requirement_title" value="<?php echo $requirement_detail['name']; ?>" required>
                  </div>
                </div>

                <div class="checkbox-fade fade-in-primary">
                  <label>
                    <input value="" type="checkbox" name="requirement_type" <?php echo $requirement_detail['type'] ? "checked" : ''; ?>>
                    <span class="cr">
                      <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span> <span>Is this requirement fulfill before booking ?</span>
                  </label>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="update_requirement_btn" class="btn btn-primary m-b-0">Submit</button>

                    <button type="button" id="delete_requirement_btn" data-id="<?php echo $requirement_detail['id']; ?>" class="btn btn-danger m-b-0">Delete</button>

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

  <script>
    $("#update_requirement").validate();
    $('#update_requirement_btn').click(function(){
      if($("#update_requirement").valid()){

        var btn = $(this);

        $(btn).button('loading');

        var value = $("#update_requirement").serialize();

        $.ajax({

          url:'<?php echo admin_url(); ?>preference/update_requirement',

          type:'post',

          data:value,

          dataType:'json',

          success:function(status){

            if(status.msg=='success'){
              notify('Success! ', status.response, 'success');
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


    $("#delete_requirement_btn" ).on('click', function(e) {
      var requirement_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this requirement !",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url:'<?php echo admin_url(); ?>preference/delete_requirement',
            type:'post',
            dataType: 'json',
            data:{ requirement_id : requirement_id },
            success:function(res){ 
              if(res.msg == 'success'){
                
                swal({title: "Deleted!", text: res.response, type: "success"},
                 function(){ 
                   location.href = '<?php echo admin_url(); ?>preference/customer_requirements';
                 });

              }else if (res.msg = 'error'){
               swal("Error", res.response, "error");
             }
           }
         });
        } else {
          swal("Cancelled", "", "error");
        }
      });
    });


  </script>