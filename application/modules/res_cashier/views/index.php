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
              'shift' : ['1 2 3 4 5 6 7 8 9 0',
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
            <a href="<?=base_url()?>res_dashboard/index" role="button">Prisma POS</a>
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
            <button class="btn btn-sm btn-info"><i class="fa fa-money"></i> Down Payment</button>
            <button class="btn btn-sm btn-info"><i class="fa fa-reply"></i> Retur</button>
          </div>
        </div>
        <div id="bill" class="col-md-4 col-xs-12 right full-height-col">
          <div id="bill-info">
            <input id="bill_tx_date" type="hidden" name="tx_date" value="">
            <input id="bill_tx_time" type="hidden" name="tx_time" value="">
            <div class="col-md-3 lbl-tx" style="cursor:pointer;" onclick="change_customer_show()">
              <i class="fa fa-user-o"></i> <span id="bill_customer_name"></span>
              <input id="bill_customer_id" type="hidden" name="customer_id" value="">
            </div>
            <div class="col-md-4 lbl-tx">
              <i class="fa fa-laptop"></i> <span id="bill_cashier_name">
              <input id="bill_cashier_id" type="hidden" name="cashier_id" value="">
            </div>
            <div class="col-md-5 lbl-tx">
              <i class="fa fa-user-o"></i> <span id="bill_tx_id_name"></span>
              <input id="bill_tx_id" type="hidden" name="tx_id" value="">
              <input id="bill_tx_receipt_no" type="hidden" name="tx_receipt_no" value="">
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
              DISKON<span id="bill_tx_total_discount_nominal" class="pull-right"></span>
              <?php else: ?>
              <br>
              <?php endif; ?>
              <input id="bill_tx_total_discount" type="hidden" name="" value="">
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
              <b>TOTAL <span id="bill_tx_total_grand_nominal" class="pull-right"></span></b>
              <input id="bill_tx_total_grand" type="hidden" name="" value="">
            </div>
            <button id="bill_btn_payment" class="btn btn-lg btn-success btn-block btn-flat" type="button" name="button" onclick="payment_show()">BAYAR [F2]</button>
            <div class="col-md-6" style="padding:0px;">
              <button id="bill_btn_pending" class="btn btn-lg btn-warning btn-block btn-flat" type="button" name="button" onclick="pending_show()">TAHAN [F3]</button>
            </div>
            <div class="col-md-6" style="padding:0px;">
              <button id="bill_btn_cancel" class="btn btn-lg btn-danger btn-block btn-flat" type="button" name="button" onclick="cancel_show()">BATAL [F4]</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ############ MODALS ############ -->
    <!-- Modal add item -->
    <div id="modal_add_item" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Item</h4>
          </div>
          <div class="modal-body">
            <input id="add_item_id" type="hidden" name="item_id" value="">
            <h4 class="cl-info text-center" id="add_item_name"></h4>
            <br>
            <table class="table table-condensed table-sstriped">
              <tr>
                <td>Barcode</td>
                <td>:</td>
                <td id="add_item_barcode"></td>
              </tr>
              <tr>
                <td>Kategori</td>
                <td>:</td>
                <td id="add_category_name"></td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>:</td>
                <td>
                  <input class="form-control num autonumeric" type="text" id="add_item_price_after_tax" value="0">
                </td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>:</td>
                <td id="add_unit_code"></td>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td>
                  <div class="input-group col-md-10">
                    <span class="input-group-btn">
                      <button id="add_btn_decrement" class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                    </span>
                    <input id="add_tx_amount" type="number" class="form-control num" value="1">
                    <span class="input-group-btn">
                      <button id="add_btn_increment" class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </span>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button id="add_btn_action" type="button" class="btn btn-info" onclick="add_item_action()"><i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal add item -->
    <div id="modal_add_custom" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Item Kustom</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Item</label>
              <input class="form-control keyboard" name="add_custom_name" id="add_custom_name" type="text" value="">
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Harga</label>
                  <input class="form-control num autonumeric" name="add_custom_price" id="add_custom_price" type="text" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Jumlah</label>
                  <input class="form-control num autonumeric" name="add_custom_amount" id="add_custom_amount" type="text" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button type="button" class="btn btn-info" onclick="add_custom_action()"><i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal edit item -->
    <div id="modal_edit_item" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div style="width:310px;" class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ubah Item</h4>
          </div>
          <div class="modal-body">
            <input id="edit_billing_detail_id" type="hidden" name="billing_detail_id" value="">
            <input id="edit_item_id" type="hidden" name="item_id" value="">
            <h4 class="cl-info text-center" id="edit_item_name"></h4>
            <br>
            <table class="table table-condensed table-sstriped">
              <tr>
                <td>Barcode</td>
                <td>:</td>
                <td id="edit_item_barcode"></td>
              </tr>
              <tr>
                <td>Kategori</td>
                <td>:</td>
                <td id="edit_category_name"></td>
              </tr>
              <tr>
                <td>Harga</td>
                <td>:</td>
                <td>
                  <input class="form-control num autonumeric" type="text" id="edit_item_price_after_tax" value="0">
                </td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>:</td>
                <td id="edit_unit_code"></td>
              </tr>
              <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td>
                  <div class="input-group col-md-10">
                    <span class="input-group-btn">
                      <button id="edit_btn_decrement" class="btn btn-default" type="button"><i class="fa fa-minus"></i></button>
                    </span>
                    <input id="edit_tx_amount" type="number" class="form-control num" value="1">
                    <span class="input-group-btn">
                      <button id="edit_btn_increment" class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                    </span>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button id="edit_btn_action" type="button" class="btn btn-success" onclick="edit_item_action()"><i class="fa fa-refresh"></i> Perbarui</button>
            <button id="delete_btn_action" type="button" class="btn btn-danger" onclick="delete_item_action()"><i class="fa fa-trash"></i> Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Customer -->
    <div id="modal_customer" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ganti Pelanggan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Pelanggan</label>
              <select id="customer_list" class="form-control keyboard select2" name="">
                <?php foreach ($customer as $row): ?>
                  <option value="<?=$row->customer_id?>"><?=$row->customer_name?></option>
                <?php endforeach; ?>
              </select>
              <div class="form-group">
                <div class="form-group">
                  <label>Nama <small class="required-field">*</small></label>
                  <input id="lbl_customer_name" class="form-control input-sm" type="text" name="customer_name" value="" readonly>
                </div>
                <div class="form-group">
                  <label>Telepon <small class="required-field">*</small></label>
                  <input id="lbl_customer_phone" class="form-control input-sm" type="text" name="customer_phone" value="" readonly>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input id="lbl_customer_email" class="form-control input-sm" type="text" name="customer_email" value="" readonly>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input id="lbl_customer_address" class="form-control input-sm" type="text" name="customer_address" value="" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="add_customer()"><i class="fa fa-plus"></i> Tambah</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button id="customer_btn_choose" type="button" class="btn btn-info"><i class="fa fa-check"></i> Pilih</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Customer -->
    <div id="modal_add_customer" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <form id="form_add_customer" action="<?=base_url()?>res_cashier/add_customer" method="post">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pelanggan</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="form-group">
                  <label>Nama <small class="required-field">*</small></label>
                  <input class="form-control keyboard" type="text" name="customer_name" value="">
                </div>
                <div class="form-group">
                  <label>Telepon <small class="required-field">*</small></label>
                  <input class="form-control num" type="text" name="customer_phone" value="">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control keyboard" type="text" name="customer_email" value="">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input class="form-control keyboard" type="text" name="customer_address" value="">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Payment -->
    <div id="modal_payment" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Pembayaran</h4>
          </div>
          <div class="modal-body">
            <div id="change_section">
              <div id="change_label"></div>
              <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="fa fa-flag-checkered"></i> Selesai</button>
            </div>
            <div id="payment_section">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#cash" aria-controls="cash" role="tab" data-toggle="tab">Tunai</a></li>
                <li role="presentation"><a href="#card" aria-controls="card" role="tab" data-toggle="tab">Kartu</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="cash">
                  <div class="form-group">
                    <label>Pembayaran</label>
                    <input id="payment_tx_payment" class="form-control autonumeric num" type="text" name="tx_payment" value="" autofocus onkeyup="calc_change()" onchange="calc_change()">
                  </div>
                  <div class="form-group">
                    <label>Kembali</label>
                    <input id="payment_tx_change" class="form-control" type="text" name="" value="" readonly>
                  </div>
                  <div id="payment_cash_status" class="">

                  </div>
                  <br>
                  <div class="">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    <button type="button" class="btn btn-success pull-right" onclick="payment_cash_action()"><i class="fa fa-check"></i> Ok</button>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="card">
                  <div class="form-group">
                    <label>Bank</label>
                    <select id="payment_card_bank_id" class="form-control keyboard select2" name="">
                      <?php foreach ($bank as $row): ?>
                        <option value="<?=$row->bank_id?>"><?=$row->bank_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nomor Kartu</label>
                    <input id="payment_card_bank_card_no" class="form-control num" type="text" name="" value="">
                  </div>
                  <div class="form-group">
                    <label>Nomor Referensi</label>
                    <input id="payment_card_bank_reference_no" class="form-control num" type="text" name="" value="">
                  </div>
                  <div id="payment_card_status" class="">

                  </div>
                  <div class="">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    <button type="button" class="btn btn-success pull-right" onclick="payment_card_action()"><i class="fa fa-check"></i> Ok</button>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div id="buyget_section">

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Pending -->
    <div id="modal_pending" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tahan Billing</h4>
          </div>
          <div class="modal-body">
            Apakah Anda ingin menahan billing ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button id="pending_btn_action" type="button" class="btn btn-info" onclick="pending_action()"><i class="fa fa-check"></i> Ya</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Cancel -->
    <div id="modal_cancel" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Batalkan Billing</h4>
          </div>
          <div class="modal-body">
            Apakah Anda ingin membatalkan billing ini?
            <div class="form-group">
              <label>Alasan Pembatalan</label>
              <textarea id="cancel_tx_cancel_notes" class="form-control keyboard" name="" row="2"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button id="cancel_btn_action" type="button" class="btn btn-info" onclick="cancel_action()"><i class="fa fa-check"></i> Ya</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal hold -->
    <div id="modal_hold" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">Billing Tertahan</div>
          <div class="modal-body">
            <table class="table table-condensed table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Pelanggan</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Jam</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody id="hold_list">

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal search -->
    <div id="modal_search" class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Pencarian Barang</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Berdasarkan</label>
                  <select id="search_type" class="form-control" name="search_type">
                    <option value="item_name">Nama</option>
                    <option value="item_barcode">Barcode</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pencarian</label>
                  <input id="search_name" class="form-control keyboard" type="text" name="search_name" value="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <button class="btn btn-info" type="button" name="button" onclick="action_search()"><i class="fa fa-search"></i> Cari</button>
                </div>
              </div>
            </div>
            <table id="search_table" class="table table-bordered table-striped table-hover table-condensed">
              <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Nama Item</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody id="search_row">

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
            <button id="cancel_btn_action" type="button" class="btn btn-info" onclick="cancel_action()"><i class="fa fa-check"></i> Ya</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
        $("#item-list").slimscroll({
          height: '100%'
        }).parent().css({
          'height' : 'calc(100% - 85px)'
        });
        $("#category-list").slimscroll({
          height: '100%'
        }).parent().css({
          'height' : '100%'
        });
        $("#bill-items").slimscroll({
          height: '100%'
        }).parent().css({
          'height' : 'calc(100% - (187px + 75px))'
        });

        //call new billing for first
        new_billing();
        //call get_all_item for first
        get_all_item();

        //change customer
        $("#customer_btn_choose").click(function () {
          $("#bill_customer_id").val($("#customer_list option:selected").val());
          $("#bill_customer_name").html($("#customer_list option:selected").html());
          $("#modal_customer").modal('hide');
        })

        $("#form_add_customer").validate({
          rules: {
            'customer_id': {
              required: true
            },
            'customer_name': {
              required: true
            },
            'customer_phone': {
              required: true
            }
          },
          messages: {
            'customer_id': {
              required: '<i style="color:red">Wajib diisi!</i>'
            },
            'customer_name': {
              required: '<i style="color:red">Wajib diisi!</i>'
            },
            'customer_phone': {
              required: '<i style="color:red">Wajib diisi!</i>'
            }
          },
          submitHandler: function(form) {
            $.ajax({
              url: form.action,
              type: form.method,
              data: $(form).serialize(),
              dataType: 'json',
              success: function(data) {
                $("#modal_add_customer").modal('hide');
                get_customer();
                //change customer
                $("#bill_customer_id").val(data.customer_id);
                $("#bill_customer_name").html(data.customer_name);
              }
            });
          }
        });

        $('#customer_list').on('change', function() {
          $.ajax({
            type: 'post',
            url: '<?=base_url()?>res_cashier/get_detail_customer',
            data: 'customer_id='+this.value,
            dataType: 'json',
            success: function(data) {
              $("#lbl_customer_name").val(data.customer_name);
              $("#lbl_customer_phone").val(data.customer_phone);
              $("#lbl_customer_email").val(data.customer_email);
              $("#lbl_customer_address").val(data.customer_address);
            }
          })
        });

        $('#payment_tx_payment').keypress(function (e) {
          if (e.which == 13) {
            payment_cash_action();
            return false;
          }
        });
      });

      // hold billing

      function appendHoldBilling(data) {
        $("#hold_list").html('');
        $.each(data, function(i, item) {
          var row = '<tr>'+
            '<td>TXS-'+item.tx_id+'</td>'+
            '<td>'+item.customer_name+'</td>'+
            '<td class="text-center">'+item.tx_date+'</td>'+
            '<td class="text-center">'+item.tx_time+'</td>'+
            '<td class="text-center">'+
              '<a class="btn btn-xs btn-success" onclick="get_billing_id('+item.tx_id+')"><i class="fa fa-refresh"></i></a>'
            '</td>'+
          '</tr>';
          $("#hold_list").append(row);
        })
      }

      function getHoldBilling() {
        $.ajax({
          type: 'post',
          url: '<?=base_url()?>res_cashier/get_hold_billing',
          dataType: 'json',
          success: function(data) {
            console.log(data);
            appendHoldBilling(data);
            $("#modal_hold").modal('show');
          }
        })
      }

      // get all detail action / append to billing
      function get_billing_id(tx_id) {
        $("#modal_hold").modal('hide');
        $.ajax({
          type: 'post',
          url : '<?=base_url()?>res_cashier/get_billing_now',
          data : 'tx_id='+tx_id,
          dataType : 'json',
          success : function (data) {
            $("#bill_tx_id").val(data.tx_id);
            $("#bill_tx_id_name").html('TXS-'+data.tx_id);
            $("#bill_tx_total_after_tax_nominal").html(sys_to_ind(data.tx_total_after_tax));
            $("#bill_tx_total_before_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_before_tax)));
            $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
            $("#bill_tx_total_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_tax)));
            $("#bill_tx_total_tax").val(data.tx_total_tax);
            $("#bill_tx_total_discount").val(data.tx_total_discount);
            $("#bill_tx_total_discount_nominal").html(sys_to_ind(data.tx_total_discount));
            $("#bill_tx_total_discount").val(data.tx_total_discount);
            $("#bill_tx_total_grand_nominal").html(sys_to_ind(data.tx_total_grand));
            $("#bill_tx_total_grand").val(data.tx_total_grand);
            $("#bill-list").html('');
            $.each(data.detail, function(i, item) {
              var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>'+
                '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
                '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(data.detail[i].tx_subtotal_after_tax)+'</span></div>'+
                '<ul>'+
                  '<li>@ '+sys_to_ind(data.detail[i].item_price_after_tax);

              if(data.detail[i].tx_subtotal_discount != 0){
                html += ' Disc ('+sys_to_ind(data.detail[i].tx_subtotal_discount)+')</li>';
              }

              html +=
                '</ul>'+
              '</li>';

              $("#bill-list").append(html);
            })
            $("#buyget_section").html('');
            if(data.buyget != ''){
              $("#buyget_section").append('<div class="list-group"></div>');
              $("#buyget_section .list-group").append('<a class="list-group-item active">Anda berhak mendapatkan</a>');
              $.each(data.buyget, function(i, item) {
                var html = '<a class="list-group-item">'+
                  '<span class="badge">'+data.buyget[i].get_amount+'</span>'+
                  data.buyget[i].item_name+
                  '</a>';
                $("#buyget_section .list-group").append(html);
              })
            }
            // disabled button
            $("#bill_btn_payment").prop('disabled', false);
            $("#bill_btn_pending").prop('disabled', false);
            $("#bill_btn_cancel").prop('disabled', false);
          }
        })
      }

      //customer add
      function add_customer() {
        $("#modal_customer").modal('hide');
        $("#modal_add_customer").modal('show');
      }

      //increment amount
      $("#add_btn_increment").click(function () {
        var tx_amount = $("#add_tx_amount").val();
        $("#add_tx_amount").val(++tx_amount);
      })
      //decrement amount
      $("#add_btn_decrement").click(function () {
        var tx_amount = $("#add_tx_amount").val();
        if(tx_amount > 1){
          $("#add_tx_amount").val(--tx_amount);
        }
      })
      //increment amount
      $("#edit_btn_increment").click(function () {
        var tx_amount = $("#edit_tx_amount").val();
        $("#edit_tx_amount").val(++tx_amount);
      })
      //decrement amount
      $("#edit_btn_decrement").click(function () {
        var tx_amount = $("#edit_tx_amount").val();
        if(tx_amount > 1){
          $("#edit_tx_amount").val(--tx_amount);
        }
      })
      //new biling
      function new_billing() {
        get_customer();
        appendHoldBilling();
        $.ajax({
          type: 'post',
          url: '<?=base_url()?>res_cashier/new_billing',
          dataType: 'json',
          success: function (data) {
            // first customer
            $("#bill_customer_id").val(data.customer.customer_id);
            $("#bill_customer_name").html(data.customer.customer_name);
            // cashier
            $("#bill_cashier_id").val(data.cashier.cashier_id);
            $("#bill_cashier_name").html(data.cashier.cashier_name);
            // Bill
            $("#bill_tx_id").val(data.tx_id);
            $("#bill_tx_receipt_no").val(data.tx_receipt_no);
            $("#bill_tx_id_name").html(data.tx_id_name);
            $("#bill_tx_date").val(data.tx_date);
            $("#bill_tx_time").val(data.tx_time);
            $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
            $("#bill_tx_total_after_tax_nominal").html(data.tx_total_after_tax);
            $("#bill_tx_total_discount").val(data.tx_total_discount);
            $("#bill_tx_total_discount_nominal").html(data.tx_total_discount);
            $("#bill_tx_total_tax").val(data.tx_total_tax);
            $("#bill_tx_total_tax_nominal").html(data.tx_total_tax);
            $("#bill_tx_total_grand").val(data.tx_total_grand);
            $("#bill_tx_total_grand_nominal").html(data.tx_total_grand);
            // disabled button
            $("#bill_btn_payment").prop('disabled', true);
            $("#bill_btn_pending").prop('disabled', true);
            $("#bill_btn_cancel").prop('disabled', true);
            // clear billing
            $("#bill-list").html('');
          }
        })
      }

      //append table item
      function append_item(data) {
        $("#item-row").html('');
        $.each(data, function(i, item) {
          var row;
          row = '<tr onclick="add_item_show('+item.item_id+')">'+
            '<td class="lbl-barcode">'+item.item_barcode+'</td>'+
            '<td class="lbl-item_name">'+item.item_name+'</td>'+
            '<td class="lbl-category_name">'+item.category_name+'</td>'+
            <?php if($client->client_is_taxed == 0): ?>
            '<td class="lbl-item_price_after_tax text-right">'+sys_to_ind(Math.round(item.item_price_before_tax))+'</td>'+
            <?php else: ?>
            '<td class="lbl-item_price_after_tax text-right">'+sys_to_ind(Math.round(item.item_price_after_tax))+'</td>'+
            <?php endif; ?>
            '</tr>';
          $("#item-row").append(row);
        })
      }
      //get all item
      function get_all_item() {
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/get_all_item',
          dataType : 'json',
          success : function (data) {
            append_item(data);
          }
        })
      }
      //get item by category
      function get_item_by_category(id) {
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/get_item_by_category',
          data : 'category_id='+id,
          dataType : 'json',
          success : function (data) {
            append_item(data);
          }
        })
      }
      //get_item_search
      function get_item_search() {
        var search_term = $("#search_term").val();
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/get_item_search',
          data : 'search_term='+search_term,
          dataType : 'json',
          success : function (data) {
            append_item(data);
          }
        })
      }
      //add item show
      function add_item_show(id) {
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/add_item_show',
          data : 'item_id='+id,
          dataType : 'json',
          success : function (data) {
            $("#add_item_id").val(data.item_id);
            $("#add_item_name").html(data.item_name);
            $("#add_item_barcode").html(data.item_barcode);
            <?php if($client->client_is_taxed == 0):?>
            $("#add_item_price_after_tax").val(sys_to_ind(Math.round(data.item_price_before_tax)));
            <?php else:?>
            $("#add_item_price_after_tax").val(sys_to_ind(Math.round(data.item_price_after_tax)));
            <?php endif; ?>
            $("#add_category_name").html(data.category_name);
            $("#add_unit_code").html(data.unit_code);
            $("#modal_add_item").modal('show');
            $("#modal_search").modal('hide');
            $("#add_tx_amount").val(1);
          }
        })
      }
      //add item action
      function add_item_action() {
        var tx_id = $("#bill_tx_id").val();
        var tx_receipt_no = $("#bill_tx_receipt_no").val();
        var customer_id = $("#bill_customer_id").val();
        var tx_date = $("#bill_tx_date").val();
        var tx_time = $("#bill_tx_time").val();
        var item_id = $("#add_item_id").val();
        var tx_amount = $("#add_tx_amount").val();
        var item_price = $("#add_item_price_after_tax").val();

        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/add_item_action',
          data : 'tx_id='+tx_id+'&tx_receipt_no='+tx_receipt_no+'&customer_id='+customer_id+'&tx_date='+tx_date+
            '&tx_time='+tx_time+'&item_id='+item_id+'&tx_amount='+tx_amount+'&item_price='+item_price,
          success : function (data) {
            get_billing_now();
            $("#modal_add_item").modal('hide');
            // enable button
            $("#bill_btn_payment").prop('disabled', false);
            $("#bill_btn_pending").prop('disabled', false);
            $("#bill_btn_cancel").prop('disabled', false);
          }
        })
      }
      // get all detail action / append to billing
      function get_billing_now() {
        var tx_id = $("#bill_tx_id").val();
        $.ajax({
          type: 'post',
          url : '<?=base_url()?>res_cashier/get_billing_now',
          data : 'tx_id='+tx_id,
          dataType : 'json',
          success : function (data) {
            $("#bill_tx_total_after_tax_nominal").html(sys_to_ind(data.tx_total_after_tax));
            $("#bill_tx_total_before_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_before_tax)));
            $("#bill_tx_total_after_tax").val(data.tx_total_after_tax);
            $("#bill_tx_total_tax_nominal").html(sys_to_ind(Math.round(data.tx_total_tax)));
            $("#bill_tx_total_tax").val(data.tx_total_tax);
            $("#bill_tx_total_discount").val(data.tx_total_discount);
            $("#bill_tx_total_discount_nominal").html(sys_to_ind(data.tx_total_discount));
            $("#bill_tx_total_discount").val(data.tx_total_discount);
            $("#bill_tx_total_grand_nominal").html(sys_to_ind(Math.round(data.tx_total_grand)));
            $("#bill_tx_total_grand").val(data.tx_total_grand);
            $("#bill-list").html('');
            $.each(data.detail, function(i, item) {
              var client_is_taxed = <?=$client->client_is_taxed?>;
              if (client_is_taxed == 0) {
                // Harga Sebelum Pajak
                var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>'+
                  '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
                  '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_before_tax))+'</span></div>'+
                  '<ul>'+
                    '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_before_tax));
              }else{
                // Harga Sesudah Pajak
                var html = '<li onclick=edit_item_show('+data.detail[i].billing_detail_id+')>'+
                  '<div class="amount">'+data.detail[i].tx_amount+'</div>'+
                  '<div class="name">'+data.detail[i].item_name+' <span class="price">'+sys_to_ind(Math.round(data.detail[i].tx_subtotal_after_tax))+'</span></div>'+
                  '<ul>'+
                    '<li>@ '+sys_to_ind(Math.round(data.detail[i].item_price_after_tax));
              }

              if(data.detail[i].tx_subtotal_discount != 0){
                html += ' Disc ('+sys_to_ind(data.detail[i].tx_subtotal_discount)+')</li>';
              }

              html +=
                '</ul>'+
              '</li>';

              $("#bill-list").append(html);
            })
            $("#buyget_section").html('');
            if(data.buyget != ''){
              $("#buyget_section").append('<div class="list-group"></div>');
              $("#buyget_section .list-group").append('<a class="list-group-item active">Anda berhak mendapatkan</a>');
              $.each(data.buyget, function(i, item) {
                var html = '<a class="list-group-item">'+
                  '<span class="badge">'+data.buyget[i].get_amount+'</span>'+
                  data.buyget[i].item_name+
                  '</a>';
                $("#buyget_section .list-group").append(html);
              })
            }
          }
        })
      }

      //edit item show
      function edit_item_show(id) {
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/edit_item_show',
          data : 'billing_detail_id='+id,
          dataType : 'json',
          success : function (data) {
            $("#edit_billing_detail_id").val(data.billing_detail_id);
            $("#edit_item_id").val(data.item_id);
            $("#edit_item_name").html(data.item_name);
            $("#edit_item_barcode").html(data.item_barcode);
            $("#edit_item_price_after_tax").val(sys_to_ind(data.item_price_after_tax));
            $("#edit_category_name").html(data.category_name);
            $("#edit_unit_code").html(data.unit_code);
            $("#edit_tx_amount").val(data.tx_amount);
            $("#modal_edit_item").modal('show');
          }
        })
      }

      function edit_item_action()
      {
        var tx_id = $("#bill_tx_id").val();
        var item_id = $("#edit_item_id").val();
        var tx_amount = $("#edit_tx_amount").val();
        var billing_detail_id = $("#edit_billing_detail_id").val();
        var item_price = $("#edit_item_price_after_tax").val();

        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/edit_item_action',
          data : 'tx_id='+tx_id+'&item_id='+item_id+'&tx_amount='+tx_amount+
            '&billing_detail_id='+billing_detail_id+'&item_price='+item_price,
          success : function () {
            $("#modal_edit_item").modal('hide');
            get_billing_now();
          }
        })
      }

      function delete_item_action()
      {
        var tx_id = $("#bill_tx_id").val();
        var billing_detail_id = $("#edit_billing_detail_id").val();
        var item_id = $("#edit_item_id").val();

        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/delete_item_action',
          data : 'tx_id='+tx_id+'&billing_detail_id='+billing_detail_id+"&item_id="+item_id,
          success : function () {
            $("#modal_edit_item").modal('hide');
            get_billing_now();
          }
        })
      }

      // change customer idea
      function change_customer_show() {
        $("#modal_customer").modal('show');
      }

      // payment show
      function payment_show() {
        $("#change_section").hide();
        $("#payment_section").show();
        $("#payment_card_bank_card_no").val('');
        $("#payment_card_bank_reference_no").val('');
        $("#payment_tx_payment").val('');
        $("#payment_tx_change").val('');
        $("#modal_payment").modal('show');
      }

      function calc_change() {
        var tx_total_grand = $("#bill_tx_total_grand").val();
        var tx_payment = ind_to_sys($("#payment_tx_payment").val());
        var tx_change = parseFloat(ind_to_sys(tx_payment)) - parseFloat(tx_total_grand);

        if (tx_change >= 0) {
          $("#payment_tx_change").val(sys_to_ind(Math.round(tx_change)));
        }
      }

      function payment_cash_action() {
        var tx_id = $("#bill_tx_id").val();
        var tx_total_grand = $("#bill_tx_total_grand").val();
        var tx_payment = ind_to_sys($("#payment_tx_payment").val());
        var tx_change = parseFloat(ind_to_sys(tx_payment)) - parseFloat(tx_total_grand);

        if (tx_payment == '') {
          $("#payment_cash_status").html('<i class="cl-danger">Silakan isi nominal !</i>');
          setTimeout(function(){
            $('#payment_cash_status').html('');
          }, 1500);
        }else if(tx_change < 0){
          $("#payment_cash_status").html('<i class="cl-danger">Pembayaran kurang !</i>');
          setTimeout(function(){
            $('#payment_cash_status').html('');
          }, 1500);
        }else{
          $.ajax({
            type : 'post',
            url : '<?=base_url()?>res_cashier/payment_cash_action',
            data : 'tx_id='+tx_id+'&tx_payment='+tx_payment,
            dataType : 'json',
            success : function (data) {
              $("#payment_section").hide();
              $("#change_section").show();
              $("#bill_tx_total_before_tax_nominal").html('');
              printBill();
              $("#change_label").html('<h5>Kembalian</h5><h3>'+sys_to_cur(Math.round(tx_change))+'</h3>');
              new_billing();
              send_dashboard(data);
            }
          })
        }
      }

      function payment_card_action() {
        var tx_id = $("#bill_tx_id").val();
        var tx_total_grand = $("#bill_tx_total_grand").val();
        var tx_payment = tx_total_grand;
        var tx_change = 0;
        var bank_id = $("#payment_card_bank_id").val();
        var bank_card_no = $("#payment_card_bank_card_no").val();
        var bank_reference_no = $("#payment_card_bank_reference_no").val();

        if (bank_card_no == '') {
          $("#payment_card_status").html('<i class="cl-danger">Silakan isi no kartu !</i>');
          setTimeout(function(){
            $('#payment_card_status').html('');
          }, 1500);
        }else{
          $.ajax({
            type : 'post',
            url : '<?=base_url()?>res_cashier/payment_card_action',
            dataType : 'json',
            data : 'tx_id='+tx_id+'&bank_id='+bank_id+
              '&bank_card_no='+bank_card_no+'&bank_reference_no='+bank_reference_no+
              '&tx_payment='+tx_payment+'&tx_change='+tx_change,
            success : function (data) {
              $("#modal_payment").modal('hide');
              printBill();
              new_billing();
              send_dashboard(data);
            }
          })
        }
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
            console.log(jqXHR.status);
            console.log(errorThrown);
          }
        })
        // console.log(data);
      }

      function update_data(id) {
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>update_data.php',
          data : 'id='+id,
          dataType : 'json',
          success : function (data) {
            console.log('ok');
          }
        })
      }

      //pending show
      function pending_show() {
        $("#modal_pending").modal('show');
      }
      function pending_action() {
        var tx_id = $("#bill_tx_id").val();

        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/pending_action',
          data : 'tx_id='+tx_id,
          success : function () {
            $("#modal_pending").modal('hide');
            new_billing();
          }
        })
      }

      function get_customer() {
        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/get_customer',
          dataType : 'json',
          success : function (data) {
            $("#customer_list").html('');
            $.each(data, function() {
              $("#customer_list").append($("<option/>").val(this.customer_id).text(this.customer_name));
            });
          }
        })
      }

      //cancel show
      function cancel_show() {
        $("#modal_cancel").modal('show');
        $("#cancel_tx_cancel_notes").val('');
      }

      function cancel_action() {
        var tx_id = $("#bill_tx_id").val();
        var tx_cancel_notes = $("#cancel_tx_cancel_notes").val();

        $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/cancel_action',
          data : 'tx_id='+tx_id+'&tx_cancel_notes='+tx_cancel_notes,
          success : function () {
            $("#modal_cancel").modal('hide');
            new_billing();
          }
        })
      }

      function printBill() {
        var tx_id = $("#bill_tx_id").val();
        $.ajax({
          type: 'post',
          url : '<?=base_url()?>res_cashier/print_bill',
          data : 'tx_id='+tx_id,
          success : function () {

          }
        })
      }

      function printLast() {
        var tx_id = $("#bill_tx_id").val()-1;
        $.ajax({
          type: 'post',
          url : '<?=base_url()?>res_cashier/print_bill',
          data : 'tx_id='+tx_id,
          success : function () {

          }
        })
      }



      function open_search() {
        $("#modal_search").modal('show');
      }

      function action_search() {
        var search_type = $("#search_type").val();
        var search_name = $("#search_name").val();

        if (search_name != '') {
          $.ajax({
            type: 'post',
            url : '<?=base_url()?>res_cashier/search_action',
            data : 'search_type='+search_type+'&search_name='+search_name,
            dataType : 'json',
            success : function (data) {
              console.log(data);
              $("#search_row").html('');
              $.each(data, function(i, item) {
                var row;
                row = '<tr onclick="add_item_show('+item.item_id+')" style="cursor:pointer">'+
                '<td class="lbl-barcode">'+item.item_barcode+'</td>'+
                '<td class="lbl-item_name">'+item.item_name+'</td>'+
                '<td class="lbl-category_name">'+item.category_name+'</td>'+
                '<td class="lbl-item_price_after_tax text-right">'+sys_to_ind(item.item_price_after_tax)+'</td>'+
                '</tr>';
                $("#search_row").append(row);
              })
            }
          });
        }
      }

      function add_custom_show() {
        $("#add_custom_name").val('');
        $("#add_custom_price").val('0');
        $("#add_custom_amount").val('1');
        $('#modal_add_custom').modal('show');
      }

      function add_custom_action() {
        var tx_id = $("#bill_tx_id").val();
        var tx_receipt_no = $("#bill_tx_receipt_no").val();
        var customer_id = $("#bill_customer_id").val();
        var tx_date = $("#bill_tx_date").val();
        var tx_time = $("#bill_tx_time").val();
        var item_name = $("#add_custom_name").val();
        var item_price = $("#add_custom_price").val();
        var tx_amount = $("#add_custom_amount").val();

        if(item_name == '' || item_price == 0){
          alert('Isi semua data');
        }else{
          $.ajax({
          type : 'post',
          url : '<?=base_url()?>res_cashier/add_custom_action',
          data : 'tx_id='+tx_id+'&tx_receipt_no='+tx_receipt_no+'&customer_id='+customer_id+'&tx_date='+tx_date+
            '&tx_time='+tx_time+'&item_name='+item_name+'&tx_amount='+tx_amount+'&item_price='+item_price,
          success : function (data) {
            get_billing_now();
            $("#modal_add_custom").modal('hide');
            // enable button
            $("#bill_btn_payment").prop('disabled', false);
            $("#bill_btn_pending").prop('disabled', false);
            $("#bill_btn_cancel").prop('disabled', false);
          }
        })
        }
      }

      // Shortcut keyboard
      $(document).bind('keydown', 'f2', function assets() {
        payment_show();
        return false;
      });
      $(document).bind('keydown', 'f3', function assets() {
        pending_show();
        return false;
      });
      $(document).bind('keydown', 'f4', function assets() {
        cancel_show();
        return false;
      });
      $(document).bind('keydown', 'f8', function assets() {
        open_search();
        return false;
      });
    </script>
  </body>
</html>
