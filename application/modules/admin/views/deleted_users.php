<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Deleted Users</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>users" class="btn btn-primary">Active Users</a>

        <a href="<?php echo admin_url(); ?>users/inactive_users" class="btn btn-info">Inactive Users</a>

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
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Email Address</th>
                    <th>Paypal Email</th>
                    <th>Phone Number</th>
                    <th>Street Address Line 1</th>
                    <th>Street Address Line 2</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Status</th>
                    <th>About</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i= 1; foreach ($users as $user) { ?>
                  <tr>
                    <td> 
                      <a href="<?php echo admin_url(); ?>users/edit_user/<?php echo $user['id']; ?>" title="Edit"> 
                        <?php echo $user['first_name']." ".$user['last_name']; ?>
                      </a> 
                    </td>
                    <td> <?php echo $user['gender']; ?> </td>
                    <td> <?php echo formatted_date($user['dob']); ?></td>
                    <td> <?php echo $user['email']; ?> </td>
                    <td> <?php echo $user['paypal_email']; ?> </td>
                    <td> <?php echo $user['phone']; ?> </td>

                    <td> <?php echo wordwrap($user['address1'], 30, "<br>\n"); ?> </td>
                    <td> <?php echo wordwrap($user['address2'], 30, "<br>\n"); ?> </td>
                    <td> <?php echo $user['city']; ?> </td>
                    <td> <?php echo $user['state']; ?> </td>
                    <td> <?php echo $user['zip']; ?> </td>
                    
                    <td>
                      <label class="label <?php if($user['status']) {?> label-success <?php } else { ?> label-danger <?php } ?>">
                        <?php if($user['status']) {?> Active <?php } else { ?> Inactive <?php } ?>
                      </label>
                    </td>
                    <td> <?php echo wordwrap($user['about'], 220, "<br>\n"); ?> </td>
                    <td>
                     <label class="btn btn-info btn-sm restore_user" data-id="<?php echo $user['id']; ?>"> Restore </label>

                     <label class="btn btn-danger btn-sm delete_user" data-id="<?php echo $user['id']; ?>" title="Delete">
                      Permanent Delete
                    </label>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Birth Date</th>
                  <th>Email Address</th>
                  <th>Paypal Email</th>
                  <th>Phone Number</th>
                  <th>Street Address Line 1</th>
                  <th>Street Address Line 2</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip</th>
                  <th>Status</th>
                  <th>About</th>
                  <th>Action</th>
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
  $('body').on('click', '.restore_user', function (event) {

    var user_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to restore this user!",
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
        url:'<?php echo admin_url(); ?>users/restore_user',
        type:'post',
        data:{ user_id : user_id},
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

  $('body').on('click', '.delete_user', function (event) {

    var user_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to delete this user. You will not be able to recover this action!",
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
        url:'<?php echo admin_url(); ?>users/user_permanent_delete',
        type:'post',
        data:{ user_id : user_id },
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