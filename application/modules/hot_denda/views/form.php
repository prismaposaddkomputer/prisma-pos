<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_denda/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="denda_id" value="<?php if($denda_type != null){echo $denda_type->denda_id;}?>">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Waktu Berlaku Denda Setelah Checkout <small class="required-field">*</small></label>
              <div class="input-group col-md-3">
                <input class="form-control autonumeric num" type="text" name="denda_duration" value="<?php if($denda_type != null){echo $denda_type->denda_duration;}?>">
                <div class="input-group-addon"><b>Jam</b></div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Harga Denda Per Jam <small class="required-field">*</small></label>
              <div class="input-group col-md-5">
                <div class="input-group-addon"><b>Rp</b></div>
                <input class="form-control autonumeric num" type="text" name="denda_charge" value="<?php if($denda_type != null){echo $denda_type->denda_charge;}?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($denda_type != null){if($denda_type->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_denda/index"><i class="fa fa-close"></i> Batal</a>
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
        'denda_name': {
          required: true
        },
        'denda_charge': {
          required: true,
          number: true
        }
      },
      messages: {
        'denda_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'denda_charge': {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        }
      }
    });
  })

 $('[name=status]').change(function(){
		if($(this).val()==1){
			$('[name=before_tax]').prop('readonly',true);
      $('[name=after_tax]').prop('readonly',false);
     
    }else{
			$('[name=before_tax]').prop('readonly',false);
      $('[name=after_tax]').prop('readonly',true);	
		}
	});
</script>
