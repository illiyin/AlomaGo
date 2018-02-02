        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Kabar Burung <small>Kabar berita dan komik</small></h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <form method="get">
                      <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search for..." autocomplete="off">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </form>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="form-group">
                          <a href="<?= admin_url() ?>kabarburung?method=new" type="submit" class="btn btn-success"> Kabar Baru</a>
                        </div>
                      </div>
                  <div class="clearfix"></div>
                  <div class="x_content">
                    <?php if(!$kabarBurung->is_ok): ?>
                    <h3 class="text-center">Data kabar burung masih kosong</h3>
                    <?php else: ?>
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title">Judul </th>
                            <th class="column-title">Penulis </th>
                            <th class="column-title">Tanggal </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php
                          foreach($kabarBurung->data as $num => $row):
                          ?>
                          <tr class="even pointer">
                            <td class=" "><?= $num+1 ?></td>
                            <td class=" "><?= $row->judul ?></td>
                            <td class=" "><?= $row->author ?></td>
                            <td class=" "><?= humantime($row->tanggal_waktu->datetime) ?></td>
                            <td class=" last">
                              <a href="<?= admin_url().'kabarburung?method=detail&id='.$row->id ?>"><i class="fa fa-eye"></i></a>
                              <a href="<?= admin_url().'kabarburung?method=edit&id='.$row->id ?>"><i class="fa fa-pencil-square-o"></i></a>
                              <a href="#" onclick="deleteKabarBurung(<?= $row->id ?>);"><i class="fa fa-trash"></i></a>
                            </td>
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