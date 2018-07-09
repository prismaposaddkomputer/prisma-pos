<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-primary" href="<?=base_url()?>kar_report_billing_member/daily_pdf/<?=$date?>/<?=$member_id?>" target="_blank"><i class="fa fa-print"></i> Download PDF</a>
      <br><br>
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" width="150">No. Kwitansi</th>
            <th class="text-center">Aksi</th>
            <th class="text-center">Waktu Awal</th>
            <th class="text-center">Waktu Akhir</th>
            <th class="text-center">Member</th>
            <th class="text-center">Pelangan</th>
            <th class="text-center">Status</th>
            <th class="text-center" width="100">Pembayaran</th>
            <th class="text-center" width="100">Subtotal</th>
            <th class="text-center" width="100">Pajak</th>
            <!-- <th class="text-center" width="100">Diskon</th> -->
            <th class="text-center" width="100">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $total_before_tax = 0;
            $total_discount = 0;
            $total_tax = 0;
            $total_grand = 0;
          ?>
          <?php if ($daily != null): ?>
            <?php foreach ($daily as $row): ?>
              <tr>
                <td class="text-center"><?='TXP-'.$row->tx_receipt_no?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>kar_report_billing_member/detail/<?=$row->tx_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td class="text-center"><?=$row->tx_time_start?></td>
                <td class="text-center"><?=$row->tx_time_end?></td>
                <td><?=$row->member_name?></td>
                <td><?=$row->member_name?></td>
                <td class="text-center">
                  <?php switch ($row->tx_status) {
                    case '-1':
                      echo 'Batal';
                      break;

                    case '0':
                      echo 'Proses';
                      break;

                    case '1':
                      echo 'Tunda';
                      break;

                    case '2':
                      echo 'Sukses';
                      break;
                  } ?>
                </td>
                <td><?=$row->payment_type_name?></td>
                <td><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $total_before_tax += $row->tx_total_before_tax;?>
                <td><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $total_tax += $row->tx_total_tax;?>
                <!-- <td><?=num_to_idr($row->tx_total_discount)?></td>
                  <?php $total_discount += $row->tx_total_discount;?> -->
                <td><?=num_to_idr($row->tx_total_grand)?></td>
                  <?php $total_grand += $row->tx_total_grand;?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="11">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="8" class="text-center">Total</th>
            <th><?=num_to_idr($total_before_tax)?></th>
            <th><?=num_to_idr($total_tax)?></th>
            <!-- <th><?=num_to_idr($total_discount)?></th> -->
            <th><?=num_to_idr($total_grand)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
