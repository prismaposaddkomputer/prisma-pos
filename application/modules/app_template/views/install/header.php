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
    <!-- Prisma POS Install CSS -->
    <link rel="stylesheet" href="<?=base_url()?>dist/css/prismapos.install.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/font-awesome/css/font-awesome.min.css">
    <!-- Keyboard css -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/keyboard-master/dist/css/keyboard.min.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/jquery-ui/jquery-ui.min.css">
    <!-- jQuery CDN -->
    <script src="<?=base_url()?>vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- JQuery UI -->
    <script src="<?=base_url()?>vendor/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="<?=base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- JQuery Validation JS -->
    <script src="<?=base_url()?>vendor/jquery-validation/dist/jquery.validate.min.js" charset="utf-8"></script>
    <!-- keyboard js -->
    <script src="<?=base_url()?>vendor/keyboard-master/dist/js/jquery.keyboard.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.keyboard').keyboard({
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
          }
        });
        $('.num').keyboard({
          layout : 'custom',
          customLayout: { 'normal': ['1 2 3 {sign}', '4 5 6 ,', '7 8 9 {b}', '{c} 0 . {a}'] }
        });
      })
    </script>
    <style media="screen">
      div.ui-widget {
        font-size: 1.5em;
      }
      button.ui-keyboard-button {
        margin: 4px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Prisma Point of Sales</a>
        </div>
        <div class="btn-group pull-right" role="group">
          <button type="button" class="btn btn-danger navbar-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-power-off"></i> Power
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>app_system/shutdown"><i class="fa fa-circle-o"></i> Shutdown</a></li>
            <li><a href="<?=base_url()?>app_system/restart"><i class="fa fa-refresh"></i> Restart</a></li>
          </ul>
        </div>
      </div>
    </nav>
