<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Edit Space Storage Type</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/space_storage_types" class="btn btn-primary">Back to Space Storage Types</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Edit Space Storage Type</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="update_space_storage_type" method="post" action="" novalidate>

                <input type="hidden" name="space_storage_type_id" value="<?php echo $space_storage_type_detail['id']; ?>">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Storage Spaces Type</label>
                  <div class="col-sm-10">
                    <select name="space_type" class="form-control" required>

                      <?php foreach ($spaces as $space) { ?>
                      <option value="<?php echo $space['id']; ?>" <?php if($space_storage_type_detail['storage_size_types_id'] == $space['id']){ ?> selected <?php } ?> ><?php echo $space['name']; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Space Storage Type</label>
                  <div class="col-sm-10">
                    <input type="text" id="space_storage_type" class="form-control" placeholder="Enter Space Storage Type" name="space_storage_type" value="<?php echo $space_storage_type_detail['name']; ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="description" class="form-control" placeholder="Enter description" name="description"><?php echo $space_storage_type_detail['description']; ?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="update_space_storage_type_btn" class="btn btn-primary m-b-0">Submit</button>

                    <button type="button" id="delete_space_storage_type_btn" data-id="<?php echo $space_storage_type_detail['id']; ?>" class="btn btn-danger m-b-0">Delete</button>

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
    $("#update_space_storage_type").validate();
    $('#update_space_storage_type_btn').click(function(){
      if($("#update_space_storage_type").valid()){

        var btn = $(this);

        $(btn).button('loading');

        var value = $("#update_space_storage_type").serialize();

        $.ajax({

          url:'<?php echo admin_url(); ?>preference/update_space_storage_type',

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


    $("#delete_space_storage_type_btn" ).on('click', function(e) {
      var space_storage_type_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Space Storage Type !",
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
            url:'<?php echo admin_url(); ?>preference/delete_space_storage_type',
            type:'post',
            dataType: 'json',
            data:{ space_storage_type_id : space_storage_type_id },
            success:function(res){ 
              if(res.msg == 'success'){
       
                swal({title: "Deleted!", text: res.response, type: "success"},
                 function(){ 
                   location.href = '<?php echo admin_url(); ?>preference/space_storage_types';
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