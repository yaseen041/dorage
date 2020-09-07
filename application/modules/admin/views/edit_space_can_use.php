<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Edit Space Can Guests Use</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/spaces_can_use" class="btn btn-primary">Back to Spaces Can Guests Use</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Edit Space Can Guests Use</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="update_space_can_use" method="post" action="" novalidate>

                <input type="hidden" name="space_id" value="<?php echo $space_detail['id']; ?>">
                
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Space Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="space_title" class="form-control" placeholder="Enter space title" name="space_title" value="<?php echo $space_detail['name']; ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="update_space_can_use_btn" class="btn btn-primary m-b-0">Submit</button>

                    <button type="button" id="delete_space_can_use_btn" data-id="<?php echo $space_detail['id']; ?>" class="btn btn-danger m-b-0">Delete</button>

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
    $("#update_space_can_use").validate();
    $('#update_space_can_use_btn').click(function(){
      if($("#update_space_can_use").valid()){

        var btn = $(this);

        $(btn).button('loading');

        var value = $("#update_space_can_use").serialize();

        $.ajax({

          url:'<?php echo admin_url(); ?>preference/update_space_can_use',

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


    $("#delete_space_can_use_btn" ).on('click', function(e) {
      var space_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this space can guests use !",
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
            url:'<?php echo admin_url(); ?>preference/delete_space_can_use',
            type:'post',
            dataType: 'json',
            data:{ space_id : space_id },
            success:function(res){ 
              if(res.msg == 'success'){
                
                swal({title: "Deleted!", text: res.response, type: "success"},
                 function(){ 
                   location.href = '<?php echo admin_url(); ?>preference/spaces_can_use';
                 });

              }else if (res.msg = 'error'){
               swal("Cancelled", res.response, "error");
             }
           }
         });
        } else {
          swal("Cancelled", "", "error");
        }
      });
    });


  </script>