<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-primary" href="<?=base_url()?>ret_report_selling_item/range_pdf/<?=$date_start?>/<?=$date_end?>" target="_blank"><i class="fa fa-print"></i> Download PDF</a>
      <br><br>
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" width="80">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($range != null): ?>
            <?php $i=1;foreach ($range as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->item_name?></td>
                <td class="text-center"><?=$row->tx_amount?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td class="text-center" colspan="10">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
