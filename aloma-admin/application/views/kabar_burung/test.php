        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Kabar Burung<small>New</small></h2>
                  <div class="clearfix"></div>
                  <?php if ( $this->session->userdata('uploadMsg')): ?>
                  <h4 class="text-center"><?= $this->session->userdata('uploadMsg'); ?></h4>
                  <?php
                  $this->session->unset_userdata('uploadMsg');
                  endif; ?>
                </div>
                <div class="x_content">
                    <br />
<?php echo form_open_multipart(admin_url().'do_action?method=new_kabarburung');?>
   <span class="fa fa-plus" id="addImage"></span>
   <input type="file" name="profile_pic[]" size="20" multiple/>
    <div id="display"></div>
   <br /><br />
   <input type="submit" value="upload" name="submit_form"/>
</form>
