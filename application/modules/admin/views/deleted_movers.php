<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Deleted Mover Listings</h4>
      </div>
      <div class="page-header-breadcrumb">

        <a href="<?php echo admin_url(); ?>listings/mover" class="btn btn-default">Active Mover</a>

        <a href="<?php echo admin_url(); ?>listings/inactive_mover" class="btn btn-primary">Inactive Mover</a>

        <a href="<?php echo admin_url(); ?>listings/updated_movers" class="btn btn-info">Updated Mover</a>

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
                    <th>Mover Help</th>
                    <th>Publisher</th>
                    <th>Created At</th>
                    <th>Action</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($mover_listings as $list) { ?>
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

                    <?php if( get_meta_value('mover_help' , @$list['id']) == '0' ): ?>
                      Loading
                    <?php elseif ( get_meta_value('mover_help' , @$list['id']) == '1' ): ?>
                      Moving
                    <?php else: ?>
                      Loading <br> Moving
                    <?php endif; ?>

                  </td>

                  <td>
                    <label class="label label-info"><?php echo $list['first_name']." ".$list['last_name']; ?></label>
                  </td>

                  <td><?php echo formatted_date($list['created_at']); ?></td>
                  <td class="action-icon">

                    <label class="btn btn-info btn-sm restore_list" data-id="<?php echo $list['unique_id']; ?>"> Restore </label>

                    <label class="btn btn-danger btn-sm delete_mover" data-id="<?php echo $list['unique_id']; ?>" title="Delete">
                      Permanent Delete
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
                  <th>Mover Help</th>
                  <th>Publisher</th>
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
  $('body').on('click', '.restore_list', function (event) {

    var unique_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to restore this mover!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes, please!',
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){

     if (isConfirm){
       $.ajax({
        url:'<?php echo admin_url(); ?>listings/restore_list',
        type:'post',
        data:{ unique_id : unique_id},
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

     } else {
      swal("Cancelled", "", "error");
      e.preventDefault();
    }
  });
  });

  $('body').on('click', '.delete_mover', function (event) {

    var unique_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to delete this mover. You will not be able to recover this action!",
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
        url:'<?php echo admin_url(); ?>listings/list_permanent_delete',
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