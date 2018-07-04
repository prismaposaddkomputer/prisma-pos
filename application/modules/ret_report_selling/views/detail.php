<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <table class="table table-condensed table-striped">
        <tr>
          <td width="150">No Kwitansi</td>
          <td width="20">:</td>
          <td><?=$billing->tx_type?>-<?=$billing->tx_receipt_no?></td>
        </tr>
        <tr>
          <td>Tanggal & Waktu</td>
          <td>:</td>
          <td><?=date_to_ind($billing->tx_date)?> <?=$billing->tx_time?></td>
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
              case '-2':
                echo 'Batal';
                break;

              case '-1':
                echo 'Tahan';
                break;

              case '0':
                echo 'Proses';
                break;

              case '1':
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
          <td width="150">Pelanggan</td>
          <td width="20">:</td>
          <td><?=$billing->customer_name?></td>
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
            <th class="text-center" width="200">Harga <small>(Setelah Pajak)</small></th>
            <th class="text-center" width="70"> Banyak</th>
            <th class="text-center" width="200">Diskon</th>
            <th class="text-center" width="200">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; foreach ($billing->detail as $row): ?>
            <tr>
              <td><?=$i++?></td>
              <td><?=$row->item_name?></td>
              <td><?=num_to_idr($row->item_price_after_tax)?></td>
              <td class="text-center"><?=$row->tx_amount?></td>
              <td><?=num_to_idr($row->tx_subtotal_discount)?></td>
              <td><?=num_to_idr($row->tx_subtotal_after_tax)?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-8">
      <?php if ($billing->buyget != null || $billing->buyitem != null || $billing->buyall != null): ?>
        <h4>Promo</h4>
      <?php endif; ?>
      <?php if ($billing->buyget != null): ?>
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Jenis Promo</th>
              <th class="text-center">Nama Item</th>
              <th class="text-center">Banyak</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($billing->buyget as $row): ?>
              <tr>
                <td><?=$row->promo_name?></td>
                <td><?=$row->item_name?></td>
                <td><?=$row->get_amount?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
      <?php if ($billing->buyitem != null): ?>
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Jenis Promo</th>
              <th class="text-center">Diskon</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($billing->buyitem as $row): ?>
              <tr>
                <td><?=$row->promo_name?></td>
                <td><?=$row->get_discount?>%</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
      <?php if ($billing->buyall != null): ?>
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Jenis Promo</th>
              <th class="text-center">Diskon</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($billing->buyall as $row): ?>
              <tr>
                <td><?=$row->promo_name?></td>
                <td><?=$row->get_discount?>%</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
    <div class="col-md-4">
      <table class="table table-striped table-condensed">
        <tr>
          <td width="100">Subtotal</td>
          <td width="50">:</td>
          <td><?=num_to_idr($billing->tx_total_before_tax)?></td>
        </tr>
        <tr>
          <td>Diskon</td>
          <td>:</td>
          <td><?=num_to_idr($billing->tx_total_discount)?></td>
        </tr>
        <tr>
          <td>Pajak</td>
          <td>:</td>
          <td><?=num_to_idr($billing->tx_total_tax)?></td>
        </tr>
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
