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
			break;
		case '2':	// restaurant
			$tbl_client = 'res_client';
			break;
		case '3':	// hotel
			$tbl_client = 'hot_client';
			break;
		case '4':	// karaoke
			$tbl_client = 'kar_client';
			break;
		case '5':	// parkir
			$tbl_client = 'par_client';
			break;
		default:
			$tbl_client = 'ret_client';
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
	//
?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>PING PRISMAPOS</title>
			<script type="text/javascript" src="<?php echo $prismapos_base_url.'vendor/jquery/jquery-3.3.1.min.js'?>"></script>
			<script type="text/javascript">
			$(function() {
				function _ping() {
					$.get('<?php echo $dashboard_base_url?>');
				}
				_ping();
				var auto_ping = setInterval(function () {
				    _ping();
				}, 60000); // miliseconds -> 60sec
			});
			</script>
		</head>
		<body>

		</body>
		</html>

<?php } // end condition?>
