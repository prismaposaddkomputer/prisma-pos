<?php
	function digit($inp = 0)
	{
	    return number_format($inp, 0, ',', '.');
	}
?>
<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-4">
      <a class="btn btn-info" href="<?=base_url()?>kar_non_tax/form"><i class="fa fa-plus"></i> Tambah Barang Non Pajak</a>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInformation">
        <i class="fa fa-question"></i> Informasi
      </button>
    </div>
    <div class="col-md-4 pull-right">
      <form class="" action="<?=base_url()?>kar_non_tax/index" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control keyboard" name="search_term" placeholder="Pencarian..." value="<?php echo $this->session->userdata('search_term');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>kar_non_tax/reset_search"><i class="fa fa-refresh"></i></a>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php if ($this->session->userdata('search_term')): ?>
        <i class="search_result">Hasil pencarian dengan kata kunci: <b><?=$this->session->userdata('search_term');?></b></i><br><br>
      <?php endif; ?>
      <?php echo $this->session->flashdata('status'); ?>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" width="50">No</th>
              <th class="text-center" width="100">Aksi</th>
              <th class="text-center">Nama Barang Non Pajak</th>
              <th class="text-center" width="150">Harga</th>
              <th class="text-center" width="80">Aktif</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($non_tax_type != null): ?>
              <?php $i=1;foreach ($non_tax_type as $row): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td class="text-center">
                      <a class="btn btn-xs btn-warning" href="<?=base_url()?>kar_non_tax/form/<?=$row->non_tax_id?>"><i class="fa fa-pencil"></i></a>
                      <button class="btn btn-xs btn-danger" onclick="del('<?=$row->non_tax_id?>');"><i class="fa fa-trash"></i></button>
                  </td>
                  <td><?=$row->non_tax_name?></td> 
                  <td><?=num_to_idr($row->non_tax_charge)?></td>
                  <td class="text-center">
                    <?php if ($row->is_active == 1): ?>
                      <i class="fa fa-check cl-success"></i>
                    <?php else: ?>
                      <i class="fa fa-close cl-danger"></i>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="5">Tidak ada data!</td>
              </tr>
            <?php endif; ?>
          </tbody>
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
  function del(id) {
    $("#modal_delete").modal('show');

    $("#btn_delete_action").click(function () {
      window.location = "<?=base_url()?>kar_non_tax/delete/"+id;
    })
  }
</script>

<!-- Modal -->
<div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informasi Menu Non Pajak</h4>
      </div>
      <div class="modal-body" style="font-size: 15px;">
        <ul style="margin-left: -22px;">
          <li>Menu ini digunakan untuk memanajemen Barang Non Pajak / Barang yang tidak kena Pajak</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> <b>Tutup</b></button>
      </div>
    </div>
  </div>
</div>
