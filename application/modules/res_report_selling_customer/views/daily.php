<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">Tx Kwitansi</th>
            <th class="text-center">Aksi</th>
            <th class="text-center">Waktu</th>
            <th class="text-center">Kasir</th>
            <th class="text-center">Pelangan</th>
            <th class="text-center">Status</th>
            <th class="text-center">Pembayaran</th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($daily != null): ?>
            <?php foreach ($daily as $row): ?>
              <tr>
                <td class="text-center"><?=$row->tx_type.'-'.$row->tx_receipt_no?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>res_report_selling_customer/detail/<?=$row->tx_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td class="text-center"><?=$row->tx_time?></td>
                <td><?=$row->user_realname?></td>
                <td><?=$row->customer_name?></td>
                <td class="text-center">
                  <?php switch ($row->tx_status) {
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
                <td><?=$row->payment_type_name?></td>
                <td><?=num_to_idr($row->tx_total_discount)?></td>
                <td><?=num_to_idr($row->tx_total_tax)?></td>
                <td><?=num_to_idr($row->tx_total_grand)?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="10">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
