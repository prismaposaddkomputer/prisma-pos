<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-primary" href="<?=base_url()?>hot_report_receptionist/annual_pdf/<?=$year?>/<?=$user_id?>" target="_blank"><i class="fa fa-print"></i> Download PDF</a>
      <a href="<?=base_url()?>hot_report_receptionist/annual_print/<?=$year?>/<?=$user_id?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
      <br><br>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="85">Bulan</th>
            <th class="text-center" width="50">Aksi</th>
            <th class="text-center">Sub Total</th>
            <th class="text-center">Diskon</th>

            <?php 
            foreach ($charge_type as $data): 
            //
            $no = $data['charge_type_id'];
            $grand_down_total_tax[$no] = 0;
            //
            ?>
            <th class="text-center"><?=$data['charge_type_name']?></th>
            <?php endforeach ?>

            <th class="text-center">Total<br><small>(3 - 4 
            <?php 
            $no_awal = 5;
            $no_akhir = $no_awal+count($charge_type);
            for ($i=5; $i < $no_akhir ; $i++): 
            ?>
            + <?=$i?>
            <?php endfor; ?>
            )</small></th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>

            <?php 
            $no_awal = 5;
            $no_akhir = $no_awal+count($charge_type);
            for ($i=5; $i < $no_akhir ; $i++): 
            ?>
            <td class="text-center" style="padding:0px;"><?=$i?></td>
            <?php endfor; ?>
            <td class="text-center" style="padding:0px;"><?=$i?></td>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_sub_total = 0;
            $grand_total_all = 0;
          ?>
          <?php if ($annual != null): ?>
            <?php $i=1;foreach ($annual as $row): ?>
              <tr>
                <td class="text-center"><?=month_name_ind($row->tx_month)?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>hot_report_receptionist/monthly/<?=$row->tx_year?>-<?=str_pad($row->tx_month, 2, '0', STR_PAD_LEFT)?>/<?=$user_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td><?=num_to_idr($row->billing_sub_total)?></td>
                  <?php $billing_sub_total += $row->billing_sub_total;?>

                <!-- Diskon -->
                <td>0</td>
                <!-- End Diskon -->

                <!-- Charge Type -->
                <?php 
                  $grand_total_tax = 0;
                  foreach ($charge_type as $data): 
                  $no = $data['charge_type_id'];
                  $total_tax[$no] = 0;
                  $total_tax[$no] = ($row->billing_sub_total - 0) * $data_charge_type[$no]['charge_type_ratio'] / 100;
                  //
                  $grand_total_tax += $total_tax[$no];
                ?>
                <td><?=num_to_idr($total_tax[$no])?></td>
                  <?php $grand_down_total_tax[$no] += $total_tax[$no]; ?>
                <?php endforeach; ?>  
                <!-- End Charge Type -->

                <!-- Grand Total -->
                <?php
                $grand_total = ($row->billing_sub_total - 0) + $grand_total_tax;
                ?>
                <td><?=num_to_idr($grand_total)?></td>
                <?php $grand_total_all += $grand_total; ?>
                <!-- End Grand Total -->
                  
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="9">Tidak ada data!</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="2">Total</th>
            <th><?=num_to_idr($billing_sub_total)?></th>
            <th>0</th>
            <?php foreach ($charge_type as $data): 
              $no = $data['charge_type_id'];
            ?>
            <th><?=num_to_idr($grand_down_total_tax[$no])?></th>
            <?php endforeach; ?> 
            <th><?=num_to_idr($grand_total_all)?></th> 
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
