<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_member/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="member_id" value="<?php if($member != null){echo $member->member_id;}?>">
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="member_name" value="<?php if($member != null){echo $member->member_name;}?>">
        </div>
        <div class="form-group">
          <label>Tipe Member<small class="required-field">*</small></label>
          <select class="form-control keyboard select2" name="member_type_id">
            <?php foreach ($member_type as $row): ?>
              <option value="<?=$row->member_type_id?>" <?php if($member != null){if($member->member_type_id == $row->member_type_id){echo 'selected';};}?>><?=$row->member_type_name?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Telepon <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="member_phone" value="<?php if($member != null){echo $member->member_phone;}?>">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input class="form-control keyboard" type="text" name="member_email" value="<?php if($member != null){echo $member->member_email;}?>">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input class="form-control keyboard" type="text" name="member_address" value="<?php if($member != null){echo $member->member_address;}?>">
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($member != null){if($member->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_member/index"><i class="fa fa-close"></i> Batal</a>
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
        'member_id': {
          required: true
        },
        'member_name': {
          required: true
        },
        'member_phone': {
          required: true
        }
      },
      messages: {
        'member_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'member_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'member_phone': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
