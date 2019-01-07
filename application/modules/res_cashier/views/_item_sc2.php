<script>
  //append table item
  function append_item(data) {
    $("#item-row").html('');
    $.each(data, function(i, item) {
      var row;
      row = '<div onclick="add_item_show('+item.item_id+')" class="col-md-2">'+
        '<div class="card">'+
          '<img src="<?=base_url()?>img/res_item/'+item.item_logo+'" alt="Food" width="100%" height="100">'+
          '<div class="container-card" style="border-top:1px solid #eee">'+
            '<div class="lbl-item_name">'+item.item_name+'</div>'+
            '<div class="lbl-item_category">'+item.category_name+'</div>'+
            '<div>'+
              '<span class="lbl-item_barcode">['+item.item_barcode+']</span>'+
              <?php if($client->client_is_taxed == 0): ?>
              '<span class="lbl-item_price_after_tax text-left pull-right">'+sys_to_ind(Math.round(item.item_price_before_tax))+'</span>'+
              <?php else: ?>
              '<span class="lbl-item_price_after_tax text-left pull-right">'+sys_to_ind(Math.round(item.item_price_after_tax))+'</span>'+
              <?php endif; ?>
            '</div>'+
          '</div>'+
        '</div>'+
     ' </div>';
      $("#item-row").append(row);
    })
  }
  //get all item
  function get_all_item() {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/get_all_item',
      dataType : 'json',
      success : function (data) {
        append_item(data);
      }
    })
  }
  //get item by category
  function get_item_by_category(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/get_item_by_category',
      data : 'category_id='+id,
      dataType : 'json',
      success : function (data) {
        append_item(data);
      }
    })
  }
  //get_item_search
  function get_item_search() {
    var search_term = $("#search_term").val();
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/get_item_search',
      data : 'search_term='+search_term,
      dataType : 'json',
      success : function (data) {
        append_item(data);
      }
    })
  }
  //add item show
  function add_item_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/add_item_show',
      data : 'item_id='+id,
      dataType : 'json',
      success : function (data) {
        $("#add_item_id").val(data.item_id);
        $("#add_item_name").html(data.item_name);
        $("#add_item_barcode").html(data.item_barcode);
        <?php if($client->client_is_taxed == 0):?>
        $("#add_item_price_after_tax").val(sys_to_ind(Math.round(data.item_price_before_tax)));
        <?php else:?>
        $("#add_item_price_after_tax").val(sys_to_ind(Math.round(data.item_price_after_tax)));
        <?php endif; ?>
        $("#add_category_name").html(data.category_name);
        $("#add_unit_code").html(data.unit_code);
        $("#modal_add_item").modal('show');
        $("#modal_search").modal('hide');
        $("#add_tx_amount").val(1);
      }
    })
  }
  //add item action
  function add_item_action() {
    var tx_id = $("#bill_tx_id").val();
    var tx_receipt_no = $("#bill_tx_receipt_no").val();
    var customer_id = $("#bill_customer_id").val();
    var tx_date = $("#bill_tx_date").val();
    var tx_time = $("#bill_tx_time").val();
    var item_id = $("#add_item_id").val();
    var tx_amount = $("#add_tx_amount").val();
    var item_price = $("#add_item_price_after_tax").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/add_item_action',
      data : 'tx_id='+tx_id+'&tx_receipt_no='+tx_receipt_no+'&customer_id='+customer_id+'&tx_date='+tx_date+
        '&tx_time='+tx_time+'&item_id='+item_id+'&tx_amount='+tx_amount+'&item_price='+item_price,
      success : function (data) {
        get_billing_now();
        $("#modal_add_item").modal('hide');
        // enable button
        $("#bill_btn_payment").prop('disabled', false);
        $("#bill_btn_pending").prop('disabled', false);
        $("#bill_btn_cancel").prop('disabled', false);
      }
    })
  }

  //edit item show
  function edit_item_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/edit_item_show',
      data : 'billing_detail_id='+id,
      dataType : 'json',
      success : function (data) {
        $("#edit_billing_detail_id").val(data.billing_detail_id);
        $("#edit_item_id").val(data.item_id);
        $("#edit_item_name").html(data.item_name);
        $("#edit_item_barcode").html(data.item_barcode);
        $("#edit_item_price_after_tax").val(sys_to_ind(data.item_price_after_tax));
        $("#edit_category_name").html(data.category_name);
        $("#edit_unit_code").html(data.unit_code);
        $("#edit_tx_amount").val(data.tx_amount);
        $("#modal_edit_item").modal('show');
      }
    })
  }

  function edit_item_action()
  {
    var tx_id = $("#bill_tx_id").val();
    var item_id = $("#edit_item_id").val();
    var tx_amount = $("#edit_tx_amount").val();
    var billing_detail_id = $("#edit_billing_detail_id").val();
    var item_price = $("#edit_item_price_after_tax").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/edit_item_action',
      data : 'tx_id='+tx_id+'&item_id='+item_id+'&tx_amount='+tx_amount+
        '&billing_detail_id='+billing_detail_id+'&item_price='+item_price,
      success : function () {
        $("#modal_edit_item").modal('hide');
        get_billing_now();
      }
    })
  }

  function delete_item_action()
  {
    var tx_id = $("#bill_tx_id").val();
    var billing_detail_id = $("#edit_billing_detail_id").val();
    var item_id = $("#edit_item_id").val();
    var customer_id = $("#bill_customer_id").val();
    var tx_date = $("#bill_tx_date").val();
    var tx_time = $("#bill_tx_time").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/delete_item_action',
      data : 'tx_id='+tx_id+'&billing_detail_id='+billing_detail_id+"&item_id="+item_id+
              '&customer_id='+customer_id+'&tx_date='+tx_date+'&tx_time='+tx_time,
      success : function () {
        $("#modal_edit_item").modal('hide');
        get_billing_now();
      }
    })
  }

  //increment amount
  $("#add_btn_increment").click(function () {
    var tx_amount = $("#add_tx_amount").val();
    $("#add_tx_amount").val(++tx_amount);
  })
  //decrement amount
  $("#add_btn_decrement").click(function () {
    var tx_amount = $("#add_tx_amount").val();
    if(tx_amount > 1){
      $("#add_tx_amount").val(--tx_amount);
    }
  })
  //increment amount
  $("#edit_btn_increment").click(function () {
    var tx_amount = $("#edit_tx_amount").val();
    $("#edit_tx_amount").val(++tx_amount);
  })
  //decrement amount
  $("#edit_btn_decrement").click(function () {
    var tx_amount = $("#edit_tx_amount").val();
    if(tx_amount > 1){
      $("#edit_tx_amount").val(--tx_amount);
    }
  })
</script>