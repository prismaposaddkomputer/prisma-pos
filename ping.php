<?php $prismapos_base_url = 'http://localhost/prisma-pos/';?>
<?php

//load install
$this->load->model('app_install/m_app_install');
$install = $this->m_app_install->get_install();

// load client
switch ($install['type_id']) {
	case '1':
		$this->load->model('ret_retail/m_ret_client');
		$client = $this->m_ret_retail->get_all();
		break;

	case '2':
		$this->load->model('ret_retail/m_res_client');
		$client = $this->m_ret_retail->get_all();
		break;

	case '3':
		$this->load->model('ret_retail/m_hot_client');
		$client = $this->m_ret_retail->get_all();
		break;

	case '4':
		$this->load->model('ret_retail/m_kar_client');
		$client = $this->m_ret_retail->get_all();
		break;

	case '5':
		$this->load->model('ret_retail/m_par_client');
		$client = $this->m_ret_retail->get_all();
		break;
}

$dashboard_base_url = 'http://addkomputer.com/prismapos/index.php/api/json/ping?auth=prismapos.addkomputer&apikey=69f86eadd81650164619f585bb017316';
$dashboard_base_url.= '&app_type_id='.$install['type_id'];
$dashboard_base_url.= '&client_id='.$client->client_id;
$dashboard_base_url.= '&pos_sn='.$client->client_serial_number;
$dashboard_base_url.= '&npwpd='.$client->client_npwpd;
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
