<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_room/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="room_id" value="<?php if($room != null){echo $room->room_id;}?>">
        <div class="form-group">
          <label>Kode <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="room_code" value="<?php if($room != null){echo $room->room_code;}?>">
        </div>
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="room_name" value="<?php if($room != null){echo $room->room_name;}?>">
        </div>
        <div class="form-group">
          <label>Tipe <small class="required-field">*</small></label>
          <select class="form-control keyboard select2" name="room_type_id">
            <?php foreach ($room_type as $row): ?>
              <option value="<?=$row->room_type_id?>" <?php if($room != null){if($room->room_type_id == $row->room_type_id){echo 'selected';};}?>><?=$row->room_type_name?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($room != null){if($room->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>kar_room/index"><i class="fa fa-close"></i> Batal</a>
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
        'room_id': {
          required: true
        },
        'room_name': {
          required: true
        }
      },
      messages: {
        'room_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'room_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
