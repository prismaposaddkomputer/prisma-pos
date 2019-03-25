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
        <input type="hidden" name="url" value="<?=base_url()?>res_report_selling/range_pdf/<?=$date_start?>/<?=$date_end?>">
        <button class="btn btn-primary" type="submit"><i class="fa fa-file-pdf-o"></i> Download PDF</button>
        <a href="<?=base_url()?>res_report_selling/range_print/<?=$date_start?>/<?=$date_end?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
      </form>
      <br>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="85">Tanggal</th>
            <th class="text-center" width="50">Aksi</th>
            <th class="text-center">Penjualan<br><small>(Sebelum Pajak)</small></th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Penjualan<br><small>(Setelah Pajak)</small><br><small>(3+4)</small></th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Total<br><small>(5-6)</small></th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>
            <td class="text-center" style="padding:0px;">5</td>
            <td class="text-center" style="padding:0px;">6</td>
            <td class="text-center" style="padding:0px;">7</td>
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
                  <a href="<?=base_url()?>res_report_selling/daily/<?=$row->tx_date?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $tx_total_before_tax += $row->tx_total_before_tax;?>
                <td><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $tx_total_tax += $row->tx_total_tax;?>
                <td><?=num_to_idr($row->tx_total_after_tax)?></td>
                  <?php $tx_total_after_tax += $row->tx_total_after_tax;?>
                <td><?=num_to_idr($row->tx_total_discount)?></td>
                  <?php $tx_total_discount += $row->tx_total_discount;?>
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
          <th><?=num_to_idr($tx_total_after_tax)?></th>
          <th><?=num_to_idr($tx_total_discount)?></th>
          <th><?=num_to_idr($tx_total_grand)?></th>
        </tfoot>
      </table>
    </div>
  </div>
</div>
