<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Updated Storage Space Listings</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>listings/storage" class="btn btn-default">Active Storages</a>

        <a href="<?php echo admin_url(); ?>listings/inactive_storage" class="btn btn-primary">Inactive Storages</a>

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
                    <th>Old Price/day</th>
                    <th>Updated Price/day</th>
                    <th>Address</th>
                    <th>Publisher</th>
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
                   <td>$<?php echo $list['price']; ?></td>
                   <td>
                    <?php if(!empty($list['new_price'])){ ?>
                    $<?php echo $list['new_price']; ?>
                    <?php } else { ?> - <?php } ?>
                  </td>
                  <td>
                    <?php
                    echo wordwrap(@$list['place'], 44, "<br />\n");
                    ?>
                  </td>
                  <td>
                    <label class="label label-info"><?php echo $list['first_name']." ".$list['last_name']; ?></label>
                  </td>

                  <td class="action-icon">

                    <?php if(!empty($list['new_price'])){ ?>

                    <label class="btn btn-primary btn-sm change_status" data-id="<?php echo $list['unique_id']; ?>"> Update Price and Active </label>

                    <?php } else { ?>

                    <label class="btn btn-primary btn-sm make_active" data-id="<?php echo $list['unique_id']; ?>"> Active </label>

                    <?php } ?>

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
                  <th>Old Price/day</th>
                  <th>Updated Price/day</th>
                  <th>Address</th>
                  <th>Publisher</th>
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

    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this action!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes, I am sure!',
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){

     if (isConfirm){
       $.ajax({
        url:'<?php echo admin_url(); ?>listings/update_price_active',
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

  $('body').on('click', '.make_active', function (event) {

    var unique_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this action!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes, I am sure!',
      cancelButtonText: "No, cancel it!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){

     if (isConfirm){
       $.ajax({
        url:'<?php echo admin_url(); ?>listings/make_active',
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