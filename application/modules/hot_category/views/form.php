<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>hot_category/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control" type="hidden" name="category_id" value="<?php if($category != null){echo $category->category_id;}?>">
        <div class="form-group">
          <label>Nama Tipe<small class="required-field">*</small></label>
          <input class="form-control" type="text" name="category_name" value="<?php if($category != null){echo $category->category_name;}?>">
        </div>
        <div class="form-group">
          <label>Harga<small class="required-field">*</small></label>
          <input class="form-control" type="number" name="category_price" value="<?php if($category != null){echo $category->category_price;}?>">
        </div>
        <div class="form-group">
          <label>Keterangan<small class="required-field">*</small></label>
          <textarea name="category_desc" class="form-control"><?php if($category != null){echo $category->category_desc;}?></textarea>
        </div>
        <div class="form-group">
          <label>Aktif?</label><br>
          <input class="" type="checkbox" name="is_active" value="1" <?php if($category != null){if($category->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
        </div>
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>hot_category/index"><i class="fa fa-close"></i> Batal</a>
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
        'category_id': {
          required: true
        },
        'category_name': {
          required: true
        }
      },
      messages: {
        'category_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'category_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })
</script>
