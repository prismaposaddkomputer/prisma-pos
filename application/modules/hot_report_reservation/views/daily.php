<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a href="<?=base_url()?>hot_report_reservation/monthly/<?=$month?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
      <a class="btn btn-primary" href="<?=base_url()?>hot_report_reservation/daily_pdf/<?=$date?>" target="_blank"><i class="fa fa-print"></i> Download PDF</a>
      <a href="<?=base_url()?>hot_report_reservation/daily_print/<?=$date?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
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

            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_sub_total = 0;
            $grand_total_all = 0;
          ?>
          <?php if ($daily != null): ?>
            <?php foreach ($daily as $row): ?>
              <tr>
                <td class="text-center">TRS - <?=$row->billing_receipt_no?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>hot_report_reservation/detail/<?=$row->billing_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
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
                <td><?=num_to_idr($row->billing_sub_total)?></td>
                  <?php $billing_sub_total += $row->billing_sub_total;?>
                <td>0</td>
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
              <td class="text-center" colspan="11">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-center">Total</th>
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
