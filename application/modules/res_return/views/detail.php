<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <table class="table table-condensed table-striped">
        <tbody>
          <tr>
            <td width="150">No Kwitansi</td>
            <td width="20">:</td>
            <td><?='TXS-'.$return->tx_receipt_no?></td>
          </tr>
          <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td><?=$return->customer_name?></td>
          </tr>
          <tr>
            <td>Tanggal/Waktu</td>
            <td>:</td>
            <td><?=ind_to_date($return->tx_date)?> <?=$return->tx_time?></td>
          </tr>
          <tr>
            <td>Alasan</td>
            <td>:</td>
            <td><?=$return->return_notes?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table style="background:white" class="table table-bordered table-">
        <thead>
          <tr>
            <th class="text-center">Item Name</th>
            <th class="text-center" width="200">Harga</th>
            <th class="text-center" width="80">Banyak Beli</th>
            <th class="text-center" width="80">Banyak Retur</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($return->detail as $row): ?>
            <tr>
              <td><?=$row->item_name?></td>
              <td><?=num_to_idr($row->item_price_after_tax)?></td>
              <td class="text-center"><?=$row->tx_amount?></td>
              <td class="text-center"><?=$row->return_amount?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
