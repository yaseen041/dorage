<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Storage Listings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>listings/inactive_storage" class="btn btn-primary">Inactive Storages</a>

        <a href="<?php echo admin_url(); ?>listings/updated_storages" class="btn btn-info">Updated Storages</a>

        <a href="<?php echo admin_url(); ?>listings/deleted_storages" class="btn btn-danger">Deleted Storages</a>

      </div>
    </div>

    <div class="page-body">
      <div class="card">

        <div class="card-block">
          <div class="table-content crm-table">
            <div class="project-table">
              <table id="crm-contact" class="table table-striped dt-responsive nowrap">
                <thead>
                  <tr>
                    <th>List Title</th>
                    <th>Price/day</th>
                    <th>Address</th>
                    <th>Publisher</th>
                    <th>Published</th>
                    <th>Created At</th>
                    <th>Action</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if(empty($storage_listings)) { ?>
                  <tr>
                    <td colspan="8" style="color: red;"> Storages spaces not found. </td>
                  </tr>
                  <?php } ?>

                  <?php $i= 1; foreach ($storage_listings as $list) { ?>
                  <tr>

                    <td class="pro-name">
                     <a href="<?php echo admin_url(); ?>listings/storage_detail/<?php echo $list['unique_id']; ?>" title="view details" target="_blank"><?php echo $list['title']; ?>
                     </a>

                   </td>
                   <td>$<?php echo $list['price']; ?></td>
                   <td>
                    <?php
                    echo wordwrap(@$list['place'] , 44, "<br />\n");
                    ?>
                  </td>
                  <td>
                    <label class="label label-info"> <?php echo $list['first_name']." ".$list['last_name']; ?> </label>
                  </td>
                  <td>
                    <?php if($list['is_published'] == "1"): ?>
                     <label class="label label-success"> Yes </label> 
                   <?php else: ?>
                    <label class="label label-danger"> No </label>
                  <?php endif; ?>
                </td>
                <td><?php echo formatted_date($list['created_at']); ?></td>
                <td class="action-icon">

                  <!-- <a href="javascript:;" class="crm-action-delete text-muted"><i class="icofont icofont-delete-alt"></i></a> -->

                  <?php if($list['is_featured']): ?>
                    <label class="btn btn-success btn-sm featured" data-id="<?php echo $list['unique_id']; ?>" data-featured="remove_featured"  title="Remove featured"> Remove featured </label>
                  <?php else: ?>
                    <label class="btn btn-primary btn-sm featured" data-id="<?php echo $list['unique_id']; ?>" data-featured="add_featured" title="Add to featured">Add to featured</label>
                  <?php endif; ?>


                  <?php if($list['is_banned']): ?>
                    <label class="btn btn-success btn-sm banned" data-id="<?php echo $list['unique_id']; ?>" data-banned="remove_banned"  title="Remove banned"> Remove ban </label>
                  <?php else: ?>
                    <label class="btn btn-warning btn-sm banned" data-id="<?php echo $list['unique_id']; ?>" data-banned="add_banned" title="Add to banned">Ban listing</label>
                  <?php endif; ?>
                  
                  <label class="btn btn-danger btn-sm delete_storage" data-id="<?php echo $list['unique_id']; ?>" title="Delete">
                    Delete
                  </label>

                </td>
                <td> 
                  <?php echo wordwrap($list['description'] , 200, "<br />\n");?>
                </td>
              </tr>

              <?php } ?>

            </tbody>
            <tfoot>
              <tr>
                <th>List Title</th>
                <th>Price/day</th>
                <th>Address</th>
                <th>Publisher</th>
                <th>Is Published</th>
                <th>Created At</th>
                <th>Action</th>
                <th>Description</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid ends -->
</div>

</div>
</div>

<?php $this->load->view('common/admin_footer'); ?>

<script type="text/javascript">
  $('body').on('click', '.featured', function (event) {

    var unique_id = $(this).attr('data-id');
    var featured = $(this).attr('data-featured');

    swal({
      title: "Are you sure?",
      text: "You want to perform this action!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, please!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {

       $.ajax({
        url:'<?php echo admin_url(); ?>listings/'+featured,
        type:'post',
        data:{ unique_id : unique_id },
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            swal({title: "Success!", text: status.response, type: "success"},
              function(){ 
               location.reload();
             });

          } else if(status.msg=='error'){

            swal("Cancelled", res.response, "error");

          }
        }
      });
     } else {
      swal("Cancelled", "", "error");
    }
  });
  });

  $('body').on('click', '.banned', function (event) {

    var unique_id = $(this).attr('data-id');
    var banned = $(this).attr('data-banned');

    swal({
      title: "Are you sure?",
      text: "You want to perform this action!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, please!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {

       $.ajax({
        url:'<?php echo admin_url(); ?>listings/'+banned,
        type:'post',
        data:{ unique_id : unique_id },
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            swal({title: "Success!", text: status.response, type: "success"},
              function(){ 
               location.reload();
             });

          } else if(status.msg=='error'){

            swal("Error", res.response, "error");

          }
        }
      });
     } else {
      swal("Cancelled", "", "error");
    }
  });
  });

  $('body').on('click', '.delete_storage', function (event) {

    var unique_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to delete this storage!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, please!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {

       $.ajax({
        url:'<?php echo admin_url(); ?>listings/list_delete',
        type:'post',
        data:{ unique_id : unique_id },
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            swal({title: "Success!", text: status.response, type: "success"},
              function(){ 
               location.reload();
             });

          } else if(status.msg=='error'){

            swal("Error", status.response, "error");

          }
        }
      });
     } else {
      swal("Cancelled", "", "error");
    }
  });
  });


</script>