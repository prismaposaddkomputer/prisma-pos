<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="<?=base_url()?>hot_report_tax/frame_pdf">
        <a href="<?=base_url()?>hot_report_tax/monthly/<?=$month?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
        <input type="hidden" name="url" value="<?=base_url()?>hot_report_tax/daily_pdf/<?=$date?>">
        <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Download PDF</button>
        <a href="<?=base_url()?>hot_report_tax/daily_print/<?=$date?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
      </form>
      <br><br>
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No Nota</th>
            <th class="text-center">Aksi</th>
            <th class="text-center">Nama Tamu</th>
            <th class="text-center">Status</th>
            <th class="text-center" width="23%">Total</th>
            <th class="text-center" width="23%">Pajak</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_total_all = 0;
            $tax_total_all = 0;
          ?>
          <?php if ($daily != null): ?>
            <?php foreach ($daily as $row): ?>
              <tr>
                <td class="text-center">TRS - <?=$row->billing_receipt_no?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>hot_report_tax/detail/<?=$row->billing_id?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
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

                <?php
                $billing_total = $row->billing_total-$row->billing_discount_custom;
                $tax_total = $billing_total * ($charge_type->charge_type_ratio/100);
                ?>

                <?php if ($client->client_is_taxed == 0): ?>

                  <!-- Grand Total -->
                  <td><?=num_to_idr($billing_total)?></td>
                    <?php $billing_total_all += $billing_total;?>
                  <!-- End Grand Total -->

                  <!-- Tax Total -->
                  <td><?=num_to_idr($tax_total)?></td>
                    <?php $tax_total_all += $tax_total;?>
                  <!-- End Tax Total -->

                <?php else: ?>

                  <!-- Grand Total -->
                  <td><?=num_to_idr($billing_total)?></td>
                    <?php $billing_total_all += $billing_total;?>
                  <!-- End Grand Total -->

                  <!-- Tax Total -->
                  <td><?=num_to_idr($tax_total)?></td>
                    <?php $tax_total_all += $tax_total;?>
                  <!-- End Tax Total -->

                <?php endif; ?>


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
            <th><?=num_to_idr($billing_total_all)?></th> 
            <th><?=num_to_idr($tax_total_all)?></th> 
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
