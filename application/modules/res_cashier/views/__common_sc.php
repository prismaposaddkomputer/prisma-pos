<?php
  $dashboard_base_url = 'http://182.253.114.52/dashboard_pos/index.php/api/json/ping?auth=prismapos.addkomputer&apikey=69f86eadd81650164619f585bb017316';
  $dashboard_base_url.= '&app_type_id='.$install['type_id'];
  $dashboard_base_url.= '&client_id='.$client->client_id;
  $dashboard_base_url.= '&name='.$client->client_name;
  $dashboard_base_url.= '&pos_sn='.$client->client_serial_number;
  $dashboard_base_url.= '&npwpd='.$client->client_npwpd;
?>
<script>
  $.ajaxSetup({
    async: true
  });
  $(document).ready(function() {
    function _ping() {
					$.ajax({
						type : 'get',
						url : '<?=$dashboard_base_url?>',
						dataType : 'json',
						// async : false,
						success : function (data) {
              if (data.resp_desc == 'success') {
                $("#status_info").html('Online');
                $("#status_info").removeClass('label-danger').addClass('label-success');
              }
						},
						error: function(jqXHR, exception) { // if error occured
							if (jqXHR.status === 0) {
								$("#status_info").html('Not connect.\n Verify Network.');
							} else if (jqXHR.status == 404) {
								$("#status_info").html('Requested page not found. [404]');
							} else if (jqXHR.status == 500) {
								$("#status_info").html('Internal Server Error [500].');
							} else if (exception === 'parsererror') {
								$("#status_info").html('Requested JSON parse failed.');
							} else if (exception === 'timeout') {
								$("#status_info").html('Time out error.');
							} else if (exception === 'abort') {
								$("#status_info").html('Ajax request aborted.');
							} else {
								$("#status_info").html('Uncaught Error.\n' + jqXHR.responseText);
              }
              $("#status_info").removeClass('label-success').addClass('label-danger');
							//$("#status_ping").html("Error occured.please try again");
							// $(placeholder).append(xhr.statusText + xhr.responseText);
							// $(placeholder).removeClass('loading');
							// $("#status_ping").html(xhr.responseText);
							// alert(xhr.responseText);
						}
					})
					// return $.getJSON('<?php echo $dashboard_base_url?>');
				}
    function send_dashboard(data) {
      $.ajax({
        type : 'GET',
        // url : 'http://addkomputer.com/prismapos/index.php/api/json/store',
        url : 'http://182.253.114.52/dashboard_pos/index.php/api/json/store',
        data : data,
        dataType : 'json',
        success : function (data) {
          if(data.resp_code == '00'){
            update_data(data.tx_id);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) { // if error occured
          // $("#status_ping").html(jqXHR.status);
          console.log(jqXHR.status);
          console.log(errorThrown);
        }
      })
      // console.log(data);
    }
    function get_data() {
      $.ajax({
        type : 'post',
        url : '<?=base_url();?>data_trx.php',
        dataType : 'json',
        success : function (data) {
          if(data != null || data != ''){
            send_dashboard(data);
          }
        }
      })
    }
    function update_data(id) {
      $.ajax({
        type : 'post',
        url : '<?=base_url();?>update_data.php',
        data : 'id='+id,
        dataType : 'json',
        success : function (data) {
          console.log('ok');
        }
      })
    }
    // get_data();
    // _ping();
    var auto_ping = setInterval(function () {
      _ping();
      get_data();
    }, 30000); // miliseconds -> 60sec

    //get data
    
  });
</script>
<script>
  //new biling
  function new_billing() {
    get_customer();
    appendHoldBilling();  
    $.ajax({
      type: 'post',
      url: '<?=base_url()?>res_cashier/new_billing',
      dataType: 'json',
      success: function (data) {
        // first customer
        $("#bill_customer_id").val(data.customer.customer_id);
        $("#bill_customer_name").html(data.customer.customer_name);
        // cashier
        $("#bill_cashier_id").val(data.cashier.cashier_id);
        $("#bill_cashier_name").html(data.cashier.cashier_name);
        // Bill
        $("#bill_tx_table_no").val(data.tx_table_no);
        $("#edit_tx_table_no").val(data.tx_table_no);
        $("#bill_tx_table_no_name").html(data.tx_table_no);
        $("#bill_tx_id").val(data.tx_id);
        $("#bill_tx_receipt_no").val(data.tx_receipt_no);
        $("#bill_tx_id_name").html(data.tx_id_name);
        $("#bill_tx_date").val(data.tx_date);
        $("#bill_tx_time").val(data.tx_time);
        $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
        $("#bill_tx_total_after_tax_nominal").html(data.tx_total_after_tax);
        $("#bill_tx_total_before_tax_nominal").html(data.tx_total_before_tax);
        $("#bill_tx_total_discount").val(data.tx_total_discount);
        $("#bill_tx_total_discount_nominal").html(data.tx_total_discount);
        $("#bill_tx_total_tax").val(data.tx_total_tax);
        $("#bill_tx_total_tax_nominal").html(data.tx_total_tax);
        $("#bill_tx_total_grand").val(data.tx_total_grand);
        $("#bill_tx_total_grand_nominal").html(data.tx_total_grand);
        // disabled button
        $("#bill_btn_payment").prop('disabled', true);
        $("#bill_btn_pending").prop('disabled', true);
        $("#bill_btn_cancel").prop('disabled', true);
        // clear billing
        $("#bill-list").html('');
        //show button
        $("#btn_payment_group").show();
        $("#btn_return_group").hide();
      }
    })
  }
  
  function get_billing_id(tx_id) {
    $("#modal_hold").modal('hide');
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/get_billing_now',
      data : 'tx_id='+tx_id,
      dataType : 'json',
      success : function (data) {
        $("#bill_tx_id").val(data.tx_id);
        $("#bill_tx_id_name").html('TXS-'+data.tx_receipt_no);
        $("#bill_customer_name").html(data.customer_name);
        $("#bill_customer_id").val(data.customer_id);
        $("#bill_tx_table_no").val(data.tx_table_no);
        $("#bill_tx_table_no_name").html(data.tx_table_no);
        $("#bill_tx_total_after_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_after_tax)));
        $("#bill_tx_total_before_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_before_tax)));
        $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
        $("#bill_tx_total_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_tax)));
        $("#bill_tx_total_tax").val(Math.round(data.tx_total_tax));
        $("#bill_tx_total_discount").val(Math.round(data.tx_total_discount));
        $("#bill_tx_total_discount_nominal").html(sys_to_ind(Math.round(data.tx_total_discount)));
        $("#bill_tx_total_discount").val(Math.round(data.tx_total_discount));
        $("#bill_tx_total_grand_nominal").html(sys_to_ind(Math.round(data.tx_total_grand)));
        $("#bill_tx_total_grand").val(Math.round(data.tx_total_grand));
        $("#bill-list").html('');
        $("#bill_tx_date").val(data.tx_date);
        $("#bill_tx_time").val(data.tx_time);
        $("#tx_total_discount").val(sys_to_ind(Math.round(data.tx_total_discount)));
        $("#tx_discount_percent").val(sys_to_inddec(data.tx_discount_percent));
        $("#tx_discount_type").val(data.tx_discount_type).trigger('change');;
        $("#tx_down_payment").val(sys_to_ind(Math.round(data.tx_down_payment)));
        $.each(data.detail, function(i, item) {
          var client_is_taxed = <?=$client->client_is_taxed?>;
          if (client_is_taxed == 0) {
            // Harga Sebelum Pajak
            if(data.detail[i].is_custom == 0){
              var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>';
            }else{
              var html = '<li onclick=edit_custom_show('+data.detail[i].billing_detail_id+')>';
            };
            html += '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
              '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_before_tax))+'</span></div>'+
              '<ul>'+
                '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_before_tax));
          }else{
            // Harga Sesudah Pajak
            if(data.detail[i].is_custom == 0){
              var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>';
            }else{
              var html = '<li onclick=edit_custom_show('+data.detail[i].billing_detail_id+')>';
            };
            html += '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
              '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_after_tax))+'</span></div>'+
              '<ul>'+
                '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_after_tax));
          }

          if(data.detail[i].tx_subtotal_discount != 0){
            html += ' Disc ('+sys_to_ind(data.detail[i].tx_subtotal_discount)+')</li>';
          }

          html +=
            '</ul>'+
          '</li>';

          $("#bill-list").append(html);
        })
        $("#buyget_section").html('');
        if(data.buyget != ''){
          $("#buyget_section").append('<div class="list-group"></div>');
          $("#buyget_section .list-group").append('<a class="list-group-item active">Anda berhak mendapatkan</a>');
          $.each(data.buyget, function(i, item) {
            var html = '<a class="list-group-item">'+
              '<span class="badge">'+data.buyget[i].get_amount+'</span>'+
              data.buyget[i].item_name+
              '</a>';
            $("#buyget_section .list-group").append(html);
          })
        }
        // disabled button
        $("#bill_btn_payment").prop('disabled', false);
        $("#bill_btn_pending").prop('disabled', false);
        $("#bill_btn_cancel").prop('disabled', false);
      }
    })
  }

  // get all detail action / append to billing
  function get_billing_now() {
    var tx_id = $("#bill_tx_id").val();
    $.ajax({
      type: 'post',
      url : '<?=base_url()?>res_cashier/get_billing_now',
      data : 'tx_id='+tx_id,
      dataType : 'json',
      success : function (data) {
        $("#bill_tx_table_no").val(data.tx_table_no);
        $("#bill_tx_table_no_name").html(data.tx_table_no);
        $("#bill_tx_total_after_tax_nominal").html(sys_to_ind(data.tx_total_after_tax));
        $("#bill_tx_total_before_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_before_tax)));
        $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
        $("#bill_tx_total_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_tax)));
        $("#bill_tx_total_tax").val(data.tx_total_tax);
        $("#bill_tx_total_discount").val(data.tx_total_discount);
        $("#bill_tx_total_discount_nominal").html(sys_to_ind(Math.round(data.tx_total_discount)));
        $("#bill_tx_total_discount").val(data.tx_total_discount);
        $("#bill_tx_total_grand_nominal").html(sys_to_ind(Math.round(data.tx_total_grand)));
        $("#bill_tx_total_grand").val(data.tx_total_grand);
        $("#bill-list").html('');
        $("#tx_down_payment").val(sys_to_ind(Math.round(data.tx_down_payment)));
        $.each(data.detail, function(i, item) {
          var client_is_taxed = <?=$client->client_is_taxed?>;
          if (client_is_taxed == 0) {
            // Harga Sebelum Pajak
            if(data.detail[i].is_custom == 0){
              var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>';
            }else{
              var html = '<li onclick=edit_custom_show('+data.detail[i].billing_detail_id+')>';
            };
            html += '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
              '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_before_tax))+'</span></div>'+
              '<ul>'+
                '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_before_tax));
          }else{
            // Harga Sesudah Pajak
            if(data.detail[i].is_custom == 0){
              var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>';
            }else{
              var html = '<li onclick=edit_custom_show('+data.detail[i].billing_detail_id+')>';
            };
            html += '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
              '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_after_tax))+'</span></div>'+
              '<ul>'+
                '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_after_tax));
          }

          if(data.detail[i].tx_subtotal_discount != 0){
            html += ' Disc ('+sys_to_ind(data.detail[i].tx_subtotal_discount)+')</li>';
          }

          html +=
            '</ul>'+
          '</li>';

          $("#bill-list").append(html);
        })
        $("#buyget_section").html('');
        if(data.buyget != ''){
          $("#buyget_section").append('<div class="list-group"></div>');
          $("#buyget_section .list-group").append('<a class="list-group-item active">Anda berhak mendapatkan</a>');
          $.each(data.buyget, function(i, item) {
            var html = '<a class="list-group-item">'+
              '<span class="badge">'+data.buyget[i].get_amount+'</span>'+
              data.buyget[i].item_name+
              '</a>';
            $("#buyget_section .list-group").append(html);
          })
        }
      }
    })
  }

  function send_dashboard(data) {
    $.ajax({
      type : 'GET',
      // url : 'http://addkomputer.com/prismapos/index.php/api/json/store',
      url : 'http://182.253.114.52/dashboard_pos/index.php/api/json/store',
      data : data,
      dataType : 'json',
      success : function (data) {
        if(data.resp_code == '00'){
          update_data(data.tx_id);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) { // if error occured
        console.log(jqXHR.status);
        console.log(errorThrown);
      }
    })
    // console.log(data);
  }

  function update_data(id) {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>update_data.php',
      data : 'id='+id,
      dataType : 'json',
      success : function (data) {
        console.log('ok');
      }
    })
  }

  function get_customer() {
    $.ajax({
      type : 'post',
      url : '<?=base_url()?>res_cashier/get_customer',
      dataType : 'json',
      success : function (data) {
        $("#customer_list").html('');
        $.each(data, function() {
          $("#customer_list").append($("<option/>").val(this.customer_id).text(this.customer_name));
        });
      }
    })
  }

  // Shortcut keyboard
  $(document).bind('keydown', 'f2', function assets() {
    payment_show();
    return false;
  });
  $(document).bind('keydown', 'f3', function assets() {
    pending_show();
    return false;
  });
  $(document).bind('keydown', 'f4', function assets() {
    cancel_show();
    return false;
  });
  $(document).bind('keydown', 'f8', function assets() {
    open_search();
    return false;
  });
</script>