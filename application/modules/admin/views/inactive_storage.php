<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Inactive Storage Space Listings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>listings/storage" class="btn btn-default">Active Storages</a>

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
                    <th>Min Price</th>
                    <th>Max Price</th>
                    <th>Address</th>
                    <th>Publisher</th>
                    <th>Completed</th>
                    <th>Created At</th>
                    <th>Action</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $i= 1; foreach ($storage_listings as $list) { ?>
                  <tr>
                    <td class="pro-name">
                     <a href="<?php echo admin_url(); ?>listings/storage_detail/<?php echo $list['unique_id']; ?>" title="view details" target="_blank"><?php echo $list['title']; ?>
                     </a>
                     
                   </td>
                   <td>$<?php echo get_meta_value('price_min_day' , @$list['id']); ?></td>
                   <td>$<?php echo get_meta_value('price_max_day' , @$list['id']); ?></td>
                   <td>
                    <?php
                    echo wordwrap(@$list['place'], 44, "<br />\n");
                    ?>
                  </td>
                  <td>
                    <label class="label label-info"><?php echo $list['first_name']." ".$list['last_name']; ?></label>
                  </td>
                  <td>
                    <?php if($list['step_completed'] == "3"): ?>
                      <label class="label label-success"> Yes </label>
                    <?php else: ?>
                      <label class="label label-warning"> No </label>
                    <?php endif; ?>
                  </td>
                  <td><?php echo formatted_date($list['created_at']); ?></td>
                  <td class="action-icon">

                    <label class="btn btn-primary btn-sm change_status" data-id="<?php echo $list['unique_id']; ?>"  data-status="status_active"> Set Price and Active </label>

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
                  <th>Min Price</th>
                  <th>Max Price</th>
                  <th>Address</th>
                  <th>Publisher</th>
                  <th>Completed</th>
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
  $('body').on('click', '.change_status', function (event) {

    var unique_id = $(this).attr('data-id');
    var ch_status = $(this).attr('data-status');

    swal({
      title: "Set Price",
      text: "Enter the recommended price for storage space.",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      inputPlaceholder: "price"
    }, function(inputValue) {

      if(inputValue !== false) {

        $.ajax({
          url:'<?php echo admin_url(); ?>listings/'+ch_status,
          type:'post',
          data:{ unique_id : unique_id , price : inputValue },
          dataType:'json',
          success:function(status){

            if(status.msg=='success'){

              swal({title: "Success!", text: status.response, type: "success"},
                function(){ 
                 location.reload();
               });

            } else if(status.msg=='error'){

              notify('Error! ', status.response, 'danger');

            }
          }
        });

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