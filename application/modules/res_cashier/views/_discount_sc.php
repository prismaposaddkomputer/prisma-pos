<script>
  //discount
  function discount_show() {
    $("#modal_discount").modal('show');
    var tx_id = $("#bill_tx_id").val();
    get_billing_id(tx_id);
  }

  function edit_discount() {
    var tx_id = $("#bill_tx_id").val();
    var tx_total_discount = $("#tx_total_discount").val();
    
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/update_discount_action',
      data : 'tx_id='+tx_id+'&tx_total_discount='+tx_total_discount,
      success : function () {
        get_billing_now();
        $("#modal_discount").modal('hide');
      }
    })
  }
</script>