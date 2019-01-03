<script>
  //pending show
  function pending_show() {
    $("#modal_pending").modal('show');
  }
  function pending_action() {
    var tx_id = $("#bill_tx_id").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/pending_action',
      data : 'tx_id='+tx_id,
      success : function () {
        new_billing();
        $("#btn_payment_group").show();
        $("#btn_return_group").hide();
        $("#modal_pending").modal('hide');
      }
    })
  }
  function search_pending_action() {
    var search_pending = $("#search_pending").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/search_pending_action',
      data : 'search_pending='+search_pending,
      dataType : 'json',
      success : function (data) {
        appendHoldBilling(data)
      }
    })
  }
</script>