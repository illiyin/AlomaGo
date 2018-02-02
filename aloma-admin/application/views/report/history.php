        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>History Transaksi <small>Laporan setiap transaksi transfer pulsa</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!-- <div class="filter col-md-3 pull-right"> -->
                    <!-- <select name="History" class="form-control" onchange="dateChange(this.value)">
                        <option>-- Pilih Batas Waktu --</option>
                        <option value="all">Semua History</option>
                        <option value="today">Hari ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="last7">7 Hari terakhir</option>
                        <option value="last30">30 Hari terakhir</option>
                        <option value="monthly">Bulan ini</option>
                        <option value="lastmonth">Bulan terakhir</option>
                        <option value="custom">Atur Manual</option>
                    </select> -->
                  <!-- </div> -->
                  <div class="clearfix"></div>
                  <div class="x_content">
                    <?php if($this->session->userdata('sessionMessage')): ?>
                    <h3><?= $this->session->userdata('sessionMessage'); ?></h3>
                    <?php endif; ?>
                    <?php 
                    if($transferPulsa->is_ok):
                    ?>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title text-center">#</th>
                            <th class="column-title text-center">No. Penerima </th>
                            <th class="column-title text-center">No. Pengirim </th>
                            <th class="column-title text-center">Denominasi</th>
                            <th class="column-title text-center">Total Transfer</th>
                            <th class="column-title text-center">Verifikasi</th>
                            <th class="column-title text-center">Sent</th>
                            <th class="column-title text-center">Tanggal Transaksi</th>
                            <th class="column-title text-center" colspan="2">Aksi</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($transferPulsa->data as $num => $row): ?>
                          <tr class="even pointer text-center" id="transaksi<?= $row->id ?>">
                            <td><?= $num+1 ?></td>
                            <td><?= $row->nomor_tujuan ?></td>
                            <td><?= $row->nomor_pengirim ?></td>
                            <td><?= toRupiah($row->denominasi) ?></td>
                            <td><?= toRupiah($row->total_pulsa_transfer) ?></td>
                            <td><?= $row->verifikasi ?></td>
                            <td><?= $row->sent ?></td>
                            <td><?= humantime($row->tanggal) ?></td>
                            <!-- <td><span class="fa fa-eye" title="Detail Transaksi" onclick="detailTransaksi()"></span></td> -->
                            <td><span class="fa fa-pencil-square-o" title="Ubah Data" onclick="window.location.href='<?= admin_url().'history?mode=edit&id='. $row->id ?>'"></span></td>
                            <td><span class="fa fa-trash-o" title="Hapus Data" onclick="deleteTransaksi(<?= $row->id ?>)"></span></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <?php else: ?>
                    <h3 class="text-center"><?= @$transferPulsa->error_message ?></h3>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->