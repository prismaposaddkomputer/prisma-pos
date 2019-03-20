<div class="content-header">
  <h4>
    <a href="<?=base_url('kar_paket')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i></a> 
    <i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?>
  </h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_paket/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="paket_id" value="<?php if($paket != null){echo $paket->paket_id;}?>">
        <div class="form-group">
          <label>Nama Paket <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="paket_name" value="<?php if($paket != null){echo $paket->paket_name;}?>">
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Harga <small class="required-field">*</small></label>
              <div class="input-group">
                <div class="input-group-addon"><b>Rp</b></div>
                <input class="form-control autonumeric num" type="text" name="paket_charge" value="<?php if($paket != null){echo $paket->paket_charge;}?>">
              </div>
            </div>            
            <small>
              Harga
              <?php if ($client->client_is_taxed == 1) {
                echo 'Sudah Termasuk';
              }else{
                echo 'Belum Termasuk';
              } ?>
              Pajak karaoke
            </small>
          </div>
        </div>
        <h4>Detail Paket</h4>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Pilih Jenis Ruang</label>
              <select class="form-control select2" name="room_type_id" id="room_type_id">
                <option value="0" <?php if($paket){if($paket->room_type_id == 0){echo 'selected';}} ?>>-- Pilih Tipe Ruang --</option>
                <?php foreach($room_type as $row): ?>
                  <option value="<?=$row->room_type_id?>" <?php if($paket){if($paket->room_type_id == $row->room_type_id){echo 'selected';}} ?>><?=$row->room_type_name?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Durasi <small class="required-field">*</small></label>
              <div class="input-group">
                <input class="form-control autonumeric num" type="text" name="tx_duration" value="<?php if($paket != null){echo $paket->tx_duration;}?>">
                <div class="input-group-addon"><b>Jam</b></div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($paket != null){if($paket->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <?php if($action == 'update'): ?>
              <h4>Food and Beverage</h4>
              <button class="btn btn-sm btn-info" type="button" onclick="fnb_show()"><i class="fa fa-plus"></i> Tambah</button>
              <br><br>
              <table class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th class="text-center" width="10">No.</th>
                    <th class="text-center">FnB</th>
                    <th class="text-center" width="10">Jumlah</th>
                    <th class="text-center" width="50">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($paket->fnb != null): ?>
                    <?php $i=1;foreach($paket->fnb as $row): ?>
                      <tr>
                        <td class="text-center"><?=$i++?></td>
                        <td><?=$row->fnb_name?></td>
                        <td class="text-center"><?=$row->tx_amount?></td>
                        <td class="text-center">
                          <a class="btn btn-xs btn-danger" href="<?=base_url()?>kar_paket/del_fnb/<?=$row->paket_id?>/<?=$row->paket_fnb_id?>"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endforeach;?>
                  <?php else: ?>
                    <tr>
                      <td class="text-center" colspan="99"><i>Tidak ada data!</i></td>
                    </tr>
                  <?php endif;?>
                </tbody>
              </table>
            <?php endif;?>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_paket/index"><i class="fa fa-close"></i> Batal</a>
          <?php if($action == 'insert'): ?>
            <button class="btn btn-warning" type="submit"><i class="fa fa-save"></i> Tambah FnB</button>
          <?php else: ?>
            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
          <?php endif;?>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="modal_fnb" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="<?=base_url()?>kar_paket/add_fnb" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah FnB</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="paket_id" value="<?=$paket_id?>">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Pilih FnB</label>
                <select class="form-control select2" name="fnb_id" id="fnb_id">
                  <?php foreach($fnb as $row): ?>
                    <option value="<?=$row->fnb_id?>"><?=$row->fnb_name?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
            <div class="col-md-4">  
              <div class="form-group">
                <label>Jumlah</label>
                <input class="form-control" type="text" name="tx_amount" id="tx_amount_fnb">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'paket_name': {
          required: true
        },
        'paket_charge': {
          required: true,
          number: true
        }
      },
      messages: {
        'paket_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'paket_charge': {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        }
      }
    });
  })

 $('[name=status]').change(function(){
		if($(this).val()==1){
			$('[name=before_tax]').prop('readonly',true);
      $('[name=after_tax]').prop('readonly',false);
     
    }else{
			$('[name=before_tax]').prop('readonly',false);
      $('[name=after_tax]').prop('readonly',true);	
		}
	});

  function findAfter(){
    $('[name=before_tax]').prop('readonly',true);
    var pajak=0;
    var hasil=0;
    var service_karaoke=0;
    var sudahx=ind_to_sys($('#sudah').val());
    var sudah=parseFloat(sudahx);
      hasil=(sudah*100)/120;
      pajak=(sudah*10)/120;
    $("#pajak").val(sys_to_ind(pajak.toFixed(0)));
    $("#service_karaoke").val(sys_to_ind(pajak.toFixed(0)));
    $("#belum").val(sys_to_ind(hasil.toFixed(0)));
  }

   function findBefore(){
    $('[name=after_tax]').prop('readonly',true);
    var pajak=0;
    var hasil=0;
    var service_karaoke=0;
    var belumx=ind_to_sys($('#belum').val());
    var belum=parseFloat(belumx);
      pajak=(belum*10)/100;
      hasil=belum+pajak+pajak;
    $("#pajak").val(sys_to_ind(pajak.toFixed(0)));
    $("#service_karaoke").val(sys_to_ind(pajak.toFixed(0)));
    $("#sudah").val(sys_to_ind(hasil.toFixed(0)));
  }

  function fnb_show() {
    $("#tx_amount_fnb").val('');
    $("#modal_fnb").modal('show');
  }
</script>
