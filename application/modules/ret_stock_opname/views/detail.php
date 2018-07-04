<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <div class="table-responsive">
        <table class="table table-striped table-condensed">
          <tbody>
            <tr>
              <td width="150">No Kwitansi</td>
              <td class="text-center" width="30">:</td>
              <td><?=$detail->tx_type.'-'.$detail->tx_receipt_no?></td>
            </tr>
            <tr>
              <td>Jenis Transaksi</td>
              <td class="text-center">:</td>
              <td><?=$detail->tx_name?></td>
            </tr>
            <tr>
              <td>Stempel Waktu</td>
              <td class="text-center">:</td>
              <td><?=$detail->created?></td>
            </tr>
            <tr>
              <td>Catatan</td>
              <td class="text-center">:</td>
              <td><?=$detail->tx_notes?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-condensed table-bordered">
          <thead>
            <tr>
              <th class="text-center">Nama</th>
              <th class="text-center" width="100">Jumlah</th>
              <th class="text-center" width="150">Harga Beli/Unit</th>
              <th class="text-center" width="150">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $grand_total = 0; foreach ($detail->recap as $row): ?>
              <tr>
                <td><?=$row->item_name?></td>
                <td class="text-center"><?=$row->stock_adjustment?></td>
                <td><?=num_to_idr($row->stock_price)?></td>
                <td><?=num_to_idr($row->stock_adjustment*$row->stock_price)?></td>
              </tr>
              <?php $grand_total = $grand_total+$row->stock_in*$row->stock_price; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
