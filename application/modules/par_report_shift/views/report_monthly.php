<div class="content-header">
  <a class="btn btn-success pull-right" target="" href="<?=base_url()?>par_report_shift/report_monthly_pdf/<?=$month?>"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <table class="table table-bordered table-condensed table-striped">
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Nama Pengguna</th>
        <th class="text-center">Tipe</th>
        <th class="text-center">Masuk</th>
        <th class="text-center">Jam Masuk</th>
        <th class="text-center">Total Uang</th>
        <th class="text-center">Keluar</th>
        <th class="text-center">Jam Keluar</th>
        <th class="text-center">Total Uang</th>
      </tr>
    </thead>
    <tbody>
      <?php if($shift != null):?>
        <?php $i=1; foreach ($shift as $row): ?>
          <tr>
            <td class="text-center"><?=$i++?></td>
            <td><?=$row->user_realname?></td>
            <td class="text-center">
              <?php if($row->parking_type == 0):?>
                <span class="badge bg-success"><i class="fa fa-sign-in"></i> Parkir Masuk</span>
              <?php else:?>
                <span class="badge bg-danger"><i class="fa fa-sign-out"></i> Parkir Keluar</span>
              <?php endif;?>
            </td>
            <td class="text-center">
              <?php if($row->shift_in_status == 1):?>
                <i class="fa fa-check cl-success"></i>
              <?php else:?>
                <i class="fa fa-close cl-danger"></i>
              <?php endif;?>
            </td>
            <td class="text-center"><?=$row->shift_in_date.' '.$row->shift_in_time?></td>
            <td><?=num_to_idr($row->total_in)?></td>
            <td class="text-center">
              <?php if($row->shift_out_status == 1):?>
                <i class="fa fa-check cl-success"></i>
              <?php else:?>
                <i class="fa fa-close cl-danger"></i>
              <?php endif;?>
            </td>
            <td class="text-center"><?=$row->shift_out_date.' '.$row->shift_out_time?></td>
            <td><?=num_to_idr($row->total_out)?></td>
          </tr>
        <?php endforeach; ?>
      <?php else:?>
        <tr>
          <td colspan="6" class="text-center">Tidak ada data!</td>
        </tr>
      <?php endif;?>
    </tbody>
  </table>
</div>
