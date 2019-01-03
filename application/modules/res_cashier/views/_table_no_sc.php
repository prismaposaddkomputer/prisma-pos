<script>
  //tx_table_no
  function change_tx_table_no() {
    var tx_id = $("#bill_tx_id").val();
    var tx_tx_table_no = $("#bill_tx_table_no").val();
    $("#modal_tx_table_no").modal('show');
  }

  function change_tx_table_no_action() {
    var tx_id = $("#bill_tx_id").val();
    var tx_table_no = $("#edit_tx_table_no").val();

    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/change_tx_table_no_action',
      data : 'tx_id='+tx_id+'&tx_table_no='+tx_table_no,
      success : function () {
        get_billing_now();
        $("#modal_tx_table_no").modal('hide');
      }
    })
  }
</script>