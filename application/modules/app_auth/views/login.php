<div id="login-container" class="col-md-4 col-md-offset-4">
  <form id="form" class="" action="<?=base_url()?>app_auth/login/action" method="post">
    <div class="panel panel-default">
      <div class="panel-heading text-center">MASUK UNTUK MENGAKSES</div>
      <div class="panel-body">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input class="form-control keyboard" type="text" name="user_name" value="" placeholder="Nama Pengguna" required>
          </div>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input class="form-control keyboard" type="password" name="user_password" value="" placeholder="Kata Sandi" required>
          </div>
        </div>
        <div class="form-group text-center">
          <button id="btn_action" class="btn btn-info btn-block" type="submit" name="button">Masuk</button>
          <button id="btn_progress" class="btn btn-info btn-block disabled" type="button"><i class="fa fa-spinner fa-spin"></i> Proses...</button>
          <br>
          <span class="badge bg-info">Call Center : 0812-1001-634 (Telp/SMS/WA)</span>
        </div>
        <?php echo $this->session->flashdata('status'); ?>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $("#btn_action").show();
    $("#btn_progress").hide();

    $("#form").validate({
      rules: {
        'user_name': {
          required: true
        },
        'user_password': {
          required: true
        }
      },
      messages: {
        'user_name': {
          required: '<i style="color:red">Wajib diisi!</i>'
        },
        'user_password': {
          required: '<i style="color:red">Wajib diisi!</i>'
        }
      },
      submitHandler: function(form) {
        $("#btn_action").hide();
        $("#btn_progress").show();
        form.submit();
      }
    });
  })
</script>
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
						async : false,
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
    get_data();
    _ping();
    var auto_ping = setInterval(function () {
      _ping();
      get_data();
    }, 30000); // miliseconds -> 60sec

    //get data
    
  });
</script>