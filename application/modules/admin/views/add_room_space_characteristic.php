<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="page-header-title">
                <h4>Add Room Space Characteristic</h4>
            </div>
            <div class="page-header-breadcrumb">
                <a href="<?php echo admin_url(); ?>preference/room_space_characteristics" class="btn btn-primary">Back to Room Space Characteristics</a>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Room Space Characteristic</h5>
                        </div>
                        <div class="card-block col-md-6 offset-md-3">
                            <form id="add_room_space_characteristic" method="post" action="" novalidate>
                                    
                              <!-- <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Space Storage Type</label>
                                        <div class="col-sm-10">
                                            <select name="space_type" class="form-control" required>

                                              <?php //foreach ($space_storage_types as $space_type) { ?>
                                                <option value="<?php //echo $space_type['id']; ?>"><?php //echo $space_type['name']; ?></option>
                                              <?php //} ?>
                                          
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Room Space Characteristic</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="room_space_characteristic" class="form-control" placeholder="Enter Room Space Characteristic" name="room_space_characteristic" required>
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

  <script type="text/javascript">


    $('#add_room_space_characteristic').validate();

    $('#submit').click(function(e){

     if($("#add_room_space_characteristic").valid()){
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#add_room_space_characteristic").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>preference/insert_room_space_characteristic',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){
       
          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $("#add_room_space_characteristic")[0].reset();
            $(btn).button('reset');

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