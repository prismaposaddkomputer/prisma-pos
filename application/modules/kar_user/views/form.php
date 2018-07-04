<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_user/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="user_id" value="<?php if($user != null){echo $user->user_id;}?>">
        <div class="form-group">
          <label>Nama Lengkap <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="user_realname" value="<?php if($user != null){echo $user->user_realname;}?>">
        </div>
        <div class="form-group">
          <label>Role <small class="required-field">*</small></label>
          <select class="form-control keyboard" name="role_id">
            <?php foreach ($role_list as $row): ?>
              <option value="<?=$row->role_id?>" <?php if($user != null){if($row->role_id == $user->role_id){echo 'selected';};}?>><?=$row->role_name?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Nama Pengguna (username) <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="user_name" value="<?php if($user != null){echo $user->user_name;}?>">
        </div>
        <?php if ($action == 'insert'): ?>
          <div class="form-group">
            <label>Kata Sandi <small class="required-field">*</small></label>
            <input id="user_password" class="form-control keyboard" type="password" name="user_password" value="<?php if($user != null){echo $user->user_password;}?>">
          </div>
          <div class="form-group">
            <label>Ulangi Kata Sandi <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="password" name="user_password_repeat" value="<?php if($user != null){echo $user->user_password;}?>">
          </div>
        <?php endif; ?>
        <div class="form-group">
          <label>Aktif? <small class="required-field">*</small></label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($user != null){if($user->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_user/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
  <?php if ($action == 'update'): ?>
  <div class="row">
    <form id="form_password" class="" action="<?=base_url()?>kar_user/update_password" method="post">
      <div class="col-md-6">
        <h4>Ubah Kata Sandi</h4>
        <?php echo $this->session->flashdata('status'); ?>
        <input class="form-control keyboard" type="hidden" name="user_id" value="<?php if($user != null){echo $user->user_id;}?>">
        <div class="form-group">
          <label>Kata Sandi Lama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="password" name="user_password_old" value="">
        </div>
          <div class="form-group">
            <label>Kata Sandi Baru <small class="required-field">*</small></label>
            <input id="user_password_new" class="form-control keyboard" type="password" name="user_password_new" value="">
          </div>
          <div class="form-group">
            <label>Ulangi Kata Sandi Baru <small class="required-field">*</small></label>
            <input class="form-control keyboard" type="password" name="user_password_new_repeat" value="">
          </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_user/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
  <?php endif; ?>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'user_name': {
          required: true
        },
        'user_realname': {
          required: true
        },
        'user_name': {
          required: true
        },
        'user_password': {
          required: true
        },
        'user_password_repeat': {
          required: true,
          equalTo: '#user_password'
        }
      },
      messages: {
        'user_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_realname': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_password': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_password_repeat': {
          required: '<i style="color:red">Wajib diisi!</i>',
          equalTo: '<i style="color:red">Kata sandi tidak sama!</i>'
        }
      }
    });

    $("#form_password").validate({
      rules: {
        'user_password_old': {
          required: true
        },
        'user_password_new': {
          required: true
        },
        'user_password_new_repeat': {
          required: true,
          equalTo: '#user_password_new'
        }
      },
      messages: {
        'user_password_old': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_password_new': {
          required: '<i style="color:red">Wajib diisi!</i>',
        },
        'user_password_new_repeat': {
          required: '<i style="color:red">Wajib diisi!</i>',
          equalTo: '<i style="color:red">Kata sandi tidak sama!</i>'
        }
      }
    });
  })
</script>
