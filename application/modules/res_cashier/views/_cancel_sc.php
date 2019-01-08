<script>
  //cancel show
  function cancel_show() {
    $("#modal_cancel").modal('show');
    $("#cancel_tx_cancel_notes").val('');
  }

  function cancel_action() {
    var tx_id = $("#bill_tx_id").val();
    var tx_cancel_notes = $("#cancel_tx_cancel_notes").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/cancel_action',
      data : 'tx_id='+tx_id+'&tx_cancel_notes='+tx_cancel_notes,
      success : function () {
        new_billing();
        $("#modal_cancel").modal('hide');
      }
    })
  }
</script>