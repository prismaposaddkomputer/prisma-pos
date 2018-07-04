<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="85">Bulan</th>
            <th class="text-center" width="50">Aksi</th>
            <th class="text-center">Pembelian</th>
            <th class="text-center">Penjualan<br><small>(Sebelum Pajak)</small></th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Penjualan<br><small>(Setelah Pajak)</small><br><small>(3+4)</small></th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Keuntungan<br><small>(Sebelum Pajak)</small><br><small>(3-2-6)</small></th>
            <th class="text-center">Keuntungan<br><small>(Setelah Pajak)</small><br><small>(7-4)</small></th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>
            <td class="text-center" style="padding:0px;">5</td>
            <td class="text-center" style="padding:0px;">6</td>
            <td class="text-center" style="padding:0px;">7</td>
            <td class="text-center" style="padding:0px;">8</td>
            <td class="text-center" style="padding:0px;">9</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $tx_total_buy_average = 0;
            $tx_total_before_tax = 0;
            $tx_total_tax = 0;
            $tx_total_after_tax = 0;
            $tx_total_discount = 0;
            $tx_total_profit_before_tax = 0;
            $tx_total_profit_after_tax = 0;
          ?>
          <?php if ($annual != null): ?>
            <?php $i=1;foreach ($annual as $row): ?>
              <tr>
                <td class="text-center"><?=month_name_ind($row->tx_month)?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>res_report_profit/monthly/<?=$row->tx_year?>-<?=str_pad($row->tx_month, 2, '0', STR_PAD_LEFT)?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td><?=num_to_idr($row->tx_total_buy_average)?></td>
                  <?php $tx_total_buy_average += $row->tx_total_buy_average;?>
                <td><?=num_to_idr($row->tx_total_before_tax)?></td>
                  <?php $tx_total_before_tax += $row->tx_total_before_tax;?>
                <td><?=num_to_idr($row->tx_total_tax)?></td>
                  <?php $tx_total_tax += $row->tx_total_tax;?>
                <td><?=num_to_idr($row->tx_total_after_tax)?></td>
                  <?php $tx_total_after_tax += $row->tx_total_after_tax;?>
                <td><?=num_to_idr($row->tx_total_discount)?></td>
                  <?php $tx_total_discount += $row->tx_total_discount;?>
                <td><?=num_to_idr($row->tx_total_profit_before_tax)?></td>
                  <?php $tx_total_profit_before_tax += $row->tx_total_profit_before_tax;?>
                <td><?=num_to_idr($row->tx_total_profit_after_tax)?></td>
                  <?php $tx_total_profit_after_tax += $row->tx_total_profit_after_tax;?>
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
          <th><?=num_to_idr($tx_total_buy_average)?></th>
          <th><?=num_to_idr($tx_total_before_tax)?></th>
          <th><?=num_to_idr($tx_total_tax)?></th>
          <th><?=num_to_idr($tx_total_after_tax)?></th>
          <th><?=num_to_idr($tx_total_discount)?></th>
          <th><?=num_to_idr($tx_total_profit_before_tax)?></th>
          <th><?=num_to_idr($tx_total_profit_after_tax)?></th>
        </tfoot>
      </table>
    </div>
  </div>
</div>
