<div class="content-header">
  <a class="btn btn-danger pull-right" href="<?=base_url()?>par_parking_out/shift/close">Tutup Shift</a>
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Form input kendaraan keluar.</div>
        <div class="panel-body">
          <form id="form" class="form" action="<?=base_url()?>par_parking_out/<?=$action?>" method="post">
            <div class="form-group">
              <label>Tanda Nomor Kendaraan Bermotor</label>
              <input id="billing_tnkb" class="form-control keyboard input-lg" style="text-transform: uppercase" type="text" name="billing_tnkb" value="" <?php if($keyboard == 1){echo 'onchange="get_billing()"';}else{echo 'oninput="get_billing()"';} ?> >
            </div>
            <div class="form-group">
              <label>No. Karcis</label>
              <input id="lbl_receipt_no" class="form-control" type="text" name="" value="" readonly>
              <input id="billing_id" type="hidden" name="billing_id" value="">
              <input id="receipt_no" type="hidden" name="receipt_no" value="">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kategori</label>
                  <input id="category_name" class="form-control" type="text" name="category_name" value="" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Merk</label>
                  <input id="brand_name" class="form-control" type="text" name="brand_name" value="" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Durasi</label>
                  <input id="billing_duration" class="form-control" type="text" name="billing_duration" value="" readonly>
                </div>
              </div>
              <input id="billing_date_out" type="hidden" name="billing_date_out" value="">
              <input id="billing_time_out" type="hidden" name="billing_time_out" value="">
              <div class="col-md-9">
                <div class="form-group">
                  <label>Biaya Parkir</label>
                  <input id="billing_total_grand" class="form-control" type="text" name="billing_total_grand" value="" readonly>
                  <input id="billing_subtotal" type="hidden" name="billing_subtotal" value="">
                  <input id="billing_tax" type="hidden" name="billing_tax" value="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Bayar</label>
                  <input id="billing_payment" class="form-control keyboard autonumeric" type="text" name="billing_payment" value="" onkeyup="calcChange()">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kembali</label>
                  <input id="billing_change" class="form-control" type="text" name="billing_change" value="" readonly>
                </div>
              </div>
            </div>
            <div class="pull-right">
              <button id="btn_save" class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
              <button id="btn_progress" class="btn btn-default disabled" type="button"><i class="fa fa-spinner fa-spin"></i> Proses...</button>
            </div>
          </form>
          <div id="message"></div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Data transaksi parkir keluar <?=day_name_ind(date('N'))?>, <?=date('d')?> <?=month_name_ind(date('m'))?> <?=date('Y')?></div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th class="text-center">Id</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">TNKB</th>
                      <th class="text-center">Merek</th>
                      <th class="text-center" width="150">Masuk</th>
                      <th class="text-center" width="150">Keluar</th>
                      <th class="text-center">Durasi</th>
                      <th class="text-center">Biaya</th>
                    </tr>
                  </thead>
                  <tbody id="get_list_out">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<div id="modal_success" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h3>Transaksi Berhasil</h3>
        <i class="fa fa-check fa-5x cl-success"></i>
        <h3 id="label_change"></h3>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-check"></i> Selesai</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#sidebar, #content').toggleClass('active');
    $('.collapse.in').toggleClass('in');
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    $("#btn_save").prop("disabled", true);

    //get list today
    $("#btn_progress").hide();
    get_list_out();

    $("#form").validate({
      rules: {
        'billing_tnkb': {
          required: true
        }
      },
      messages: {
        'billing_tnkb': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        var billing_total_grand = ind_to_sys($("#billing_total_grand").val());
        var billing_payment = ind_to_sys($("#billing_payment").val());
        var billing_change;
        billing_change = parseFloat(billing_payment) - parseFloat(billing_total_grand);
        console.log(billing_change);
        if (billing_payment == '') {
          $("#message").html('<i class="cl-danger">Isi pembayaran!</i>');
          setTimeout(function() {$('#message').html('');}, 1500);
        }else if (billing_change < 0) {
          $("#message").html('<i class="cl-danger">Pembayaran kurang!</i>');
          setTimeout(function() {$('#message').html('');}, 1500);
        }else{
          $("#billing_change").val(sys_to_ind(billing_change));
          $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            dataType: 'json',
            beforeSend: function() {
              $("#btn_save").hide();
              $("#btn_progress").show();
            },
            success: function(data) {
              $("#btn_save").prop("disabled", true);
              $("#billing_tnkb").val('');
              $("#billing_id").val('');
              $("#receipt_no").val('');
              $("#lbl_receipt_no").val('');
              $("#category_name").val('');
              $("#brand_name").val('');
              $("#billing_duration").val('');
              $("#billing_timestamp_out").val('');
              $("#billing_total_grand").val('');
              $("#billing_payment").val('');
              $("#billing_change").val('');
              $("#btn_save").show();
              $("#btn_progress").hide();
              $("#label_change").html('Kembalian = '+data.billing_change);
              $("#modal_success").modal('show');
              get_list_out();
              console.log(data);
              send_dashboard(data);
            }
          })
        }
      }
    });
  })

  function send_dashboard(data) {
    $.ajax({
      type : 'GET',
      url : 'http://addkomputer.com/prismapos/index.php/api/json/store',
      data : data,
      dataType : 'json',
      success : function (data) {
        console.log(data);
      },
      error: function(jqXHR, textStatus, errorThrown) { // if error occured
        console.log(jqXHR.status);
        console.log(errorThrown);
      }
    })
    // console.log(data);
  }

  function calcChange() {
    var billing_total_grand = ind_to_sys($("#billing_total_grand").val());
    var billing_payment = ind_to_sys($("#billing_payment").val());
    var billing_change;
    billing_change = parseFloat(billing_payment) - parseFloat(billing_total_grand);
    console.log(billing_change);
    if (billing_change < 0) {
      $("#message").html('<i class="cl-danger">Pembayaran kurang!</i>');
      setTimeout(function() {$('#message').html('');}, 1500);
      $("#btn_save").prop("disabled", true);
    }else{
      $("#btn_save").prop("disabled", false);
    };
    $("#billing_change").val(billing_change);
  }

  function get_list_out() {
    $.ajax({
      url : '<?=base_url()?>par_parking_out/get_list_out',
      type : 'post',
      dataType : 'json',
      success : function (data) {
        $("#get_list_out").html('');
        $.each(data, function(i, item) {
          var html = '<tr>'+
              '<td class="text-center">TXP-'+item.receipt_no+'</td>'+
              '<td>'+item.category_name+'</td>'+
              '<td class="text-center">'+item.billing_tnkb+'</td>'+
              '<td class="text-center">'+item.brand_name+'</td>'+
              '<td class="text-center">'+item.billing_date_in+' '+item.billing_time_in+'</td>'+
              '<td class="text-center">'+item.billing_date_out+' '+item.billing_time_out+'</td>'+
              '<td class="text-center">'+item.billing_duration+' jam</td>'+
              '<td class="text-center">'+item.billing_total_grand+'</td>'+
            '</tr>';
          $("#get_list_out").append(html);
        });
      }
    })
  }

  function get_billing() {
    var billing_tnkb = $("#billing_tnkb").val();
    $.ajax({
      url : '<?=base_url()?>par_parking_out/get_billing',
      type : 'post',
      data : 'billing_tnkb='+billing_tnkb,
      dataType : 'json',
      success : function (data) {
        $("#billing_id").val(data.billing_id);
        $("#receipt_no").val(data.receipt_no);
        $("#lbl_receipt_no").val('TXP-'+data.receipt_no);
        $("#category_name").val(data.category_name);
        $("#brand_name").val(data.brand_name);
        $("#billing_duration").val(data.billing_duration);
        $("#billing_date_out").val(data.billing_date_out);
        $("#billing_time_out").val(data.billing_time_out);
        $("#billing_subtotal").val(data.billing_subtotal);
        $("#billing_tax").val(data.billing_tax);
        $("#billing_total_grand").val(sys_to_ind(data.billing_total_grand));
        console.log(data);
      }
    })
  }

</script>
