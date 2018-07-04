<h3><?= $client->client_name; ?></h3>
<h5><?= $client->client_street.', '.$client->client_subdistrict.', '.$client->client_district.', '.$client->client_city.', '.$client->client_province;?></h5>
<?php if($this->session->userdata('role_id') <= 1):?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">Kendaraan masuk</div>
      <div class="panel-body">
        <h3><?php if($num_in != null){echo $num_in->total;}else{echo 0;} ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">Kendaraan keluar</div>
      <div class="panel-body">
        <h3><?php if($num_in != null){echo $num_out->total;}else{echo 0;} ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">Pemasukan</div>
      <div class="panel-body">
        <h3><?php if($income_today != null){echo num_to_idr($income_today->total);}else{echo num_to_idr(0);} ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Penjualan Bulan <?php echo date('M'); ?></div>
      <div class="panel-body">
        <canvas id="monthCart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Laba Tahun <?php echo date('Y'); ?></div>
      <div class="panel-body">
        <canvas id="yearCart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Parkir Masuk Terakhir Hari Ini</div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">TNKB</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Merek</th>
              <th class="text-center">Waktu</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($last_park_in != null): ?>
              <?php foreach ($last_park_in as $row): ?>
                <tr>
                  <td class="text-center"><?=$row->billing_tnkb?></td>
                  <td><?=$row->category_name?></td>
                  <td><?=$row->brand_name?></td>
                  <td class="text-center"><?=$row->billing_time_in?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">Data tidak ada!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Parkir Keluar Terakhir Hari Ini</div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">TNKB</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">Merek</th>
              <th class="text-center">Waktu</th>
              <th class="text-center">Durasi</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($last_park_out != null): ?>
              <?php foreach ($last_park_out as $row): ?>
                <tr>
                  <td class="text-center"><?=$row->billing_tnkb?></td>
                  <td><?=$row->category_name?></td>
                  <td><?=$row->brand_name?></td>
                  <td class="text-center"><?=$row->billing_time_out?></td>
                  <td class="text-center"><?=$row->billing_duration?> jam</td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center">Data tidak ada!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  //month chart
  var mC = document.getElementById("monthCart").getContext('2d');
  var monthCart = new Chart(mC, {
    type: 'line',
    data: {
      labels: [
        <?php
          foreach ($income_date as $row) {
            echo substr($row->billing_date_out,8,2).',';
          }
        ?>
      ],
      datasets: [{
        label: 'Pendapatan',
        data: [
          <?php
            foreach ($income_date_amount as $row) {
              echo $row->total.',';
            }
          ?>
        ],
        fill: false,
        backgroundColor: '#0abde3',
        borderColor: '#0abde3',
        borderWidth: 3
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
  //year chart
  var yC = document.getElementById("yearCart").getContext('2d');
  var yearCart = new Chart(yC, {
    type: 'bar',
    data: {
      labels: [
        <?php
          foreach ($income_month as $row) {
            echo '"'.$row->month.'",';
          }
        ?>
      ],
      datasets: [{
        label: 'Laba (Sebelum Pajak)',
        data: [
          <?php
            foreach ($income_month_amount as $row) {
              echo $row->total.',';
            }
          ?>
        ],
        fill: false,
        backgroundColor: '#ff9f43',
        borderColor: '#ff9f43',
        borderWidth: 3
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>
<?php endif;?>
