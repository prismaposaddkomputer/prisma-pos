<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_charge_type/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="charge_type_id" value="<?php if($charge_type != null){echo $charge_type->charge_type_id;}?>">
        <div class="form-group">
          <label>Nama Jenis Biaya <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="charge_type_name" value="<?php if($charge_type != null){echo $charge_type->charge_type_name;}?>">
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Kode</label>
              <input class="form-control keyboard" type="text" name="charge_type_code" value="<?php if($charge_type != null){echo $charge_type->charge_type_code;}?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Rasio <small class="required-field">*</small></label>
              <div class="input-group">
                <input class="form-control autonumeric keyboard" type="text" name="charge_type_ratio" value="<?php if($charge_type != null){echo $charge_type->charge_type_ratio;}else{echo '0';}?>">
                <div class="input-group-addon">%</div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Dekripsi</label>
          <textarea class="form-control keyboard" name="charge_type_desc"><?php if($charge_type != null){echo $charge_type->charge_type_desc;}?></textarea>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($charge_type != null){if($charge_type->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_charge_type/index"><i class="fa fa-close"></i> Batal</a>
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
        'charge_type_name': {
          required: true
        },
        'charge_type_ratio': {
          required: true,
          number: true
        }
      },
      messages: {
        'charge_type_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'charge_type_ratio': {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        }
      }
    });
  })
</script>
