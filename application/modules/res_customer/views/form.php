<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>res_customer/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="customer_id" value="<?php if($customer != null){echo $customer->customer_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="customer_name" value="<?php if($customer != null){echo $customer->customer_name;}?>">
        </div>
        <div class="form-group">
          <label>Telepon <small class="required-field">*</small></label>
          <input class="form-control num" type="text" name="customer_phone" value="<?php if($customer != null){echo $customer->customer_phone;}?>">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input class="form-control keyboard" type="text" name="customer_email" value="<?php if($customer != null){echo $customer->customer_email;}?>">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input class="form-control keyboard" type="text" name="customer_address" value="<?php if($customer != null){echo $customer->customer_address;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($customer != null){if($customer->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_customer/index"><i class="fa fa-close"></i> Batal</a>
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
        'customer_id': {
          required: true
        },
        'customer_name': {
          required: true
        },
        'customer_phone': {
          required: true
        }
      },
      messages: {
        'customer_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'customer_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'customer_phone': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
