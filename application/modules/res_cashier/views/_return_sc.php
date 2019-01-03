<script>
  function get_return_id(tx_id) {
    $("#modal_hold").modal('hide');
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/get_billing_now',
      data : 'tx_id='+tx_id,
      dataType : 'json',
      success : function (data) {
        $("#bill_tx_id").val(data.tx_id);
        $("#bill_tx_id_name").html('TXS-'+data.tx_receipt_no);
        $("#bill_customer_name").html(data.customer_name);
        $("#bill_customer_id").val(data.customer_id);
        $("#bill_tx_table_no").val(data.tx_table_no);
        $("#bill_tx_table_no_name").html(data.tx_table_no);
        $("#bill_tx_total_after_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_after_tax)));
        $("#bill_tx_total_before_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_before_tax)));
        $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
        $("#bill_tx_total_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_tax)));
        $("#bill_tx_total_tax").val(Math.round(data.tx_total_tax));
        $("#bill_tx_total_discount").val(Math.round(data.tx_total_discount));
        $("#bill_tx_total_discount_nominal").html(sys_to_ind(Math.round(data.tx_total_discount)));
        $("#bill_tx_total_discount").val(Math.round(data.tx_total_discount));
        $("#bill_tx_total_grand_nominal").html(sys_to_ind(Math.round(data.tx_total_grand)));
        $("#bill_tx_total_grand").val(Math.round(data.tx_total_grand));
        $("#bill-list").html('');
        $("#tx_total_discount").val(sys_to_ind(Math.round(data.tx_total_discount)));
        $("#tx_down_payment").val(sys_to_ind(Math.round(data.tx_down_payment)));
        $.each(data.detail, function(i, item) {
          if(data.detail[i].is_return == 0){
              var html = '<li onclick=edit_return_show('+data.detail[i].billing_detail_id+')>';
              var status = '';
            }else{
              var html = '<li style="background-color:gray !important; color:white !important;" onclick=delete_return_show('+data.detail[i].billing_detail_id+')>';
              var status = '(Retur) ';
          };
          html += '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
            '<div class="name">'+status+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_after_tax))+'</span></div>'+
            '<ul>'+
              '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_after_tax));

          if(data.detail[i].tx_subtotal_discount != 0){
            html += ' Disc ('+sys_to_ind(Math.round(data.detail[i].tx_subtotal_discount))+')</li>';
          }

          html +=
            '</ul>'+
          '</li>';

          $("#bill-list").append(html);
        })
        $("#buyget_section").html('');
        if(data.buyget != ''){
          $("#buyget_section").append('<div class="list-group"></div>');
          $("#buyget_section .list-group").append('<a class="list-group-item active">Anda berhak mendapatkan</a>');
          $.each(data.buyget, function(i, item) {
            var html = '<a class="list-group-item">'+
              '<span class="badge">'+data.buyget[i].get_amount+'</span>'+
              data.buyget[i].item_name+
              '</a>';
            $("#buyget_section .list-group").append(html);
          })
        }
        // disabled button
        $("#bill_btn_payment").prop('disabled', false);
        $("#bill_btn_pending").prop('disabled', false);
        $("#bill_btn_cancel").prop('disabled', false);
      }
    })
  }

  function return_show() {
    $("#modal_return").modal('show');
    $('#return_tx_receipt_no').val('');
  }

  function return_action() {
    var tx_receipt_no = $("#return_tx_receipt_no").val();
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/get_billing_by_receipt',
      data : 'tx_receipt_no='+tx_receipt_no,
      dataType : 'json',
      success : function (data) {
        if(data != null){
          var tx_id = data.tx_id;
          get_return_id(tx_id);
          $("#modal_return").modal('hide');
          $("#btn_payment_group").hide();
          $("#btn_return_group").show();
        }else{
          alert('No. Struk Salah!');
        }
      }
    })
  }

  function edit_return_show(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/edit_item_show',
      data : 'billing_detail_id='+id,
      dataType : 'json',
      success : function (data) {
        $("#edit_return_billing_detail_id").val(data.billing_detail_id);
        $("#edit_return_item_id").val(data.item_id);
        $("#edit_return_item_barcode").html(data.item_barcode);
        $("#edit_return_category_name").html(data.category_name);
        $("#edit_return_item_name").html(data.item_name);
        $("#edit_return_item_price_after_tax").html(sys_to_ind(data.item_price_after_tax));
        $("#edit_return_unit_code").html(data.unit_code);
        $("#edit_return_buy_amount").html(data.tx_amount);
        $("#edit_return_tx_amount").val(1);
        $("#modal_edit_return").modal('show');
      }
    });
  }

  function edit_return_item_action() {
    var tx_buy = $("#edit_return_buy_amount").html();
    var tx_amount = $("#edit_return_tx_amount").val();
    var id = $("#edit_return_billing_detail_id").val();

    if(parseFloat(tx_amount) > parseFloat(tx_buy)){
      alert('Jumlah retur tidak boleh lebih dari jumlah beli!');
    }else{
      $.ajax({
        type : 'post',
        url : '<?=base_url()?>res_cashier/edit_return_item_action',
        data : 'billing_detail_id='+id+'&tx_amount='+tx_amount,
        dataType : 'json',
        success : function (data) {
          get_return_id(data.tx_id);
          $("#modal_edit_return").modal('hide');
        }
      });
    }
  }

  function delete_return_show(id) {
    $("#delete_return_billing_detail_id").val(id);
    $("#modal_delete_return").modal('show');
  }

  function delete_return_item_action() {
    var id = $("#delete_return_billing_detail_id").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/delete_return_item_action',
      data : 'billing_detail_id='+id,
      dataType : 'json',
      success : function (data) {
        get_return_id(data.tx_id);
        $("#modal_delete_return").modal('hide');
      }
    });
  }

  //increment amount
  $("#return_btn_increment").click(function () {
    var tx_amount = $("#edit_return_tx_amount").val();
    $("#edit_return_tx_amount").val(++tx_amount);
  })
  //decrement amount
  $("#return_btn_decrement").click(function () {
    var tx_amount = $("#edit_return_tx_amount").val();
    if(tx_amount > 1){
      $("#edit_return_tx_amount").val(--tx_amount);
    }
  })
</script>