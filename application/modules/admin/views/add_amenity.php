<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="page-header-title">
                <h4>Add amenity</h4>
            </div>
            <div class="page-header-breadcrumb">
                <a href="<?php echo admin_url(); ?>preference/amenities" class="btn btn-primary">Back to amenities</a>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add amenity</h5>
                        </div>
                        <div class="card-block col-md-6 offset-md-3">
                            <form id="add_amenity_form" method="post" action="" novalidate>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Amenity Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="amenity_title" class="form-control" placeholder="Enter amenity title" name="amenity_title" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" class="form-control" placeholder="Enter description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input value="" type="checkbox" name="amenity_type">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span> <span>Is safety amenity?</span>
                                    </label>
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


    $('#add_amenity_form').validate();

    $('#submit').click(function(e){

     if($("#add_amenity_form").valid()){
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#add_amenity_form").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>preference/insert_amenity',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $("#add_amenity_form")[0].reset();
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