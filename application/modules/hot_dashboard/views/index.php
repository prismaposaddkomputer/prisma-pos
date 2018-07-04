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
          <h3 class="panel-title">Jumlah Tamu Hari Ini</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-users fa-4x cl-info">&nbsp;<?php if($total_guest_today != null){echo $total_guest_today->total_guest;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
          <a class="btn btn-info btn-block" href="<?=base_url()?>hot_guest">Lihat</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Pemesanan Hari ini</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-credit-card fa-4x cl-info">&nbsp;<?php if($booking_today != null){echo $booking_today->total_booking;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
          <a class="btn btn-info btn-block" href="<?=base_url()?>hot_booking">Lihat</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Kamar Tersedia</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-home fa-4x cl-info">&nbsp;<?php if($total_room_available != null){echo $total_room_available->total_room;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
          <a class="btn btn-info btn-block" href="<?=base_url()?>hot_room">Lihat</a>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Jumlah Pelayanan</h3>
				</div>
				<div class="panel-body">
					<i class="fa fa-bell fa-4x cl-info">&nbsp;<?php if($total_service_available != null){echo $total_service_available->total_service;}else{echo 0;} ?></i>
				</div>
				<div class="panel-footer">
            <a class="btn btn-info btn-block" href="<?=base_url()?>hot_service">Lihat</a>
				</div>
			</div>
		</div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-bar-chart"></i> Grafik Pemesanan Tahun <?php echo date('Y'); ?></div>
      <div class="panel-body">
        <canvas id="sellingChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-external-link"></i> Pemesanan Terakhir</div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Aksi</th>
              <th class="text-center">Kode Booking</th>
              <th class="text-center">Tanggal Booking</th>
              <th class="text-center">Check Out</th>
              <th class="text-center">Nama Tamu</th>
              <th class="text-center">Nama Resepsionis</th>
              <th class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php if ($payment != null): ?>
              <?php $i=1;foreach ($payment as $row): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td class="text-center">
                    <?php if ($row->cashed == 1): ?>
                        <?php if ($row->id != 0 ): ?>
                          <a class="btn btn-xs btn-warning" href="<?=base_url()?>hot_payment/struk/<?=$row->booking_id?>"><i class="fa fa-print"></i></a>
                          
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($row->id != 0 ): ?>
                          <a class="btn btn-xs btn-warning" href="<?=base_url()?>hot_payment/form/<?=$row->booking_id?>"><i class="fa fa-pencil"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=$t->booking_code?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=$t->date_booking_from?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=$t->date_booking_to?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>

                              <?php
                                foreach($guest as $z){
                                  if($t->guest_id==$z->guest_id){
                                    ?>
                                    <?=$z->guest_name?>
                                    <?php
                                  }
                                }
                              ?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=$t->created_by?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td class="text-center">
                    <?php if ($row->cashed == 1): ?>
                        <small class='label label-success'>Sudah Bayar</small>
                    <?php else: ?>
                        <small class='label label-danger'>Belum Bayar</small>
                    <?php endif; ?>
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

<script>
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
