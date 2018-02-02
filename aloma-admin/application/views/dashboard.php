
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
      <?php
      $today = date('Y-m-d');
      $transToday = 0;

      if ( $transferPulsa->is_ok)
      {
        foreach($transferPulsa->data as $row)
        {
          $tanggal = explode(' ' , $row->tanggal);
          if($tanggal[0] == $today) $transToday += 1;

          // $pendapatan += $row->nominal;
        }
      }
      
      ?>
      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
          <div class="count"><?= $transferPulsa->is_ok ? count($transferPulsa->data) : 0?></div>
          <h3>Transaksi</h3>
          <p><?= $transToday; ?> transaksi hari ini.</p>
        </div>
      </div>
    </div>
  </div>
</div>