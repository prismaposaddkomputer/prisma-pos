<script>
  $(document).ready(function () {
    $("#item-list").slimscroll({
      height: '100%'
    }).parent().css({
      'height' : 'calc(100% - 85px)'
    });
    $("#category-list").slimscroll({
      height: '100%'
    }).parent().css({
      'height' : '100%'
    });
    $("#bill-items").slimscroll({
      height: '100%'
    }).parent().css({
      'height' : 'calc(100% - (187px + 75px))'
    });

    //call new billing for first
    new_billing();
    //call get_all_item for first
    get_all_item();

    //change customer
    $("#customer_btn_choose").click(function () {
      $("#bill_customer_id").val($("#customer_list option:selected").val());
      $("#bill_customer_name").html($("#customer_list option:selected").html());
      $("#modal_customer").modal('hide');
      var tx_id = $("#bill_tx_id").val();
      var customer_id = $("#customer_list option:selected").val();
      var customer_name = $("#customer_list option:selected").html();
      $.ajax({
        type : 'post',
        url : '<?=base_url()?>res_cashier/change_customer',
        data : 'tx_id='+tx_id+'&customer_id='+customer_id+'&customer_name='+customer_name,
        dataType : 'json',
        success : function (data) {
          
        }
      })
    })

    $("#form_add_customer").validate({
      rules: {
        'customer_id': {
          required: true
        },
        'customer_name': {
          required: true
        },
        'customer_phone': {
          required: true
        }
      },
      messages: {
        'customer_id': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'customer_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'customer_phone': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        $.ajax({
          url: form.action,
          type: form.method,
          data: $(form).serialize(),
          dataType: 'json',
          success: function(data) {
            $("#modal_add_customer").modal('hide');
            get_customer();
            //change customer
            $("#bill_customer_id").val(data.customer_id);
            $("#bill_customer_name").html(data.customer_name);
          }
        });
      }
    });

    $('#customer_list').on('change', function() {
      $.ajax({
        type: 'post',
        url: '<?=base_url()?>res_cashier/get_detail_customer',
        data: 'customer_id='+this.value,
        dataType: 'json',
        success: function(data) {
          $("#lbl_customer_name").val(data.customer_name);
          $("#lbl_customer_phone").val(data.customer_phone);
          $("#lbl_customer_email").val(data.customer_email);
          $("#lbl_customer_address").val(data.customer_address);
        }
      })
    });

    $('#payment_tx_payment').keypress(function (e) {
      if (e.which == 13) {
        payment_cash_action();
        return false;
      }
    });
  });
</script>