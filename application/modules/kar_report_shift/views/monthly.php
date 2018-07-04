<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-condensed table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Waktu Masuk</th>
            <th class="text-center">Uang Masuk</th>
            <th class="text-center">Waktu Keluar</th>
            <th class="text-center">Uang Keluar</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($monthly != null): ?>
            <?php $i=1; foreach ($monthly as $row): ?>
              <tr>
                <td class="text-center"><?=$i++?></td>
                <td><?=$row->user_realname?></td>
                <td class="text-center"><?=$row->shift_in_date?> <?=$row->shift_in_time?></td>
                <td><?=num_to_idr($row->total_in)?></td>
                <td class="text-center"><?=$row->shift_out_date?> <?=$row->shift_out_time?></td>
                <td><?=num_to_idr($row->total_out)?></td>
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
