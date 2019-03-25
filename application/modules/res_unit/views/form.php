<div class="content-header">
  <h4>
    <a href="<?=base_url('res_unit')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i></a> 
    <i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?>
  </h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>res_unit/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="unit_id" value="<?php if($unit != null){echo $unit->unit_id;}?>">
        <div class="form-group">
          <label>Kode <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="unit_code" value="<?php if($unit != null){echo $unit->unit_code;}?>">
        </div>
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="unit_name" value="<?php if($unit != null){echo $unit->unit_name;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($unit != null){if($unit->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_unit/index"><i class="fa fa-close"></i> Batal</a>
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
        'unit_code': {
          required: true
        },
        'unit_name': {
          required: true
        }
      },
      messages: {
        'unit_code': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'unit_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
