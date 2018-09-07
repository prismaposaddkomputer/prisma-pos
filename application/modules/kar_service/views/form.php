<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_service/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="service_id" value="<?php if($service != null){echo $service->service_id;}?>">
        <div class="form-group">
          <label>Nama Pelayanan Kamar <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="service_name" value="<?php if($service != null){echo $service->service_name;}?>">
        </div>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Harga <small class="required-field">*</small></label>
              <div class="input-group">
                <div class="input-group-addon"><b>Rp</b></div>
                <input class="form-control autonumeric num" type="text" name="service_charge" value="<?php if($service != null){echo $service->service_charge;}?>">
              </div>
            </div>
          </div>
        </div>
        <small>
          Harga
          <?php if ($client->client_is_taxed == 1) {
            echo 'Sudah Termasuk';
          }else{
            echo 'Belum Termasuk';
          } ?>
          Pajak karaoke
        </small>
        <div class="form-group">
          <label>Tersedia?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($service != null){if($service->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_service/index"><i class="fa fa-close"></i> Batal</a>
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
        'service_id': {
          required: true
        },
        'service_name': {
          required: true
        },
        'service_charge': {
          required: true
        }
      },
      messages: {
        'service_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'service_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'service_charge': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
