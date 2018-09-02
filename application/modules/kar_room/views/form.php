<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>kar_room/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="room_id" value="<?php if($room != null){echo $room->room_id;}?>">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Nama Ruang <small class="required-field">*</small></label>
              <input class="form-control keyboard" name="room_name" value="<?php if($room != null){echo $room->room_name;}?>">
            </div>
          </div>
        </div>
        <div class="form-group" style="display:none;">
          <label>Aktif?</label><br>
          <input class="" type="hidden" name="is_active" value="1">
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
        'room_name': {
          required: true
        }
      },
      messages: {
        'room_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
