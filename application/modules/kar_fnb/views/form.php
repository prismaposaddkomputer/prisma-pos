<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_fnb/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="fnb_id" value="<?php if($fnb_type != null){echo $fnb_type->fnb_id;}?>">
        <div class="form-group">
          <label>Nama Food and Beverage (FnB) <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="fnb_name" value="<?php if($fnb_type != null){echo $fnb_type->fnb_name;}?>">
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Harga <small class="required-field">*</small></label>
              <div class="input-group">
                <div class="input-group-addon"><b>Rp</b></div>
                <input class="form-control autonumeric num" type="text" name="fnb_charge" value="<?php if($fnb_type != null){echo $fnb_type->fnb_charge;}?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($fnb_type != null){if($fnb_type->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_fnb/index"><i class="fa fa-close"></i> Batal</a>
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
        'fnb_name': {
          required: true
        },
        'fnb_charge': {
          required: true,
          number: true
        }
      },
      messages: {
        'fnb_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'fnb_charge': {
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
