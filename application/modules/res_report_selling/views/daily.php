<div class="content-header">
  <h4>
    <a href="<?=base_url('res_report_selling')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i></a> 
    <i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?>
  </h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="<?=base_url()?>res_report_selling/frame_pdf">
        <input type="hidden" name="url" value="<?=base_url()?>res_report_selling/daily_pdf/<?=$date?>">
        <button class="btn btn-primary" type="submit"><i class="fa fa-file-pdf-o"></i> Download PDF</button>
        <a href="<?=base_url()?>res_report_selling/daily_print/<?=$date?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Komplit</a>
        <a href="<?=base_url()?>res_report_selling/daily_print_only_nominal/<?=$date?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Hanya Nominal</a>
        <a href="<?=base_url()?>res_report_selling/daily_print_per_item/<?=$date?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Per Item</a>
      </form>
      <br>
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No Kwitansi</th>
            <th class="text-center">Aksi</th>
            <th class="text-center">Waktu</th>
            <th class="text-center">Kasir</th>
            <th class="text-center">Pelangan</th>
            <th class="text-center">Status</th>
            <th class="text-center">Pembayaran</th>
            <th class="text-center">Subtotal</th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Total</th>
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
                <td class="text-center"><?=$row->tx_type.'-'.$row->tx_receipt_no?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>res_report_selling/detail/<?=$row->tx_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
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
                <td><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $total_before_tax += $row->tx_total_before_tax;?>
                <td><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $total_tax += $row->tx_total_tax;?>
                <td><?=num_to_idr($row->tx_total_discount)?></td>
                  <?php $total_discount += $row->tx_total_discount;?>
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
            <th colspan="7" class="text-center">Total</th>
            <th><?=num_to_idr($total_before_tax)?></th>
            <th><?=num_to_idr($total_tax)?></th>
            <th><?=num_to_idr($total_discount)?></th>
            <th><?=num_to_idr($total_grand)?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
