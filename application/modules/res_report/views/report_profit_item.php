<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-8 col-lg-7 pull-right">
      <form class="" action="<?=base_url()?>res_report/report_profit_item" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control daterange-picker" name="search_profit_item" value="<?php echo $this->session->userdata('search_profit_item');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>res_report/reset_profit_item"><i class="fa fa-refresh"></i></a>
            </span>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php if ($this->session->userdata('search_profit_item')): ?>
        <i class="search_result">Hasil pencarian dengan kata kunci: <b><?=$this->session->userdata('search_profit_item');?></b></i><br><br>
      <?php endif; ?>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center">Nama Item</th>
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
            </tr>
          </thead>
          <tbody>
            <?php
              $tx_subtotal_buy_average = 0;
              $tx_subtotal_before_tax = 0;
              $tx_subtotal_tax = 0;
              $tx_subtotal_after_tax = 0;
              $tx_subtotal_discount = 0;
              $tx_subtotal_profit_before_tax = 0;
              $tx_subtotal_profit_after_tax = 0;
            ?>
            <?php if ($profit_item != null): ?>
              <?php $i=1;foreach ($profit_item as $row): ?>
                <tr>
                  <td><?=$row->item_name?></td>
                  <td><?=num_to_idr($row->tx_subtotal_buy_average)?></td>
                    <?php $tx_subtotal_buy_average += $row->tx_subtotal_buy_average;?>
                  <td><?=num_to_idr($row->tx_subtotal_before_tax)?></td>
                    <?php $tx_subtotal_before_tax += $row->tx_subtotal_before_tax;?>
                  <td><?=num_to_idr($row->tx_subtotal_tax)?></td>
                    <?php $tx_subtotal_tax += $row->tx_subtotal_tax;?>
                  <td><?=num_to_idr($row->tx_subtotal_after_tax)?></td>
                    <?php $tx_subtotal_after_tax += $row->tx_subtotal_after_tax;?>
                  <td><?=num_to_idr($row->tx_subtotal_discount)?></td>
                    <?php $tx_subtotal_discount += $row->tx_subtotal_discount;?>
                  <td><?=num_to_idr($row->tx_subtotal_profit_before_tax)?></td>
                    <?php $tx_subtotal_profit_before_tax += $row->tx_subtotal_profit_before_tax;?>
                  <td><?=num_to_idr($row->tx_subtotal_profit_after_tax)?></td>
                    <?php $tx_subtotal_profit_after_tax += $row->tx_subtotal_profit_after_tax;?>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="9">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <th class="text-center">Total</th>
            <th><?=num_to_idr($tx_subtotal_buy_average)?></th>
            <th><?=num_to_idr($tx_subtotal_before_tax)?></th>
            <th><?=num_to_idr($tx_subtotal_tax)?></th>
            <th><?=num_to_idr($tx_subtotal_after_tax)?></th>
            <th><?=num_to_idr($tx_subtotal_discount)?></th>
            <th><?=num_to_idr($tx_subtotal_profit_before_tax)?></th>
            <th><?=num_to_idr($tx_subtotal_profit_after_tax)?></th>
          </tfoot>
        </table>
        <div class="pull-right">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
