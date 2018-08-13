<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_guest/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="guest_id" value="<?php if($guest != null){echo $guest->guest_id;}?>">
        <div class="form-group">
          <label>Nama Tamu<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="guest_name" value="<?php if($guest != null){echo $guest->guest_name;}?>">
        </div>
        <div class="form-group" style="display:none;">
          <label>No Identitas<small class="required-field">*</small></label>
          <input class="form-control num" type="number" name="guest_number" value="<?php if($guest != null){echo $guest->guest_number;}?>">
        </div>
        <div class="form-group" style="display:none;">
          <label>Pekerjaan<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="guest_job" value="<?php if($guest != null){echo $guest->guest_job;}?>">
        </div>
        <div class="form-group">
          <label>Jenis Kelamin<small class="required-field">*</small></label>
          <br>
          <?php if($guest != null): ?>
              <?php if($guest->guest_gender=='P'): ?>
                    <label class="radio-inline">
                      <input type="radio" name="guest_gender" value="L" required/> Laki-laki
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="guest_gender" value="P" checked="true" required/> Perempuan
                    </label>
                <?php Else: ?>
								<label class="radio-inline">
									 <input type="radio" name="guest_gender" value="L" checked="true" required/> Laki-laki
								</label>
								<label class="radio-inline">
									 <input type="radio" name="guest_gender" value="P" required/> Perempuan
								</label>
                <?php EndIf; ?>
							<?php Else: ?>
								<label class="radio-inline">
									 <input type="radio" name="guest_gender" value="L" checked="true" required/> Laki-laki
								</label>
								<label class="radio-inline">
									 <input type="radio" name="guest_gender" value="P" required/> Perempuan
								</label>
							<?php EndIf; ?>	
          </div>
        <div class="form-group">
          <label>No Telepon<small class="required-field"></small></label>
          <input class="form-control num" type="number" name="guest_phone" value="<?php if($guest != null){echo $guest->guest_phone;}?>">
        </div>
        <div class="form-group" style="display:none;">
          <label>Email<small class="required-field">*</small></label>
          <input class="form-control keyboard" type="email" name="guest_email" value="<?php if($guest != null){echo $guest->guest_email;}?>">
        </div>
        <div class="form-group" style="display:none;">
          <label>Alamat<small class="required-field">*</small></label>
          <textarea name="guest_address" class="form-control keyboard"><?php if($guest != null){echo $guest->guest_address;}?></textarea>
        </div>
        <div class="form-group" style="display:none;" >
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="0">
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_guest/index"><i class="fa fa-close"></i> Batal</a>
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
        'guest_id': {
          required: true
        },
        'guest_name': {
          required: true
        }
      },
      messages: {
        'guest_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'guest_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
