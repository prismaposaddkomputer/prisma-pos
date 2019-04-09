<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <form method="post" action="<?=base_url()?>hot_report_tax/frame_pdf">
        <input type="hidden" name="url" value="<?=base_url()?>hot_report_tax/annual_pdf/<?=$year?>">
        <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Download PDF</button>
        <a href="<?=base_url()?>hot_report_tax/annual_print/<?=$year?>" class="btn btn-warning"><i class="fa fa-print"></i> Print Laporan</a>
      </form>
      <br><br>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th class="text-center" width="85">Bulan</th>
            <th class="text-center" width="50">Aksi</th>
            <th class="text-center" width="120">Total</th>
            <th class="text-center" width="120">Pajak</th>
          </tr>
          <tr>
            <td class="text-center" style="padding:0px;">1</td>
            <td class="text-center" style="padding:0px;">2</td>
            <td class="text-center" style="padding:0px;">3</td>
            <td class="text-center" style="padding:0px;">4</td>
          </tr>
        </thead>
        <tbody>
          <?php
            $billing_total_all = 0;
            $tax_total_all = 0;
          ?>
          <?php if ($annual != null): ?>
            <?php $i=1;foreach ($annual as $row): ?>
              <tr>
                <td class="text-center"><?=month_name_ind($row->tx_month)?></td>
                <td class="text-center">
                  <a href="<?=base_url()?>hot_report_tax/monthly/<?=$row->tx_year?>-<?=str_pad($row->tx_month, 2, '0', STR_PAD_LEFT)?>" class="btn btn-xs btn-success"><i class="fa fa-list"></i> </a>
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
              <td class="text-center" colspan="9">Tidak ada data!</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <th class="text-center" colspan="2">Total</th>
            <th><?=num_to_idr($billing_total_all)?></th> 
            <th><?=num_to_idr($tax_total_all)?></th> 
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
