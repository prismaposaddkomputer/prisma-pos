<?php $prismapos_base_url = 'http://localhost/prisma-pos/';?>

<!DOCTYPE html>
<html>
<head>
	<title>PRISMAPOS</title>
	<link rel="shortcut icon" href="<?php echo $prismapos_base_url;?>img\prisma-pos.png">
	<style type="text/css">iframe{border:0px; margin: -10px}</style>
	<script type="text/javascript" src="<?php echo $prismapos_base_url.'vendor/jquery/jquery-3.3.1.min.js'?>"></script>
	<script type="text/javascript">
	$(function() {
		var width  = $(window).width();
		var height = $(window).height();
		var width_prismapos  = parseFloat(width);
		var height_prismapos = parseFloat(height)*99/100;
		var height_ping = parseFloat(height)*1/100;
		$('#iframe_prismapos').css({
			'width'  : width_prismapos,
			'height' : height_prismapos,
		});
		$('#iframe_ping').css({
			'height' : height_ping
		});
	});
	</script>
</head>
<body>

<iframe src="<?php echo $prismapos_base_url.'prismapos.php'?>" id="iframe_prismapos"></iframe>
<iframe src="<?php echo $prismapos_base_url.'ping.php'?>" id="iframe_ping"></iframe>

</body>
</html>
