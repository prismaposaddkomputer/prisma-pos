<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="50">No</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center" width="50">Awal</th>
              <th class="text-center" width="50">Masuk</th>
              <th class="text-center" width="50">Keluar</th>
              <th class="text-center" width="50">Penyesuaian</th>
              <th class="text-center" width="50">Akhir</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($monthly != null): ?>
              <?php $i=1;foreach ($monthly as $key => $val): ?>
                <tr>
                  <td class="text-center"><?=$i++?></td>
                  <td><?=$val['item_name']?></td>
                  <td class="text-center"><?=$val['stock_last']?></td>
                  <td class="text-center"><?=$val['stock_in']?></td>
                  <td class="text-center"><?=$val['stock_out']?></td>
                  <td class="text-center"><?=$val['stock_adjustment']?></td>
                  <td class="text-center"><?=$val['stock_now']?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="4">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
