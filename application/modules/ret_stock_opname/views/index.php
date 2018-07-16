<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-4">
      <a class="btn btn-info" href="<?=base_url()?>ret_stock_opname/form"><i class="fa fa-plus"></i> Tambah Stok Opname</a>
    </div>
    <div class="col-md-8 col-lg-7 pull-right">
      <form class="" action="<?=base_url()?>ret_stock_opname/index" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control daterange-picker" name="search_term" value="<?php echo $this->session->userdata('search_term');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>ret_stock_opname/reset_search"><i class="fa fa-refresh"></i></a>
            </span>
          </div>
        </div>
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
              <th class="text-center" width="80">Aksi</th>
              <th class="text-center" width="150">No Kwitansi</th>
              <th class="text-center" width="150">Tanggal</th>
              <th class="text-center" width="150">Jenis</th>
              <th class="text-center">Catatan</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($stock_opname != null): ?>
              <?php $i=1;foreach ($stock_opname as $row): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td class="text-center">
                    <?php if ($row->tx_id != '' ): ?>
                      <?php if ($row->tx_status == 0): ?>
                        <a class="btn btn-xs btn-warning" href="<?=base_url()?>ret_stock_opname/form/<?=$row->tx_id?>"><i class="fa fa-pencil"></i></a>
                      <?php endif; ?>
                      <a class="btn btn-xs btn-success" href="<?=base_url()?>ret_stock_opname/detail/<?=$row->tx_id?>/<?=$row->tx_type?>"><i class="fa fa-list"></i></a>
                    <?php endif; ?>
                  </td>
                  <td class="text-center"><?=$row->tx_type.'-'.$row->tx_receipt_no?></td>
                  <td class="text-center"><?=$row->tx_date?></td>
                  <td class="text-center"><?=$row->tx_name?></td>
                  <td><?=$row->tx_notes?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="6">Tidak ada data!</td>
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
      window.location = "<?=base_url()?>ret_stock_opname/delete/"+id;
    })
  }
</script>
