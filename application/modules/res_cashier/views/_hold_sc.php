<script>
  function appendHoldBilling(data) {
    $("#hold_list").html('');
    $.each(data, function(i, item) {
      var row = '<tr>'+
        '<td>TXS-'+item.tx_receipt_no+'</td>'+
        '<td>'+item.customer_name+'</td>'+
        '<td class="text-center">'+item.tx_date+'</td>'+
        '<td class="text-center">'+item.tx_time+'</td>'+
        '<td class="text-center">'+
          '<a class="btn btn-xs btn-success" onclick="get_billing_id('+item.tx_id+')"><i class="fa fa-refresh"></i></a>'
        '</td>'+
      '</tr>';
      $("#hold_list").append(row);
    })
  }

  function getHoldBilling() {
    $.ajax({
      type: 'post',
      url: '<?=base_url()?>res_cashier/get_hold_billing',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        appendHoldBilling(data);
        $("#modal_hold").modal('show');
      }
    })
  }
</script>