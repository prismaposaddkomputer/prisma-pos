<script>
  function add_custom_show() {
    $("#add_custom_name").val('');
    // $("#add_custom_price").val('0');
    // $("#add_custom_amount").val('1');
    $('#modal_add_custom').modal('show');
  }

  function add_custom_action() {
    var tx_id = $("#bill_tx_id").val();
    var tx_receipt_no = $("#bill_tx_receipt_no").val();
    var customer_id = $("#bill_customer_id").val();
    var tx_date = $("#bill_tx_date").val();
    var tx_time = $("#bill_tx_time").val();
    var item_name = $("#add_custom_name").val();
    var item_price = $("#add_custom_price").val();
    var tx_amount = $("#add_custom_amount").val();

    if(item_name == '' || item_price == 0){
      alert('Isi semua data');
    }else{
      $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/add_custom_action',
      data : 'tx_id='+tx_id+'&tx_receipt_no='+tx_receipt_no+'&customer_id='+customer_id+'&tx_date='+tx_date+
        '&tx_time='+tx_time+'&item_name='+item_name+'&tx_amount='+tx_amount+'&item_price='+item_price,
      success : function (data) {
        get_billing_now();
        $("#modal_add_custom").modal('hide');
        // enable button
        $("#bill_btn_payment").prop('disabled', false);
        $("#bill_btn_pending").prop('disabled', false);
        $("#bill_btn_cancel").prop('disabled', false);
      }
    })
    }
  }

  function edit_custom_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/edit_custom_show',
      data : 'billing_detail_id='+id,
      dataType : 'json',
      success : function (data) {
        console.log(data);
        $("#edit_billing_detail_id").val(data.billing_detail_id);
        $("#edit_custom_name").val(data.item_name);
        <?php if($client->client_is_taxed == 0): ?>
          $("#edit_custom_price").val(sys_to_ind(data.item_price_before_tax));
        <?php else:?>
          $("#edit_custom_price").val(sys_to_ind(data.item_price_after_tax));
        <?php endif;?>
        $("#edit_custom_amount").val(data.tx_amount);
        $("#modal_edit_custom").modal('show');
      }
    })
  }
  
  function edit_custom_action(){
    var tx_id = $("#bill_tx_id").val();
    var billing_detail_id = $("#edit_billing_detail_id").val();
    var edit_custom_name = $("#edit_custom_name").val();
    var edit_custom_price = $("#edit_custom_price").val();
    var edit_custom_amount = $("#edit_custom_amount").val();
    var customer_id = $("#bill_customer_id").val();
    var tx_date = $("#bill_tx_date").val();
    var tx_time = $("#bill_tx_time").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/edit_custom_action',
      data : 'tx_id='+tx_id+'&billing_detail_id='+billing_detail_id+
            '&item_name='+edit_custom_name+'&item_price='+edit_custom_price+
            '&tx_amount='+edit_custom_amount+'&customer_id='+customer_id+
            '&tx_date='+tx_date+'&tx_time='+tx_time,
      success : function () {
        $("#modal_edit_custom").modal('hide');
        get_billing_now();
      }
    })
  }

  function delete_custom_action(){
    var tx_id = $("#bill_tx_id").val();
    var billing_detail_id = $("#edit_billing_detail_id").val();
    var edit_custom_name = $("#edit_custom_name").val();
    var edit_custom_price = $("#edit_custom_price").val();
    var edit_custom_amount = $("#edit_custom_amount").val();
    var customer_id = $("#bill_customer_id").val();
    var tx_date = $("#bill_tx_date").val();
    var tx_time = $("#bill_tx_time").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/delete_custom_action',
      data : 'tx_id='+tx_id+'&billing_detail_id='+billing_detail_id+
            '&item_name='+edit_custom_name+'&item_price='+edit_custom_price+
            '&tx_amount='+edit_custom_amount+'&customer_id='+customer_id+
            '&tx_date='+tx_date+'&tx_time='+tx_time,
      success : function () {
        $("#modal_edit_custom").modal('hide');
        get_billing_now();
      }
    })
  }
</script>