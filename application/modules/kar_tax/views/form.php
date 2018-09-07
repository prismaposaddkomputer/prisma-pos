<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_tax/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="tax_id" value="<?php if($tax != null){echo $tax->tax_id;}?>">
        <div class="form-group">
          <label>Kode Pajak<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="tax_code" value="<?php if($tax != null){echo $tax->tax_code;}?>">
        </div>
        <div class="form-group">
          <label>Nama Pajak<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="tax_name" value="<?php if($tax != null){echo $tax->tax_name;}?>">
        </div>
        <div class="form-group">
          <label>Sebesar (%)<small class="required-field">*</small></label>
          <input class="form-control num" type="number" min="0" max="100" name="tax_ratio" value="<?php if($tax != null){echo $tax->tax_ratio;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($tax != null){if($tax->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_tax/index"><i class="fa fa-close"></i> Batal</a>
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
        'tax_id': {
          required: true
        },
        'tax_name': {
          required: true
        }
      },
      messages: {
        'tax_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'tax_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
