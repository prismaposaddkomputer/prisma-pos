<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <table class="table table-condensed table-striped">
        <tr>
          <td width="150">No Transaksi</td>
          <td width="20">:</td>
          <td>TXP-<?=$billing->tx_id?></td>
        </tr>
        <tr>
          <td>Tanggal & Waktu</td>
          <td>:</td>
          <td><?=date_to_ind($billing->tx_date)?> <?=$billing->tx_time_start?> s/d <?=$billing->tx_time_end?></td>
        </tr>
        <tr>
          <td>Kasir</td>
          <td>:</td>
          <td><?=$billing->user_realname?></td>
        </tr>
        <tr>
          <td>Status</td>
          <td>:</td>
          <td>
            <?php switch ($billing->tx_status) {
              case '-1':
                echo 'Batal';
                break;

              case '0':
                echo 'Proses';
                break;

              case '1':
                echo 'Tahan';
                break;

              case '2':
                echo 'Sukses';
                break;
            } ?>
          </td>
        </tr>
      </table>
    </div>
    <div class="col-md-6">
      <table class="table table-striped table-condensed">
        <tr>
          <td width="150">Member</td>
          <td width="20">:</td>
          <td><?=$billing->member_name?></td>
        </tr>
        <tr>
          <td width="150">Jenis Pembayaran</td>
          <td width="20">:</td>
          <td><?=$billing->payment_type_name?></td>
        </tr>
      </table>
    </div>
    <div class="col-md-12">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="50">No</th>
            <th class="text-center">Nama Item</th>
            <th class="text-center" width="200">Harga</th>
            <th class="text-center" width="70"> Banyak</th>
            <th class="text-center" width="200">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <tr>
            <td><?=$i++?></td>
            <td>Room <?=$billing->room_type_name?> <?=$billing->room_name?></td>
            <td><?=num_to_idr($billing->tx_room_price)?></td>
            <td class="text-center"><?=$billing->tx_duration?> jam</td>
            <td><?=num_to_idr($billing->tx_room_price_total)?></td>
          </tr>
          <?php foreach ($billing->service_charge as $row): ?>
            <tr>
              <td><?=$i++?></td>
              <td><?=$row->service_charge_name?></td>
              <td><?=num_to_idr($row->service_charge_price)?></td>
              <td class="text-center"><?=$row->service_charge_amount?></td>
              <td><?=num_to_idr($row->service_charge_total)?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-8">

    </div>
    <div class="col-md-4">
      <table class="table table-striped table-condensed">
        <tr>
          <td width="100">Subtotal</td>
          <td width="50">:</td>
          <td><?=num_to_idr($billing->tx_total_before_tax)?></td>
        </tr>
        <!-- <tr>
          <td>Diskon</td>
          <td>:</td>
          <td><?=num_to_idr($billing->tx_total_discount)?></td>
        </tr>
        <tr>
          <td>Pajak</td>
          <td>:</td>
          <td><?=num_to_idr($billing->tx_total_tax)?></td>
        </tr> -->
        <tr>
          <th>Total</th>
          <th>:</th>
          <th><?=num_to_idr($billing->tx_total_grand)?></th>
        </tr>
      </table>
      <table class="table table-striped table-condensed">
        <tr>
          <td width="100">Pembayaran</td>
          <td width="50">:</td>
          <td><?=num_to_idr($billing->tx_payment)?></td>
        </tr>
        <tr>
          <th>Kembalian</th>
          <th>:</th>
          <th><?=num_to_idr($billing->tx_change)?></th>
        </tr>
      </table>
    </div>
  </div>
</div>
