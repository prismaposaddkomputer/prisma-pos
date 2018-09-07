<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <div class="row">
    <form id="form" class="" action="<?=base_url()?>res_item/<?=$action?>" method="post">
      <div class="col-md-6">
        <input class="form-control keyboard" type="hidden" name="item_id" value="<?php if($item != null){echo $item->item_id;}?>">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Kode Item </label>
              <input class="form-control num" type="text" name="item_barcode" value="<?php if($item != null){echo $item->item_barcode;}?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Nama <small class="required-field">*</small></label>
          <input class="form-control keyboard" type="text" name="item_name" value="<?php if($item != null){echo $item->item_name;}?>">
        </div>
        <div class="form-group">
          <label>Kategori <small class="required-field">*</small></label>
          <select class="form-control keyboard select2" name="category_id">
            <?php foreach ($category_list as $row): ?>
              <option value="<?=$row->category_id?>" <?php if($item != null){if($row->category_id == $item->category_id){echo 'selected';};}?>><?=$row->category_name?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Pajak <small class="required-field">*</small></label>
          <select class="select2" name="tax_id" id="tax_id">
            <?php foreach ($tax_list as $row): ?>
              <option value="<?=$row->tax_id?>" <?php if($item != null){if($row->tax_id == $item->tax_id){echo 'selected';};}?>><?=$row->tax_name?> (<?=$row->tax_ratio?> %)</option>
            <?php endforeach;?>
          </select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Satuan <small class="required-field">*</small></label>
              <select class="form-control keyboard select2" name="unit_id">
                <?php foreach ($unit_list as $row): ?>
                  <option value="<?=$row->unit_id?>" <?php if($item != null){if($row->unit_id == $item->unit_id){echo 'selected';};}?>><?=$row->unit_code?> - <?=$row->unit_name?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Harga per Satuan <small class="required-field">*</small></label>
              <input class="form-control num autonumeric" type="text" name="item_price" value="<?php if($item != null){echo $item->item_price;}?>">
            </div>
            <small>
              <span class="cl-danger">**</span>
              Harga
              <?php if ($client->client_is_taxed == 1) {
                echo 'sudah termasuk';
              }else{
                echo 'belum termasuk';
              } ?>
              pajak di atas.
            </small>
          </div>
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea class="form-control keyboard" name="item_desc"><?php if($item != null){echo $item->item_desc;}?></textarea>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Aktif?</label><br>
              <input class="" type="checkbox" name="is_active" value="1" <?php if($item != null){if($item->is_active == 1){echo 'checked';}}else{echo 'checked';}?>>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <?php if ($item == null): ?>
          <div class="form-group">
            <label>Berupa Paket?</label><br>
            <input class="" type="checkbox" name="is_package" value="1" <?php if($item != null){if($item->is_package == 1){echo 'checked';}}?>>
          </div>
        <?php elseif($item != null && $item->is_package == 1): ?>
          <div class="form-group">
            <label>Berupa Paket?</label><br>
            <input class="" type="checkbox" name="is_package" value="1" <?php if($item != null){if($item->is_package == 1){echo 'checked';}}?>>
          </div>
        <?php endif; ?>
        <div id="package_section">
          <?php if ($item == !null): ?>
            <?php if ($item->is_package == 1): ?>
              <?php if ($item->package != null): ?>
                <button class="btn btn-info" type="button" onclick="add_package()">Tambah</button><br><br>
                <?php $package_row = 0; foreach ($item->package as $row): ?>
                  <div id="row_<?=$package_row?>" class="form-group">
                    <div class="row">
                      <div class="col-md-7">
                        <label>Item</label>
                        <select class="form-control keyboard select2" name="item_detail_id[]">
                          <?php foreach ($item_list as $row2): ?>
                            <option value="<?=$row2->item_id?>" <?php if($row->item_detail_id == $row2->item_id){echo 'selected';}?>><?=$row2->item_name?> (<?=num_to_idr($row2->item_price_before_tax)?>)</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label>Harga Paket</label>
                        <input class="form-control keyboard" type="number" name="item_detail_price[]" oninput="cacl_price()" value="<?=$row->item_detail_price?>">
                      </div>
                      <div class="col-md-1">
                        <label>&nbsp;</label>
                        <button class="btn btn-danger" type="button" onclick="remove_package('<?=$package_row?>')"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                  </div>
                  <?php $package_row++; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group pull-right">
            <a class="btn btn-default" href="<?=base_url()?>res_item/index"><i class="fa fa-close"></i> Batal</a>
            <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  var package_row=0;

  <?php if ($item != null): ?>
    package_row = <?=$package_row?>;
  <?php endif; ?>

  function add_package() {
    var html =
      '<div id="row_'+package_row+'" class="form-group">'+
        '<div class="row">'+
          '<div class="col-md-7">'+
            '<label>Item</label>'+
            '<select class="form-control keyboard select2" name="item_detail_id[]">'+
              <?php foreach ($item_list as $row): ?>
                '<option value="<?=$row->item_id?>"><?=$row->item_name?> (<?php if($client->client_is_taxed == 0){echo num_to_idr($row->item_price_before_tax);}else{echo num_to_idr($row->item_price_after_tax);}?>)</option>'+
              <?php endforeach; ?>
            '</select>'+
          '</div>'+
          '<div class="col-md-3">'+
            '<label>Harga Paket</label>'+
            '<input class="form-control keyboard" type="number" name="item_detail_price[]" onchange="cacl_price()">'+
          '</div>'+
          '<div class="col-md-1">'+
            '<label>&nbsp;</label>'+
            '<button class="btn btn-danger" type="button" onclick="remove_package('+package_row+')"><i class="fa fa-minus"></i></button>'+
          '</div>'+
        '</div>'
      '</div>';
    $("#package_section").append(html);
    package_row++;
  };

  function cacl_price() {
    var price = 0;
    $("input[name='item_detail_price[]']").each(function() {
      if($(this).val() == ''){
        price += 0;
      }else{
        price += parseFloat($(this).val());
      }
    });
    $("input[name='item_price']").val(sys_to_ind(price));
    calc_after_tax();
  }

  function remove_package(id){
    if(id != 0){
      $("#row_"+id).remove();
      cacl_price();
    }
  }

  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'item_name': {
          required: true
        },
        'item_price_before_tax': {
          required: true
        }
      },
      messages: {
        'item_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'item_price_before_tax': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });

    $('input[name=is_package]').change(function() {
      if($(this).is(":checked")) {
        $('input[name="item_price_before_tax"]').attr('readonly', true);
        $('input[name="item_price_after_tax"]').attr('readonly', true);
        $('input[name="item_price_before_tax"]').val(0);
        $('input[name="item_tax"]').val(0);
        $('input[name="item_price_after_tax"]').val(0);
        $("#package_section").append('<button class="btn btn-info" type="button" onclick="add_package()">Tambah</button><br><br>');
        add_package();
      }else{
        $('input[name="item_price_before_tax"]').attr('readonly', false);
        //$('input[name="item_price_before_tax"]').val(0);
        $("#package_section").html('');
      };
    });


  });

</script>
