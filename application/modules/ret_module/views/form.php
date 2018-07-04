<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>ret_module/<?=$action?>" method="post">
      <div class="col-md-8">
        <input type="hidden" name="module_id_old" value="<?php if($module != null){echo $module->module_id;}?>">
        <div class="form-group">
          <label>Kode <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="module_id" value="<?php if($module != null){echo $module->module_id;}?>">
        </div>
        <div class="form-group">
          <label>Modul Induk <small class="required-field">*</small></label>
          <select class="form-control keyboard select2" name="module_parent">
            <option value=""> --- </option>
            <?php foreach ($module_all as $row): ?>
              <option value="<?=$row->module_id?>" <?php if($module != null){if($row->module_id == $module->module_parent){echo 'selected';};}?>><?=$row->module_id.' - '.$row->module_name?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="module_name" value="<?php if($module != null){echo $module->module_name;}?>">
        </div>
        <div class="form-group">
          <label>Folder <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="module_folder" value="<?php if($module != null){echo $module->module_folder;}?>">
        </div>
        <div class="form-group">
          <label>Controller <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="module_controller" value="<?php if($module != null){echo $module->module_controller;}?>">
        </div>
        <div class="form-group">
          <label>Ikon <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="module_icon" value="<?php if($module != null){echo $module->module_icon;}?>">
        </div>
        <div class="form-group">
          <label>Modul URL <small class="required-field">*</small></label>
          <div class="input-group col-md-12">
            <span class="input-group-addon" id="module-url-addon"><?=base_url()?>{folder}/{controller}/</span>
            <input class="form-control keyboard" type="text" name="module_url" aria-describedby="module-url-addon" value="<?php if($module != null){echo $module->module_url;}?>">
          </div>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>ret_module/index"><i class="fa fa-close"></i> Batal</a>
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
        'module_id': {
          required: true
        },
        'module_name': {
          required: true
        },
        'module_url': {
          required: true
        }
      },
      messages: {
        'module_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'module_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'module_url': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
