<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Edit amenity</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/amenities" class="btn btn-primary">Back to amenities</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Edit amenity</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="update_amenity" method="post" action="" novalidate>

                <input type="hidden" name="amenity_id" value="<?php echo $amenity_detail['id']; ?>">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Amenity Title</label>
                  <div class="col-sm-10">
                    <input type="text" id="amenity_title" class="form-control" placeholder="Enter amenity title" name="amenity_title" value="<?php echo $amenity_detail['name']; ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="description" class="form-control" placeholder="Enter description" name="description"><?php echo $amenity_detail['description']; ?></textarea>
                  </div>
                </div>

                <div class="checkbox-fade fade-in-primary">
                  <label>
                    <input value="" type="checkbox" name="amenity_type" <?php echo $amenity_detail['type'] ? "checked" : ''; ?>>
                    <span class="cr">
                      <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                    </span> <span>Is safety amenity?</span>
                  </label>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="update_amenity_btn" class="btn btn-primary m-b-0">Submit</button>

                    <button type="button" id="delete_amenity_btn" data-id="<?php echo $amenity_detail['id']; ?>" class="btn btn-danger m-b-0">Delete</button>

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
    $("#update_amenity").validate();
    $('#update_amenity_btn').click(function(){
      if($("#update_amenity").valid()){

        var btn = $(this);

        $(btn).button('loading');

        var value = $("#update_amenity").serialize();

        $.ajax({

          url:'<?php echo admin_url(); ?>preference/update_amenity',

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


    $("#delete_amenity_btn" ).on('click', function(e) {
      var amenity_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this amenity !",
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
            url:'<?php echo admin_url(); ?>preference/delete_amenity',
            type:'post',
            dataType: 'json',
            data:{ amenity_id : amenity_id },
            success:function(res){ 
              if(res.msg == 'success'){
        
                swal({title: "Deleted!", text: res.response, type: "success"},
                 function(){ 
                   location.href = '<?php echo admin_url(); ?>preference/amenities';
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