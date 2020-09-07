<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Space Storage Types</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/add_space_storage_type" class="btn btn-primary">Add Space Storage Type</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Space Storage Types</h5>
            </div>
            <div class="card-block col-md-8 offset-md-2">
              <div class="dt-responsive table-responsive">
                <table id="res-config" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Storage Space Type</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($spaces as $space) { ?>
                    <tr>
                      <td> <a href="<?php echo admin_url(); ?>preference/edit_space_storage_type/<?php echo $space['id']; ?>" title="Edit"> <?php echo $space['name']; ?> </a> </td>
                      <td><?php echo $space['storage_name']; ?></td>
                      <td><?php echo wordwrap($space['description'], 40, "<br>\n"); ?></td>
                      <td>
                        <label class="label <?php if($space['status']) {?> label-success <?php } else { ?> label-danger <?php } ?>">
                          <?php if($space['status']) {?> Active <?php } else { ?> Inactive <?php } ?>
                        </label>
                      </td>

                      <td>
                        <?php if($space['status']) {?>
                        <button class="label label-danger inactive_status" data-id="<?php echo $space['id']; ?>"> Inactive </button>
                        <?php } else { ?>
                        <button class="label label-success active_status" data-id="<?php echo $space['id']; ?>"> Active </button>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('common/admin_footer'); ?>

<script type="text/javascript">
  $(".inactive_status" ).on('click', function(e) {
    var space_storage_type_id = $(this).attr('data-id');
    swal({
      title: "Are you sure?",
      text: "You want to inactive this space storage type!",
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
          url:'<?php echo admin_url(); ?>preference/inactive_space_storage_type_status',
          type:'post',
          dataType: 'json',
          data:{ space_storage_type_id : space_storage_type_id },
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
    var space_storage_type_id = $(this).attr('data-id');
    swal({
      title: "Are you sure?",
      text: "You want to active this space storage type!",
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
          url:'<?php echo admin_url(); ?>preference/active_space_storage_type_status',
          type:'post',
          dataType: 'json',
          data:{ space_storage_type_id : space_storage_type_id },
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