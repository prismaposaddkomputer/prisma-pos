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
      </div>
    <div class="col-md-4 pull-right">
      <form class="" action="<?=base_url()?>kar_payment/index" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" name="search_term" placeholder="Pencarian (Kode Booking)..." value="<?php echo $this->session->userdata('search_term');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>kar_payment/reset_search"><i class="fa fa-refresh"></i></a>
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
              <th class="text-center" width="70">Aksi</th>
              <th class="text-center">Kode Booking</th>
              <th class="text-center">Check In</th>
              <th class="text-center">Check Out</th>
              <th class="text-center">Nama Tamu</th>
              <th class="text-center">Nama Resepsionis</th>
              <th class="text-center">Status Pembayaran</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($payment != null): ?>
              <?php $i=1;foreach ($payment as $row): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td class="text-center">
                    <?php if ($row->cashed == 1): ?>
                        <?php if ($row->id != 0 ): ?>
                          <a class="btn btn-xs btn-warning" href="<?=base_url()?>kar_payment/struk/<?=$row->booking_id?>"><i class="fa fa-print"></i></a>
                          
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($row->id != 0 ): ?>
                          <a class="btn btn-xs btn-warning" href="<?=base_url()?>kar_payment/form/<?=$row->booking_id?>"><i class="fa fa-pencil"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=$t->booking_code?>
                              <?php
                            }
                          }
                        ?>  
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=date_to_ind($t->date_booking_from)?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=date_to_ind($t->date_booking_to)?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              
                              <?php
                                foreach($guest as $z){
                                  if($t->guest_id==$z->guest_id){
                                    ?>
                                    <?=$z->guest_name?>
                                    <?php
                                  }
                                }
                              ?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td>
                    <?php
                          foreach($booking as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                              <?=$t->created_by?>
                              <?php
                            }
                          }
                        ?>
                  </td>
                  <td class="text-center">
                    <?php if ($row->cashed == 1): ?>
                        <small class='label label-success'>Sudah Bayar</small>
                    <?php else: ?>
                        <small class='label label-danger'>Belum Bayar</small>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="8">Tidak ada data!</td>
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
      window.location = "<?=base_url()?>kar_payment/delete/"+id;
    })
  }
</script>
