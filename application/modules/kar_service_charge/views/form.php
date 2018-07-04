<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_service_charge/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="service_charge_id" value="<?php if($service_charge != null){echo $service_charge->service_charge_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="service_charge_name" value="<?php if($service_charge != null){echo $service_charge->service_charge_name;}?>">
        </div>
        <div class="form-group">
          <label>Harga <small class="required-field">*</small></label>
          <input class="form-control keyboard autonumeric" type="text" name="service_charge_price" value="<?php if($service_charge != null){echo $service_charge->service_charge_price;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($service_charge != null){if($service_charge->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_service_charge/index"><i class="fa fa-close"></i> Batal</a>
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
        'service_charge_id': {
          required: true
        },
        'service_charge_name': {
          required: true
        },
        'service_charge_phone': {
          required: true
        }
      },
      messages: {
        'service_charge_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'service_charge_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'service_charge_phone': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
