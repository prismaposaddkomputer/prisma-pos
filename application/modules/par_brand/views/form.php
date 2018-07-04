<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>par_brand/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="brand_id" value="<?php if($brand != null){echo $brand->brand_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="brand_name" value="<?php if($brand != null){echo $brand->brand_name;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($brand != null){if($brand->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>par_brand/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#brand_per_hour').hide();
    $('input[name=brand_is_flat]').change(function() {
      if($(this).is(":checked")) {
        $('input[name=brand_per_hour]').val('0');
        $('#brand_per_hour').show();
      }else{
        $('#brand_per_hour').hide();
      }
    });

    <?php if ($action == 'update'): ?>
      $('#brand_per_hour').show();
    <?php endif; ?>

    $("#form").validate({
      rules: {
        'brand_id': {
          required: true
        },
        'brand_name': {
          required: true
        },
        'brand_rate': {
          required: true
        }
      },
      messages: {
        'brand_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'brand_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'brand_rate': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
