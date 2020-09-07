<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Inactive Mover Listings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>listings/mover" class="btn btn-default">Active Mover</a>

        <a href="<?php echo admin_url(); ?>listings/updated_movers" class="btn btn-info">Updated Mover</a>

        <a href="<?php echo admin_url(); ?>listings/deleted_movers" class="btn btn-danger">Deleted Movers</a>

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
                    <th>Address</th>
                    <th>Publisher</th>
                    <th>Completed</th>
                    <th>Created At</th>
                    <th>Action</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $i= 1; foreach ($mover_listings as $list) { ?>
                  <tr>
                    <td class="pro-name">
                     <a href="<?php echo admin_url(); ?>listings/mover_detail/<?php echo $list['unique_id']; ?>" title="view details" target="_blank"><?php echo $list['title']; ?>
                     </a> 
                   </td>

                   <td>
                    <?php
                    echo wordwrap(@$list['place'], 44, "<br />\n");
                    ?>
                  </td>
                  <td>
                    <label class="label label-info"><?php echo $list['first_name']." ".$list['last_name']; ?></label>
                  </td>
                  <td>
                    <?php if($list['step_completed'] == "4"): ?>
                      <label class="label label-success"> Yes </label>
                    <?php else: ?>
                      <label class="label label-warning"> No </label>
                    <?php endif; ?>
                  </td>
                  <td><?php echo formatted_date($list['created_at']); ?></td>
                  <td class="action-icon">

                    <?php if($list['step_completed'] == "4"): ?>

                      <label class="btn btn-info btn-sm change_status" data-id="<?php echo $list['unique_id']; ?>"  data-status="mover_status_active"> Active </label>

                    <?php endif; ?>

                    <label class="btn btn-danger btn-sm delete_mover" data-id="<?php echo $list['unique_id']; ?>" title="Delete">
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
        url:'<?php echo admin_url(); ?>listings/'+ch_status,
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


  $('body').on('click', '.delete_mover', function (event) {

    var unique_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to delete this mover!",
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