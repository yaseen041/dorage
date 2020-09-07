<?php 
$this->load->view('common/admin_header');
$this->load->view('common/admin_sidebar');
$this->load->view('common/admin_chat_sidebar');
?>
<div class="main-body">
  <div class="page-wrapper">
    <div class="page-header">
      <div class="page-header-title">
        <h4>General Settings</h4>
      </div>
    </div>
    <div class="page-body">
      <div class="row">
        <div class="col-lg-12 col-xl-12">
          <div class="sub-title">Manage Settings</div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs md-tabs setting-tabs" role="tablist">
            <li class="nav-item col-lg-6">
              <a class="nav-link active" data-toggle="tab" href="#home5" role="tab">General Text and Settings</a>
            </li>
            <li class="nav-item col-lg-6">
              <a class="nav-link" data-toggle="tab" href="#cms_pages" role="tab">CMS Pages</a>
            </li>

          </ul>
          <!-- Tab panes -->
          <div class="tab-content col-md-8 offset-md-2 card-block">
            <div class="tab-pane active" id="home5" role="tabpanel">
              <?php if(!empty($this->session->flashdata('alert_success'))): ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
                </div>
              <?php elseif(!empty($this->session->flashdata('alert_error'))): ?>
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Error!</strong> <?php echo $this->session->flashdata('alert_error'); ?>
                </div>
              <?php endif; ?>
              <h3> Home </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_home" enctype="multipart/form-data" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Banner Image (Best Image Size 1920 x 768) </label>
                  <div class="col-sm-8">
                    <input class="form-control" name="banner_image" type="file">
                  </div> 
                  <div class="col-sm-12 offset-md-1 text-center"><br>
                    <img class="img-responsive" style="max-width: 250px;" src="<?php echo base_url(); ?>/assets/images/<?php echo get_section_content('home' , 'banner_image'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Welcome Text</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="welcome_text" id="welcome_text" placeholder="Enter welcome text" type="text" value="<?php echo get_section_content('home' , 'welcome_text'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Welcome Description</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="welcome_desc" id="welcome_desc" placeholder="Enter welcome description"><?php echo get_section_content('home' , 'welcome_desc'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Footer Text</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="footer_text" id="footer_text" placeholder="Enter footer text"><?php echo get_section_content('home' , 'footer_text'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>

              <h3> Social links </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_social_links" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Facebook</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="facebook" id="facebook" placeholder="Enter facebook link includeing http://" type="text" value="<?php echo get_section_content('social_links' , 'facebook'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Twitter</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="twitter" id="twitter" placeholder="Enter twitter link includeing http://" type="text" value="<?php echo get_section_content('social_links' , 'twitter'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Instagram</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="instagram" id="instagram" placeholder="Enter instagram link includeing http://" type="text" value="<?php echo get_section_content('social_links' , 'instagram'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>


              <h3> Pricing </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_pricing" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Pricing Heading</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="pricing_heading" id="pricing_heading" placeholder="Enter pricing heading" type="text" value="<?php echo get_section_content('pricing' , 'pricing_heading'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Pricing Note</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="pricing_statement" id="pricing_statement" placeholder="Enter pricing note"><?php echo get_section_content('pricing' , 'pricing_statement'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Update Pricing Heading</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="update_pricing_heading" id="update_pricing_heading" placeholder="Enter update pricing heading" type="text" value="<?php echo get_section_content('pricing' , 'update_pricing_heading'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Update Pricing Note</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="update_pricing_statement" id="update_pricing_statement" placeholder="Enter update pricing note"><?php echo get_section_content('pricing' , 'update_pricing_statement'); ?></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>


              <h3> Contact Us </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_contact_us" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Address</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="contactus_address" id="contactus_address" placeholder="Enter company address" type="text" value="<?php echo get_section_content('contactus' , 'contactus_address'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Phone Number</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="contactus_phone" id="contactus_phone" placeholder="Enter company phone number" type="text" value="<?php echo get_section_content('contactus' , 'contactus_phone'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="contactus_email" id="contactus_email" placeholder="Enter company email address" type="email" value="<?php echo get_section_content('contactus' , 'contactus_email'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>



              <h3> Insurance </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_insurance" novalidate="">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Insurance charges</label>
                  <div class="col-sm-8">
                    <input class="form-control" name="insurance_value" id="insurance_value" placeholder="Enter insurance charges" type="text" value="<?php echo get_section_content('insurance' , 'insurance_value'); ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Insurance Note</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="insurance_statement" id="insurance_statement" placeholder="Enter insurance note"><?php echo get_section_content('insurance' , 'insurance_statement'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Insurance Detail</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="insurance_detail" id="insurance_detail" placeholder="Enter insurance detail"><?php echo get_section_content('insurance' , 'insurance_detail'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Do you want to turn off insurance policy ? </label>
                  <div class="col-sm-8">
                    <input class="border-checkbox" name="insurance_provide" id="checkbox1" type="checkbox" <?php echo get_section_content('insurance' , 'insurance_provide') ? "" : "checked"; ?>>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>

              <h3> Mover Booking </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_mover_fun" novalidate="">

                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Do you want to turn off mover booking function ? </label>
                  <div class="col-sm-8">
                    <input class="border-checkbox" name="mover_provide" id="checkbox1" type="checkbox" <?php echo get_section_content('mover' , 'mover_provide') ? "" : "checked"; ?>>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>

            </div>
            <div class="tab-pane" id="social_links5" role="tabpanel">

            </div>
            <div class="tab-pane" id="cms_pages" role="tabpanel">
              <h3> About Us </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_aboutus" novalidate="">

                <div class="form-group row">
                  <div class="col-sm-12">
                    <textarea name="aboutus_text1" id="editor0"><?php echo get_section_content('aboutus' , 'about_us'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>
              <br />
              <h3> Careers </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_careers" novalidate="">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <textarea name="careers_text" id="editor1"><?php echo get_section_content('careers' , 'careers'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>
              <br />
              <h3> Policies </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_policies" novalidate="">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <textarea name="policy1" id="editor2"><?php echo get_section_content('policies' , 'policies'); ?></textarea>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>
              <br />
              <h3> Help </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_help" novalidate="">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <textarea name="help_text" id="editor3"><?php echo get_section_content('help' , 'help'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>
              <br />
              <h3> Terms and conditions </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_terms_and_conditions" novalidate="">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <textarea name="tcondition1" id="editor4"><?php echo get_section_content('termconditions' , 'termconditions'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>
              <br />
              <h3> Privacy policy </h3>
              <hr>
              <form method="post" action="<?php echo admin_url(); ?>settings/general_settings/update_privacy_policy" novalidate="">
                <div class="form-group row">

                  <div class="col-sm-12">
                    <textarea name="ppolicy1" id="editor5"><?php echo get_section_content('privacypolicy' , 'privacypolicy'); ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary m-b-0 float-right">Submit</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('common/admin_footer'); ?>
  <script src="<?php echo base_url(); ?>/admin_assets/bower_components/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>/admin_assets/bower_components/ckeditor/config.js"></script>
  <script type="text/javascript">
  //CKEDITOR.replace('editor0');
  // CKEDITOR.replace('editor1');
  // CKEDITOR.replace('editor2');
  // CKEDITOR.replace('editor3');
  // CKEDITOR.replace('editor4');
  // CKEDITOR.replace('editor5');
  // CKEDITOR.replace('editor6');
  // CKEDITOR.replace('editor7');
  // CKEDITOR.replace('editor8');
  // CKEDITOR.replace('editor9');
  // CKEDITOR.replace('editor10');
  // CKEDITOR.replace('editor11');
</script>
<script>
  for (i = 0; i <= 5; i++) { 
    CKEDITOR.replace( 'editor'+i, {
      extraPlugins: 'image2,uploadimage,texttransform',

      // toolbar: [
      //   { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
      //   { name: 'styles', items: [ 'Styles', 'Format' ] },
      //   { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
      //   { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
      //   { name: 'links', items: [ 'Link', 'Unlink' ] },
      //   { name: 'insert', items: [ 'Image', 'Table' ] },
      //   { name: 'tools', items: [ 'Maximize' ] },
      //   { name: 'editing', items: [ 'Scayt', 'Source' ] }
      // ],

      format_tags: 'p;h1;h2;h3;pre',
      // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
      removeDialogTabs: 'image:advanced;link:advanced',

      height: 450
    } );
  }

</script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/4.x/dist/jquery.inputmask.bundle.js"></script>
<script>
//$('#user_dob').mask('9999/999/99','YYYY/MMM/dd' , {placeholder:"1990/Jan/02"});
$('#contactus_phone').inputmask({mask: '(999) 999-9999'});
</script>