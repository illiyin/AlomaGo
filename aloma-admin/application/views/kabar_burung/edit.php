        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <label class="pull-right button-upload">
                      <input type="file" id="addImage" />
                      <i class="fa fa-cloud-upload"></i> Tambah Gambar
                  </label>
                  <h2><a href="<?= admin_url().'kabarburung' ?>" class="fa fa-chevron-left"></a>&nbsp;Kabar Burung<small>Edit</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php if($kabarBurung->is_ok): $data = $kabarBurung->data; ?>
                  <form action="#" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" accept-charset="utf-8" id="formEdit">
                    <input type="hidden" name="id" id="id" value="<?= $data->id ?>">
                    <input type="hidden" name="author" id="author" value="<?= @$this->admindata->nama ?>">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Judul
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="judul" autocomplete="off" name="title" required="required" value="<?= $data->judul ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <?php foreach($kabarBurung->data->images as $index => $img): $no = $index+1?>
                      <div class="col-md-3 col-xs-3 image-upload">
                        <input type="hidden" id="imageId<?= $no ?>" value="<?= $img->id ?>">
                        <span class="fa fa-times pull-right" style="margin: 7px 0px; color: #f90000;" onclick="deleteImage(<?= $img->id ?>)"></span>
                        <div class="clearfix"></div>
                        <label for="file-input<?= $index ?>">
                          <img src="<?= $img->url ?>" id="imagePreview<?= $no ?>" style="border:1px dashed; padding:15px; margin-bottom: 15px; width:auto; max-height:200px;" class="img-responsive" />
                        </label>
                        <input id="file-input<?= $index ?>" class="editImage" name="uploadImage" type="file" onchange="return changeImage(this, '<?= $no ?>')" accept="image/*" />
                      </div>
                      <?php endforeach; ?>
                    </div>

                <div class="ln_solid"></div>
                    <!-- <div class="form-group">
                        <button type="submit" id="saveBtn" class="btn btn-success">Simpan</button>
                      </div> -->
                      </form>
                     <?php else: ?>
                    <h3>Kabar burung tidak ditemukan</h3>
                    <?php endif; ?>
                    </div>
                </div>
              </div>
            </div>
        <!-- /page content -->