<div class="content-header">
  <a class="btn btn-danger pull-right" href="<?=base_url()?>kar_cashier/shift/close">Tutup Shift</a>
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-12">
      <!-- <div class="panel panel-default">
        <div class="panel-body"> -->
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <select id="room_type_id" class="form-control keyboard select2" name="room_type_id">
                  <option value="0">Semua Tipe</option>
                  <?php foreach ($room_type as $row): ?>
                    <option value="<?=$row->room_type_id?>"><?=$row->room_type_name?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
  <div id="room-list" class="row">

  </div>
</div>
<!-- /.modal -->
<div id="modal_success" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h3>Transaksi Berhasil</h3>
        <i class="fa fa-check fa-5x cl-success"></i>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>

<!-- /.modal -->
<div id="modal_finish" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        Anda yakin menyelesaikan transaksi ini?
        <input id="finish_tx_id" type="hidden" name="" value="">
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
        <button type="button" class="btn btn-success" onclick="finish_action()"><i class="fa fa-check"></i> Ya</button>
      </div>
    </div>
  </div>
</div>

<!-- /.modal -->
<div id="modal_payment" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form id="form_payment" class="" action="<?=base_url()?>kar_cashier/payment_action" method="post">
        <div class="modal-header text-center">
          Pembayaran
        </div>
        <div class="modal-body">
          <input id="payment_tx_id" type="hidden" name="tx_id" value="">
          <div class="form-group">
            <label>Total Tagihan</label>
            <input id="payment_tx_total_grand" class="form-control" type="text" name="tx_total_grand" value="" readonly>
          </div>
          <div class="form-group">
            <label>Pembayaran</label>
            <input id="payment_tx_payment" class="form-control keyboard" type="text" name="tx_payment" value="" <?php if($keyboard == 1){echo 'onchange="calc_change()"';}else{echo 'oninput="calc_change()"';} ?>>
          </div>
          <div class="form-group">
            <label>Kembalian</label>
            <input id="payment_tx_change" class="form-control" type="text" name="tx_change" value="" readonly>
          </div>
          <div id="payment_message"></div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Bayar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal proses -->
<div id="modal_proses" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div id="proses_content" class="modal-content">
      <div class="modal-header text-center" style="text-transform:uppercase"><b id="proses_room_code"></b></div>
      <div class="modal-body">
        <table>
          <tbody>
            <tr>
              <td width="60">Tipe</td>
              <td width="10">:</td>
              <td id="proses_room_type_name"></td>
            </tr>
            <tr>
              <td>Status</td>
              <td>:</td>
              <td id="proses_status"><b></b></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td>:</td>
              <td id="proses_tx_room_price_lbl"></td>
            </tr>
          </tbody>
        </table>
        <br>
        <form id="form_proses" class="" action="<?=base_url()?>kar_cashier/insert" method="post">
          <input id="proses_room_id" type="hidden" name="room_id" value="">
          <input id="proses_tx_room_price" type="hidden" name="tx_room_price" value="">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label>Durasi (jam)</label>
                <input id="proses_tx_duration" class="form-control keyboard" type="number" name="tx_duration" value="" <?php if($keyboard == 1){echo 'onchange="calc()"';}else{echo 'oninput="calc()"';} ?> >
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label>Jumlah</label>
                <input id="proses_tx_room_price_total" class="form-control" type="text" name="tx_room_price_total" value="0" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Member</label>
            <select class="form-control keyboard select2" name="member_id">
              <?php foreach ($member as $row): ?>
                <option value="<?=$row->member_id?>"><?=$row->member_name?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-info btn-sm" type="button" name="button" onclick="addServiceCharge()"><i class="fa fa-plus"></i> Add Service Charge</button>
          <br><br>
          <input id="nServiceCharge" type="hidden" name="" value="0">
          <div id="service_charge_list">

          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit">Selesai</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#sidebar, #content').toggleClass('active');
    $('.collapse.in').toggleClass('in');
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');

    //get all room
    get_all_room();

    $('#room_type_id').on('change', function() {
      if (this.value == 0) {
        get_all_room();
      }else{
        get_room_by_type(this.value);
      }
    });

    $("#form_proses").validate({
      rules: {
        'tx_duration': {
          required: true
        }
      },
      messages: {
        'tx_duration': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        $.ajax({
          url: form.action,
          type: form.method,
          data: $(form).serialize(),
          success: function() {
            $("#modal_proses").modal('hide');
            get_all_room();
            $("#modal_success").modal('show');
          }
        });
      }
    });

    var printer = new Recta('17081945', '1811');

    $("#form_payment").validate({
      rules: {
        'tx_payment': {
          required: true
        }
      },
      messages: {
        'tx_payment': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        var tx_change = $("#payment_tx_change").val();
        if (tx_change < 0) {
          $("#payment_message").html('<i class="cl-danger">Pembayaran kurang!</i>');
          setTimeout(function(){
            $('#payment_message').html('');
          }, 1500);
        }else{
          $.ajax({
            url: form.action,
            type: form.method,
            dataType: 'json',
            data: $(form).serialize(),
            success: function(data) {
              console.log(data);
              $("#modal_payment").modal('hide');
              get_all_room();
              printer.open().then(function () {
                printer.mode('A', false, false, false, false)
                  printer.align('center');
                  printer.bold(true);
                  if (data.receipt.receipt_name == 1) {
                    printer.text(data.client.client_name);
                  }
                  printer.bold(false);
                  if (data.receipt.receipt_street == 1) {
                    printer.text(data.client.client_street);
                  }
                  if (data.receipt.receipt_district == 1) {
                    printer.text(data.client.client_district);
                  }
                  if (data.receipt.receipt_city == 1) {
                    printer.text(data.client.client_city);
                  }
                  if (data.receipt.receipt_province == 1) {
                    printer.text(data.client.client_province);
                  }
                  if (data.receipt.receipt_npwp == 1) {
                    printer.text('NPWP : '+data.client.client_npwp);
                  }
                  printer.bold(false);
                  printer.text('--------------------------------');
                  printer.bold(true);
                  printer.text('TXP-'+data.billing.tx_id+' '+data.billing.member_name);
                  printer.bold(false);
                  printer.text('--------------------------------');
                  printer.align('left');
                  printer.text('Room '+data.room_type.room_type_name+' '+data.room.room_code);
                  printer.align('right');
                  printer.text(data.billing.tx_duration+' x '+sys_to_ind(data.billing.tx_room_price)+' = '+sys_to_ind(data.billing.tx_room_price_total));
                if(data.service_charge != null || data.service_charge != ''){
                  $.each(data.service_charge, function(i, item) {
                    printer.align('left');
                    printer.text(data.service_charge[i].service_charge_name);
                    printer.align('right');
                    printer.text(data.service_charge[i].service_charge_amount+' x '+sys_to_ind(data.service_charge[i].service_charge_price)+' = '+sys_to_ind(data.service_charge[i].service_charge_total));
                  })
                }
                printer.text('--------------------------------');
                // get length
                var l_payment = data.billing.tx_payment.length;
                var l_change = data.billing.tx_change.length;
                var l_subtotal = data.billing.tx_total_before_tax.length;
                var l_discount = data.billing.tx_total_discount.length;
                var l_tax = data.billing.tx_total_tax.length;
                var l_total = data.billing.tx_total_grand.length;
                // inital space
                var s_subtotal = '';
                var s_discount = '';
                var s_tax = '';
                var s_total = '';
                var s_change = '';
                // set space
                for (var i = 0; i < (parseInt(l_payment)-parseInt(l_subtotal)); i++) {s_subtotal += ' ';};
                for (var i = 0; i < (parseInt(l_payment)-parseInt(l_discount)); i++) {s_discount += ' ';};
                for (var i = 0; i < (parseInt(l_payment)-parseInt(l_tax)); i++) {s_tax += ' ';};
                for (var i = 0; i < (parseInt(l_payment)-parseInt(l_total)); i++) {s_total += ' ';};
                for (var i = 0; i < (parseInt(l_payment)-parseInt(l_change)); i++) {s_change += ' ';};
                // printer.align('right').text('Subtotal = '+s_subtotal+sys_to_ind(data.billing.tx_total_before_tax));
                // printer.align('right').text('Diskon = '+s_discount+sys_to_ind(data.billing.tx_total_discount));
                // printer.align('right').text('Pajak = '+s_tax+sys_to_ind(data.billing.tx_total_tax));
                printer.align('right').text('Total = '+s_total+sys_to_ind(data.billing.tx_total_grand));
                printer.text('');
                printer.text('Bayar = '+sys_to_ind(data.billing.tx_payment));
                printer.text('Kembali = '+s_change+sys_to_ind(data.billing.tx_change));
                printer.text(data.client.client_footer);
                printer.cut().print();
              });
              $("#modal_success").modal('show');
            }
          });
        }
      }
    });
  })

  function payment(tx_id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>kar_cashier/payment',
      data : 'tx_id='+tx_id,
      dataType : 'json',
      success : function (data) {
        console.log(data);
        $("#payment_tx_id").val(data.tx_id);
        $("#payment_tx_total_grand").val(data.tx_total_grand);
        $("#modal_payment").modal('show');
      }
    })
  }

  function calc_change() {
    var tx_total_grand = $("#payment_tx_total_grand").val();
    var tx_payment = $("#payment_tx_payment").val();
    var tx_change = tx_payment-tx_total_grand;
    $("#payment_tx_change").val(tx_change);
  }

  function addServiceCharge() {
    var i = $("#nServiceCharge").val();
    var html = '<div id="service_charge_list_'+i+'" class="row">'+
      '<div class="col-md-6">'+
        '<div class="form-group">'+
          '<select class="form-control keyboard select2" name="service_charge_id[]">'+
            <?php foreach ($service_charge as $row): ?>
              '<option value="<?=$row->service_charge_id?>"><?=$row->service_charge_name?> (<?=num_to_idr($row->service_charge_price)?>)</option>'+
            <?php endforeach; ?>
          '</select>'+
        '</div>'+
      '</div>'+
      '<div class="col-md-4">'+
        '<div class="form-group">'+
          '<input class="form-control keyboard" type="number" name="service_charge_amount[]" value="0">'+
        '</div>'+
      '</div>'+
      '<div class="col-md-2">'+
        '<div class="form-group">'+
          '<button class="btn btn-danger" onclick="deleteServiceCharge('+i+')"><i class="fa fa-minus"></i></button>'+
        '</div>'+
      '</div>'+
    '</div>';
    $("#nServiceCharge").val(++i);
    $("#service_charge_list").append(html);
  }

  function deleteServiceCharge(id) {
    $("#service_charge_list_"+id).remove();
  }

  function calc() {
    var tx_duration = $("#proses_tx_duration").val();
    var tx_room_price = $("#proses_tx_room_price").val();
    var tx_total = tx_duration*tx_room_price;
    $("#proses_tx_room_price_total").val(tx_total);
  }

  //append table room
  function append_room(data) {
    $("#room-list").html('');
    $.each(data, function(i, room) {
      var status,cl,panel;
      if (room.tx_id == null) {
        receipt_no = '---';
        status_payment = 'Available';
        status_room = 'Available';
        cl = 'cl-info';
        panel = 'panel-info';
        button = '<button class="btn btn-info btn-block" onclick="proses('+room.room_id+')">Proses</button>';
      }else{
        receipt_no = room.tx_receipt_no;
        if (room.tx_status == 0) {
          status_payment = 'Payment Pending';
          status_room = 'Used';
          cl = 'cl-warning';
          panel = 'panel-warning';
          button = '<button class="btn btn-warning btn-block" onclick="payment('+room.tx_id+')">Bayar</button>';
        }else{
          status_payment = 'Payment Ok';
          status_room = 'Used';
          cl = 'cl-success';
          panel = 'panel-success';
          button = '<button class="btn btn-success btn-block" onclick="finish('+room.tx_id+')">Selesai</button>';
        }
      };
      var row;
      row = '<div class="col-md-3">'+
        '<div class="panel '+panel+'">'+
          '<div class="panel-heading text-center" style="text-transform:uppercase"><b>'+room.room_code+'</b></div>'+
          '<div class="panel-body">'+
            '<table>'+
              '<tbody>'+
                '<tr>'+
                  '<td width="120">No Kwitansi</td>'+
                  '<td width="10">:</td>'+
                  '<td>'+receipt_no+'</td>'+
                '</tr>'+
                '<tr>'+
                  '<td width="120">Tipe</td>'+
                  '<td width="10">:</td>'+
                  '<td>'+room.room_type_name+'</td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Status Room</td>'+
                  '<td>:</td>'+
                  '<td class="'+cl+'"><b>'+status_room+'</b></td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Status Payment</td>'+
                  '<td>:</td>'+
                  '<td class="'+cl+'"><b>'+status_payment+'</b></td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Mulai</td>'+
                  '<td>:</td>'+
                  '<td>'+room.tx_time_start+'</b></td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Akhir</td>'+
                  '<td>:</td>'+
                  '<td>'+room.tx_time_end+'</b></td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Member</td>'+
                  '<td>:</td>'+
                  '<td>'+room.member_name+'</b></td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Total</td>'+
                  '<td>:</td>'+
                  '<td>'+room.tx_total_grand+'</b></td>'+
                '</tr>'+
                '<tr>'+
                  '<td>Kasir</td>'+
                  '<td>:</td>'+
                  '<td>'+room.user_realname+'</b></td>'+
                '</tr>'+
              '</tbody>'+
            '</table>'+
          '</div>'+
          '<div class="panel-footer">'+
            button+
          '</div>'+
        '</div>'+
      '</div>';
      $("#room-list").append(row);
    })
  }
  //get all room
  function get_all_room() {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>kar_cashier/get_all_room',
      dataType : 'json',
      success : function (data) {
        console.log(data);
        append_room(data);
      }
    })
  }

  //get room by type
  function get_room_by_type(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>kar_cashier/get_room_by_type',
      data : 'room_type_id='+id,
      dataType : 'json',
      success : function (data) {
        console.log(data);
        append_room(data);
      }
    })
  }
  //proses modal
  function proses(id){
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>kar_cashier/get_room_by_id',
      data : 'room_id='+id,
      dataType : 'json',
      success : function (data) {
        console.log(data);
        var status,cl,panel;
        if (data.room_is_used == 0) {
          status = 'Available';
          cl = 'cl-success';
          panel = 'panel-success';
        }else{
          status = 'Occupied';
          cl = 'cl-danger';
          panel = 'panel-danger';
        };
        $("#proses_room_id").val(data.room_id);
        $("#proses_room_code").html(data.room_code);
        $("#proses_room_type_name").html(data.room_type_name);
        $("#proses_room_type_name").html(data.room_type_name);
        $("#proses_tx_room_price_lbl").html(data.room_price);
        $("#proses_tx_room_price").val(data.room_price);
        $("#proses_status").html(status);
        $("#modal_proses").modal('show');
      }
    })
  }

  function finish(id) {
    $("#finish_tx_id").val(id);
    $("#modal_finish").modal('show');
  }

  function finish_action() {
    var tx_id = $("#finish_tx_id").val();
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>kar_cashier/finish_action',
      data : 'tx_id='+tx_id,
      success : function () {
        get_all_room();
        $("#modal_finish").modal('hide');
      }
    })
  }
</script>
