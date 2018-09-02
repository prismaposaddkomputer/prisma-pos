<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_discount/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="discount_id" value="<?php if($discount != null){echo $discount->discount_id;}?>">
        <div class="form-group">
          <label>Nama Diskon <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="discount_name" value="<?php if($discount != null){echo $discount->discount_name;}?>">
        </div>
        <div class="form-group">
          <label>Pilih Tipe Diskon <small class="required-field">*</small></label>
          <select class="form-control select2" name="discount_group" id="select-get-value">
            <option value="1" <?php if($discount != null){if($discount->discount_group == '1'){echo 'selected';}}?>>Diskon Ruangan</option>
            <option value="2" <?php if($discount != null){if($discount->discount_group == '2'){echo 'selected';}}?>>Diskon Member</option>
            <option value="3" <?php if($discount != null){if($discount->discount_group == '3'){echo 'selected';}}?>>Diskon Total</option>
          </select>
        </div>
        <div class="form-group">
          <label>Pilih Jenis Diskon <small class="required-field">*</small></label>
          <br>
            <label class="radio-inline">
               <input type="radio" name="discount_type" value="1" <?php if($discount != null){if($discount->discount_type == '1'){echo 'checked';}}else{echo 'checked';}?>/> Persentase (%)
            </label>
            &nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
               <input type="radio" name="discount_type" value="2" <?php if($discount != null){if($discount->discount_type == '2'){echo 'checked';}}?>/> Nominal (Rp)
            </label>
        </div>
        <div class="row" id="discountAmmount">
          <div class="col-md-4">
            <div class="form-group">
              <label><span id="name_field"></span> <small class="required-field">*</small></label>
              <div class="input-group">
                <div class="input-group-addon" id="rp_icon"></div>
                <input class="form-control autonumeric num" type="text" name="discount_amount" id="value_amount" value="<?php if($discount != null){echo $discount->discount_amount;}?>">
                <div class="input-group-addon" id="prosen_icon"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($discount != null){if($discount->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_discount/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {

    $('#name_field').html('Persentase');
    $('#prosen_icon').html('%');
    $('#rp_icon').hide();
    //
    <?php
      if($discount != null){if($discount->discount_type == '1'){
    ?>
    $('#name_field').html('Persentase');
    $('#prosen_icon').html('%');
    $('#rp_icon').hide();
    $('#prosen_icon').show();
    <?php
      }else if($discount->discount_type == '2'){
    ?>
    $('#name_field').html('Nominal');
    $('#rp_icon').html('Rp');
    $('#prosen_icon').hide();
    $('#rp_icon').show();
    <?php
      }}
    ?>
    //
    $('#form input[type=radio]').on('change', function() {
      var discount_type = $('input[name=discount_type]:checked', '#form').val();
      if (discount_type == '1') {
        $('#name_field').html('Persentase');
        $('#prosen_icon').html('%');
        $('#rp_icon').hide();
        $('#prosen_icon').show();
      }else if (discount_type == '2') {
        $('#name_field').html('Nominal');
        $('#rp_icon').html('Rp');
        $('#rp_icon').show();
        $('#prosen_icon').hide();
      }
    });

    $("#form").validate({
      rules: {
        'discount_name': {
          required: true
        },
        'discount_type': {
          required: true
        },
        'discount_amount': {
          required: true
        }
      },
      messages: {
        'discount_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'discount_type': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'discount_amount': {
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

</script>
