<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_diskon/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="diskon_id" value="<?php if($diskon != null){echo $diskon->diskon_id;}?>">
        <div class="form-group">
          <label>Nama Diskon<small class="required-field">*</small></label>
          <input class="form-control" type="text" name="diskon_name" value="<?php if($diskon != null){echo $diskon->diskon_name;}?>">
        </div>
        <div class="form-group">
          <label>Sebesar (%)<small class="required-field">*</small></label>
          <input class="form-control" type="number" min="0" max="100" name="diskon_price" value="<?php if($diskon != null){echo $diskon->diskon_price;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($diskon != null){if($diskon->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_diskon/index"><i class="fa fa-close"></i> Batal</a>
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
        'diskon_id': {
          required: true
        },
        'diskon_name': {
          required: true
        }
      },
      messages: {
        'diskon_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'diskon_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
