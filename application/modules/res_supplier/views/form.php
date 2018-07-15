<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>res_supplier/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="supplier_id" value="<?php if($supplier != null){echo $supplier->supplier_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="supplier_name" value="<?php if($supplier != null){echo $supplier->supplier_name;}?>">
        </div>
        <div class="form-group">
          <label>Telepon <small class="required-field">*</small></label>
          <input class="form-control num" type="text" name="supplier_phone" value="<?php if($supplier != null){echo $supplier->supplier_phone;}?>">
        </div>
        <div class="form-group">
          <label>Fax</label>
          <input class="form-control num" type="text" name="supplier_fax" value="<?php if($supplier != null){echo $supplier->supplier_fax;}?>">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input class="form-control keyboard" type="text" name="supplier_email" value="<?php if($supplier != null){echo $supplier->supplier_email;}?>">
        </div>
        <div class="form-group">
          <label>Alamat <small class="required-field">*</small></label>
          <textarea class="form-control keyboard" name="supplier_address"><?php if($supplier != null){echo $supplier->supplier_address;}?></textarea>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($supplier != null){if($supplier->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_supplier/index"><i class="fa fa-close"></i> Batal</a>
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
        'supplier_id': {
          required: true
        },
        'supplier_name': {
          required: true
        },
        'supplier_phone': {
          required: true
        },
        'supplier_address': {
          required: true
        }
      },
      messages: {
        'supplier_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'supplier_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'supplier_phone': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'supplier_address': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
