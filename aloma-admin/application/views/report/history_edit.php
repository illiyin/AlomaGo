        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>History<small>Edit</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <?php 
                  if($transferPulsa->is_ok):
                  $data = $transferPulsa->data;
                  ?>
                  <br />
                  <form data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?= admin_url() ?>do_action?method=editHistory">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Pengirim
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="" name="nomor_pengirim" required="required" value="<?= $data->nomor_pengirim ?>" onkeydown="return numericOnly(event)" class="form-control col-md-7 col-xs-12" autocomplete="off" />
                      </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $data->id; ?>">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Tujuan
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="" name="nomor_tujuan" required="required" value="<?= $data->nomor_tujuan ?>" onkeydown="return numericOnly(event)" class="form-control col-md-7 col-xs-12" autocomplete="off" />
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Denominasi
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="" name="denominasi" required="required" value="<?= $data->denominasi ?>" onkeydown="return numericOnly(event)" class="form-control col-md-7 col-xs-12" autocomplete="off" /> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Pulsa Transfer
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="" name="total_pulsa_transfer" required="required" value="<?= $data->total_pulsa_transfer ?>" onkeydown="return numericOnly(event)" class="form-control col-md-7 col-xs-12" autocomplete="off" /> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Verifikasi
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="verifikasi" class="form-control">
                          <option disabled>--Pilihan--</option>
                          <option value="Y" <?= $data->verifikasi == 'Y' ? 'selected' : null?>>Ya</option>
                          <option value="N" <?= $data->verifikasi == 'N' ? 'selected' : null?>>Tidak</option>
                        </select> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sent
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="sent" class="form-control">
                          <option disabled>--Pilihan--</option>
                          <option value="Y" <?= $data->sent == 'Y' ? 'selected' : null?>>Ya</option>
                          <option value="N" <?= $data->sent == 'N' ? 'selected' : null?>>Tidak</option>
                        </select> 
                      </div>
                    </div>
                  <br />

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
                  </form>
                  <?php else: ?>
                    <h3 class="text-center">Data History tidak ditemukan!</h3>
                  <?php endif; ?>
                </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->