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
          <label>Nama Kamar<small class="required-field">*</small></label>
          <input class="form-control" type="text" name="room_name" value="<?php if($room != null){echo $room->room_name;}?>">
        </div>
        <div class="form-group">
          <label>Tipe Kamar<small class="required-field">*</small></label>
          <select name="category_id" class="form-control" required>
								<option></option>
								<?php foreach($category as $t): ?>
                <?php if($room != null):?>
									<?php if($t->category_id==$room->category_id): ?>
										<option value="<?php echo $t->category_id;?>" selected><?php echo $t->category_name;?></option>
                    <?php EndIf; ?>
                  <?php Else: ?>
										<option value="<?php echo $t->category_id;?>"><?php echo $t->category_name;?></option>
									<?php EndIf; ?>	
								<?php EndForeach; ?>	
					</select>
        </div>
        <div class="form-group">
          <label>Nomor Kamar<small class="required-field">*</small></label>
          <input class="form-control" type="number" name="room_number" value="<?php if($room != null){echo $room->room_number;}?>">
        </div>
        <div class="form-group">
          <label>Lantai<small class="required-field">*</small></label>
          <input class="form-control" type="number" name="room_floor" value="<?php if($room != null){echo $room->room_floor;}?>">
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
