<div class="content-header">
  <a class="btn btn-danger pull-right" href="<?=base_url()?>par_parking_in/shift/close">Tutup Shift</a>
  <h4><i class="fa fa-<?=$access->module_icon?>"></i> <?=$title?></h4>
</div>
<div class="content-body">
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Form input kendaraan masuk.</div>
        <div class="panel-body">
          <form id="form" class="form" action="<?=base_url()?>par_parking_in/<?=$action?>" method="post">
            <div class="form-group">
              <label>No Karcis</label>
              <input id="lbl_receipt_no" class="form-control" type="text" name="" value="" readonly>
              <input id="billing_id" type="hidden" name="billing_id" value="">
              <input id="receipt_no" type="hidden" name="receipt_no" value="">
            </div>
            <div class="form-group">
              <label>Kategori Kendaraan</label>
              <select id="category_id" class="form-control keyboard select2" name="category_id">
                <?php foreach ($category as $row): ?>
                  <option value="<?=$row->category_id?>"><?=$row->category_name?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Merek Kendaraan</label>
              <select id="brand_id" class="form-control keyboard select2" name="brand_id">
                <?php foreach ($brand as $row): ?>
                  <option value="<?=$row->brand_id?>"><?=$row->brand_name?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Tanda Nomor Kendaraan Bermotor</label>
              <input id="billing_tnkb" class="form-control keyboard input-lg" style="text-transform:uppercase" type="text" name="billing_tnkb" value="">
            </div>
            <div class="pull-right">
              <button id="btn_save" class="btn btn-info" type="submit"><i class="fa fa-save"></i> Simpan</button>
              <button id="btn_progress" class="btn btn-info disabled" type="button"><i class="fa fa-spinner fa-spin"></i> Proses...</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Data transaksi parkir masuk <?=day_name_ind(date('N'))?>, <?=date('d')?> <?=month_name_ind(date('m'))?> <?=date('Y')?></div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                  <thead>
                    <tr>
                      <th class="text-center" width="150">Id</th>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Merek</th>
                      <th class="text-center">TNKB</th>
                      <th class="text-center" width="150">Masuk</th>
                    </tr>
                  </thead>
                  <tbody id="get_list_in">

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

    //get list today
    new_billing();
    get_list_in();

    var printer = new Recta('17081945', '1811');

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
            printBill(data.billing_id);
            console.log(data);
            $("#modal_success").modal('show');
            get_list_in();
            new_billing();
          }
        });
      }
    });
    new_billing();
  })

  function printBill(billing_id) {
    $.ajax({
      url : '<?=base_url()?>par_parking_in/print_bill',
      type : 'post',
      data : 'billing_id='+billing_id,
      success : function () {

      }
    });
  }

  function get_list_in() {
    $.ajax({
      url : '<?=base_url()?>par_parking_in/get_list_in',
      type : 'post',
      dataType : 'json',
      success : function (data) {
        $("#get_list_in").html('');
        $.each(data, function(i, item) {
          var html = '<tr>'+
              '<td class="text-center">TXP-'+item.receipt_no+'</td>'+
              '<td>'+item.category_name+'</td>'+
              '<td class="text-center">'+item.brand_name+'</td>'+
              '<td class="text-center">'+item.billing_tnkb+'</td>'+
              '<td class="text-center">'+item.billing_date_in+' '+item.billing_time_in+'</td>'+
            '</tr>';
          $("#get_list_in").append(html);
        });
      }
    })
  }

  function new_billing() {
    $.ajax({
      url : '<?=base_url()?>par_parking_in/new_billing',
      type : 'post',
      dataType : 'json',
      success : function (data) {
        $("#billing_id").val(data.billing_id);
        $("#receipt_no").val(data.receipt_no);
        $("#lbl_receipt_no").val(data.lbl_receipt_no);
        $("#btn_save").show();
        $("#btn_progress").hide();
        $("#billing_tnkb").val('');
      }
    })
  }
</script>
