<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar'); 
?>

<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>Add User</h4>
      </div>
      <div class="page-header-breadcrumb">
        <a href="<?php echo admin_url(); ?>users" class="btn btn-primary">Back to Users</a>
      </div>
    </div>
    <div class="page-body"> 
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Add User</h5>
            </div>
            <div class="card-block col-md-6 offset-md-3">
              <form id="add_user" method="post" action="" novalidate>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" id="first_name" class="form-control" placeholder="Enter first name" name="first_name" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" id="last_name" class="form-control" placeholder="Enter last name" name="last_name" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Gender</label>
                  <div class="col-sm-10">
                    <select name="gender" class="form-control" required>
                      <option value="Male"> Male </option>
                      <option value="Female"> Female </option>
                      <option value="Other"> Other </option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Birth Date</label>
                  <div class="col-sm-10">
                    <input type="text" id="user_dob" class="form-control" placeholder="mm/dd/yyyy" name="dob">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Phone Number</label>
                  <div class="col-sm-10">
                    <input type="text" id="phone_number" class="form-control" placeholder="Enter phone number" name="phone">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" id="email" class="form-control" placeholder="Enter email" name="email" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" id="c_password" class="form-control" placeholder="Confirm password" name="c_password" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Address Line 1</label>
                  <div class="col-sm-10">
                    <input type="text" id="address1" class="form-control" placeholder="Enter address line 1" name="address1" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Address Line 2</label>
                  <div class="col-sm-10">
                    <input type="text" id="address2" class="form-control" placeholder="Enter address line 2 (optional)" name="address2">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">City</label>
                  <div class="col-sm-10">
                    <input type="text" id="city" class="form-control" placeholder="Enter city" name="city" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">State</label>
                  <div class="col-sm-10">
                    <input type="text" id="state" class="form-control" placeholder="Enter state" name="state" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Zip</label>
                  <div class="col-sm-10">
                    <input type="text" id="zip" class="form-control" placeholder="Enter zip code" name="zip" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Describe Yourself</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" placeholder="Enter address" name="describe_yourself"></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="button" id="submit" class="btn btn-primary m-b-0">Submit</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<?php $this->load->view('common/admin_footer'); ?>
<script src="<?php echo base_url(); ?>admin_assets/js/jquery.validate.min.js"
  type="text/javascript"></script>

<script src="https://rawgit.com/RobinHerbots/Inputmask/4.x/dist/jquery.inputmask.bundle.js"></script>
<script>
    //$('#user_dob').mask('9999/999/99','YYYY/MMM/dd' , {placeholder:"1990/Jan/02"});

    $('#user_dob').inputmask({mask: '99/99/9999'});

    $('#phone_number').inputmask({mask: '(999) 999-9999'});


</script>

  <script type="text/javascript">


    $('#add_user').validate();

    $('#submit').click(function(e){

     if($("#add_user").valid()){
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#add_user").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>users/insert_user',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $("#add_user")[0].reset();
            $(btn).button('reset');
            location.href = '<?php echo admin_url(); ?>users';
          }

          else if(status.msg == 'error'){
            notify('Error! ', status.response, 'danger');
            $(btn).button('reset');
          }
        }
      });
    }
  });

</script>