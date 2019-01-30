<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prisma Point of Sales</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>img/prisma-pos.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/bootstrap/css/bootstrap.min.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/jquery-ui/jquery-ui.min.css">
    <!-- Keyboard css -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/keyboard-master/dist/css/keyboard.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/font-awesome/css/font-awesome.min.css">
    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Timepicker CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/bootstrap-timepicker/bootstrap-timepicker.css">
    <!-- Select2 Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/select2/dist/css/select2-bootstrap.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/select2/dist/css/select2.min.css">
    <!-- iCheck CSS -->
    <link rel="stylesheet" href="<?=base_url()?>vendor/iCheck/all.css">
    <!-- Klepon Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>dist/css/ret-cashier.css">
    <!-- jQuery -->
    <script src="<?=base_url()?>vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- JQuery UI -->
    <script src="<?=base_url()?>vendor/jquery-ui/jquery-ui.min.js"></script>
    <!-- keyboard js -->
    <script src="<?=base_url()?>vendor/keyboard-master/dist/js/jquery.keyboard.min.js"></script>
    <!-- Bootstrap Js -->
    <script src="<?=base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- JQuery Slim Scroll -->
    <script src="<?=base_url()?>vendor/jQuery-slimScroll/jquery.slimscroll.min.js" charset="utf-8"></script>
    <!-- jQuery Validation JS -->
    <script src="<?=base_url()?>vendor/jquery-validation/dist/jquery.validate.min.js" charset="utf-8"></script>
    <!-- jQuery Form JS -->
    <script src="<?=base_url()?>vendor/jquery-form/jquery-form.min.js" charset="utf-8"></script>
    <!-- Moment JS -->
    <script src="<?=base_url()?>vendor/bootstrap-daterangepicker/moment.min.js" charset="utf-8"></script>
    <!-- Daterange picker JS -->
    <script src="<?=base_url()?>vendor/bootstrap-daterangepicker/daterangepicker.js" charset="utf-8"></script>
    <!-- Timepicker JS -->
    <script src="<?=base_url()?>vendor/bootstrap-timepicker/bootstrap-timepicker.min.js" charset="utf-8"></script>
    <!-- Select2 JS -->
    <script src="<?=base_url()?>vendor/select2/dist/js/select2.full.min.js" charset="utf-8"></script>
    <!-- iCheck JS -->
    <script src="<?=base_url();?>vendor/iCheck/icheck.min.js" charset="utf-8"></script>
    <!-- Hotkey JS -->
    <script src="<?=base_url()?>vendor/hotkeys/jquery.hotkeys.js"></script>
    <!-- Auto Numeric JS -->
    <script src="<?=base_url()?>vendor/autoNumeric/autoNumeric.js" charset="utf-8"></script>
    <!-- Recta JS For Printer -->
    <script src="<?=base_url()?>vendor/recta/recta.js" charset="utf-8"></script>
    <!-- PrismaPos JS -->
    <script src="<?=base_url()?>dist/js/prismapos.js" charset="utf-8"></script>
    <!-- Common JS -->
    <script type="text/javascript">
      $(document).ready(function () {
        $('.timepicker').timepicker({
            defaultTime: 'current',
            minuteStep: 1,
            showMeridian: false
        });
        $('input').iCheck({
           checkboxClass: 'icheckbox_minimal-grey',
           radioClass: 'iradio_minimal-grey'
        });
        $('.datepicker').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          locale: {
            format: 'YYYY-MM-DD'
          }
        });
        $(".select2").select2({
          width: '100%'
        });
        $(".autonumeric").autoNumeric('init',{
          aSep: '.',
          aDec: ',',
          aForm: true,
          vMax: '999999999',
          vMin: '-999999999'
        });
        <?php if($keyboard == 1):?>
          $('.keyboard').keyboard({
            layout : 'custom',
            customLayout : {
              'normal' : ['1 2 3 4 5 6 7 8 9 0',
                          'q w e r t y u i o p',
                          'a s d f g h j k l',
                          '{s} z x c v b n m {b}',
                          '{c} {space} {a}'],
              'shift' : ['! @ # $ % ^ & * ( ) / -',
                          'Q W E R T Y U I O P',
                          'A S D F G H J K L',
                          '{s} Z X C V B N M {b}',
                          '{c} {space} {a}'],
            }
          });
          $('.num').keyboard({
            layout : 'custom',
            customLayout: { 'normal': ['1 2 3 {sign}', '4 5 6 ,', '7 8 9 {b}', '{c} 0 . {a}'] }
          });
        <?php endif;?>
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
          <a class="navbar-brand" href="#"><?=$client->client_name?></a>
        </div>
        <ul class="nav navbar-nav">
          <li>
            <a href="<?=base_url()?>res_dashboard/index" role="button">
              Prisma POS 
              <span class="label" id="status_info"></span>
              <span class="label label-info">Call Center : 0812-1001-634 (Telp/SMS/WA)</span>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="<?=base_url()?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$this->session->userdata('user_realname')?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li onclick="getHoldBilling()"><a href="#"><i class="fa fa-hand-paper-o"></i> Billing Tertahan</a></li>
              <li onclick="printLast()"><a href="#"><i class="fa fa-print"></i> Cetak Struk Terakhir</a></li>
              <li><a href="<?=base_url()?>res_cashier/shift/close"><i class="fa fa-sign-out"></i> Tutup Shift</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid full-height-container">
      <div class="row full-height-row">
        <div id="category" class="col-md-2 col-xs-12 full-height-col">
          <ul id="category-list">
            <li><a onclick="get_all_item()">Semua Kategori</a></li>
            <?php foreach ($category as $row): ?>
              <li><a onclick="get_item_by_category('<?=$row->category_id?>')"><?=$row->category_name?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div id="item" class="col-md-6 col-xs-12 right full-height-col">
          <div id="search-form">
            <div class="input-group">
              <input id="search_term" type="text" class="form-control keyboard" name="search_term" <?php if($keyboard == 1){echo 'onchange="get_item_search()"';}else{echo 'oninput="get_item_search()"';};?> placeholder="Ketik nama atau barcode untuk mencari">
              <span class="input-group-btn">
                <button class="btn btn-info" type="button" onclick="open_search()"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
          <div id="item-header">
            <table class="table table-bordered table-condensed table-striped">

            </table>
          </div>
          <div id="item-list">
            <table id="item-table" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="lbl-barcode">Barcode</th>
                  <th class="lbl-item_name">Nama Item</th>
                  <th class="lbl-category_name">Kategori</th>
                  <th class="lbl-item_price_after_tax">Harga</th>
                </tr>
              </thead>
              <tbody id="item-row">

              </tbody>
            </table>
          </div>
          <div id="item-footer">
            <button class="btn btn-sm btn-info" onclick="add_custom_show()"><i class="fa fa-list"></i> Item Kustom</button>
            <button class="btn btn-sm btn-info" onclick="down_payment_show()"><i class="fa fa-money"></i> Uang Muka</button>
            <button class="btn btn-sm btn-info" onclick="print_dapur()"><i class="fa fa-cutlery"></i> Struk Dapur</button>
            <button class="btn btn-sm btn-info" onclick="discount_show()"><i class="fa fa-cut"></i> Diskon</button>
            <button class="btn btn-sm btn-warning" onclick="return_show()"><i class="fa fa-reply"></i> Retur</button>
            <button class="btn btn-sm btn-warning" onclick="print_receipt_show()"><i class="fa fa-print"></i> Cetak Struk</button>
          </div>
        </div>
        <input id="bill_tx_date" type="hidden" name="tx_date" value="">
        <input id="bill_tx_time" type="hidden" name="tx_time" value="">
        <div id="bill" class="col-md-4 col-xs-12 right full-height-col">
          <div id="bill-info">
            <div class="col-md-2 lbl-tx" style="cursor:pointer;" onclick="change_customer_show()">
              <i class="fa fa-user-o"></i> <span id="bill_customer_name"></span>
              <input id="bill_customer_id" type="hidden" name="customer_id" value="">
            </div>
            <div class="col-md-4 lbl-tx">
              <i class="fa fa-laptop"></i> <span id="bill_cashier_name">
              <input id="bill_cashier_id" type="hidden" name="cashier_id" value="">
            </div>
            <div class="col-md-4 lbl-tx">
              <i class="fa fa-user-o"></i> <span id="bill_tx_id_name"></span>
              <input id="bill_tx_id" type="hidden" name="tx_id" value="">
              <input id="bill_tx_receipt_no" type="hidden" name="tx_receipt_no" value="">
            </div>
            <div class="col-md-2 lbl-tx" onclick="change_tx_table_no()">
              <i class="fa fa-map-marker"></i> <span id="bill_tx_table_no_name">
              <input id="bill_tx_table_no" type="hidden" name="tx_table_no" value="">
            </div>
          </div>
          <div id="bill-items">
            <ul id="bill-list" class="bill-list">

            </ul>
          </div>
          <div id="tx-actions">
            <div class="lbl-bill">
              <?php if ($client->client_is_taxed == 0): ?>
              <b>SUBTOTAL <span id="bill_tx_total_before_tax_nominal" class="pull-right"></span></b>
              <?php else: ?>
              <br>
              <?php endif; ?>
              <input id="bill_tx_total_after_tax" type="hidden" name="" value="">
            </div>
            <div class="lbl-bill">
              <?php if ($client->client_is_taxed == 0): ?>
              PAJAK<span id="bill_tx_total_tax_nominal" class="pull-right"></span>
              <?php else: ?>
              <br>
              <?php endif; ?>
              <input id="bill_tx_total_tax" type="hidden" name="" value="">
            </div>
            <div class="lbl-bill">
              <?php if ($client->client_is_taxed == 0): ?>
              (DISKON)<span id="bill_tx_total_discount_nominal" class="pull-right"></span>
              <?php else: ?>
              (DISKON)<span id="bill_tx_total_discount_nominal" class="pull-right"></span>
              <?php endif; ?>
              <input id="bill_tx_total_discount" type="hidden" name="" value="">
            </div>
            <div class="lbl-bill">
              <b>TOTAL <span id="bill_tx_total_grand_nominal" class="pull-right"></span></b>
              <input id="bill_tx_total_grand" type="hidden" name="" value="">
            </div>
            <div id="btn_payment_group">
              <button id="bill_btn_payment" class="btn btn-lg btn-success btn-block btn-flat" type="button" name="button" onclick="payment_show()">BAYAR [F2]</button>
              <div class="col-md-6" style="padding:0px;">
                <button id="bill_btn_pending" class="btn btn-lg btn-warning btn-block btn-flat" type="button" name="button" onclick="pending_show()">TAHAN [F3]</button>
              </div>
              <div class="col-md-6" style="padding:0px;">
                <button id="bill_btn_cancel" class="btn btn-lg btn-danger btn-block btn-flat" type="button" name="button" onclick="cancel_show()">BATAL [F4]</button>
              </div>
            </div>
            <div id="btn_return_group">
              <button id="bill_btn_return_ok" class="btn btn-lg btn-info btn-block btn-flat" type="button" name="button" onclick="printReturn()">SELESAI</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modals -->
    <?php $this->load->view('_cancel_modal')?>
    <?php $this->load->view('_custom_modal');?>
    <?php $this->load->view('_customer_modal');?>
    <?php $this->load->view('_discount_modal');?>
    <?php $this->load->view('_down_payment_modal');?>
    <?php $this->load->view('_hold_modal');?>
    <?php $this->load->view('_item_modal');?>
    <?php $this->load->view('_payment_modal');?>
    <?php $this->load->view('_pending_modal');?>
    <?php $this->load->view('_receipt_modal');?>
    <?php $this->load->view('_return_modal');?>
    <?php $this->load->view('_search_modal');?>
    <?php $this->load->view('_table_no_modal');?>
    
    <!-- Scripts -->
    <?php $this->load->view('_on_load_sc');?>
    <?php $this->load->view('__common_sc');?>
    <?php $this->load->view('_cancel_sc');?>
    <?php $this->load->view('_custom_sc');?>
    <?php $this->load->view('_customer_sc');?>
    <?php $this->load->view('_discount_sc');?>
    <?php $this->load->view('_down_payment_sc');?>
    <?php $this->load->view('_hold_sc');?>
    <?php $this->load->view('_item_sc');?>
    <?php $this->load->view('_payment_sc');?>
    <?php $this->load->view('_pending_sc');?>
    <?php $this->load->view('_print_sc');?>
    <?php $this->load->view('_search_sc');?>
    <?php $this->load->view('_return_sc');?>
    <?php $this->load->view('_table_no_sc');?>
    
  </body>
</html>
