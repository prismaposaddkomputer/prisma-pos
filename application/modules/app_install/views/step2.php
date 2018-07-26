<div class="col-md-6 col-md-offset-3">
  <form id="form" action="<?=base_url()?>app_install/update_client" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Identitas Perusahaan</strong></div>
        <div class="panel-body">
          <small class="pull-right"><span class="cl-danger">*</span> Kolom wajib diisi!</small>
          <h4>Profil Perusahaan</h4>
          <div class="form-group">
            <label>Nama Usaha <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="text" name="client_name" value="">
          </div>
          <div class="form-group">
            <label>Nama Brand <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="text" name="client_brand" value="">
          </div>
          <div class="form-group">
            <label>Status Usaha <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="text" name="client_status" value="">
          </div>
          <hr>
          <h4>Alamat Perusahaan</h4>
          <div class="form-group">
            <label>Jalan <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="text" name="client_street" value="">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Kelurahan <small class="required-field">*</small></label>
                <input class="form-control keyboard" type="text" name="client_subdistrict" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kecamatan <small class="required-field">*</small></label>
                <input class="form-control keyboard" type="text" name="client_district" value="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Kota/Kabupaten <small class="required-field">*</small></label>
                <input class="form-control keyboard" type="text" name="client_city" value="SEMARANG">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Provinsi <small class="required-field">*</small></label>
                <input class="form-control keyboard" type="text" name="client_province" value="JAWA TENGAH">
              </div>
            </div>
          </div>
          <hr>
          <h4>Kontak</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Telepon 1 <small class="required-field">*</small></label>
                <input class="form-control num" type="text" name="client_phone_1" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Telepon 2</label>
                <input class="form-control num" type="text" name="client_phone_2" value="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input class="form-control keyboard" type="text" name="client_email" value="">
          </div>
          <hr>
          <h4>Wajib Pajak</h4>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>NPWP <small class="required-field">*</small></label>
                <input class="form-control num" type="text" name="client_npwp" value="0">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>NPWPD <small class="required-field">*</small></label>
                <input class="form-control num" type="text" name="client_npwpd" value="">
              </div>
            </div>
          </div>
          <h4>Pemilik</h4>
          <div class="form-group">
            <label>Nama Pemilik <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="text" name="client_owner_name" value="">
          </div>
          <div class="form-group">
            <label>Alamat Pemilik <small class="required-field">*</small></label>
            <textarea class="form-control keyboard" type="text" name="client_owner_address"></textarea>
          </div>
          <hr>
          <h4>Data Lain</h4>
          <div class="form-group">
            <label>Keterangan Tambahan</label>
            <textarea class="form-control keyboard" type="text" name="client_notes"></textarea>
          </div>
          <div class="form-group">
            <label>Serial Number <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="text" name="client_serial_number" value="06042018AA">
          </div>
          <div class="form-group">
            <label>Logo Perusahaan</label>
            <input type="file" name="client_logo" value="">
            <small>Type : *.gif/*.jpg/*.png; Max Size : 10 MB; Max Height : 1024px; Max Width : 768px;</small>
          </div>
        </div>
        <div class="panel-footer">
          <a class="btn btn-default" href="<?=base_url()?>app_install/step1"><i class="fa fa-arrow-left"></i> Kembali</a>
          <button type="submit" class="btn btn-info pull-right">Lanjut <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    //form validation
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
