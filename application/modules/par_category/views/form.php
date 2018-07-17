<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small><br>
  <small><b class="required-field">**</b> Tarif termasuk pajak</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>par_category/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="category_id" value="<?php if($category != null){echo $category->category_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="category_name" value="<?php if($category != null){echo $category->category_name;}?>">
        </div>
        <div class="form-group">
          <label>Tarif Dasar <small class="required-field">**</small></label>
          <input class="form-control num autonumeric" type="text" name="category_rate" value="<?php if($category != null){echo $category->category_rate;}?>">
        </div>
        <div class="form-group">
          <label>Tarif Per Jam?</label><br>
          <input class="" type="checkbox" name="category_not_flat" value="1" <?php if($category != null){if($category->category_not_flat  == 1){echo 'checked';}};?>>
        </div>
        <div class="form-group" id="category_per_hour">
          <label>Tarif Per Jam</label>
          <input class="form-control num autonumeric" type="text" name="category_per_hour" value="<?php if($category != null){echo $category->category_per_hour;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($category != null){if($category->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>par_category/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#category_per_hour').hide();
    $('input[name=category_not_flat]').change(function() {
      if($(this).is(":checked")) {
        $('input[name=category_per_hour]').val('0');
        $('#category_per_hour').show();
      }else{
        $('#category_per_hour').hide();
      }
    });

    <?php if ($action == 'update'): ?>
      $('#category_per_hour').show();
    <?php endif; ?>

    $("#form").validate({
      rules: {
        'category_id': {
          required: true
        },
        'category_name': {
          required: true
        },
        'category_rate': {
          required: true
        }
      },
      messages: {
        'category_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'category_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'category_rate': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
