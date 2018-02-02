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
                    <form action="<?= admin_url()?>do_action?method=new_kabarburung" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" accept-charset="utf-8">
                      <input type="hidden" name="author" value="<?= @$this->admindata->nama ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Judul <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="judul" autocomplete="off" name="title" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gambar <span class="required">*</span>
                        </label>
                        <span class="fa fa-plus" id="addImage"></span>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="imageUpload[]" size="20" multiple required/>
                          <div id="display"></div>
                        </div>
                      </div>

                  <div class="ln_solid"></div>
                      <div class="form-group">
                          <button type="submit" id="saveBtn" class="btn btn-success">Simpan</button>
                        </div>
                        </form>
                      </div>
                </div>
              </div>
            </div>
        <!-- /page content -->