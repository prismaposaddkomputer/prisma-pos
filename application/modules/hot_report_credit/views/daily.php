<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a href="<?=base_url()?>hot_report_credit/monthly/<?=$month?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
      <a class="btn btn-primary" href="<?=base_url()?>hot_report_credit/daily_pdf/<?=$date?>" target="_blank"><i class="fa fa-print"></i> Download PDF</a>
      <a href="<?=base_url()?>hot_report_credit/daily_print/<?=$date?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
      <br><br>
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No Nota</th>
            <th class="text-center">Aksi</th>
            <th class="text-center">Nama Tamu</th>
            <th class="text-center">Status</th>
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

            <th class="text-center">DP</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_subtotal = 0;
            $billing_tax = 0;
            $billing_service = 0;
            $billing_other = 0;
            $total_tax = 0;
            $total_service = 0;
            $total_other = 0;
            $billing_total = 0;
            $billing_down_payment = 0;
          ?>
          <?php if ($daily != null): ?>
            <?php foreach ($daily as $row): ?>
              <tr>
                <td class="text-center">TRS - <?=$row->billing_receipt_no?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>hot_report_credit/detail/<?=$row->billing_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
                </td>
                <td class="text-center"><?=$row->guest_name?></td>
                <td class="text-center">
                  <?php switch ($row->billing_status) {
                    case '-1':
                      echo '<span class="badge bg-danger">Batal</span>';
                      break;

                    case '1':
                      echo '<span class="badge bg-warning">Proses</span>';
                      break;

                    case '2':
                      echo '<span class="badge bg-success">Selesai</span>';
                      break;
                  } ?>
                </td>
                <td><?=num_to_idr($row->billing_subtotal)?></td>
                  <?php $billing_subtotal += $row->billing_subtotal;?>

                <!-- Diskon -->
                <td>0</td>
                <!-- End Diskon -->
                
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
              <td class="text-center" colspan="11">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="4">Total</th>
            <th><?=num_to_idr($billing_subtotal)?></th>
            <th>0</th>
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
