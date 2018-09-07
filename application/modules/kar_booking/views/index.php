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
      <a class="btn btn-info" href="<?=base_url()?>kar_booking/form"><i class="fa fa-plus"></i> Tambah Pemesanan Kamar</a>
    </div>
    <div class="col-md-4 pull-right">
      <form class="" action="<?=base_url()?>kar_booking/index" method="post">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" name="search_term" placeholder="Pencarian (Kode Booking)..." value="<?php echo $this->session->userdata('search_term');?>">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit"><i class="fa fa-search"></i></button>
              <a class="btn btn-default" href="<?=base_url()?>kar_booking/reset_search"><i class="fa fa-refresh"></i></a>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <div class="well" style="display:none;">
					<form class="form-horizontal" method="GET" action="<?=base_url()?>kar_booking/index">
					<div class="form-group">
						 <label class="col-sm-2 control-label">First Date</label>
						 <div class="col-sm-3">
							 <div class="input-group">
		                    <input type="text" class="form-control date-picker" name="date_first"  placeholder="First Date" id="input-date-start" />
		    
                    	</div>
						 </div>
					</div>
					<div class="form-group">
						 <label class="col-sm-2 control-label">Last Date</label>
						 <div class="col-sm-3">
							 <div class="input-group">
		                    <input type="text" class="form-control date-picker" name="date_last"  placeholder="Last Date" id="input-date-start" />
		                  
                    	</div>
						 </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-3">
							 <button type="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
						</div>
					</div>
				</form>
        </div>
    </div>
    <div class="col-md-1"></div>
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
              <th class="text-center">No Kamar</th>
              <th class="text-center">Nama Kamar</th>
              <th class="text-center">Nama Resepsionis</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($booking != null): ?>
              <?php $i=1;foreach ($booking as $row): ?>
                <tr>
                  <td class="text-center"><?=$this->uri->segment('3')+$i++?></td>
                  <td class="text-center">
                    <?php if ($row->booking_id != 0 ): ?>
                      <?php
                          foreach($payment as $t){
                            if($row->booking_id==$t->booking_id){
                              ?>
                                <?php if ($t->cashed == 1): ?>
                                    <small class='label label-success'>Sudah Selesai</small>
                                <?php else: ?>
                                  <a class="btn btn-xs btn-warning" href="<?=base_url()?>kar_booking/form/<?=$row->booking_id?>"><i class="fa fa-pencil"></i></a>
                      
                                  <button class="btn btn-xs btn-danger" onclick="del('<?=$row->booking_id?>');"><i class="fa fa-trash"></i></button>
                                <?php endif; ?>
                              <?php
                            }
                          }
                        ?>
                      <?php endif; ?>
                  </td>
                  <td><?=$row->booking_code?></td>
                  <td><?=date_to_ind($row->date_booking_from)?></td>
                  <td><?=date_to_ind($row->date_booking_to)?></td>
                  <td>
                  <?php
                        foreach($guest as $t){
                          if($row->guest_id==$t->guest_id){
                            ?>
                            <?=$t->guest_name?>
                            <?php
                          }
                        }
                      ?>
                  </td>
                  <td>
                  <?php
                        foreach($room as $t){
                          if($row->room_id==$t->room_id){
                            ?>
                            <?=$t->room_number?>
                            <?php
                          }
                        }
                      ?>
                  </td>
                  <td>
                  <?php
                        foreach($room as $t){
                          if($row->room_id==$t->room_id){
                            ?>
                            <?php
                              foreach($tipe as $s){
                                if($s->category_id==$t->category_id){
                                  ?>
                                  <?=$s->category_name?> - 
                                  <?php
                                }
                              }
                            ?>
                            <?=$t->room_name?>
                            <?php
                          }
                        }
                      ?>
                  </td>
                  <td><?=$row->created_by?></td>
                  
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="9">Tidak ada data!</td>
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
      window.location = "<?=base_url()?>kar_booking/delete/"+id;
    })
  }
</script>

