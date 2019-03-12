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
    var tx_discount_type = $("#tx_discount_type").val();
    var tx_discount_percent = $("#tx_discount_percent").val();
    var total = $('#bill_tx_total_after_tax').val();

    if(tx_discount_type == 0){
      tx_discount_percent = (ind_to_sys(tx_total_discount)/total)*100;
      console.log(tx_discount_percent);
    }else{
      tx_discount_percent = ind_to_sys(tx_discount_percent);
    }

    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/update_discount_action',
      data : 'tx_id='+tx_id+'&tx_total_discount='+tx_total_discount
        +'&tx_discount_type='+tx_discount_type+'&tx_discount_percent='+tx_discount_percent,
      success : function () {
        get_billing_now();
        $("#modal_discount").modal('hide');
      }
    })
  }

  function calc_percent_discount() {
    //subtotal+pajak
    var total = $('#bill_tx_total_after_tax').val();
    var percent = $('#tx_discount_percent').val();
    var nominal = ind_to_sys(percent)*total/100;
    $('#tx_total_discount').val(sys_to_ind(nominal));
  }

  $(document).ready(function () {
    $('.discount_percent').hide();

    $('#tx_discount_type').on('change', function() {
      var data = $("#tx_discount_type option:selected").val();
      if (data == 1) {
        $('.discount_percent').show();
        $('#tx_total_discount').attr('readonly', true);
      }else{
        $('.discount_percent').hide();
        $('#tx_total_discount').attr('readonly', false);
      }
    })
  })
</script>