<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prisma-POS</title>
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
    <style type="text/css">
      .btn-telo {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
      }
      .btn-telo:focus,
      .btn-telo.focus {
        color: #fff;
        background-color: #31b0d5;
        border-color: #1b6d85;
      }
      .btn-telo:hover {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
      }
      .btn-telo:active,
      .btn-telo.active,
      .open > .dropdown-toggle.btn-telo {
        color: #fff;
        background-color: #31b0d5;
        border-color: #269abc;
      }
      .btn-telo:active:hover,
      .btn-telo.active:hover,
      .open > .dropdown-toggle.btn-telo:hover,
      .btn-telo:active:focus,
      .btn-telo.active:focus,
      .open > .dropdown-toggle.btn-telo:focus,
      .btn-telo:active.focus,
      .btn-telo.active.focus,
      .open > .dropdown-toggle.btn-telo.focus {
        color: #fff;
        background-color: #269abc;
        border-color: #1b6d85;
      }
      .btn-telo:active,
      .btn-telo.active,
      .open > .dropdown-toggle.btn-telo {
        background-image: none;
      }
      .btn-telo.disabled:hover,
      .btn-telo[disabled]:hover,
      fieldset[disabled] .btn-telo:hover,
      .btn-telo.disabled:focus,
      .btn-telo[disabled]:focus,
      fieldset[disabled] .btn-telo:focus,
      .btn-telo.disabled.focus,
      .btn-telo[disabled].focus,
      fieldset[disabled] .btn-telo.focus {
        background-color: #5bc0de;
        border-color: #46b8da;
      }
      .btn-telo .badge {
        color: #5bc0de;
        background-color: #fff;
      }
    </style>
    <script>
      $(document).ready(function () {
        <?php if($client->client_keyboard_status == 1):?>
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
          tabNavigation : true,
          layout : 'custom',
          css: {
            buttonHover: 'btn-primary',
            buttonDefault: 'btn btn-default'
          },
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
        <?php endif;?>
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
      })
    </script>
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
    <script type="text/javascript">
      setInterval(function () {
        $('.alert').fadeOut();
      }, 1500);
    </script>
  </head>
  <body>
    <div class="modal fade modal-power" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center">Prisma Point of Sales</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <a class="btn btn-danger btn-block" href="<?=base_url()?>app_system/shutdown"><i class="fa fa-circle-o"></i> Shutdown</a>
              </div>
              <div class="col-md-6">
                <a class="btn btn-success btn-block" href="<?=base_url()?>app_system/restart"><i class="fa fa-refresh"></i> Restart</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3" style="width:max-content !important;">  
            <div class="navbar-header">
              <a class="navbar-brand" href="#">
                Prisma Point of Sales
              </a>
            </div>
          </div>
          <div class="col-md-1" style="padding:15px;">
            <span class="label" id="status_info"></span>
          </div>
          <div class="col-md-1 col-md-offset-7 pull-right">
            <button type="button" class="btn btn-danger navbar-btn pull-right" data-toggle="modal" data-target=".modal-power"><i class="fa fa-power-off"></i></button>
          </div>
        </div>
        <!-- <div style="padding-top:0px; !Important">fasdfasd</div> -->
      </div>
    </nav>
