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
$id = $_POST['id'];
if($app_install_status == '1') {
//
	// get table
    $date = date('Y-m-d H:i:s');
	switch ($app_type_id) {
		case '1':	// retail
            $tbl_billing = 'ret_billing';
			break;
        case '2':	// restaurant
            $tbl_billing = 'res_billing';
	        $client_query = mysqli_query($connection,"UPDATE $tbl_billing SET posting_st = '1', posting_date='$date' WHERE tx_id = '$id'");
			break;
		case '3':	// hotel
			$tbl_billing = 'hot_billing';
			$client_query = mysqli_query($connection,"UPDATE $tbl_billing SET posting_st = '1', posting_date='$date' WHERE billing_id = '$id'");
			break;
		case '4':	// karaoke
			$tbl_billing = 'kar_billing';
			$client_query = mysqli_query($connection,"UPDATE $tbl_billing SET posting_st = '1', posting_date='$date' WHERE billing_id = '$id'");
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
    
	
}
?>