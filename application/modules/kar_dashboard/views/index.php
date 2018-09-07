<h3><?= $client->client_name; ?></h3>
<h5><?= $client->client_street.', '.$client->client_subdistrict.', '.$client->client_district.', '.$client->client_city.', '.$client->client_province;?></h5>
<div class="container-fluid">
	<div class="alert alert-success">
		<i class="fa fa-exclamation-circle"></i><small> Login berhasil, Selamat Datang <?=$this->session->userdata('user_realname')?>.</small>
		<button type="button" class="close" data-dismiss="alert">
			×
		</button>
	</div>
</div>
<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Reservasi Hari Ini</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-users fa-4x cl-info">&nbsp;<?php if($count_today != null){echo $count_today;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
          <a class="btn btn-info btn-block" href="<?=base_url()?>kar_report_reservation/daily/<?=date("Y-m-d")?>">Lihat</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Total Reservasi</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-credit-card fa-4x cl-info">&nbsp;<?php if($count_all != null){echo $count_all;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
          <a class="btn btn-info btn-block" href="<?=base_url()?>kar_reservation">Lihat</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Kamar</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-home fa-4x cl-info">&nbsp;<?php if($total_room_available != null){echo $total_room_available->total_room;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
          <a class="btn btn-info btn-block" href="<?=base_url()?>kar_room">Lihat</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Tamu Langganan</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-users fa-4x cl-info">&nbsp;<?php if($count_guest_member != null){echo $count_guest_member;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
            <a class="btn btn-info btn-block" href="<?=base_url()?>kar_guest/index/ada">Lihat</a>
				</div>
			</div>
		</div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-bar-chart"></i> Grafik Jumlah Pemesanan Bulan <?=month_name_ind($name_month)?></div>
      <div class="panel-body">
        <canvas id="chart_month"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-bar-chart"></i> Grafik Total Transaksi Bulan <?=month_name_ind($name_month)?></div>
      <div class="panel-body">
        <canvas id="total_month"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-external-link"></i> Pemesanan Terakhir</div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="50">No</th>
              <th class="text-center" width="100">Aksi</th>
              <th class="text-center">No. Nota</th>
              <th class="text-center cl-success"><i class="fa fa-arrow-down"></i> In (Masuk)</th>
              <th class="text-center cl-danger"><i class="fa fa-arrow-up"></i> Out (Keluar)</th>
              <th class="text-center">Tamu</th>
              <th class="text-center" width="150">Total</th>
              <th class="text-center" width="80">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($billing != null): ?>
              <?php $i=1;foreach ($billing as $row): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td class="text-center">
                    <?php if ($row->billing_status != -1): ?>
                      <a class="btn btn-xs btn-warning" href="<?=base_url()?>kar_reservation/form/<?=$row->billing_id?>"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-xs btn-success" href="<?=base_url()?>kar_reservation/payment/<?=$row->billing_id?>"><i class="fa fa-money"></i></a>
                      <a class="btn btn-xs btn-danger" href="<?=base_url()?>kar_reservation/cancel/<?=$row->billing_id?>"><i class="fa fa-trash"></i></a>
                    <?php endif;?>
                  </td>
                  <td class="text-center">TRS-<?=$row->billing_receipt_no?></td> 
                  <td class="text-center"><?=date_to_ind($row->billing_date_in).' '.$row->billing_time_in?></td>
                  <td class="text-center"><?=date_to_ind($row->billing_date_out).' '.$row->billing_time_out?></td>
                  <td><?=$row->guest_name?></td>
                  <td><?=num_to_idr($row->billing_total)?></td>
                  <td class="text-center">
                    <?php if ($row->billing_status == -1){ ?>
                      <span class="badge bg-danger">Dibatalkan</span>
                    <?php }else if($row->billing_status == 1){ ?>
                      <span class="badge bg-warning">Belum Dibayar</span>
                    <?php }else if($row->billing_status == 2){ ?>
                      <span class="badge bg-success">Sudah Dibayar</span>
                    <?php }; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="8">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="informationUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informasi Update</h4>
      </div>
      <div class="modal-body">
        <div style="font-weight: bold; font-size: 15px; margin-bottom: 7px;">Prisma POS - V<?=$version->version_now?></div>
        <ul style="margin-left: -10px; font-size: 15px;">
          <li>Metode input kamar sudah otomatis. Hanya mengisi jenis kamar dan jumlah kamar, maka data kamar akan terisi otomatis</li>
          <li>Item transaksi sudah dipisah-pisah menurut kategori (Ekstra, Pelayanan, FnB dan Non Pajak)</li>
          <li>Untuk 1 transaksi bisa menginputkan data item transaksi > 1</li>
          <li>Harga bisa di set sebelum/sesudah pajak, dimenu Pengaturan -> Client</li>
          <li>Jenis harga bisa disesuaikan dengan kebutuhan (Pajak, service, biaya lain-lain)</li>
          <li>Pemesanan, Pembayaran, dan Tamu jadi 1 menu</li>
          <li>Cetak struk bisa berupa kertas Thermal (Printer Kecil) atau PDF (Printer Besar)</li>
          <li>Laporan bisa berupa cetak Printer Thermal (Printer Kecil) atau PDF</li>
          <li>Printer Thermal (Printer Kecil) bisa mencetak gambar</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><b>Close</b> <i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<script>
    // Grafik Jumlah Pemesanan Bulan Ini
    var color = Chart.helpers.color;
    var barChartData = {
      labels: [
      <?php 
      foreach ($monthly as $row): 
      $date = $row->billing_date_in;
      $raw = $raw = explode("-", $date);
      ?>
        'Tgl <?=$raw[2]?>',
      <?php endforeach; ?>
      ],
      datasets: [{
        label: 'Orang',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: [
        <?php foreach ($count_monthly as $row): ?>
          '<?=$row['count_data']?>',
        <?php endforeach; ?>
        ]
      }]

    };

    // Grafik Total Bulan Ini
    var color = Chart.helpers.color;
    var barTotalmonth = {
      labels: [
      <?php 
      foreach ($monthly as $row): 
      $date = $row->billing_date_in;
      $raw = $raw = explode("-", $date);
      ?>
        'Tgl <?=$raw[2]?>',
      <?php endforeach; ?>
      ],
      datasets: [{
        label: 'Rp',
        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [
        <?php 
        $billing_total = 0;
        foreach ($monthly as $row): 
        $billing_total += $row->billing_total;
        ?>
          '<?=$billing_total?>',
        <?php endforeach; ?>
        ]
      }]

    };

    // Grafik Jumlah Pemesanan Bulan Ini
    window.onload = function() {
      var ctx = document.getElementById('chart_month').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          responsive: true,
          legend: {
            // position: 'top',
            display: false
          },
          title: {
            display: false,
            text: 'Chart.js Bar Chart'
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Tanggal'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Jumlah Pemesan (Orang)'
              },
              ticks: {
                stepSize: 0
              }
            }]
          }
        }
      });

      // Grafik Total Bulan Ini
      var total = document.getElementById('total_month').getContext('2d');
      window.totalBar = new Chart(total, {
        type: 'bar',
        data: barTotalmonth,
        options: {
          responsive: true,
          legend: {
            // position: 'top',
            display: false
          },
          title: {
            display: false,
            text: 'Chart.js Bar Chart'
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Tanggal'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Total Transaksi (Rp)'
              },
              ticks: {
                stepSize: 0
              }
            }]
          }
        }
      });

    };
</script>

<script>
  $('#informationUpdate').modal('show')
  //selling chart
  var sC = document.getElementById("sellingChart").getContext('2d');
  var sellingChart = new Chart(sC, {
    type: 'line',
    data: {
      labels: [
        <?php
          foreach ($graph_profit_month as $row) {
            echo '"'.$row->tx_month.'",';
          }
        ?>
      ],
      datasets: [{
        label: 'Pemesanan (Per Bulan)',
        data: [
          <?php
            foreach ($graph_profit_amount as $row) {
              echo $row->total_booking.',';
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
              echo $row->total_booking.',';
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
