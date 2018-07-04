<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>par_client/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="client_id" value="<?php if($client != null){echo $client->client_id;}?>">
        <div class="form-group">
          <label>Nama Perusahaan <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_name" value="<?php if($client != null){echo $client->client_name;}?>">
        </div>
        <div class="form-group">
          <label>Jalan <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_street" value="<?php if($client != null){echo $client->client_street;}?>">
        </div>
        <div class="form-group">
          <label>Kecamatan <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_district" value="<?php if($client != null){echo $client->client_district;}?>">
        </div>
        <div class="form-group">
          <label>Kota <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_city" value="<?php if($client != null){echo $client->client_city;}?>">
        </div>
        <div class="form-group">
          <label>Provinsi <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_province" value="<?php if($client != null){echo $client->client_province;}?>">
        </div>
        <div class="form-group">
          <label>Serial Number <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_serial_number" value="<?php if($client != null){echo $client->client_serial_number;}?>">
        </div>
        <div class="form-group">
          <label>NPWP <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_npwp" value="<?php if($client != null){echo $client->client_npwp;}?>">
        </div>
        <div class="form-group">
          <label>Virtual Keyboard?</label><br>
          <input class="" type="checkbox" name="client_keyboard_status" value="1" <?php if($client != null){if($client->client_keyboard_status == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>par_client/index"><i class="fa fa-close"></i> Batal</a>
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
        'client_name': {
          required: true
        },
        'client_realname': {
          required: true
        },
        'client_name': {
          required: true
        },
        'client_password': {
          required: true
        },
        'client_password_repeat': {
          required: true,
          equalTo: '#client_password'
        }
      },
      messages: {
        'client_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_realname': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_password': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_password_repeat': {
          required: '<i style="color:red">Wajib diisi!</i>',
          equalTo: '<i style="color:red">Kata sandi tidak sama!</i>'
        }
      }
    });

    $("#form_password").validate({
      rules: {
        'client_password_old': {
          required: true
        },
        'client_password_new': {
          required: true
        },
        'client_password_new_repeat': {
          required: true,
          equalTo: '#client_password_new'
        }
      },
      messages: {
        'client_password_old': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_password_new': {
          required: '<i style="color:red">Wajib diisi!</i>',
        },
        'client_password_new_repeat': {
          required: '<i style="color:red">Wajib diisi!</i>',
          equalTo: '<i style="color:red">Kata sandi tidak sama!</i>'
        }
      }
    });
  })
</script>
