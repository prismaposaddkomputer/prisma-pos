<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-6">
      <a class="btn btn-primary" href="<?=base_url()?>kar_report_credit/range_pdf/<?=$date_start?>/<?=$date_end?>" target="_blank"><i class="fa fa-print"></i> Download PDF</a>
      <br><br>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="85">Tanggal</th>
            <th class="text-center" width="50">Aksi</th>
            <th class="text-center">Subtotal</th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $tx_total_before_tax = 0;
            $tx_total_tax = 0;
            $tx_total_after_tax = 0;
            $tx_total_discount = 0;
            $tx_total_grand = 0;
          ?>
          <?php if ($range != null): ?>
            <?php $i=1;foreach ($range as $row): ?>
              <tr>
                <td class="text-center"><?=date_to_ind($row->tx_date)?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>kar_report_credit/daily/<?=$row->tx_date?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $tx_total_before_tax += $row->tx_total_before_tax;?>
                <td><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $tx_total_tax += $row->tx_total_tax;?>
                <td><?=num_to_idr($row->tx_total_grand)?></td>
                  <?php $tx_total_grand += $row->tx_total_grand;?>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="9">Tidak ada data!</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <th class="text-center" colspan="2">Total</th>
          <th><?=num_to_idr($tx_total_before_tax)?></th>
          <th><?=num_to_idr($tx_total_tax)?></th>
          <th><?=num_to_idr($tx_total_grand)?></th>
        </tfoot>
      </table>
    </div>
  </div>
</div>
