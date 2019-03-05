<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <form id="form_search" action="<?=base_url()?>res_harian/search" method="post">
      <div class="col-md-4">
        <a class="btn btn-info" href="<?=base_url()?>res_harian/form"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
      <div class="col-md-2 col-md-offset-4">
        <div class="form-group">
          <select name="bulan" class="form-control select2">
            <option value="01" <?php if($search){if($search['bulan'] == '01'){echo 'selected';}}else{if(date('m') == '01'){echo 'selected';}} ?>>Januari</option>
            <option value="02" <?php if($search){if($search['bulan'] == '02'){echo 'selected';}}else{if(date('m') == '02'){echo 'selected';}} ?>>Februari</option>
            <option value="03" <?php if($search){if($search['bulan'] == '03'){echo 'selected';}}else{if(date('m') == '03'){echo 'selected';}} ?>>Maret</option>
            <option value="04" <?php if($search){if($search['bulan'] == '04'){echo 'selected';}}else{if(date('m') == '04'){echo 'selected';}} ?>>April</option>
            <option value="05" <?php if($search){if($search['bulan'] == '05'){echo 'selected';}}else{if(date('m') == '05'){echo 'selected';}} ?>>Mei</option>
            <option value="06" <?php if($search){if($search['bulan'] == '06'){echo 'selected';}}else{if(date('m') == '06'){echo 'selected';}} ?>>Juni</option>
            <option value="07" <?php if($search){if($search['bulan'] == '07'){echo 'selected';}}else{if(date('m') == '07'){echo 'selected';}} ?>>Juli</option>
            <option value="08" <?php if($search){if($search['bulan'] == '08'){echo 'selected';}}else{if(date('m') == '08'){echo 'selected';}} ?>>Agustus</option>
            <option value="09" <?php if($search){if($search['bulan'] == '09'){echo 'selected';}}else{if(date('m') == '09'){echo 'selected';}} ?>>September</option>
            <option value="10" <?php if($search){if($search['bulan'] == '10'){echo 'selected';}}else{if(date('m') == '10'){echo 'selected';}} ?>>Oktober</option>
            <option value="11" <?php if($search){if($search['bulan'] == '11'){echo 'selected';}}else{if(date('m') == '11'){echo 'selected';}} ?>>November</option>
            <option value="12" <?php if($search){if($search['bulan'] == '12'){echo 'selected';}}else{if(date('m') == '12'){echo 'selected';}} ?>>Desember</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <select name="tahun" class="form-control select2">
            <?php for($i=2017; $i <= date('Y'); $i++):?>
              <option value="<?=$i?>" <?php if($search){if($search['tahun'] == $i){echo 'selected';}}else{if(date('Y') == $i){echo 'selected';}} ?>><?=$i?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php echo $this->session->flashdata('status'); ?>
      <div class="badge bg-success">
        <b>Info</b> : Menu ini digunakan untuk menginput data transaksi secara global dalam 1 hari. Jika sudah menginput setiap ada transaksi di menu transaksi maka, menu ini tidak digunakan. 
      </div>
      <br><br>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="10%">Tanggal</th>
              <th class="text-center" width="5%">Aksi</th>
              <th class="text-center" width="15%">Sebelum Pajak</small></th>
              <th class="text-center" width="15%">Pajak</th>
              <th class="text-center" width="15%">Setelah Pajak</small></th>
              <!-- <th class="text-center" width="15%">Diskon</th> -->
              <th class="text-center" width="15%">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $tx_total_before_tax = 0;
              $tx_total_tax = 0;
              $tx_total_after_tax = 0;
              $tx_total_discount = 0;
              $tx_total_grand = 0;
            ?>
            <?php if ($billing != null): ?>
              <?php $i=1;foreach ($billing as $row): ?>
                <tr>
                  <td class="text-center"><?=date_to_ind($row->tx_date)?></td>
                  <td class="text-center">
                    <a href="<?=base_url()?>res_harian/form/<?=$row->tx_id?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </a>
                    <button type="button" class="btn btn-xs btn-danger" onclick="del('<?=$row->tx_id?>')"><i class="fa fa-trash"></i> </button>
                  </td>
                  <td><?=num_to_idr($row->tx_total_before_tax)?></td>
                    <?php $tx_total_before_tax += $row->tx_total_before_tax;?>
                  <td><?=num_to_idr($row->tx_total_tax)?></td>
                    <?php $tx_total_tax += $row->tx_total_tax;?>
                  <td><?=num_to_idr($row->tx_total_after_tax)?></td>
                    <?php $tx_total_after_tax += $row->tx_total_after_tax;?>
                  <!-- <td><?=num_to_idr($row->tx_total_discount)?></td>
                    <?php $tx_total_discount += $row->tx_total_discount;?> -->
                  <th><?=num_to_idr($row->tx_total_grand)?></th>
                    <?php $tx_total_grand += $row->tx_total_grand;?>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="99">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center" colspan="2">Total</th>
              <th><?=num_to_idr($tx_total_before_tax)?></th>
              <th><?=num_to_idr($tx_total_tax)?></th>
              <th><?=num_to_idr($tx_total_after_tax)?></th>
              <!-- <th><?=num_to_idr($tx_total_discount)?></th> -->
              <th><?=num_to_idr($tx_total_grand)?></th>
            </tr>
          </tfoot>
        </table>
        <div class="pull-right">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div id="modal_delete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Data</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus data ini?</p>
        <b class="cl-danger">Peringatan!</b>
        <p>Data ini mungkin digunakan atau terhubung dengan data lain.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button id="btn_delete_action" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function () {
    $('.select2').on('select2:select', function (e) {
      $('#form_search').submit();
    });
  })
  function del(id) {
    $("#modal_delete").modal('show');

    $("#btn_delete_action").click(function () {
      window.location = "<?=base_url()?>res_harian/delete/"+id;
    })
  }
</script>
