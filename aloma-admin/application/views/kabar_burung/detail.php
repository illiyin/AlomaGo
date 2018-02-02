        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><a href="<?= admin_url().'kabarburung' ?>" class="fa fa-chevron-left"></a>&nbsp;
                    Detail kabar burung<br/><small><?= $kabarBurung->is_ok ? 'Terakhir diubah: '. humantime($kabarBurung->data->terakhir_diubah->datetime) : null;?></small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  	<?php if($kabarBurung->is_ok): $data = $kabarBurung->data; ?>
                  	<form class="form-horizontal form-label-left">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        	<label class="control-label col-md-6 col-sm-6 col-xs-12"><?= $data->judul; ?></label>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Dibuat pada</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        	<label class="control-label col-md-6 col-sm-6 col-xs-12"><?= humantime($data->tanggal_waktu->datetime); ?></label>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        	<?php if($data->images): ?>
                        	<?php foreach($data->images as $num => $gambar): ?>
                        	<a href="<?= $gambar->url ?>" target="_blank"><img src="<?= $gambar->url ?>" alt="<?php echo "Gambar: ".$data->judul ?>" style="margin-bottom: 15px;max-width:500px;"></a>
                        	<?php endforeach; ?>
                        	<?php else: ?>
                        		<label class="control-label col-md-6 col-sm-6 col-xs-12">Gambar tidak ada</label>
                        	<?php endif; ?>
                        </div>
                      </div>
                     </form>
                   	<?php else: ?>
                   	<h3>Kabar burung tidak ditemukan</h3>
                   	<?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->