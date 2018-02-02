        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Inbox <small>Laporan pesan masuk di simbox</small></h3>
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
                    <?php if($inbox): ?>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title text-center">#</th>
                            <th class="column-title text-center">No. Penerima </th>
                            <th class="column-title text-center">No. Pengirim </th>
                            <th class="column-title text-center">Text</th>
                            <th class="column-title text-center">Status</th>
                            <!-- <th class="column-title text-center">Aksi</th> -->
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($inbox->data as $num => $row): ?>
                          <tr class="even pointer text-center">
                            <td><?= $num+1 ?></td>
                            <td><?= $row->SenderNumber ?></td>
                            <td><?= $row->SMSCNumber ?></td>
                            <td><?= $row->TextDecoded ?></td>
                            <td><?= $row->Processed ? 'Sudah di proses' : 'Belum di proses' ?></td>
                            <!-- <td><span class="fa fa-eye" title="Detail Inbox"></span></td> -->
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->