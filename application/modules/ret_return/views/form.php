<div class="content-header">
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
  <small>Kolom dengan tanda <b class="required-field">*</b> wajib diisi!</small>
</div>
<div class="content-body">
  <form id="form" class="" action="<?=base_url()?>ret_return/<?=$action?>" method="post">
    <div class="row">
      <div class="col-md-3">
        <input class="form-control" type="hidden" name="tx_id" value="<?php if($return != null){echo $return->tx_id;}?>">
        <div class="form-group">
          <label>No Kwitansi</label>
          <div class="input-group">
            <span class="input-group-addon">TXS-</span>
            <input id="tx_receipt_no" type="text" class="form-control num" name="tx_receipt_no" placeholder="">
            <input id="tx_id_source" type="hidden" name="tx_id_source" value="">
            <span class="input-group-btn">
              <button class="btn btn-info" type="button" onclick="get_billing()"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Nama Pelanggan</label>
          <input id="customer_id" class="form-control" type="hidden" name="customer_id" value="" readonly>
          <input id="customer_name" class="form-control" type="text" name="customer_name" value="" readonly>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Tanggal</label>
          <input id="tx_date" class="form-control" type="text" name="" value="" readonly>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Waktu</label>
          <input id="tx_time" class="form-control" type="text" name="" value="" readonly>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Jenis Pembayaran</label>
          <input id="payment_type_name" class="form-control" type="text" name="" value="" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Alasan Retur</label>
          <input class="form-control keyboard" type="text" name="return_notes" value="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table style="background:white" class="table table-bordered table-">
          <thead>
            <tr>
              <th class="text-center">Item Name</th>
              <th class="text-center" width="200">Harga</th>
              <th class="text-center" width="80">Banyak Beli</th>
              <th class="text-center" width="80">Banyak Retur</th>
            </tr>
          </thead>
          <tbody id="detail-list">

          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <a class="btn btn-default" href="<?=base_url()?>ret_return/index"><i class="fa fa-close"></i> Batal</a>
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#form").validate({
      rules: {
        'tx_id': {
          required: true
        },
        'return_name': {
          required: true
        }
      },
      messages: {
        'tx_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'return_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      }
    });
  })

  function get_billing() {
    var tx_receipt_no = $("#tx_receipt_no").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>ret_return/get_billing',
      data : 'tx_receipt_no='+tx_receipt_no,
      dataType : 'json',
      success : function (data) {
        console.log(data);
        $("#tx_id_source").val(data.tx_id);
        $("#customer_id").val(data.customer_id);
        $("#customer_name").val(data.customer_name);
        $("#tx_date").val(data.tx_date);
        $("#tx_time").val(data.tx_time);
        $("#payment_type_name").val(data.payment_type_name);
        $("#detail-list").html('');
        $.each(data.detail, function(i, item) {
          var row = '<tr>'+
            '<input type="hidden" name="item_name[]" value="'+item.item_name+'">'+
            '<td>'+item.item_name+'</td>'+
            '<input type="hidden" name="item_price_after_tax[]" value="'+item.item_price_after_tax+'">'+
            '<td>'+sys_to_cur(item.item_price_after_tax)+'</td>'+
            '<input type="hidden" name="item_id[]" value="'+item.item_id+'">'+
            '<td class="text-center">'+item.tx_amount+'</td>'+
            '<input type="hidden" name="tx_amount[]" value="'+item.tx_amount+'">'+
            '<td class="text-center">'+
              '<input style="padding:0;height:24px;width:80px" type="text" name="return_amount[]" value="">'+
            '</td>'+
          '</tr>';
          $("#detail-list").append(row);
        })
      }
    });
  }
</script>
