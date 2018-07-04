<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>ret_bank/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="bank_id" value="<?php if($bank != null){echo $bank->bank_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="bank_name" value="<?php if($bank != null){echo $bank->bank_name;}?>">
        </div>
        <div class="form-group">
          <label>Tipe <small class="required-field">*</small></label>
          <select class="form-control keyboard select2" name="payment_type_id">
            <?php foreach ($payment_type_list as $row): ?>
              <?php if ($row->payment_type_id != 1): ?>
                <option value="<?=$row->payment_type_id?>" <?php if($bank != null){if($row->payment_type_id == $bank->payment_type_id){echo 'selected';};}?>><?=$row->payment_type_name?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($bank != null){if($bank->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>ret_bank/index"><i class="fa fa-close"></i> Batal</a>
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
        'bank_id': {
          required: true
        },
        'bank_name': {
          required: true
        }
      },
      messages: {
        'bank_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'bank_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
