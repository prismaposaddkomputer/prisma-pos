<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_guest/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="guest_id" value="<?php if($guest_type != null){echo $guest_type->guest_id;}?>">
        <div class="form-group">
          <label>Jenis Tamu <small class="required-field">*</small></label>
          <br>
          <label class="radio-inline">
            <input type="radio" name="guest_type" value="0" <?php if($guest_type != null){if($guest_type->guest_type == 0){echo 'checked';}}else{echo 'checked';}?>/> Regular
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="radio-inline">
            <input type="radio" name="guest_type" value="1" <?php if($guest_type != null){if($guest_type->guest_type == 1){echo 'checked';}}?>/> Member (Tamu Langganan)
          </label>
        </div>
        <div class="form-group">
          <label>Nama Tamu / Plat Nomor Kendaraan <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="guest_name" value="<?php if($guest_type != null){echo $guest_type->guest_name;}?>">
        </div>
        <div class="form-group">
          <label>Jenis Kelamin <small class="required-field">*</small></label>
          <br>
          <label class="radio-inline">
              <input type="radio" name="guest_gender" value="L" <?php if($guest_type != null){if($guest_type->guest_gender == 'L'){echo 'checked';}}else{echo 'checked';}?>/> Laki-laki
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="radio-inline">
              <input type="radio" name="guest_gender" value="P" <?php if($guest_type != null){if($guest_type->guest_gender == 'P'){echo 'checked';}}?>/> Perempuan
          </label>
        </div>
        <div class="form-group">
          <label>No Telpon <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
          <input class="form-control num" type="text" name="guest_phone" value="<?php if($guest_type != null){echo $guest_type->guest_phone;}?>">
        </div>
        <div class="form-group">
          <label>Pilih Identitas <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
          <select class="form-control select2" name="guest_id_type" id="select-get-value">
            <option value="1" <?php if($guest_type != null){if($guest_type->guest_id_type == '1'){echo 'selected';}}?>>Tidak Ada</option>
            <option value="2" <?php if($guest_type != null){if($guest_type->guest_id_type == '2'){echo 'selected';}}?>>KTP</option>
            <option value="3" <?php if($guest_type != null){if($guest_type->guest_id_type == '3'){echo 'selected';}}?>>SIM</option>
            <option value="4" <?php if($guest_type != null){if($guest_type->guest_id_type == '4'){echo 'selected';}}?>>Lainnya</option>
          </select>
        </div>
        <div class="form-group" id="no">
          <label>No Identitas <span id="label"></span> <small class="cl-warning">&nbsp;&nbsp;(Tidak Wajib Diisi)</small></label>
          <input class="form-control num" type="text" name="guest_id_no" value="<?php if($guest_type != null){echo $guest_type->guest_id_no;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($guest_type != null){if($guest_type->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_guest/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {

    $('#no').hide();
    <?php 
      if($guest_type != null){if($guest_type->guest_id_type > 1){
    ?>
    $('#no').show();
    <?php
      }}
    ?>

    <?php
      if($guest_type != null){if($guest_type->guest_id_type == '2'){
    ?>
    $('#label').html('(KTP)');
    <?php
      }else if($guest_type->guest_id_type == '3'){
    ?>
    $('#label').html('(SIM)');
    <?php
      }else if($guest_type->guest_id_type == '4'){
    ?>
    $('#label').html('(Lainnya)');
    <?php
      }}
    ?>

    $('#select-get-value').on('change', function() {
      if (this.value > 1) {
        $('#no').show();
        if (this.value == '2') {
          $('#label').html('(KTP)');
        }else if (this.value == '3') {
          $('#label').html('(SIM)');
        }else if (this.value == '4') {
          $('#label').html('(Lainnya)');
        }
      }else{
        $('#no').hide();
      }
    });

    $("#form").validate({
      rules: {
        'guest_name': {
          required: true
        },
        'guest_gender': {
          required: true
        }
      },
      messages: {
        'guest_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'guest_gender': {
          required: '<i style="color:red">Wajib diisi!</i>'
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
</script>
