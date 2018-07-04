<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_receipt/<?=$action?>" method="post">
      <div class="col-md-6">
        <h4>Header</h4>
        <input class="form-control keyboard" type="hidden" name="receipt_id" value="<?php if($receipt != null){echo $receipt->receipt_id;}?>">
        <div class="form-group">
          <label>Nama Perusahaan</label><br>
          <input class="" type="checkbox" name="receipt_name" value="1" <?php if($receipt != null){if($receipt->receipt_name == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group">
          <label>Alamat?</label><br>
          <input class="" type="checkbox" name="receipt_street" value="1" <?php if($receipt != null){if($receipt->receipt_street == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group">
          <label>Kecamatan</label><br>
          <input class="" type="checkbox" name="receipt_district" value="1" <?php if($receipt != null){if($receipt->receipt_district == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group">
          <label>Kota</label><br>
          <input class="" type="checkbox" name="receipt_city" value="1" <?php if($receipt != null){if($receipt->receipt_city == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group">
          <label>Provinsi</label><br>
          <input class="" type="checkbox" name="receipt_province" value="1" <?php if($receipt != null){if($receipt->receipt_province == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group">
          <label>NPWP</label><br>
          <input class="" type="checkbox" name="receipt_npwp" value="1" <?php if($receipt != null){if($receipt->receipt_npwp == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
      </div>
      <div class="col-md-6">
        <h4>Footer</h4>
        <div class="form-group">
          <label>Footer</label>
          <textarea class="form-control" name="receipt_footer"><?php if($receipt != null){echo $receipt->receipt_footer;}?></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_receipt/index"><i class="fa fa-close"></i> Batal</a>
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
        'receipt_footer': {
          required: true
        }
      },
      messages: {
        'receipt_footer': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
