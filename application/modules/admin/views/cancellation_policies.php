<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Cancellation Polices</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/add_cancellation_policy" class="btn btn-primary">Add Cancellation Policy</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Cancellation Polices</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <div class="dt-responsive table-responsive">
                <table id="res-config" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($policies as $policy) { ?>
                    <tr>
                      <td> <a href="<?php echo admin_url(); ?>preference/edit_cancellation_policy/<?php echo $policy['id']; ?>" title="Edit"> <?php echo $policy['name']; ?> </a> </td>
                      <td>
                        <label class="label <?php if($policy['status']) {?> label-success <?php } else { ?> label-danger <?php } ?>">
                          <?php if($policy['status']) {?> Active <?php } else { ?> Inactive <?php } ?>
                        </label>
                      </td>
                      <td>
                        <?php if($policy['status']) {?>
                        <button class="label label-danger inactive_status" data-id="<?php echo $policy['id']; ?>"> Inactive </button>
                        <?php } else { ?>
                        <button class="label label-success active_status" data-id="<?php echo $policy['id']; ?>"> Active </button>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div>
                  <p> <span> Note :</span> <?php echo $policy_note['meta_value']; ?> <a href="javascript:void(0)" data-toggle="modal" data-target="#policy_note"><i class="ti-pencil"></i></a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Password Recovery modal start -->
      <div class="modal fade" id="policy_note" tabindex="-1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cancellation Policy Note</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div>
                <form id="policy_note_form" method="post">
                  <input type="hidden" name="note_id" value="<?php echo $policy_note['meta_id']; ?>">
                  <label class="form-control-label">Note:</label>
                  <textarea class="form-control" id="policy_note_text" name="policy_note_text" placeholder="Enter note" required><?php echo $policy_note['meta_value']; ?></textarea>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="update_note" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Password Recovery modal end -->

    </div>
  </div>
</div>

<?php $this->load->view('common/admin_footer'); ?>

<script src="<?php echo base_url(); ?>admin_assets/js/jquery.validate.min.js"
  type="text/javascript"></script>

  <script type="text/javascript">

    $('#policy_note_form').validate();

    $('#update_note').click(function(e){

     if($("#policy_note_form").valid()){
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#policy_note_form").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>preference/update_policy_note',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $(btn).button('reset');
            $('#policy_note').modal('hide');
            setTimeout(function(){ location.reload(); },2000);
          }

          else if(status.msg == 'error'){
            notify('Error! ', status.response, 'danger');
            $(btn).button('reset');
          }
        }
      });
    }
  });

    $(".inactive_status" ).on('click', function(e) {
      var policy_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You want to inactive this cancellation policy!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, inactive it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url:'<?php echo admin_url(); ?>preference/inactive_policy_status',
            type:'post',
            dataType: 'json',
            data:{ policy_id : policy_id },
            success:function(res){ 
              if(res.msg == 'success'){
                swal({title: "Inactive!", text: res.response, type: "success"},
                 function(){ 
                   location.reload();
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


    $(".active_status" ).on('click', function(e) {
      var policy_id = $(this).attr('data-id');
      swal({
        title: "Are you sure?",
        text: "You want to active this cancellation policy!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, active it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {

          $.ajax({
            url:'<?php echo admin_url(); ?>preference/active_policy_status',
            type:'post',
            dataType: 'json',
            data:{ policy_id : policy_id },
            success:function(res){ 
              if(res.msg == 'success'){
                swal({title: "Active!", text: res.response, type: "success"},
                 function(){ 
                   location.reload();
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