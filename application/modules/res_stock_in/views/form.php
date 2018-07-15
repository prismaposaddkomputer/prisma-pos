<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>res_stock_in/<?=$action?>" method="post">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>No Kwitansi <small class="required-field">*</small></label>
          <input class="form-control" type="text" name="" value="TXI-<?=$tx_receipt_no?>" readonly>
        </div>
        <input type="hidden" name="tx_id" value="<?php if($stock_in != null){echo $stock_in->tx_id;}else{echo $tx_id;}?>">
        <input type="hidden" name="tx_receipt_no" value="<?php if($stock_in != null){echo $stock_in->tx_receipt_no;}else{echo $tx_receipt_no;}?>">
        <input type="hidden" name="tx_type" value="TXI">
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Tanggal <small class="required-field">*</small></label>
          <input class="form-control date-picker" name="tx_date" value="<?php if($stock_in != null){echo date_to_indo($stock_in->tx_date);}else{echo date('d-m-Y');}?>">
        </div>
      </div>
      <div class="col-md-7">
        <div class="form-group">
          <label>Catatan <small class="required-field">*</small></label>
          <input class="form-control keyboard" name="tx_notes" value="<?php if($stock_in != null){echo $stock_in->tx_notes;}?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">Daftar Item</div>
          <div class="panel-body">
            <button id="btn_item_show" class="btn btn-info" type="button" name="button"><i class="fa fa-plus"></i> Tambah Item</button>
            <br><br>
            <div>
              <table id="tbl_item" class="table table-condensed table-bordered">
                <thead>
                  <tr>
                    <th class="text-center" width="50">Aksi</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center" width="100">Jumlah</th>
                    <th class="text-center" width="150">Harga Beli/Unit</th>
                    <th class="text-center" width="150">Total</th>
                  </tr>
                </thead>
                <tbody id="list_item">

                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center" colspan="4">Total</th>
                    <input id="grand_total" type="hidden" name="" value="0">
                    <th id="txt_grand_total">Rp <span class="pull-right">0</span></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>res_stock_in/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </div>
  </form>
</div>
<div id="modal_item" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id="form_item" action="#" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Item</label>
            <select id="item_id" class="form-control keyboard select2" name="item_id">
              <?php foreach ($item as $row): ?>
                <option value="<?=$row->item_id?>"><?=$row->item_name?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input id="stock_in" class="form-control num" name="stock_in" type="number" value="">
          </div>
          <div class="form-group">
            <label>Harga Beli</label>
            <input id="stock_price" class="form-control num autonumeric" name="stock_price" type="text" value="">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button id="btn_item_add" class="btn btn-info" type="submit" name="button"><i class="fa fa-plus"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    //open modal
    $("#btn_item_show").click(function () {
      $("#modal_item").modal('show');
      $("#stock_in").val('');
      $("#stock_price").val('');
    });

    //item add
    $('#form_item').validate({
      rules: {
        'stock_in': {
          required: true
        },
        'stock_price': {
          required: true
        }
      },
      messages: {
        'stock_in': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'stock_price': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        var item_id = $("#item_id").val();
        var item_name = $("#item_id option:selected").text();
        var stock_in = $("#stock_in").val();
        var stock_price = $("#stock_price").val();

        var html = '<tr>'+
          '<td class="text-center">'+
            '<button class="btn btn-xs btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>'+
          '</td>'+
          '<td>'+
            '<input type="hidden" name="item_id[]" value="'+item_id+'" />'+
            item_name+
          '</td>'+
          '<td class="text-center">'+
            '<input type="hidden" name="stock_in[]" value="'+stock_in+'" />'+
            stock_in+
          '</td>'+
          '<td>'+
            '<input type="hidden" name="stock_price[]" value="'+stock_price+'" />'+
            ind_to_cur(stock_price)+
          '</td>'+
          '<td>'+sys_to_cur(ind_to_sys(stock_price)*stock_in)+'</td>'+
          '</tr>';

        $("#list_item").append(html);

        var grand_total = $("#grand_total").val();
        grand_total = parseInt(grand_total)+ind_to_sys(stock_price)*stock_in;
        $("#grand_total").val(grand_total);
        $('#txt_grand_total').html('');
        $('#txt_grand_total').html(sys_to_cur(grand_total));

        $("#modal_item").modal('hide');
        return false;
      }
    });

    $("#form").validate({
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
  //get cell
  function getTotal(row,col,table) {
    var res = document.getElementById(table).rows[row].cells[col].innerHTML;
    return ind_to_sys(res.replace ( /[^\d.]/g, '' ));
  }

  //delete row
  function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    var total = getTotal(i,4,"tbl_item");

    var grand_total = $("#grand_total").val();
    grand_total = parseInt(grand_total)-total;
    $("#grand_total").val(grand_total);
    $('#txt_grand_total').html('');
    $('#txt_grand_total').html(sys_to_cur(grand_total));

    document.getElementById("tbl_item").deleteRow(i);
  }

</script>
