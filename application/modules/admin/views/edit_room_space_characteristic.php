<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Edit Room Space Characteristic</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/room_space_characteristics" class="btn btn-primary">Back to Room Space Characteristics</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Edit Room Space Characteristic</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="update_room_space_characteristic" method="post" action="" novalidate>

                <input type="hidden" name="room_char_id" value="<?php echo $room_char_detail['id']; ?>">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Room Space Characteristic</label>
                  <div class="col-sm-10">
                    <input type="text" id="room_space_characteristic" class="form-control" placeholder="Enter Room Space Characteristic" name="room_space_characteristic" value="<?php echo $room_char_detail['name']; ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="update_room_space_characteristic_btn" class="btn btn-primary m-b-0">Submit</button>

                    <button type="button" id="delete_room_space_characteristic_btn" data-id="<?php echo $room_char_detail['id']; ?>" class="btn btn-danger m-b-0">Delete</button>

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
    $("#update_room_space_characteristic").validate();
    $('#update_room_space_characteristic_btn').click(function(){
      if($("#update_room_space_characteristic").valid()){

        var btn = $(this);

        $(btn).button('loading');

        var value = $("#update_room_space_characteristic").serialize();

        $.ajax({

          url:'<?php echo admin_url(); ?>preference/update_room_space_characteristic',

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


    $("#delete_room_space_characteristic_btn" ).on('click', function(e) {
      var room_char_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Room Space Character !",
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
            url:'<?php echo admin_url(); ?>preference/delete_room_space_characteristic',
            type:'post',
            dataType: 'json',
            data:{ room_char_id : room_char_id },
            success:function(res){ 
              if(res.msg == 'success'){
                
                swal({title: "Deleted!", text: res.response, type: "success"},
                 function(){ 
                   location.href = '<?php echo admin_url(); ?>preference/room_space_characteristics';
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