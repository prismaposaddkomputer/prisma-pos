<div class="content-header">
  <h4>
    <a href="<?=base_url('res_stock_opname')?>" class="btn btn-success"><i class="fa fa-arrow-left"></i></a> 
    <i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?>
  </h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="" method="post">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>No Kwitansi <small class="required-field">*</small></label>
          <input class="form-control" type="text" name="" value="TXA-<?php if($stock_opname != null){echo $stock_opname->tx_receipt_no;}else{echo $tx_receipt_no;}?>" readonly>
        </div>
        <input type="hidden" name="tx_id" value="<?php if($stock_opname != null){echo $stock_opname->tx_id;}else{echo $tx_id;}?>">
        <input type="hidden" name="tx_receipt_no" value="<?php if($stock_opname != null){echo $stock_opname->tx_receipt_no;}else{echo $tx_receipt_no;}?>">
        <input type="hidden" name="tx_type" value="TXA">
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Tanggal <small class="required-field">*</small></label>
          <input class="form-control keyboard date-picker" name="tx_date" value="<?php if($stock_opname != null){echo date_to_ind($stock_opname->tx_date);}else{echo date('d-m-Y');}?>">
        </div>
      </div>
      <div class="col-md-7">
        <div class="form-group">
          <label>Catatan <small class="required-field">*</small></label>
          <input class="form-control keyboard" name="tx_notes" value="<?php if($stock_opname != null){echo $stock_opname->tx_notes;}?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Daftar Item</div>
          <div class="panel-body">
            <div>
              <table id="tbl_item" class="table table-condensed table-bordered">
                <thead>
                  <tr>
                    <th class="text-center" width="50">Aksi</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center" width="80">Stok Barang Sistem</th>
                    <th class="text-center" width="70">Stok Barang Aktual</th>
                    <th class="text-center" width="70">Selisih</th>
                    <th class="text-center" width="120">Harga @Unit Sistem</th>
                    <th class="text-center" width="70">Harga @Unit Baru</th>
                  </tr>
                </thead>
                <tbody id="list_item">
                  <?php if ($action == 'insert'): ?>
                    <?php foreach ($item as $row): ?>
                      <input type="hidden" name="item_id[]" value="<?=$row->item_id?>">
                      <tr>
                        <td><?=$row->item_id?></td>
                        <td><?=$row->item_name?></td>
                        <td class="text-center">
                          <input id="stock_last_<?=$row->item_id?>" type="hidden" name="stock_last[]" value="<?=$row->stock_last?>">
                          <?=$row->stock_last?>
                        </td>
                        <td>
                          <input class="autonumeric num" id="stock_now_<?=$row->item_id?>" type="text" name="stock_now[]" size="5" onchange="diff('<?=$row->item_id?>')">
                        </td>
                        <td class="text-center" id="stock_diff_<?=$row->item_id?>">0</td>
                        <td><?=num_to_idr($row->item_purchase)?></td>
                        <td>
                          <input id="stock_adjustment_<?=$row->item_id?>" type="hidden" name="stock_adjustment[]" size="5">
                          <input class="autonumeric num" type="text" name="stock_price[]" size="5">
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <?php foreach ($stock_opname->item as $row): ?>
                      <input type="hidden" name="item_id[]" value="<?=$row->item_id?>">
                      <input type="hidden" name="stock_id[]" value="<?=$row->stock_id?>">
                      <tr>
                        <td><?=$row->item_id?></td>
                        <td><?=$row->item_name?></td>
                        <td class="text-center">
                          <input id="stock_last_<?=$row->item_id?>" type="hidden" name="stock_last[]" value="<?=$row->stock_last?>">
                          <?=$row->stock_last?>
                        </td>
                        <td>
                          <input class="autonumeric" id="stock_now_<?=$row->item_id?>" type="text" name="stock_now[]" size="5" onchange="diff('<?=$row->item_id?>')" value="<?=$row->stock_now?>">
                        </td>
                        <td class="text-center" id="stock_diff_<?=$row->item_id?>"><?=$row->stock_now - $row->stock_last?></td>
                        <td><?=num_to_idr($row->item_purchase)?></td>
                        <td>
                          <input id="stock_adjustment_<?=$row->item_id?>" type="hidden" name="stock_adjustment[]" size="5">
                          <input class="autonumeric" type="text" name="stock_price[]" size="5" value="<?=$row->stock_price?>">
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_stock_opname/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-warning" type="submit" onclick="javascript: form.action='<?=base_url()?>res_stock_opname/<?=$action_draft?>';"><i class="fa fa-edit"></i> Simpan Sementara</button>
          <button class="btn btn-info" type="submit" onclick="javascript: form.action='<?=base_url()?>res_stock_opname/<?=$action?>';"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    //item add
    $('#form').validate({
      rules: {
        'tx_notes': {
          required: true
        },
        'tx_date': {
          required: true
        }
      },
      messages: {
        'tx_notes': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'tx_date': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })

  function diff(i){
    var last = $('#stock_last_'+i).val();
    var now = $('#stock_now_'+i).val();
    if(now == ''){
      now = last;
    }
    var diff = ind_to_sys(now) - last;
    $('#stock_adjustment_'+i).val(diff);
    $('#stock_diff_'+i).html(diff);
  }
</script>
