<div class="content-header">
  <a class="btn btn-success pull-right" target="_blank" href="<?=base_url()?>par_report_income_user/report_daily_pdf/<?=$date?>/<?=$user_id?>"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <table class="table table-bordered table-condensed table-striped">
    <thead>
      <tr>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Nama Petugas</th>
        <th class="text-center">Jumlah Kendaraan</th>
        <th class="text-center">Subtotal</th>
        <th class="text-center">Pajak</th>
        <th class="text-center" width="200">Total Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $billing_count = 0;
        $billing_total_subtotal = 0;
        $billing_total_tax = 0;
        $billing_total_total_grand = 0;
      ?>
      <?php if($billing != null):?>
        <?php foreach ($billing as $row): ?>
          <tr>
            <td class="text-center"><?=date_to_ind($row->billing_date)?></td>
            <td class="text-center"><?=$row->user_realname_out?></td>
            <td class="text-center"><?=$row->billing_count?></td>
            <td><?=num_to_idr($row->billing_subtotal)?></td>
            <td><?=num_to_idr($row->billing_tax)?></td>
            <td><?=num_to_idr($row->billing_total_grand)?></td>
            <?php
              $billing_count += $row->billing_count;
              $billing_total_subtotal += $row->billing_subtotal;
              $billing_total_tax += $row->billing_tax;
              $billing_total_total_grand += $row->billing_total_grand;
            ?>
          </tr>
        <?php endforeach; ?>
      <?php else:?>
        <tr>
          <td colspan="6" class="text-center">Tidak ada data!</td>
        </tr>
      <?php endif;?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center" colspan="2">Total</th>
        <th class="text-center"><?=$billing_count?></th>
        <th class=""><?=num_to_idr($billing_total_subtotal)?></th>
        <th class=""><?=num_to_idr($billing_total_tax)?></th>
        <th class=""><?=num_to_idr($billing_total_total_grand)?></th>
      </tr>
    </tfoot>
  </table>
</div>
