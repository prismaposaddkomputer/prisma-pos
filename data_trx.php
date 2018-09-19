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
            $tbl_tax = 'res_tax';
			break;
		case '3':	// hotel
			$tbl_client = 'hot_client';
            $tbl_billing = 'hot_billing';
            $tbl_tax = 'hot_charge_type';
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
    
    if ($app_type_id == 2) {
        $billing_query = mysqli_query($connection,"SELECT * FROM $tbl_billing WHERE tx_status = '1' AND posting_st = '0' LIMIT 1");
        $billing = array();
        $dashboard = array();
    
        $tax_query = mysqli_query($connection,"SELECT * FROM $tbl_tax");
        $tax_row = mysqli_fetch_assoc($tax_query);
        
        while($bill = mysqli_fetch_assoc($billing_query)){
            $dashboard = null;
            $dashboard = array(
              'auth'=> 'prismapos.addkomputer',
              'apikey'=> '69f86eadd81650164619f585bb017316',
              'app_type_id'=> $app_type_id,
              'client_id'=> $client_id,
              'pos_sn'=> $client_pos_sn,
              'npwpd'=> $client_npwpd,
              'customer_name'=> $bill['customer_name'],
              'no_receipt'=> 'TRS-'.$bill['tx_receipt_no'],
              'tx_id'=> $bill['tx_id'],
              'tx_date'=> $bill['tx_date'],
              'tx_time'=> $bill['tx_time'],
              'tx_total_before_tax'=> $bill['tx_total_before_tax'],
              'tax_code'=> $tax_row['tax_code'],
              'tax_ratio'=> $tax_row['tax_ratio'],
              'tx_total_tax'=> $bill['tx_total_tax'],
              'tx_total_after_tax'=> $bill['tx_total_after_tax'],
              'tx_total_grand'=> $bill['tx_total_grand'],
              'user_id'=> $bill['user_id'],
              'user_realname'=> $bill['user_realname'],
              'created'=> $bill['created']
            );
        };
        echo json_encode($dashboard);
    }else if ($app_type_id == 3) {
        $billing_query = mysqli_query($connection,"SELECT * FROM hot_billing WHERE billing_status = '2' AND posting_st = '0' LIMIT 1");
        $billing = array();
        $dashboard = array();
    
        $tax_query = mysqli_query($connection,"SELECT * FROM hot_charge_type WHERE charge_type_id = '1'");
        $tax = mysqli_fetch_assoc($tax_query);
        
        while($bill = mysqli_fetch_assoc($billing_query)){
            $dashboard = null;
            $dashboard = array(
                'auth'=> 'prismapos.addkomputer',
                'apikey'=> '69f86eadd81650164619f585bb017316',
                'app_type_id'=> $app_type_id,
                'client_id'=> $client_id,
                'pos_sn'=> $client_pos_sn,
                'npwpd'=> $client_npwpd,
                'customer_name'=> $bill['guest_name'],
                'no_receipt'=> 'TRS-'.$bill['billing_receipt_no'],
                'tx_id'=> $bill['billing_id'],
                'tx_date'=> $bill['billing_date_in'],
                'tx_time'=> $bill['billing_time_in'],
                'tx_total_before_tax'=> $bill['billing_subtotal'],
                'tax_code'=> $tax['charge_type_code'],
                'tax_ratio'=> $tax['charge_type_ratio'],
                'tx_total_tax'=> $bill['billing_tax'],
                'tx_total_after_tax'=> $bill['billing_subtotal']+$bill['billing_tax'],
                'tx_total_grand'=> $bill['billing_subtotal']+$bill['billing_tax'],
                'user_id'=> $bill['user_id'],
                'user_realname'=> $bill['user_realname'],
                'created'=> $bill['created'],
            );
        };
        echo json_encode($dashboard);
    }else if ($app_type_id == 4) {
        $billing_query = mysqli_query($connection,"SELECT * FROM kar_billing WHERE billing_status = '2' AND posting_st = '0' LIMIT 1");
        $billing = array();
        $dashboard = array();
    
        $tax_query = mysqli_query($connection,"SELECT * FROM kar_charge_type  WHERE charge_type_id = '1'");
        $tax = mysqli_fetch_assoc($tax_query);
        
        while($bill = mysqli_fetch_assoc($billing_query)){
            $dashboard = null;
            $dashboard = array(
                'auth'=> 'prismapos.addkomputer',
                'apikey'=> '69f86eadd81650164619f585bb017316',
                'app_type_id'=> $app_type_id,
                'client_id'=> $client_id,
                'pos_sn'=> $client_pos_sn,
                'npwpd'=> $client_npwpd,
                'customer_name'=> $bill['guest_name'],
                'no_receipt'=> 'TRS-'.$bill['billing_receipt_no'],
                'tx_id'=> $bill['billing_id'],
                'tx_date'=> $bill['billing_date_in'],
                'tx_time'=> $bill['billing_time_in'],
                'tx_total_before_tax'=> $bill['billing_subtotal'],
                'tax_code'=> $tax['charge_type_code'],
                'tax_ratio'=> $tax['charge_type_ratio'],
                'tx_total_tax'=> $bill['billing_tax'],
                'tx_total_after_tax'=> $bill['billing_subtotal']+$bill['billing_tax'],
                'tx_total_grand'=> $bill['billing_subtotal']+$bill['billing_tax'],
                'user_id'=> $bill['user_id'],
                'user_realname'=> $bill['user_realname'],
                'created'=> $bill['created'],
            );
        };
        echo json_encode($dashboard);
    }
}
?>