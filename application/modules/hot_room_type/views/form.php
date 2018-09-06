<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_room_type/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="room_type_id" value="<?php if($room_type != null){echo $room_type->room_type_id;}?>">
        <div class="form-group">
          <label>Nama Tipe Kamar (Kategori Kamar) <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="room_type_name" value="<?php if($room_type != null){echo $room_type->room_type_name;}?>">
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Tarif Kamar <small class="required-field">**</small></label>
              <div class="input-group">
                  <div class="input-group-addon"><b>Rp</b></div>
                  <input class="form-control autonumeric num" type="text" name="room_type_charge" value="<?php if($room_type != null){echo $room_type->room_type_charge;}else{echo '0';}?>">
              </div>
            </div>
          </div>
          <div class="col-md-2">&nbsp;</div>
          <div class="col-md-5">
            <div class="form-group">
              <label>Jumlah Kamar <small class="required-field">*</small></label>
              <div class="input-group">
                  <input class="form-control autonumeric num" type="text" name="room_no" value="<?php if($room_type != null){echo $number_of_room;}else{echo '0';}?>">
                  <div class="input-group-addon"><b>Kamar</b></div>
              </div>
            </div>
          </div>
        </div>
        <small class="required-field">**</small>
        <small>
          <?php if ($client->client_is_taxed == 1) {
            echo 'Sudah Termasuk';
          }else{
            echo 'Belum Termasuk';
          } ?>
        </small>
        <small>
          <?php foreach ($charge_type as $row) {
            echo $row->charge_type_name.', ';
          } ?>
        </small>
        <br><br>
        <div class="form-group">
          <label>Dekripsi</label>
          <textarea class="form-control keyboard" name="room_type_desc"><?php if($room_type != null){echo $room_type->room_type_desc;}?></textarea>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($room_type != null){if($room_type->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_room_type/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'room_type_name': {
          required: true
        },
        'room_type_charge': {
          required: true,
        }
      },
      messages: {
        'room_type_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'room_type_charge': {
          required: '<i style="color:red">Wajib diisi!</i>',
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
    var service_hotel=0;
    var sudahx=ind_to_sys($('#sudah').val());
    var sudah=parseFloat(sudahx);
      hasil=(sudah*100)/120;
      pajak=(sudah*10)/120;
    $("#pajak").val(sys_to_ind(pajak.toFixed(0)));
    $("#service_hotel").val(sys_to_ind(pajak.toFixed(0)));
    $("#belum").val(sys_to_ind(hasil.toFixed(0)));
  }

   function findBefore(){
    $('[name=after_tax]').prop('readonly',true);
    var pajak=0;
    var hasil=0;
    var service_hotel=0;
    var belumx=ind_to_sys($('#belum').val());
    var belum=parseFloat(belumx);
      pajak=(belum*10)/100;
      hasil=belum+pajak+pajak;
    $("#pajak").val(sys_to_ind(pajak.toFixed(0)));
    $("#service_hotel").val(sys_to_ind(pajak.toFixed(0)));
    $("#sudah").val(sys_to_ind(hasil.toFixed(0)));
  }
</script>
