<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Inactive Users</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>users" class="btn btn-primary">Active Users</a>

        <a href="<?php echo admin_url(); ?>users/deleted_users" class="btn btn-danger">Deleted Users</a>

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
                      <?php if($user['status']) {?>
                      <label class="btn btn-danger btn-sm inactive_status" data-id="<?php echo $user['id']; ?>"> Inactive </label>
                      <?php } else { ?>
                      <label class="btn btn-success btn-sm active_status" data-id="<?php echo $user['id']; ?>"> Active </label>
                      <?php } ?>

                      <?php if($user['is_banned']): ?>
                        <label class="btn btn-info btn-sm banned" data-id="<?php echo $user['id']; ?>" data-banned="remove_banned"  title="Remove banned"> Remove ban </label>
                      <?php else: ?>
                        <label class="btn btn-warning btn-sm banned" data-id="<?php echo $user['id']; ?>" data-banned="add_banned" title="Add to banned">Ban user</label>
                      <?php endif; ?>

                      <label class="btn btn-danger btn-sm delete_user" data-id="<?php echo $user['id']; ?>" title="Delete">
                        Delete
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

  $('body').on('click', '.inactive_status', function (event) {

    var u_id = $(this).attr('data-id');
    swal({
      title: "Are you sure?",
      text: "You want to inactive this user!",
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
          url:'<?php echo admin_url(); ?>users/inactive_status',
          type:'post',
          dataType: 'json',
          data:{ user_id : u_id },
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

  $('body').on('click', '.active_status', function (event) {

    var u_id = $(this).attr('data-id');
    swal({
      title: "Are you sure?",
      text: "You want to active this user!",
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
          url:'<?php echo admin_url(); ?>users/active_status',
          type:'post',
          dataType: 'json',
          data:{ user_id : u_id },
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

  $('body').on('click', '.banned', function (event) {

    var user_id = $(this).attr('data-id');
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
          url:'<?php echo admin_url(); ?>users/'+banned,
          type:'post',
          data:{ user_id : user_id },
          dataType:'json',
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


  $('body').on('click', '.delete_user', function (event) {

    var user_id = $(this).attr('data-id');

    swal({
      title: "Are you sure?",
      text: "You want to delete this user!",
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
        url:'<?php echo admin_url(); ?>users/delete_user',
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