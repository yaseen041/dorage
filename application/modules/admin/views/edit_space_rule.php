<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Edit space rule</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/space_rules" class="btn btn-primary">Back to space rules</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Edit space rule</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="update_rule_form" method="post" action="" novalidate>

                <input type="hidden" name="rule_id" value="<?php echo $rule_detail['id']; ?>">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Rule Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="rule_title" class="form-control" placeholder="Enter rule title" name="rule_title" value="<?php echo $rule_detail['name']; ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="description" class="form-control" placeholder="Enter description" name="description"><?php echo $rule_detail['description']; ?></textarea>
                  </div>
                </div>
                <div class="checkbox-fade fade-in-primary">
                  <label>
                    <input value="" type="checkbox" name="rule_type" <?php echo $rule_detail['type'] ? "checked" : ''; ?>>
                    <span class="cr">
                      <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span> <span>Is extra space rule?</span>
                  </label>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="update_rule_btn" class="btn btn-primary m-b-0">Submit</button>

                    <button type="button" id="delete_rule_btn" data-id="<?php echo $rule_detail['id']; ?>" class="btn btn-danger m-b-0">Delete</button>

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
    $("#update_rule_form").validate();
    $('#update_rule_btn').click(function(){
      if($("#update_rule_form").valid()){

        var btn = $(this);

        $(btn).button('loading');

        var value = $("#update_rule_form").serialize();

        $.ajax({

          url:'<?php echo admin_url(); ?>preference/update_space_rule',

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


    $("#delete_rule_btn" ).on('click', function(e) {
      var rule_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this space rule !",
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
            url:'<?php echo admin_url(); ?>preference/delete_space_rule',
            type:'post',
            dataType: 'json',
            data:{ rule_id : rule_id },
            success:function(res){ 
              if(res.msg == 'success'){
                
                swal({title: "Deleted!", text: res.response, type: "success"},
                 function(){ 
                   location.href = '<?php echo admin_url(); ?>preference/space_rules';
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