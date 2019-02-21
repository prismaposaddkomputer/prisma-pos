<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prisma-POS</title>
    <!-- Favicon -->
    <link rel="icon" href="<?=base_url()?>img/prisma-pos.png">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/bootstrap/css/bootstrap.min.css">
    <!-- Boostrap Datetimepicker CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
    <!-- Bootstrap Daterangapicker CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/bootstrap-daterangepicker/daterangepicker.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/jquery-ui/jquery-ui.min.css">
    <!-- Keyboard css -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/keyboard-master/dist/css/keyboard.min.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/jquery-custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/font-awesome/css/font-awesome.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/select2/dist/css/select2.min.css">
    <!-- Select2 Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/select2/dist/css/select2-bootstrap.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>dist/css/prismapos.css">
    <!-- Tooltip CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/tooltip-viewport/tooltip-viewport.css">
    <!-- jQuery CDN -->
    <script src="<?=base_url()?>vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="<?=base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="<?=base_url()?>vendor/jquery-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- JQuery UI -->
    <script src="<?=base_url()?>vendor/jquery-ui/jquery-ui.min.js"></script>
    <!-- keyboard js -->
    <script src="<?=base_url()?>vendor/keyboard-master/dist/js/jquery.keyboard.min.js"></script>
    <!-- jQuery Validation JS -->
    <script src="<?=base_url()?>vendor/jquery-validation/dist/jquery.validate.min.js" charset="utf-8"></script>
    <!-- jQuery Form JS -->
    <script src="<?=base_url()?>vendor/jquery-form/jquery-form.min.js" charset="utf-8"></script>
    <!-- Moment JS -->
    <script src="<?=base_url()?>vendor/bootstrap-daterangepicker/moment.min.js" charset="utf-8"></script>
    <!-- Datetimepicker JS -->
    <script src="<?=base_url()?>vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js" charset="utf-8"></script>
    <!-- Daterangepicker JS -->
    <script src="<?=base_url()?>vendor/bootstrap-daterangepicker/daterangepicker.js" charset="utf-8"></script>
    <!-- Select2 JS -->
    <script src="<?=base_url()?>vendor/select2/dist/js/select2.full.min.js" charset="utf-8"></script>
    <!-- Auto Numeric JS -->
    <script src="<?=base_url()?>vendor/autoNumeric/autoNumeric.js" charset="utf-8"></script>
    <!-- Tooltip JS -->
    <script src="<?=base_url()?>vendor/tooltip-viewport/tooltip-viewport.js" charset="utf-8"></script>
    <!-- Chart JS -->
    <script src="<?=base_url()?>vendor/chart-js/Chart.min.js" charset="utf-8"></script>
    <script src="<?=base_url()?>vendor/chart-js/Chart.bundle.min.js" charset="utf-8"></script>
    <script src="<?=base_url()?>vendor/chart-js/utils.js" charset="utf-8"></script>
    <!-- Recta JS For Printer -->
    <script src="<?=base_url()?>vendor/recta/recta.js" charset="utf-8"></script>
    <!-- Nabapos JS -->
    <script src="<?=base_url()?>dist/js/prismapos.js" charset="utf-8"></script>
    <!-- Sweetalert -->
    <script src="<?=base_url()?>vendor/sweetalert/sweetalert.min.js"></script>
    <!-- Pace loader -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/pace/pace-theme-loading-bar.css" />
    <script src="<?=base_url()?>vendor/pace/pace.js"></script>
    <!-- Common JS -->
    <script type="text/javascript">
      $(document).ready(function () {
        $('.daterange-picker').daterangepicker({
          locale: {
            format: 'DD-MM-YYYY'
          }
        });
        var date=new Date();
        var year=date.getFullYear();
        var month=date.getMonth();
        $('.time-picker').datetimepicker({
          format: 'HH:mm:ss'
        });
        $('.date-picker').datetimepicker({
          format: 'DD-MM-YYYY'
        });
        $(".week-picker").datetimepicker({
          format: 'DD-MM-YYYY'
        });
        $('.week-picker').on('dp.change', function (e) {
          var value = $(".week-picker").val();
          var firstDate = moment(value, "DD-MM-YYYY").day(0).format("DD-MM-YYYY");
          var lastDate =  moment(value, "DD-MM-YYYY").day(6).format("DD-MM-YYYY");
          $(".week-picker").val(firstDate + " - " + lastDate);
        });
        $('.month-picker').datetimepicker({
          viewMode: 'years',
          format: 'MM-YYYY'
        });
        $('.year-picker').datetimepicker({
          viewMode: 'years',
          format: 'YYYY'
        });
        $.fn.select2.defaults.set( "theme", "bootstrap" );
        $(".select2").select2({width: '100%'});
        $(".autonumeric").autoNumeric('init',{
          aSep: '.',
          aDec: ',',
          aForm: true,
          vMax: '999999999',
          vMin: '-999999999'
        });
        setInterval(function () {
          $('.alert').fadeOut();
        }, 1500);
        <?php if($keyboard == 1):?>
          $.keyboard.keyaction.enter = function(base){
            if (base.el.tagName === "INPUT") {
              base.accept();      // accept the content
              //$('form').submit(); // submit form on enter
            } else {
              base.insertText('\r\n'); // textarea
            }
          };
          $('.keyboard').keyboard({
            enterNavigation : false,
            layout : 'custom',
            customLayout : {
              'normal' : ['1 2 3 4 5 6 7 8 9 0',
                          'q w e r t y u i o p',
                          'a s d f g h j k l',
                          '{s} z x c v b n m {b}',
                          '{c} , {space} . {a}'],
              'shift' : ['! @ # $ % ^ & * ( )',
                          'Q W E R T Y U I O P',
                          'A S D F G H J K L',
                          '{s} Z X C V B N M {b}',
                          '{c} < {space} > {a}'],
            },
            visible: function(e, keyboard, el) {
              keyboard.$keyboard.find('.ui-keyboard-bksp')
                .text('\u2190')
                .attr('data-html', '<span class="ui-keyboard-text">\u2190</span>')
                .css('background-color','#ee5253')
                .css('color','#ffffff');
            }
          });
          $('.num').keyboard({
            layout : 'custom',
            customLayout: { 'normal': ['1 2 3 {sign}', '4 5 6 ,', '7 8 9 {b}', '{c} 0 . {a}'] },
            visible: function(e, keyboard, el) {
              keyboard.$keyboard.find('.ui-keyboard-bksp')
                .text('\u2190')
                .attr('data-html', '<span class="ui-keyboard-text">\u2190</span>')
                .css('background-color','#ee5253')
                .css('color','#ffffff');
            }
          });
        <?php endif;?>
      });
    </script>
    <!-- Custom Script -->
    <script type="text/javascript">
      $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
          theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
          $('#sidebar, #content').toggleClass('active');
          $('.collapse.in').toggleClass('in');
          $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
      });
    </script>
    <style>
      /* .bootstrap-datetimepicker-widget tr:hover {
        background-color: #0abde3;
      } */
    </style>
    <style media="screen">
      div.ui-widget {
        font-size: 1.5em;
      }
      button.ui-keyboard-button {
        margin: 4px;
      }
      .modal-power{
        margin-top: 200px;
      }
    </style>
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
  </head>
  <body>
    <div class="wrapper">
