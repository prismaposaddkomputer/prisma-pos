<script>
  function printBill() {
    var tx_id = $("#bill_tx_id").val();
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/print_bill',
      data : 'tx_id='+tx_id,
      success : function () {

      } 
    })
  }

  function printReturn() {
    var tx_id = $("#bill_tx_id").val();
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/print_return',
      data : 'tx_id='+tx_id,
      success : function () {
        new_billing();
      } 
    })
  }

  function printLast() {
    var tx_id = $("#bill_tx_id").val()-1;
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/print_bill',
      data : 'tx_id='+tx_id,
      success : function () {

      }
    })
  }

  function print_dapur() {
    var tx_id = $("#bill_tx_id").val();
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/print_dapur',
      data : 'tx_id='+tx_id,
      success : function () {

      }
    })
  }
  
  // print receipt
  function print_receipt_show() {
    $('#print_receipt_no').val('');
    $('#modal_print_receipt').modal('show');
  }

  function print_receipt_action() {
    var tx_receipt_no = $("#print_receipt_no").val();

    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/get_billing_by_receipt',
      data : 'tx_receipt_no='+tx_receipt_no,
      dataType : 'json',
      success : function (data) {
        if(data != null){
          var tx_id = data.tx_id;
          $.ajax({
            type: 'post',
            url : '<?=base_url()?>res_cashier/print_bill',
            data : 'tx_id='+tx_id,
            success : function () {
              $("#modal_print_receipt").modal('hide');
            }
          })
        }else{
          alert('No. Struk Salah!');
        }
      }
    })
  }

  function print_receipt_dp() {
    down_payment_action();

    var tx_id = $("#bill_tx_id").val();
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/print_receipt_dp',
      data : 'tx_id='+tx_id,
      success : function (data) {
        
      }
    })
  }

</script>