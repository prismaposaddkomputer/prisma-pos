<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_category/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="category_id" value="<?php if($category != null){echo $category->category_id;}?>">
        <div class="form-group">
          <label>Nama Tipe<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="category_name" value="<?php if($category != null){echo $category->category_name;}?>">
        </div>
        <div class="form-group">
          <label>Sudah Termasuk Pajak?<small class="required-field">*</small></label>
          <br>
          <?php if($category != null):?>
									<?php if($category->status=="1"): ?>
                      <input type="radio" name="status" value="1" id="rad" required checked="true" /> Sudah &nbsp &nbsp
                      <input type="radio" name="status" value="0" id="rad" /> Belum
                    
                  <?php elseif($category->status=="0"): ?>
                      <input type="radio" name="status" value="1" id="rad" required /> Sudah &nbsp &nbsp
                      <input type="radio" name="status" value="0" id="rad" checked="true" /> Belum
                      <?php EndIf; ?>
                  <?php Else: ?>
                      <input type="radio" name="status" value="1" id="rad" required /> Sudah &nbsp &nbsp
                      <input type="radio" name="status" value="0" id="rad" /> Belum
					<?php EndIf; ?>
        </div>
        <div class="form-group">
          <label>Harga Sebelum Pajak<small class="required-field">*</small></label>
          <input onchange="findBefore()" class="form-control autonumeric num" type="text" id="belum" name="before_tax" value="<?php if($category != null){echo num_to_price($category->before_tax);}?>">
        </div>
        <div class="form-group">
          <label>Service Hotel<small class="required-field">*</small></label>
          <input class="form-control" type="text" id="service_hotel" name="service_hotel" readonly value="<?php if($category != null){echo num_to_price($category->service_hotel);}?>">
        </div>
        <div class="form-group">
          <label>Pajak Hotel<small class="required-field">*</small></label>
          <input class="form-control" type="text" id="pajak" name="tax" readonly value="<?php if($category != null){echo num_to_price($category->tax);}?>">
        </div>
        <div class="form-group">
          <label>Harga Setelah Pajak<small class="required-field">*</small></label>
          <input onchange="findAfter()" class="form-control autonumeric num" type="text" id="sudah" name="after_tax" value="<?php if($category != null){echo num_to_price($category->after_tax);}?>">
        </div>
        <div class="form-group">
          <label>Keterangan<small class="required-field">*</small></label>
          <textarea name="category_desc" class="form-control keyboard"><?php if($category != null){echo $category->category_desc;}?></textarea>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($category != null){if($category->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_category/index"><i class="fa fa-close"></i> Batal</a>
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
        'category_id': {
          required: true
        },
        'category_name': {
          required: true
        }
      },
      messages: {
        'category_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'category_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
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

  function findAfter(){
    $('[name=before_tax]').prop('readonly',true);
    var pajak=0;
    var hasil=0;
    var service_hotel=0;
    var sudahx=ind_to_sys($('#sudah').val());
    var sudah=parseFloat(sudahx);
      hasil=(sudah*100)/120;
      pajak=(sudah*10)/120;
    $("#pajak").val(sys_to_ind(pajak.toFixed(0)));
    $("#service_hotel").val(sys_to_ind(pajak.toFixed(0)));
    $("#belum").val(sys_to_ind(hasil.toFixed(0)));
  }

   function findBefore(){
    $('[name=after_tax]').prop('readonly',true);
    var pajak=0;
    var hasil=0;
    var service_hotel=0;
    var belumx=ind_to_sys($('#belum').val());
    var belum=parseFloat(belumx);
      pajak=(belum*10)/100;
      hasil=belum+pajak+pajak;
    $("#pajak").val(sys_to_ind(pajak.toFixed(0)));
    $("#service_hotel").val(sys_to_ind(pajak.toFixed(0)));
    $("#sudah").val(sys_to_ind(hasil.toFixed(0)));
  }
</script>
