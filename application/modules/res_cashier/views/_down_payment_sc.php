<script>
  // down payment
  function down_payment_show() {
    $("#modal_down_payment").modal('show');
  }

  function down_payment_action() {
    var tx_id = $("#bill_tx_id").val();
    var tx_down_payment = $("#tx_down_payment").val();
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/down_payment_action',
      data : 'tx_id='+tx_id+'&tx_down_payment='+tx_down_payment,
      success : function () {
        get_billing_now();
        alert('Sukses');
        //$("#modal_down_payment").modal('hide');
      }
    })
  }
</script>