<?php $prismapos_base_url = 'http://localhost/prisma-pos/';?>
<?php
// connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'prisma_pos';
$connection = mysqli_connect($hostname,$username,$password);
mysqli_select_db($connection,$database);
//
// get data instalasi
$app_query = mysqli_query($connection,"SELECT * FROM app_install");
$app_row = mysqli_fetch_assoc($app_query);
$app_type_id = @$app_row['type_id'];
$app_install_status = @$app_row['install_status'];
//
// condition
if($app_install_status == '1') {
//
	// get table
	switch ($app_type_id) {
		case '1':	// retail
			$tbl_client = 'ret_client';
			$tbl_billing = 'ret_billing';
			break;
		case '2':	// restaurant
			$tbl_client = 'res_client';
			$tbl_billing = 'res_billing';
			break;
		case '3':	// hotel
			$tbl_client = 'hot_client';
			$tbl_billing = 'hot_billing';
			break;
		case '4':	// karaoke
			$tbl_client = 'kar_client';
			$tbl_billing = 'kar_billing';
			break;
		case '5':	// parkir
			$tbl_client = 'par_client';
			$tbl_billing = 'par_billing';
			break;
		default:
			$tbl_client = 'ret_client';
			$tbl_billing = 'ret_billing';
			break;
	}
	//
	// get data client
	$client_query = mysqli_query($connection,"SELECT * FROM $tbl_client");
	$client_row = mysqli_fetch_assoc($client_query);
	$client_id = @$client_row['client_id'];
	$client_name = str_replace('&', '#', @$client_row['client_name']);
	$client_pos_sn = @$client_row['client_serial_number'];
	$client_npwpd = @$client_row['client_npwpd'];
	//
	// baseurl
	// $dashboard_base_url = 'http://addkomputer.com/prismapos/index.php/api/json/ping?auth=prismapos.addkomputer&apikey=69f86eadd81650164619f585bb017316';
	$dashboard_base_url = 'http://182.253.114.52/dashboard_pos/index.php/api/json/ping?auth=prismapos.addkomputer&apikey=69f86eadd81650164619f585bb017316';
	$dashboard_base_url.= '&app_type_id='.$app_type_id;
	$dashboard_base_url.= '&client_id='.$client_id;
	$dashboard_base_url.= '&name='.$client_name;
	$dashboard_base_url.= '&pos_sn='.$client_pos_sn;
	$dashboard_base_url.= '&npwpd='.$client_npwpd;
	//data transaction
	$billing_query = mysqli_query($connection,"SELECT * FROM $tbl_billing");
	$billing_row = mysqli_fetch_assoc($billing_query);
?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>PING PRISMAPOS</title>
			<script type="text/javascript" src="<?php echo $prismapos_base_url.'vendor/jquery/jquery-3.3.1.min.js'?>"></script>
			<script type="text/javascript">
			$(function() {
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
						url : '<?=$prismapos_base_url?>data_trx.php',
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
						url : '<?=$prismapos_base_url?>update_data.php',
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
				}, 10000); // miliseconds -> 60sec

				//get data
				
			});
			</script>
		</head>
		<body>
			<div id="status_ping">Status None</div>
		</body>
		</html>

<?php } // end condition?>
