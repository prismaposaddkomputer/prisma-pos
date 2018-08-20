<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_room/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="room_id" value="<?php if($room != null){echo $room->room_id;}?>">
        <div class="form-group">
          <label>Tipe Kamar<small class="required-field">*</small></label>
          <select name="room_type_id" class="form-control select2" required>
            <?php foreach ($room_type as $row) { ?>
              <option value="<?=$row->room_type_id?>" <?php if($row->room_type_id == $room->room_type_id){echo 'selected';} ?>><?=$row->room_type_name;?></option>
            <?php } ?>
					</select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor Kamar<small class="required-field">*</small></label>
              <input class="form-control num" name="room_no" value="<?php if($room != null){echo $room->room_no;}?>">
            </div>
          </div>
        </div>
        <div class="form-group" style="display:none;">
          <label>Aktif?</label><br>
          <input class="" type="hidden" name="is_active" value="1">
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_room/index"><i class="fa fa-close"></i> Batal</a>
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
