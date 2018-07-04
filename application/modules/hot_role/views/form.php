<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_role/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="role_id" value="<?php if($role != null){echo $role->role_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control" type="text" name="role_name" value="<?php if($role != null){echo $role->role_name;}?>">
        </div>
        <div class="form-group">
          <label>Aktif? <small class="required-field">*</small></label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($role != null){if($role->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_role/index"><i class="fa fa-close"></i> Batal</a>
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
        'role_id': {
          required: true
        },
        'role_name': {
          required: true
        }
      },
      messages: {
        'role_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'role_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
