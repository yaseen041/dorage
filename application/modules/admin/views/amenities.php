<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Amenities</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>preference/add_amenity" class="btn btn-primary">Add amenity</a>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Amenities</h5>
            </div>
            <div class="card-block col-md-8 offset-md-2">
              <div class="dt-responsive table-responsive">
                <table id="res-config" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>Amenity Title</th>
                      <th>Type</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($amenities as $amenity) { ?>
                    <tr>
                      <td>
                        <a href="<?php echo admin_url(); ?>preference/edit_amenity/<?php echo $amenity['id']; ?>" title="Edit"> 
                          <?php echo $amenity['name']; ?>
                        </a>
                      </td>
                      <td>
                        <label class="label <?php if($amenity['type']) {?> label-success <?php } else { ?> label-info <?php } ?>">
                          <?php if($amenity['type']) {?> Safety <?php } else { ?> Basic <?php } ?>
                        </label>
                      </td>
                      <td><?php echo wordwrap($amenity['description'], 40, "<br>\n"); ?></td>
                      <td>
                        <label class="label <?php if($amenity['status']) {?> label-success <?php } else { ?> label-danger <?php } ?>">
                          <?php if($amenity['status']) {?> Active <?php } else { ?> Inactive <?php } ?>
                        </label>
                      </td>

                      <td>
                        <?php if($amenity['status']) {?>
                        <button class="label label-danger inactive_status" data-id="<?php echo $amenity['id']; ?>"> Inactive </button>
                        <?php } else { ?>
                        <button class="label label-success active_status" data-id="<?php echo $amenity['id']; ?>"> Active </button>
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
    var amenity_id = $(this).attr('data-id');
    swal({
      title: "Are you sure?",
      text: "You want to inactive this amenity!",
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
          url:'<?php echo admin_url(); ?>preference/inactive_amenity',
          type:'post',
          dataType: 'json',
          data:{ amenity_id : amenity_id },
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
    var amenity_id = $(this).attr('data-id');
    swal({
      title: "Are you sure?",
      text: "You want to active this amenity!",
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
          url:'<?php echo admin_url(); ?>preference/active_amenity',
          type:'post',
          dataType: 'json',
          data:{ amenity_id : amenity_id },
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