<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" action="<?=base_url()?>res_client/<?=$action?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="col-md-6">
        <input class="form-control keyboard keyboard" type="hidden" name="client_id" value="<?php if($client != null){echo $client->client_id;}?>">
        <h4>Profil Perusahaan</h4>
        <div class="form-group">
          <label>Nama Usaha <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_name" value="<?php if($client != null){echo $client->client_name;}?>">
        </div>
        <div class="form-group">
          <label>Nama Brand <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_brand" value="<?php if($client != null){echo $client->client_brand;}?>">
        </div>
        <div class="form-group">
          <label>Status Usaha <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_status" value="<?php if($client != null){echo $client->client_status;}?>">
        </div>
        <hr>
        <h4>Alamat Perusahaan</h4>
        <div class="form-group">
          <label>Jalan <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_street" value="<?php if($client != null){echo $client->client_street;}?>">
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Kelurahan <small class="required-field">*</small></label>
              <input class="form-control keyboard" type="text" name="client_subdistrict" value="<?php if($client != null){echo $client->client_subdistrict;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Kecamatan <small class="required-field">*</small></label>
              <input class="form-control keyboard" type="text" name="client_district" value="<?php if($client != null){echo $client->client_district;}?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Kota/Kabupaten <small class="required-field">*</small></label>
              <input class="form-control keyboard" type="text" name="client_city" value="<?php if($client != null){echo $client->client_city;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Provinsi <small class="required-field">*</small></label>
              <input class="form-control keyboard" type="text" name="client_province" value="<?php if($client != null){echo $client->client_province;}?>">
            </div>
          </div>
        </div>
        <hr>
        <h4>Kontak</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Telepon 1<small class="required-field">*</small></label>
              <input class="form-control num" type="text" name="client_phone_1" value="<?php if($client != null){echo $client->client_phone_1;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Telepon 2<small class="required-field">*</small></label>
              <input class="form-control num" type="text" name="client_phone_2" value="<?php if($client != null){echo $client->client_phone_2;}?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Email <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_email" value="<?php if($client != null){echo $client->client_email;}?>">
        </div>
        <hr>
        <h4>Wajib Pajak</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>NPWP<small class="required-field">*</small></label>
              <input class="form-control num" type="text" name="client_npwp" value="<?php if($client != null){echo $client->client_npwp;}?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>NPWPD<small class="required-field">*</small></label>
              <input class="form-control num" type="text" name="client_npwpd" value="<?php if($client != null){echo $client->client_npwpd;}?>" <?php if ($this->session->userdata('role_id') != 0) {echo 'readonly';}; ?>>
            </div>
          </div>
        </div>
        <h4>Pemilik</h4>
        <div class="form-group">
          <label>Nama Pemilik<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="client_owner_name" value="<?php if($client != null){echo $client->client_owner_name;}?>">
        </div>
        <div class="form-group">
          <label>Alamat Pemilik<small class="required-field">*</small></label>
          <textarea class="form-control keyboard" type="text" name="client_owner_address"><?php if($client != null){echo $client->client_owner_address;}?></textarea>
        </div>
        <hr>
        <h4>Data Lain</h4>
        <div class="form-group">
          <label>Keterangan Tambahan<small class="required-field">*</small></label>
          <textarea class="form-control keyboard" type="text" name="client_notes"><?php if($client != null){echo $client->client_notes;}?></textarea>
        </div>
        <div class="form-group">
          <label>Serial Number <small class="required-field">*</small></label>
          <input class="form-control num" type="text" name="client_serial_number" value="<?php if($client != null){echo $client->client_serial_number;}?>" <?php if ($this->session->userdata('role_id') != 0) {echo 'readonly';}; ?>>
        </div>
        <div class="form-group">
          <label>Virtual Keyboard?</label><br>
          <input class="" type="checkbox" name="client_keyboard_status" value="1" <?php if($client != null){if($client->client_keyboard_status == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group">
          <label>Logo Perusahaan</label>
          <br>
          <?php if ($client->client_logo == null || $client->client_logo == ''): ?>
            <img src="<?=base_url()?>img/no-image.png" alt="" width="200" height="200">
          <?php else: ?>
            <img src="<?=base_url()?>img/<?=$client->client_logo?>" alt="" width="200" height="200">
          <?php endif; ?>
          <br><br>
          <input type="file" name="client_logo" value="">
          <small>Type : *.gif/*.jpg/*.png; Max Size : 10 MB; Max Height : 1024px; Max Width : 768px;</small>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_client/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules : {
        'client_name' : {
          required : true
        },
        'client_brand' : {
          required : true
        },
        'client_status' : {
          required : true
        },
        'client_street' : {
          required : true
        },
        'client_subdistrict' : {
          required : true
        },
        'client_district' : {
          required : true
        },
        'client_city' : {
          required : true
        },
        'client_province' : {
          required : true
        },
        'client_phone_1' : {
          required : true,
          number : true
        },
        'client_npwp' : {
          required : true,
          number : true
        },
        'client_npwpd' : {
          required : true,
          number : true
        },
        'client_owner_name' : {
          required : true
        },
        'client_owner_address' : {
          required : true
        },
        'client_serial_number' : {
          required : true
        }
      },
      messages : {
        'client_name' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_brand' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_status' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_street' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_subdistrict' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_district' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_city' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_province' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_phone_1' : {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        },
        'client_npwp' : {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        },
        'client_npwpd' : {
          required: '<i style="color:red">Wajib diisi!</i>',
          number: '<i style="color:red">Harus berupa angka!</i>'
        },
        'client_owner_name' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_owner_address' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'client_serial_number' : {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
