<h3><?= $client->client_name; ?></h3>
<h5><?= $client->client_street.', '.$client->client_subdistrict.', '.$client->client_district.', '.$client->client_city.', '.$client->client_province;?></h5>
<?php if($this->session->userdata('role_id') <= 1):?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">Penjualan Hari Ini <small>(Setelah Pajak)</small></div>
      <div class="panel-body">
        <h3><?php if($selling_today != null){echo num_to_idr($selling_today->tx_total_after_tax);}else{echo num_to_idr(0);} ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">Keuntungan Hari Ini <small>(Sebelum Pajak)</small></div>
      <div class="panel-body">
        <h3><?php if($selling_today != null){echo num_to_idr($selling_today->tx_total_profit_before_tax);}else{echo num_to_idr(0);} ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">Jumlah Barang Terjual Hari Ini</div>
      <div class="panel-body">
        <h3 class="pull-right"><?php if($total_item_today != null){echo num_to_price($total_item_today->total_item);}else{echo num_to_price(0);} ?></h3>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Penjualan Bulan <?php echo date('M'); ?></div>
      <div class="panel-body">
        <canvas id="sellingChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Grafik Laba Tahun <?php echo date('Y'); ?></div>
      <div class="panel-body">
        <canvas id="profitChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Produk Terlaris Bulan <?php echo date('M'); ?></div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Produk</th>
              <th class="text-center">Jml Penjualan</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($most_sell != null): ?>
              <?php $i=0; foreach ($most_sell as $row): ?>
                <tr>
                  <td class="text-center"><?=++$i?></td>
                  <td><?=$row->item_name?></td>
                  <td class="text-center"><?=$row->tx_amount?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3">Data tidak ada!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Produk Terbaru</div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Produk</th>
              <th class="text-center">Terdaftar</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($new_item != null): ?>
              <?php $i=0; foreach ($new_item as $row): ?>
                <tr>
                  <td class="text-center"><?=++$i?></td>
                  <td><?=$row->item_name?></td>
                  <td class="text-center"><?=$row->created?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3">Data tidak ada!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  //selling chart
  var sC = document.getElementById("sellingChart").getContext('2d');
  var sellingChart = new Chart(sC, {
    type: 'line',
    data: {
      labels: [
        <?php
          foreach ($graph_sell_date as $row) {
            echo substr($row->tx_date,8,2).',';
          }
        ?>
      ],
      datasets: [{
        label: 'Penjualan (Setelah Pajak)',
        data: [
          <?php
            foreach ($graph_sell_amount as $row) {
              echo $row->tx_total_after_tax.',';
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
  //selling chart
  var pC = document.getElementById("profitChart").getContext('2d');
  var profitChart = new Chart(pC, {
    type: 'bar',
    data: {
      labels: [
        <?php
          foreach ($graph_profit_month as $row) {
            echo '"'.$row->tx_month.'",';
          }
        ?>
      ],
      datasets: [{
        label: 'Laba (Sebelum Pajak)',
        data: [
          <?php
            foreach ($graph_profit_amount as $row) {
              echo $row->tx_total_profit_before_tax.',';
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
