<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="<?=base_url()?>hot_report_payment/frame_pdf">
        <input type="hidden" name="url" value="<?=base_url()?>hot_report_payment/range_pdf/<?=$date_start?>/<?=$date_end?>">
        <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Download PDF</button>
        <a href="<?=base_url()?>hot_report_payment/range_print/<?=$date_start?>/<?=$date_end?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
      </form>
      <br><br>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="85">Tanggal</th>
            <th class="text-center" width="50">Aksi</th>
            <th class="text-center">Sub Total</th>
            <th class="text-center">Diskon</th>
            <th class="text-center">Denda</th>

            <?php 
            foreach ($charge_type as $data): 
            ?>
            <th class="text-center"><?=$data['charge_type_name']?></th>
            <?php endforeach ?>

            <th class="text-center">DP</th>
            <th class="text-center">Total</th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>
            <td class="text-center" style="padding:0px;">5</td>

            <?php 
            $no_awal = 6;
            $no_akhir = $no_awal+count($charge_type);
            for ($i=6; $i < $no_akhir ; $i++): 
            ?>
            <td class="text-center" style="padding:0px;"><?=$i?></td>
            <?php endfor; ?>
            <td class="text-center" style="padding:0px;"><?=$i?></td>
            <td class="text-center" style="padding:0px;"><?=$i+1?></td>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_subtotal = 0;
            $billing_tax = 0;
            $billing_service = 0;
            $billing_other = 0;
            $billing_discount = 0;
            $billing_denda = 0;
            $total_tax = 0;
            $total_service = 0;
            $total_other = 0;
            $billing_total = 0;
            $billing_down_payment = 0;
          ?>
          <?php if ($range != null): ?>
            <?php $i=1;foreach ($range as $row): ?>
              <tr>
                <td class="text-center"><?=date_to_ind($row->billing_date_in)?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>hot_report_payment/daily/<?=$row->billing_date_in?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                
                <?php if ($client->client_is_taxed == 0): ?>

                  <td><?=num_to_idr($row->billing_subtotal)?></td>
                  <?php $billing_subtotal += $row->billing_subtotal;?>

                <?php else: ?>

                  <?php
                  $after_billing_subtotal = ($row->billing_subtotal) + ($row->billing_tax + $row->billing_service + $row->billing_other) + ($row->billing_discount);
                  ?>

                  <td><?=num_to_idr($after_billing_subtotal)?></td>
                  <?php $billing_subtotal += $after_billing_subtotal;?>

                <?php endif; ?>

                <td><?=num_to_idr($row->billing_discount)?></td>
                  <?php $billing_discount += $row->billing_discount;?>

                <td><?=num_to_idr($row->billing_denda)?></td>
                  <?php $billing_denda += $row->billing_denda;?>

                <!-- Charge Type -->
                <?php 
                  foreach ($charge_type as $data): 
                  if ($data['charge_type_id'] == '1') {
                    $billing_charge_type = $row->billing_tax;
                  }else if ($data['charge_type_id'] == '2') {
                    $billing_charge_type = $row->billing_service;
                  }else if ($data['charge_type_id'] == '3') {
                    $billing_charge_type = $row->billing_other;
                  }
                ?>
                <td><?=num_to_idr($billing_charge_type)?></td>
                <?php 
                endforeach; 
                $total_tax += $row->billing_tax;
                $total_service += $row->billing_service;
                $total_other += $row->billing_other;
                ?>  
                <!-- End Charge Type -->

                <!-- DP -->
                <td><?=num_to_idr($row->billing_down_payment)?></td>
                  <?php $billing_down_payment += $row->billing_down_payment ?>
                <!-- End DP -->

                <!-- Grand Total -->
                <td><?=num_to_idr($row->billing_total)?></td>
                  <?php $billing_total += $row->billing_total;?>
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
            <th><?=num_to_idr($billing_subtotal)?></th>
            <th><?=num_to_idr($billing_discount)?></th>
            <th><?=num_to_idr($billing_denda)?></th>
            <?php 
            foreach ($charge_type as $data): 
            if ($data['charge_type_id'] == '1') {
              $total_charge_type = $total_tax;
            }else if ($data['charge_type_id'] == '2') {
              $total_charge_type = $total_service;
            }else if ($data['charge_type_id'] == '3') {
              $total_charge_type = $total_other;
            }
            ?>
            <th><?=num_to_idr($total_charge_type)?></th>
            <?php endforeach; ?> 
            <th><?=num_to_idr($billing_down_payment)?></th>
            <th><?=num_to_idr($billing_total)?></th> 
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
