<script>
  // payment show
  function payment_show() {
    var tx_id = $("#bill_tx_id").val();
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/get_billing_now',
      data : 'tx_id='+tx_id,
      dataType : 'json',
      success : function (data) {
        $("#payment_tx_total_grand").val(sys_to_ind(Math.round(data.tx_total_grand)));
        $("#payment_down_payment").val(sys_to_ind(Math.round(data.tx_down_payment)));
        $("#payment_nominal").val(sys_to_ind(Math.round(data.tx_total_grand-data.tx_down_payment)));
        $("#change_section").hide();
        $("#payment_section").show();
        $("#payment_card_bank_card_no").val('');
        $("#payment_card_bank_reference_no").val('');
        $("#payment_tx_payment").val('');
        $("#payment_tx_change").val('');
        $("#modal_payment").modal('show');
      }
    });
  }

  function calc_change() {
    var payment_nominal = ind_to_sys($("#payment_nominal").val());
    var tx_payment = ind_to_sys($("#payment_tx_payment").val());
    var tx_change = parseFloat(ind_to_sys(tx_payment)) - parseFloat(payment_nominal);

    if (tx_change >= 0) {
      $("#payment_tx_change").val(sys_to_ind(Math.round(tx_change)));
    }else{
      $("#payment_tx_change").val('NaN');
    }
  }

  function payment_cash_action() {
    var tx_id = $("#bill_tx_id").val();
    var payment_nominal = ind_to_sys($("#payment_nominal").val());
    var tx_payment = ind_to_sys($("#payment_tx_payment").val());
    var tx_change = parseFloat(ind_to_sys(tx_payment)) - parseFloat(payment_nominal);

    if (tx_payment == '') {
      $("#payment_cash_status").html('<i class="cl-danger">Silakan isi nominal !</i>');
      setTimeout(function(){
        $('#payment_cash_status').html('');
      }, 1500);
    }else if(tx_change < 0){
      $("#payment_cash_status").html('<i class="cl-danger">Pembayaran kurang !</i>');
      setTimeout(function(){
        $('#payment_cash_status').html('');
      }, 1500);
    }else{
      $.ajax({
        type : 'post',
        url : '<?=base_url()?>res_cashier/payment_cash_action',
        data : 'tx_id='+tx_id+'&tx_payment='+tx_payment,
        dataType : 'json',
        success : function (data) {
          new_billing();
          $("#payment_section").hide();
          $("#change_section").show();
          $("#bill_tx_total_before_tax_nominal").html('');
          printBill();
          $("#change_label").html('<h5>Kembalian</h5><h3>'+sys_to_cur(Math.round(tx_change))+'</h3>');
          send_dashboard(data);
        }
      })
    }
  }

  function payment_card_action() {
    var tx_id = $("#bill_tx_id").val();
    var payment_nominal = ind_to_sys($("#payment_nominal").val());
    var tx_payment = payment_nominal;
    var tx_change = 0;
    var bank_id = $("#payment_card_bank_id").val();
    var bank_card_no = $("#payment_card_bank_card_no").val();
    var bank_reference_no = $("#payment_card_bank_reference_no").val();

    if (bank_card_no == '') {
      $("#payment_card_status").html('<i class="cl-danger">Silakan isi no kartu !</i>');
      setTimeout(function(){
        $('#payment_card_status').html('');
      }, 1500);
    }else{
      $.ajax({
        type : 'post',
        url : '<?=base_url()?>res_cashier/payment_card_action',
        dataType : 'json',
        data : 'tx_id='+tx_id+'&bank_id='+bank_id+
          '&bank_card_no='+bank_card_no+'&bank_reference_no='+bank_reference_no+
          '&tx_payment='+tx_payment+'&tx_change='+tx_change,
        success : function (data) {
          printBill();
          new_billing();
          send_dashboard(data);
          $("#modal_payment").modal('hide');
        }
      })
    }
  }
</script>