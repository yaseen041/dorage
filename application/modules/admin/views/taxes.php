<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>

<div class="main-body">
    <div class="page-wrapper">
        <div class="page-header">
            <div class="page-header-title">
                <h4>Taxes</h4>
            </div>
            
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Taxes</h5>
                        </div>
                        <div class="card-block col-md-6 offset-md-3">
                            <form id="taxes_form" method="post" action="" novalidate>


                              <?php foreach ($states as $state) { ?>
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label"><?php echo $state['name']; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" class="form-control" placeholder="Enter tax rate" name="state[<?php echo $state['id']; ?>]" value="<?php echo get_tax_rate($state['id']); ?>">
                                </div>
                            </div>
                            <?php }  ?>

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
      var btn = $(this);

      $(btn).button('loading');
      var value = $("#taxes_form").serialize();
      $.ajax({
        url:'<?php echo admin_url(); ?>preference/insert_taxes',
        type:'post',
        data:value,
        dataType:'json',
        success:function(status){

          if(status.msg=='success'){
            notify('Success! ', status.response, 'success');
            $(btn).button('reset');
        }

        else if(status.msg == 'error'){
            notify('Error! ', status.response, 'danger');
            $(btn).button('reset');
        }
    }
});
  });

</script>