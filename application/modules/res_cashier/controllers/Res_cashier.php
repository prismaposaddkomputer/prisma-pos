
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_cashier extends MY_Restaurant {

  var $access, $cashier_shift_id, $type_id;

  function __construct(){
    parent::__construct();

    $this->load->model('app_config/m_res_config');

    $this->role_id = $this->session->userdata('role_id');
    $this->module_controller = 'res_cashier';
    $this->access = $this->m_res_config->get_permission($this->role_id, $this->module_controller);

    $this->load->model('res_category/m_res_category');
    $this->load->model('res_customer/m_res_customer');
    $this->load->model('res_bank/m_res_bank');
    $this->load->model('res_shift/m_res_shift');
    $this->load->model('m_res_cashier');
    $this->load->model('res_client/m_res_client');
    $this->load->model('res_tax/m_res_tax');
    $this->load->model('app_install/m_app_install');
  }

  public function shift($shift_type)
  {
    $data['access'] = $this->access;
    $data['action'] = 'shift_action/'.$shift_type;

    if ($shift_type == 'open') {
      $data['title'] = 'Kasir (Masuk Shift)';
      $data['shift_type'] = '0';
    }else{
      $data['title'] = 'Kasir (Keluar Shift)';
      $data['shift_type'] = '1';
    }
    $this->view('res_cashier/shift', $data);
  }

  public function shift_action($shift_type)
  {
    $data = $_POST;

    if ($shift_type == 'open') {
      $data['money_in_total'] = $data['money_in_100k']*100000+$data['money_in_50k']*50000+
        $data['money_in_20k']*20000+$data['money_in_10k']*10000+
        $data['money_in_5k']*5000+$data['money_in_2k']*2000+$data['money_in_1k']*1000;
      $data['coin_in_total'] = $data['coin_in_1k']*1000+$data['coin_in_500']*500+
        $data['coin_in_200']*200+$data['coin_in_100']*100+$data['coin_in_50']*50+
        $data['coin_in_25']*25;
      $data['total_in'] = $data['money_in_total']+$data['coin_in_total'];

      $data['shift_in_status'] = 1;
      $data['shift_in_date'] = date('Y-m-d');
      $data['shift_in_time'] = date('H:i:s');
      $data['created_by'] = $this->session->userdata('user_realname');
      $this->m_res_shift->insert($data);
    }else{
      $data['money_out_total'] = $data['money_out_100k']*100000+$data['money_out_50k']*50000+
        $data['money_out_20k']*20000+$data['money_out_10k']*10000+
        $data['money_out_5k']*5000+$data['money_out_2k']*2000+$data['money_out_1k']*1000;
      $data['coin_out_total'] = $data['coin_out_1k']*1000+$data['coin_out_500']*500+
        $data['coin_out_200']*200+$data['coin_out_100']*100+$data['coin_out_50']*50+
        $data['coin_out_25']*25;
      $data['total_out'] = $data['money_out_total']+$data['coin_out_total'];

      $last = $this->m_res_shift->get_last();

      $data['shift_out_status'] = 1;
      $data['shift_out_date'] = date('Y-m-d');
      $data['shift_out_time'] = date('H:i:s');
      $data['updated_by'] = $this->session->userdata('user_realname');
      $this->m_res_shift->update($last->shift_id, $data);
    }

    redirect(base_url().'res_cashier/index');
  }

  public function index()
  {
    if ($this->access->_read == 1) {
      $last = $this->m_res_shift->get_last();

      if ($last == null) {
        redirect(base_url().'res_cashier/shift/open');
      }else {
        if ($last->shift_out_status == 1) {
          redirect(base_url().'res_cashier/shift/open');
        }else{
          $data['access'] = $this->access;
          $data['category'] = $this->m_res_category->get_all();
          $data['customer'] = $this->m_res_customer->get_all();
          $data['customer_first'] = $this->m_res_customer->get_first();
          $data['bank'] = $this->m_res_bank->get_all();
          $client = $this->m_res_client->get_all();
          $data['keyboard'] = $client->client_keyboard_status;
          $data['client'] = $client;

          $this->load->view('res_cashier/index',$data);
        }
      }

    }
  }

  public function new_billing()
  {
    //initial billing
    $this->m_res_cashier->initial_billing();
    // get last billing
    $last_billing = $this->m_res_cashier->get_last_billing();
    //declare billing variable
    if ($last_billing == null) {
      $data['tx_id'] = 1;
      $data['tx_receipt_no'] = date('ymd').'000001';
      $data['tx_id_name'] = 'TXS-'.$data['tx_receipt_no'];
    }else{
      $data['tx_id'] = $last_billing->tx_id+1;
      if ($last_billing->tx_date != date('Y-m-d') && $last_billing->tx_date != '0000-00-00') {
        $data['tx_receipt_no'] = date('ymd').'000001';
      }else{
        $number = substr($last_billing->tx_receipt_no,6,12);
        $number = intval($number)+1;
        $data['tx_receipt_no'] = date('ymd').str_pad($number, 6, '0', STR_PAD_LEFT);
      }
      $data['tx_id_name'] = 'TXS-'.$data['tx_receipt_no'];
    }
    $data['tx_date'] = date('Y-m-d');
    $data['tx_time'] = date('H:i:s');
    $data['tx_total_before_tax'] = 0;
    $data['tx_total_discount'] = 0;
    $data['tx_total_tax'] = 0;
    $data['tx_total_grand'] = 0;
    $data['tx_table_no'] = '-';
    //cashier
    $data['cashier']['cashier_id'] = $this->session->userdata('user_id');
    $data['cashier']['cashier_name'] = $this->session->userdata('user_realname');
    //get first customer (default)
    $data['customer'] = $this->m_res_cashier->get_first_customer();

    echo json_encode($data);
  }

  public function get_all_item()
  {
    $item = $this->m_res_cashier->get_all_item();
    echo json_encode($item);
  }

  public function get_item_by_category()
  {
    $id = $this->input->post('category_id');
    $item = $this->m_res_cashier->get_item_by_category($id);
    echo json_encode($item);
  }

  public function get_item_search()
  {
    $search_term = $this->input->post('search_term');
    $item = $this->m_res_cashier->get_item_search($search_term);
    echo json_encode($item);
  }

  public function add_item_show()
  {
    $id = $this->input->post('item_id');
    $item = $this->m_res_cashier->add_item_show($id);
    echo json_encode($item);
  }

  public function add_item_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    $item_id = $data['item_id'];

    //get item buy price
    $data_price = $this->m_res_cashier->get_item_price_buy_average($item_id);
    $item_price_buy_average = 0;
    if ($data_price->item_price_buy_average != null) {
      $item_price_buy_average = $data_price->item_price_buy_average;
    };

    // get item detail
    $this->load->model('res_item/m_res_item');
    $item = $this->m_res_item->get_by_id($item_id);
    // get tax detail
    $this->load->model('res_tax/m_res_tax');
    $tax = $this->m_res_tax->get_by_id($item->tax_id);

    //item price
    $client = $this->m_res_client->get_all();
    if ($client->client_is_taxed == 0) {
      $item_price_before_tax = price_to_num($data['item_price']);
      $item_tax = $item_price_before_tax*$tax->tax_ratio/100;
      $item_price_after_tax = $item_price_before_tax+$item_tax;
    }else{
      $item_price_after_tax = price_to_num($data['item_price']);
      $item_tax = ($tax->tax_ratio/(100+$tax->tax_ratio))*$item_price_after_tax;
      $item_price_before_tax = $item_price_after_tax-$item_tax;
    }
    
    // cek item exist
    $item_exist = $this->m_res_cashier->item_exist($tx_id, $item_id, price_to_num($data['item_price']));
    if ($item_exist != null) {
      $data['tx_amount'] += $item_exist->tx_amount;
    }

    //subtotal
    $tx_subtotal_tax = $data['tx_amount']*$item_tax;
    $tx_subtotal_discount = 0;
    $tx_subtotal_buy_average = $data['tx_amount']*$item_price_buy_average;
    $tx_subtotal_before_tax = $data['tx_amount']*$item_price_before_tax;
    $tx_subtotal_after_tax = $data['tx_amount']*$item_price_after_tax;
    //profit
    $tx_subtotal_profit_before_tax = $tx_subtotal_before_tax-$tx_subtotal_buy_average;
    $tx_subtotal_profit_after_tax = $tx_subtotal_profit_before_tax-$tx_subtotal_tax;

    //cek promo buy item
    $promo_buyitem = $this->m_res_cashier->get_promo_buyitem($item_id, $data['tx_amount']);
    if ($promo_buyitem != null) {
      // fold of discount
      $fold = floor($data['tx_amount']/$promo_buyitem->buy_amount);
      $tx_subtotal_discount = $fold*$promo_buyitem->get_discount*$promo_buyitem->buy_amount*$item_price_after_tax/100;

      $data_buyitem = array(
        'promo_buyitem_id' => $promo_buyitem->promo_buyitem_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyitem->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyitem->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyitem
      $billing_buyitem = $this->m_res_cashier->get_billing_buyitem($tx_id, $promo_buyitem->promo_buyitem_id);
      if ($billing_buyitem == null) {
        $this->m_res_cashier->insert_promo_buyitem($data_buyitem);
      }else{
        $this->m_res_cashier->update_promo_buyitem($tx_id, $promo_buyitem->promo_buyitem_id, $data_buyitem);
      }
    }

    // data for item
    $data_detail = array(
      'tx_id' => $data['tx_id'],
      'tx_type' => 'TXS',
      'item_id' => $item->item_id,
      'item_name' => $item->item_name,
      'item_price_before_tax' => $item_price_before_tax,
      'item_price_after_tax' => $item_price_after_tax,
      'item_price_buy_average' => $item_price_buy_average,
      'tx_amount' => $data['tx_amount'],
      'tx_subtotal_tax' => $tx_subtotal_tax,
      'tx_subtotal_discount' => $tx_subtotal_discount,
      'tx_subtotal_buy_average' => $tx_subtotal_buy_average,
      'tx_subtotal_before_tax' => $tx_subtotal_before_tax,
      'tx_subtotal_after_tax' => $tx_subtotal_after_tax,
      'tx_subtotal_profit_before_tax' => $tx_subtotal_profit_before_tax-$tx_subtotal_discount,
      'tx_subtotal_profit_after_tax' => $tx_subtotal_profit_after_tax-$tx_subtotal_discount
    );

    if ($item_exist != null) {
      // if item exist add item amount
      $this->m_res_cashier->update_detail($item_exist->billing_detail_id, $data_detail);
    }else{
      // else add new item
      $this->m_res_cashier->insert_detail($data_detail);
    }

    //cek promo buyget
    $promo_buyget = $this->m_res_cashier->get_promo_buyget($item_id, $data['tx_amount']);
    if ($promo_buyget != null) {
      $data_buyget = array(
        'promo_buyget_id' => $promo_buyget->promo_buyget_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyget->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_item_id' => $promo_buyget->get_item_id,
        'get_amount' => $promo_buyget->get_amount
      );

      //cek billing buyget
      $billing_buyget = $this->m_res_cashier->get_billing_buyget($tx_id, $promo_buyget->promo_buyget_id);
      if ($billing_buyget == null) {
        $this->m_res_cashier->insert_promo_buyget($data_buyget);
      }else{
        $this->m_res_cashier->update_promo_buyget($tx_id, $promo_buyget->promo_buyget_id, $data_buyget);
      }
    }

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $grand_discount = 0;
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $grand_discount = $tx_total_grand_before_discount*$promo_buyall->get_discount/100;
      $tx_total_discount += $grand_discount;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'tx_receipt_no' => $data['tx_receipt_no'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax-$grand_discount,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax-$grand_discount,
      'tx_total_grand' => $tx_total_grand
    );

    $exist = $this->m_res_cashier->get_billing_by_id($tx_id);
    if ($exist == null) {
      // insert into billing
      $data_billing['created_by'] = $this->session->userdata('user_realname');
      $this->m_res_cashier->insert_billing($data_billing);
    }else{
      // update billing
      $data_billing['updated_by'] = $this->session->userdata('user_realname');
      $this->m_res_cashier->update_billing($tx_id,$data_billing);
    }
  }

  public function add_custom_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    //get item buy price
    $item_price_buy_average = 0;

    // get tax detail
    $this->load->model('res_tax/m_res_tax');
    $tax = $this->m_res_tax->get_by_id(1);

    //item price
    $client = $this->m_res_client->get_all();
    if ($client->client_is_taxed == 0) {
      $item_price_before_tax = price_to_num($data['item_price']);
      $item_tax = $item_price_before_tax*$tax->tax_ratio/100;
      $item_price_after_tax = $item_price_before_tax+$item_tax;
    }else{
      $item_price_after_tax = price_to_num($data['item_price']);
      $item_tax = ($tax->tax_ratio/(100+$tax->tax_ratio))*$item_price_after_tax;
      $item_price_before_tax = $item_price_after_tax-$item_tax;
    }
    
    // cek item exist
    $item_exist = $this->m_res_cashier->item_exist_custom($tx_id, $data['item_name'], price_to_num($data['item_price']));
    if ($item_exist != null) {
      $data['tx_amount'] += $item_exist->tx_amount;
    }

    //subtotal
    $tx_subtotal_tax = $data['tx_amount']*$item_tax;
    $tx_subtotal_discount = 0;
    $tx_subtotal_buy_average = $data['tx_amount']*$item_price_buy_average;
    $tx_subtotal_before_tax = $data['tx_amount']*$item_price_before_tax;
    $tx_subtotal_after_tax = $data['tx_amount']*$item_price_after_tax;
    //profit
    $tx_subtotal_profit_before_tax = $tx_subtotal_before_tax-$tx_subtotal_buy_average;
    $tx_subtotal_profit_after_tax = $tx_subtotal_profit_before_tax-$tx_subtotal_tax;

    //cek promo buy item
    $promo_buyitem = $this->m_res_cashier->get_promo_buyitem($item_id, $data['tx_amount']);
    if ($promo_buyitem != null) {
      // fold of discount
      $fold = floor($data['tx_amount']/$promo_buyitem->buy_amount);
      $tx_subtotal_discount = $fold*$promo_buyitem->get_discount*$promo_buyitem->buy_amount*$item_price_after_tax/100;

      $data_buyitem = array(
        'promo_buyitem_id' => $promo_buyitem->promo_buyitem_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyitem->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyitem->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyitem
      $billing_buyitem = $this->m_res_cashier->get_billing_buyitem($tx_id, $promo_buyitem->promo_buyitem_id);
      if ($billing_buyitem == null) {
        $this->m_res_cashier->insert_promo_buyitem($data_buyitem);
      }else{
        $this->m_res_cashier->update_promo_buyitem($tx_id, $promo_buyitem->promo_buyitem_id, $data_buyitem);
      }
    }

    // data for item
    $data_detail = array(
      'tx_id' => $data['tx_id'],
      'tx_type' => 'TXS',
      'item_id' => '99',
      'is_custom' => 1,
      'item_name' => $data['item_name'],
      'item_price_before_tax' => $item_price_before_tax,
      'item_price_after_tax' => $item_price_after_tax,
      'item_price_buy_average' => $item_price_buy_average,
      'tx_amount' => $data['tx_amount'],
      'tx_subtotal_tax' => $tx_subtotal_tax,
      'tx_subtotal_discount' => $tx_subtotal_discount,
      'tx_subtotal_buy_average' => $tx_subtotal_buy_average,
      'tx_subtotal_before_tax' => $tx_subtotal_before_tax,
      'tx_subtotal_after_tax' => $tx_subtotal_after_tax,
      'tx_subtotal_profit_before_tax' => $tx_subtotal_profit_before_tax-$tx_subtotal_discount,
      'tx_subtotal_profit_after_tax' => $tx_subtotal_profit_after_tax-$tx_subtotal_discount
    );

    if ($item_exist != null) {
      // if item exist add item amount
      $this->m_res_cashier->update_detail($item_exist->billing_detail_id, $data_detail);
    }else{
      // else add new item
      $this->m_res_cashier->insert_detail($data_detail);
    }

    //cek promo buyget
    $promo_buyget = $this->m_res_cashier->get_promo_buyget($item_id, $data['tx_amount']);
    if ($promo_buyget != null) {
      $data_buyget = array(
        'promo_buyget_id' => $promo_buyget->promo_buyget_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyget->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_item_id' => $promo_buyget->get_item_id,
        'get_amount' => $promo_buyget->get_amount
      );

      //cek billing buyget
      $billing_buyget = $this->m_res_cashier->get_billing_buyget($tx_id, $promo_buyget->promo_buyget_id);
      if ($billing_buyget == null) {
        $this->m_res_cashier->insert_promo_buyget($data_buyget);
      }else{
        $this->m_res_cashier->update_promo_buyget($tx_id, $promo_buyget->promo_buyget_id, $data_buyget);
      }
    }

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $grand_discount = 0;
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $grand_discount = $tx_total_grand_before_discount*$promo_buyall->get_discount/100;
      $tx_total_discount += $grand_discount;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'tx_receipt_no' => $data['tx_receipt_no'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax-$grand_discount,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax-$grand_discount,
      'tx_total_grand' => $tx_total_grand
    );

    $exist = $this->m_res_cashier->get_billing_by_id($tx_id);
    if ($exist == null) {
      // insert into billing
      $data_billing['created_by'] = $this->session->userdata('user_realname');
      $this->m_res_cashier->insert_billing($data_billing);
    }else{
      // update billing
      $data_billing['updated_by'] = $this->session->userdata('user_realname');
      $this->m_res_cashier->update_billing($tx_id,$data_billing);
    }
  }

  public function delete_custom_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];
    $item_id = '99';

    //edit item
    $this->m_res_cashier->delete_custom_action($data['billing_detail_id']);

    //delete promo buyget
    //$this->m_res_cashier->delete_promo_buyitem($tx_id, $item_id);
    //delete promo buyget
    //$this->m_res_cashier->delete_promo_buyget($tx_id, $item_id);

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $tx_total_discount += $tx_total_grand_before_discount*$promo_buyall->get_discount/100;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyall($tx_id);
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($tx_id, $data_billing);
  }

  public function edit_custom_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    $item_id = '99';

    //get item buy price
    $data_price = $this->m_res_cashier->get_item_price_buy_average($item_id);
    $item_price_buy_average = 0;
    // if ($data_price->item_price_average != null) {
    //   $item_price_buy_average = $data_price->item_price_buy_average;
    // };

    // // get item detail
    // $this->load->model('res_item/m_res_item');
    // $item = $this->m_res_item->get_by_id($item_id);
    // get tax detail
    $this->load->model('res_tax/m_res_tax');
    $tax = $this->m_res_tax->get_by_id(1);

    //item price
    $client = $this->m_res_client->get_all();
    if ($client->client_is_taxed == 0) {
      $item_price_before_tax = price_to_num($data['item_price']);
      $item_tax = $item_price_before_tax*$tax->tax_ratio/100;
      $item_price_after_tax = $item_price_before_tax+$item_tax;
    }else{
      $item_price_after_tax = price_to_num($data['item_price']);
      $item_tax = ($tax->tax_ratio/(100+$tax->tax_ratio))*$item_price_after_tax;
      $item_price_before_tax = $item_price_after_tax-$item_tax;
    }
    //subtotal
    $tx_subtotal_tax = $data['tx_amount']*$item_tax;
    $tx_subtotal_discount = 0;
    $tx_subtotal_buy_average = $data['tx_amount']*$item_price_buy_average;
    $tx_subtotal_before_tax = $data['tx_amount']*$item_price_before_tax;
    $tx_subtotal_after_tax = $data['tx_amount']*$item_price_after_tax;
    //profit
    $tx_subtotal_profit_before_tax = $tx_subtotal_before_tax-$tx_subtotal_buy_average;
    $tx_subtotal_profit_after_tax = $tx_subtotal_profit_before_tax-$tx_subtotal_tax;

    //cek promo buy item
    $promo_buyitem = $this->m_res_cashier->get_promo_buyitem($item_id, $data['tx_amount']);
    if ($promo_buyitem != null) {
      // fold of discount
      $fold = floor($data['tx_amount']/$promo_buyitem->buy_amount);
      $tx_subtotal_discount = $fold*$promo_buyitem->get_discount*$promo_buyitem->buy_amount*$item_price_after_tax/100;

      $data_buyitem = array(
        'promo_buyitem_id' => $promo_buyitem->promo_buyitem_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyitem->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyitem->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyitem
      $billing_buyitem = $this->m_res_cashier->get_billing_buyitem($tx_id, $promo_buyitem->promo_buyitem_id);
      if ($billing_buyitem == null) {
        $this->m_res_cashier->insert_promo_buyitem($data_buyitem);
      }else{
        $this->m_res_cashier->update_promo_buyitem($tx_id, $promo_buyitem->promo_buyitem_id, $data_buyitem);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyitem($tx_id, $item_id);
    }

    // data for item
    $data_detail = array(
      'tx_id' => $data['tx_id'],
      'tx_type' => 'TXS',
      'item_id' => $item_id,
      'item_name' => $data['item_name'],
      'item_price_before_tax' => $item_price_before_tax,
      'item_price_after_tax' => $item_price_after_tax,
      'item_price_buy_average' => $item_price_buy_average,
      'tx_amount' => $data['tx_amount'],
      'tx_subtotal_tax' => $tx_subtotal_tax,
      'tx_subtotal_discount' => $tx_subtotal_discount,
      'tx_subtotal_buy_average' => $tx_subtotal_buy_average,
      'tx_subtotal_before_tax' => $tx_subtotal_before_tax,
      'tx_subtotal_after_tax' => $tx_subtotal_after_tax,
      'tx_subtotal_profit_before_tax' => $tx_subtotal_profit_before_tax,
      'tx_subtotal_profit_after_tax' => $tx_subtotal_profit_after_tax
    );
    // update item
    $this->m_res_cashier->update_detail($data['billing_detail_id'], $data_detail);
    //cek promo buyget
    $promo_buyget = $this->m_res_cashier->get_promo_buyget($item_id, $data['tx_amount']);
    if ($promo_buyget != null) {
      $data_buyget = array(
        'promo_buyget_id' => $promo_buyget->promo_buyget_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyget->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_item_id' => $promo_buyget->get_item_id,
        'get_amount' => $promo_buyget->get_amount
      );

      //cek billing buyget
      $billing_buyget = $this->m_res_cashier->get_billing_buyget($tx_id, $promo->promo_buyget_id);
      if ($billing_buyget == null) {
        $this->m_res_cashier->insert_promo_buyget($data_buyget);
      }else{
        $this->m_res_cashier->update_promo_buyget($tx_id, $promo->promo_buyget_id, $data_buyget);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyget($tx_id, $item_id);
    }

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $tx_total_discount += $tx_total_grand_before_discount*$promo_buyall->get_discount/100;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyall($tx_id,$item_id);
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($tx_id, $data_billing);
  }

  public function edit_return_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    $item_id = $data['item_id'];

    //get item buy price
    $data_price = $this->m_res_cashier->get_item_price_buy_average($item_id);
    $item_price_buy_average = 0;
    if ($data_price->item_price_average != null) {
      $item_price_buy_average = $data_price->item_price_buy_average;
    };

    // get item detail
    $this->load->model('res_item/m_res_item');
    $item = $this->m_res_item->get_by_id($item_id);
    // get tax detail
    $this->load->model('res_tax/m_res_tax');
    $tax = $this->m_res_tax->get_by_id($item->tax_id);

    //item price
    $client = $this->m_res_client->get_all();
    if ($client->client_is_taxed == 0) {
      $item_price_before_tax = price_to_num($data['item_price']);
      $item_tax = $item_price_before_tax*$tax->tax_ratio/100;
      $item_price_after_tax = $item_price_before_tax+$item_tax;
    }else{
      $item_price_after_tax = price_to_num($data['item_price']);
      $item_tax = ($tax->tax_ratio/(100+$tax->tax_ratio))*$item_price_after_tax;
      $item_price_before_tax = $item_price_after_tax-$item_tax;
    }
    //subtotal
    $tx_subtotal_tax = $data['tx_amount']*$item_tax;
    $tx_subtotal_discount = 0;
    $tx_subtotal_buy_average = $data['tx_amount']*$item_price_buy_average;
    $tx_subtotal_before_tax = $data['tx_amount']*$item_price_before_tax;
    $tx_subtotal_after_tax = $data['tx_amount']*$item_price_after_tax;
    //profit
    $tx_subtotal_profit_before_tax = $tx_subtotal_before_tax-$tx_subtotal_buy_average;
    $tx_subtotal_profit_after_tax = $tx_subtotal_profit_before_tax-$tx_subtotal_tax;

    //cek promo buy item
    $promo_buyitem = $this->m_res_cashier->get_promo_buyitem($item_id, $data['tx_amount']);
    if ($promo_buyitem != null) {
      // fold of discount
      $fold = floor($data['tx_amount']/$promo_buyitem->buy_amount);
      $tx_subtotal_discount = $fold*$promo_buyitem->get_discount*$promo_buyitem->buy_amount*$item_price_after_tax/100;

      $data_buyitem = array(
        'promo_buyitem_id' => $promo_buyitem->promo_buyitem_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyitem->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyitem->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyitem
      $billing_buyitem = $this->m_res_cashier->get_billing_buyitem($tx_id, $promo_buyitem->promo_buyitem_id);
      if ($billing_buyitem == null) {
        $this->m_res_cashier->insert_promo_buyitem($data_buyitem);
      }else{
        $this->m_res_cashier->update_promo_buyitem($tx_id, $promo_buyitem->promo_buyitem_id, $data_buyitem);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyitem($tx_id, $item_id);
    }

    // data for item
    $data_detail = array(
      'tx_id' => $data['tx_id'],
      'tx_type' => 'TXS',
      'item_id' => $item->item_id,
      'item_name' => $item->item_name,
      'item_price_before_tax' => $item_price_before_tax,
      'item_price_after_tax' => $item_price_after_tax,
      'item_price_buy_average' => $item_price_buy_average,
      'tx_amount' => $data['tx_amount'],
      'tx_subtotal_tax' => $tx_subtotal_tax,
      'tx_subtotal_discount' => $tx_subtotal_discount,
      'tx_subtotal_buy_average' => $tx_subtotal_buy_average,
      'tx_subtotal_before_tax' => $tx_subtotal_before_tax,
      'tx_subtotal_after_tax' => $tx_subtotal_after_tax,
      'tx_subtotal_profit_before_tax' => $tx_subtotal_profit_before_tax,
      'tx_subtotal_profit_after_tax' => $tx_subtotal_profit_after_tax
    );
    // update item
    $this->m_res_cashier->update_detail($data['billing_detail_id'], $data_detail);

    //cek promo buyget
    $promo_buyget = $this->m_res_cashier->get_promo_buyget($item_id, $data['tx_amount']);
    if ($promo_buyget != null) {
      $data_buyget = array(
        'promo_buyget_id' => $promo_buyget->promo_buyget_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyget->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_item_id' => $promo_buyget->get_item_id,
        'get_amount' => $promo_buyget->get_amount
      );

      //cek billing buyget
      $billing_buyget = $this->m_res_cashier->get_billing_buyget($tx_id, $promo->promo_buyget_id);
      if ($billing_buyget == null) {
        $this->m_res_cashier->insert_promo_buyget($data_buyget);
      }else{
        $this->m_res_cashier->update_promo_buyget($tx_id, $promo->promo_buyget_id, $data_buyget);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyget($tx_id, $item_id);
    }

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $tx_total_discount += $tx_total_grand_before_discount*$promo_buyall->get_discount/100;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyall($tx_id);
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($tx_id, $data_billing);
  }

  public function edit_custom_show()
  {
    $id = $this->input->post('billing_detail_id');
    $item = $this->m_res_cashier->edit_custom_show($id);
    echo json_encode($item);
  }

  public function edit_item_show()
  {
    $id = $this->input->post('billing_detail_id');
    $item = $this->m_res_cashier->edit_item_show($id);
    $client = $this->m_res_client->get_all();
    if ($client->client_is_taxed == 0) {
      $item->item_price_after_tax = $item->item_price_before_tax;
    }
    echo json_encode($item);
  }

  public function edit_item_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    $item_id = $data['item_id'];

    //get item buy price
    $data_price = $this->m_res_cashier->get_item_price_buy_average($item_id);
    $item_price_buy_average = 0;
    if ($data_price->item_price_average != null) {
      $item_price_buy_average = $data_price->item_price_buy_average;
    };

    // get item detail
    $this->load->model('res_item/m_res_item');
    $item = $this->m_res_item->get_by_id($item_id);
    // get tax detail
    $this->load->model('res_tax/m_res_tax');
    $tax = $this->m_res_tax->get_by_id($item->tax_id);

    //item price
    $client = $this->m_res_client->get_all();
    if ($client->client_is_taxed == 0) {
      $item_price_before_tax = price_to_num($data['item_price']);
      $item_tax = $item_price_before_tax*$tax->tax_ratio/100;
      $item_price_after_tax = $item_price_before_tax+$item_tax;
    }else{
      $item_price_after_tax = price_to_num($data['item_price']);
      $item_tax = ($tax->tax_ratio/(100+$tax->tax_ratio))*$item_price_after_tax;
      $item_price_before_tax = $item_price_after_tax-$item_tax;
    }
    //subtotal
    $tx_subtotal_tax = $data['tx_amount']*$item_tax;
    $tx_subtotal_discount = 0;
    $tx_subtotal_buy_average = $data['tx_amount']*$item_price_buy_average;
    $tx_subtotal_before_tax = $data['tx_amount']*$item_price_before_tax;
    $tx_subtotal_after_tax = $data['tx_amount']*$item_price_after_tax;
    //profit
    $tx_subtotal_profit_before_tax = $tx_subtotal_before_tax-$tx_subtotal_buy_average;
    $tx_subtotal_profit_after_tax = $tx_subtotal_profit_before_tax-$tx_subtotal_tax;

    //cek promo buy item
    $promo_buyitem = $this->m_res_cashier->get_promo_buyitem($item_id, $data['tx_amount']);
    if ($promo_buyitem != null) {
      // fold of discount
      $fold = floor($data['tx_amount']/$promo_buyitem->buy_amount);
      $tx_subtotal_discount = $fold*$promo_buyitem->get_discount*$promo_buyitem->buy_amount*$item_price_after_tax/100;

      $data_buyitem = array(
        'promo_buyitem_id' => $promo_buyitem->promo_buyitem_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyitem->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyitem->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyitem
      $billing_buyitem = $this->m_res_cashier->get_billing_buyitem($tx_id, $promo_buyitem->promo_buyitem_id);
      if ($billing_buyitem == null) {
        $this->m_res_cashier->insert_promo_buyitem($data_buyitem);
      }else{
        $this->m_res_cashier->update_promo_buyitem($tx_id, $promo_buyitem->promo_buyitem_id, $data_buyitem);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyitem($tx_id, $item_id);
    }

    // data for item
    $data_detail = array(
      'tx_id' => $data['tx_id'],
      'tx_type' => 'TXS',
      'item_id' => $item->item_id,
      'item_name' => $item->item_name,
      'item_price_before_tax' => $item_price_before_tax,
      'item_price_after_tax' => $item_price_after_tax,
      'item_price_buy_average' => $item_price_buy_average,
      'tx_amount' => $data['tx_amount'],
      'tx_subtotal_tax' => $tx_subtotal_tax,
      'tx_subtotal_discount' => $tx_subtotal_discount,
      'tx_subtotal_buy_average' => $tx_subtotal_buy_average,
      'tx_subtotal_before_tax' => $tx_subtotal_before_tax,
      'tx_subtotal_after_tax' => $tx_subtotal_after_tax,
      'tx_subtotal_profit_before_tax' => $tx_subtotal_profit_before_tax,
      'tx_subtotal_profit_after_tax' => $tx_subtotal_profit_after_tax
    );
    // update item
    $this->m_res_cashier->update_detail($data['billing_detail_id'], $data_detail);

    //cek promo buyget
    $promo_buyget = $this->m_res_cashier->get_promo_buyget($item_id, $data['tx_amount']);
    if ($promo_buyget != null) {
      $data_buyget = array(
        'promo_buyget_id' => $promo_buyget->promo_buyget_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyget->promo_type_code,
        'buy_item_id' => $item_id,
        'buy_amount' => $data['tx_amount'],
        'get_item_id' => $promo_buyget->get_item_id,
        'get_amount' => $promo_buyget->get_amount
      );

      //cek billing buyget
      $billing_buyget = $this->m_res_cashier->get_billing_buyget($tx_id, $promo->promo_buyget_id);
      if ($billing_buyget == null) {
        $this->m_res_cashier->insert_promo_buyget($data_buyget);
      }else{
        $this->m_res_cashier->update_promo_buyget($tx_id, $promo->promo_buyget_id, $data_buyget);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyget($tx_id, $item_id);
    }

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $tx_total_discount += $tx_total_grand_before_discount*$promo_buyall->get_discount/100;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyall($tx_id);
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($tx_id, $data_billing);
  }

  public function change_customer()
  {
    $data = $_POST;
    $this->m_res_cashier->update_billing($data['tx_id'], $data);
  }

  public function delete_item_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];
    $item_id = $data['item_id'];

    //edit item
    $this->m_res_cashier->delete_item_action($data['billing_detail_id']);

    //delete promo buyget
    $this->m_res_cashier->delete_promo_buyitem($tx_id, $item_id);
    //delete promo buyget
    $this->m_res_cashier->delete_promo_buyget($tx_id, $item_id);

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = 0;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //cek promo buy all
    $promo_buyall = $this->m_res_cashier->get_promo_buyall($tx_total_grand_before_discount);
    if ($promo_buyall != null) {
      // add discount discount
      $tx_total_discount += $tx_total_grand_before_discount*$promo_buyall->get_discount/100;

      $data_buyall = array(
        'promo_buyall_id' => $promo_buyall->promo_buyall_id,
        'tx_id' => $tx_id,
        'tx_type' => $promo_buyall->promo_type_code,
        'buy_amount' => $data['tx_amount'],
        'get_discount' => $promo_buyall->get_discount,
        'get_discount_amount' => $tx_subtotal_discount
      );

      //cek billing buyall
      $billing_buyall = $this->m_res_cashier->get_billing_buyall($tx_id, $promo_buyall->promo_buyall_id);
      if ($billing_buyall == null) {
        $this->m_res_cashier->insert_promo_buyall($data_buyall);
      }else{
        $this->m_res_cashier->update_promo_buyall($tx_id, $promo_buyall->promo_buyall_id, $data_buyall);
      }
    }else{
      $this->m_res_cashier->delete_promo_buyall($tx_id,$item_id);
    }

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //get customer detail
    $this->load->model('res_customer/m_res_customer');
    $customer = $this->m_res_customer->get_by_id($data['customer_id']);

    //data for billing
    $data_billing = array(
      'tx_id' => $data['tx_id'],
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'customer_id' => $data['customer_id'],
      'customer_name' => $customer->customer_name,
      'tx_type' => 'TXS',
      'tx_date' => $data['tx_date'],
      'tx_time' => $data['tx_time'],
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_grand' => 0,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($tx_id, $data_billing);
  }

  public function get_billing_now()
  {
    $tx_id = $this->input->post('tx_id');
    $detail = $this->m_res_cashier->get_billing_now($tx_id);
    echo json_encode($detail);
  }

  public function get_receipt()
  {
    $tx_id = $this->input->post('tx_id');
    $detail = $this->m_res_cashier->get_receipt($tx_id);
    echo json_encode($detail);
  }

  public function get_last_receipt()
  {
    $detail = $this->m_res_cashier->get_last_receipt();
    echo json_encode($detail);
  }

  public function pending_action()
  {
    $tx_id = $this->input->post('tx_id');
    $this->m_res_cashier->pending_action($tx_id);
  }

  public function cancel_action()
  {
    $tx_id = $this->input->post('tx_id');
    $tx_cancel_notes = $this->input->post('tx_cancel_notes');
    $this->m_res_cashier->cancel_action($tx_id,$tx_cancel_notes);
  }

  public function payment_cash_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    $billing = $this->m_res_cashier->get_billing_now($tx_id);

    $data_payment = array(
      'payment_type_id' => 1,
      'tx_payment' => price_to_num($data['tx_payment']),
      'tx_change' => price_to_num($data['tx_payment']) - ($billing->tx_total_grand - $billing->tx_down_payment),
      'tx_status' => 1
    );

    $this->m_res_cashier->payment_cash_action($tx_id, $data_payment);

    //insert to stock
    foreach ($billing->detail as $row) {
      $data_stock = null;

      //cek package
      $package = $this->m_res_cashier->check_package($row->item_id);
      if ($package != null) {
        foreach ($package as $row_package){
          $data_stock = array(
            'tx_id' => $billing->tx_id,
            'tx_type' => $billing->tx_type,
            'tx_date' => $billing->tx_date,
            'item_id' => $row_package->item_detail_id,
            'stock_out' => $row->tx_amount*-1,
            'created_by' => $this->session->userdata('user_realname')
          );
          $this->m_res_cashier->insert_stock($data_stock);
        };
      }else{
        $data_stock = array(
          'tx_id' => $billing->tx_id,
          'tx_type' => $billing->tx_type,
          'tx_date' => $billing->tx_date,
          'item_id' => $row->item_id,
          'stock_out' => $row->tx_amount*-1,
          'created_by' => $this->session->userdata('user_realname')
        );
        $this->m_res_cashier->insert_stock($data_stock);
      }
    }

    //insert to stock buyget promo
    $buyget = $this->m_res_cashier->get_promo_buyget_all($tx_id);
    foreach ($buyget as $row) {
      $data_buyget = null;
      $data_buyget = array(
        'tx_id' => $billing->tx_id,
        'tx_type' => $row->tx_type,
        'tx_date' => $billing->tx_date,
        'item_id' => $row->get_item_id,
        'stock_out' => $row->get_amount*-1,
        'created_by' => $this->session->userdata('user_realname')
      );
      $this->m_res_cashier->insert_stock($data_buyget);
    }

    $bill = $this->m_res_cashier->get_billing_by_id($tx_id);
    $client = $this->m_res_client->get_all();
    $app_install = $this->m_app_install->get_install();
    $tax = $this->m_res_tax->get_by_id(1);

    $dashboard = array(
      'auth'=> 'prismapos.addkomputer',
      'apikey'=> '69f86eadd81650164619f585bb017316',
      'app_type_id'=> $app_install['type_id'],
      'client_id'=> $client->client_id,
      'pos_sn'=> $client->client_serial_number,
      'npwpd'=> $client->client_npwpd,
      'customer_name'=> $bill->customer_name,
      'no_receipt'=> 'TRS-'.$bill->tx_receipt_no,
      'tx_id'=> $bill->tx_id,
      'tx_date'=> $bill->tx_date,
      'tx_time'=> $bill->tx_time,
      'tx_total_before_tax'=> $bill->tx_total_before_tax,
      'tax_code'=> $tax->tax_code,
      'tax_ratio'=> $tax->tax_ratio,
      'tx_total_tax'=> $bill->tx_total_tax,
      'tx_total_after_tax'=> $bill->tx_total_after_tax,
      'tx_total_grand'=> $bill->tx_total_grand,
      'user_id'=> $bill->user_id,
      'user_realname'=> $bill->user_realname,
      'created'=> $bill->created,
    );

    echo json_encode($dashboard);
  }

  public function payment_card_action()
  {
    $data = $_POST;
    $tx_id = $data['tx_id'];

    $billing = $this->m_res_cashier->get_billing_now($tx_id);

    $this->load->model('res_bank/m_res_bank');
    $bank = $this->m_res_bank->get_by_id($data['bank_id']);

    $data_payment = array(
      'payment_type_id' => $bank->payment_type_id,
      'bank_id' => $data['bank_id'],
      'bank_card_no' => $data['bank_card_no'],
      'tx_payment' => $data['tx_payment'],
      'tx_change' => $data['tx_change'],
      'tx_status' => 1
    );

    $this->m_res_cashier->payment_card_action($tx_id, $data_payment);

    //insert to stock
    foreach ($billing->detail as $row) {
      $data_stock = null;
      $data_stock = array(
        'tx_id' => $billing->tx_id,
        'tx_type' => $billing->tx_type,
        'tx_date' => $billing->tx_date,
        'item_id' => $row->item_id,
        'stock_out' => $row->tx_amount*-1,
        'created_by' => $this->session->userdata('user_realname')
      );
      $this->m_res_cashier->insert_stock($data_stock);
    }

    //insert to stock buyget promo
    $buyget = $this->m_res_cashier->get_promo_buyget_all($tx_id);
    foreach ($buyget as $row) {
      $data_buyget = null;
      $data_buyget = array(
        'tx_id' => $billing->tx_id,
        'tx_type' => $row->tx_type,
        'tx_date' => $billing->tx_date,
        'item_id' => $row->get_item_id,
        'stock_out' => $row->get_amount*-1,
        'created_by' => $this->session->userdata('user_realname')
      );
      $this->m_res_cashier->insert_stock($data_buyget);
    }

    $bill = $this->m_res_cashier->get_billing_by_id($tx_id);
    $client = $this->m_res_client->get_all();
    $app_install = $this->m_app_install->get_install();
    $tax = $this->m_res_tax->get_by_id(1);

    $dashboard = array(
      'auth'=> 'prismapos.addkomputer',
      'apikey'=> '69f86eadd81650164619f585bb017316',
      'app_type_id'=> $app_install['type_id'],
      'client_id'=> $client->client_id,
      'pos_sn'=> $client->client_serial_number,
      'npwpd'=> $client->client_npwpd,
      'customer_name'=> $bill->customer_name,
      'no_receipt'=> 'TRS-'.$bill->tx_receipt_no,
      'tx_id'=> $bill->tx_id,
      'tx_date'=> $bill->tx_date,
      'tx_time'=> $bill->tx_time,
      'tx_total_before_tax'=> $bill->tx_total_before_tax,
      'tax_code'=> $tax->tax_code,
      'tax_ratio'=> $tax->tax_ratio,
      'tx_total_tax'=> $bill->tx_total_tax,
      'tx_total_after_tax'=> $bill->tx_total_after_tax,
      'tx_total_grand'=> $bill->tx_total_grand,
      'user_id'=> $bill->user_id,
      'user_realname'=> $bill->user_realname,
      'created'=> $bill->created,
    );

    echo json_encode($dashboard);
  }

  public function get_customer()
  {
    $data = $this->m_res_customer->get_all();
    echo json_encode($data);
  }

  public function add_customer()
  {
    $data = $_POST;
    $this->m_res_customer->insert($data);

    $last = $this->m_res_customer->get_last();

    echo json_encode($last);
  }

  public function get_detail_customer()
  {
    $customer_id = $this->input->post('customer_id');
    $data = $this->m_res_customer->get_by_id($customer_id);
    echo json_encode($data);
  }

  public function get_hold_billing()
  {
    $user_id = $this->session->userdata('user_id');
    $data = $this->m_res_cashier->get_hold_billing($user_id);

    echo json_encode($data);
  }

  public function search_action()
  {
    $data = $_POST;
    $res = $this->m_res_cashier->search_action($data['search_type'],$data['search_name']);
    echo json_encode($res);
  }

  public function get_billing_by_receipt()
  {
    $data = $_POST;
    $bill = $this->m_res_cashier->get_billing_by_receipt($data['tx_receipt_no']);
    echo json_encode($bill);
  }

  public function down_payment_action()
  {
    $data = $_POST;
    $this->m_res_cashier->update_billing($data['tx_id'],array('tx_down_payment' => price_to_num($data['tx_down_payment'])));
  }

  public function update_discount_action()
  {
    $data = $_POST;
    $billing = $this->m_res_cashier->get_billing_by_id($data['tx_id']);
    $data_billing = array(
      'tx_total_discount' => price_to_num($data['tx_total_discount']),
      'tx_total_grand' => $billing->tx_total_after_tax-price_to_num($data['tx_total_discount'])
    );
    // echo json_encode($billing);
    $this->m_res_cashier->update_billing($data['tx_id'],$data_billing);
  }

  public function change_tx_table_no_action()
  {
    $data = $_POST;
    $this->m_res_cashier->update_billing($data['tx_id'],array('tx_table_no' => $data['tx_table_no']));
  }

  public function search_pending_action()
  {
    $search_pending = $this->input->post('search_pending');
    $data = $this->m_res_cashier->search_pending_action($search_pending);
    
    echo json_encode($data);
  }

  public function edit_return_item_action()
  {
    $data = $_POST;
    $item = $this->m_res_cashier->get_billing_detail_by_id($data['billing_detail_id']);
    $data['tx_amount'] = -1*$data['tx_amount'];

    $this->load->model('res_tax/m_res_tax');
    $tax = $this->m_res_tax->get_by_id(1);

    $item_price_before_tax = $item->item_price_before_tax;
    $item_tax = $item_price_before_tax*$tax->tax_ratio/100;
    $item_price_after_tax = $item_price_before_tax+$item_tax;
    //subtotal
    $tx_subtotal_tax = $data['tx_amount']*$item_tax;
    $tx_subtotal_discount = 0;
    $tx_subtotal_buy_average = $data['tx_amount']*$item->item_price_buy_average;
    $tx_subtotal_before_tax = $data['tx_amount']*$item_price_before_tax;
    $tx_subtotal_after_tax = $data['tx_amount']*$item_price_after_tax;
    //profit
    $tx_subtotal_profit_before_tax = $tx_subtotal_before_tax-$tx_subtotal_buy_average;
    $tx_subtotal_profit_after_tax = $tx_subtotal_profit_before_tax-$tx_subtotal_tax;

    $data_detail = array(
      'tx_id' => $item->tx_id,
      'tx_type' => 'TXS',
      'item_id' => $item->item_id,
      'item_name' => $item->item_name,
      'item_price_before_tax' => $item_price_before_tax,
      'item_price_after_tax' => $item_price_after_tax,
      'item_price_buy_average' => $item->item_price_buy_average,
      'tx_amount' => $data['tx_amount'],
      'tx_subtotal_tax' => $tx_subtotal_tax,
      'tx_subtotal_discount' => $tx_subtotal_discount,
      'tx_subtotal_buy_average' => $tx_subtotal_buy_average,
      'tx_subtotal_before_tax' => $tx_subtotal_before_tax,
      'tx_subtotal_after_tax' => $tx_subtotal_after_tax,
      'tx_subtotal_profit_before_tax' => $tx_subtotal_profit_before_tax-$tx_subtotal_discount,
      'tx_subtotal_profit_after_tax' => $tx_subtotal_profit_after_tax-$tx_subtotal_discount,
      'is_return' => 1
    );
    
    $cek = $this->m_res_cashier->cek_return($data_detail['tx_id'],$data_detail['item_id']);
    if ($cek != null) {
      // if item exist add item amount
      $this->m_res_cashier->update_detail($cek->billing_detail_id, $data_detail);
    }else{
      // else add new item
      $this->m_res_cashier->insert_detail($data_detail);
    }

    $billing = $this->m_res_cashier->get_billing_by_id($item->tx_id);

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = $billing->tx_total_discount;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($item->tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      // $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //data for billing
    $data_billing = array(
      'tx_id' => $item->tx_id,
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($item->tx_id, $data_billing);

    echo json_encode($data_detail);

  }

  public function delete_return_item_action()
  {
    $data = $_POST;
    $item = $this->m_res_cashier->get_billing_detail_by_id($data['billing_detail_id']);
    $tx_id = $item->tx_id;

    $this->m_res_cashier->delete_item_action($data['billing_detail_id']);

    $billing = $this->m_res_cashier->get_billing_by_id($tx_id);

    $tx_total_before_tax = 0;
    $tx_total_after_tax = 0;
    $tx_total_buy_average = 0;
    $tx_total_tax = 0;
    $tx_total_discount = $billing->tx_total_discount;
    $tx_total_grand = 0;
    $tx_total_profit_before_tax = 0;
    $tx_total_profit_after_tax = 0;
    $tx_total_grand = 0;

    //get all detail and count it
    $detail = $this->m_res_cashier->get_billing_detail($item->tx_id);
    foreach ($detail as $row) {
      $tx_total_buy_average += $row->tx_subtotal_buy_average;
      $tx_total_before_tax += $row->tx_subtotal_before_tax;
      $tx_total_after_tax += $row->tx_subtotal_after_tax;
      $tx_total_tax += $row->tx_subtotal_tax;
      // $tx_total_discount += $row->tx_subtotal_discount;
      $tx_total_profit_before_tax += $row->tx_subtotal_profit_before_tax;
      $tx_total_profit_after_tax += $row->tx_subtotal_profit_after_tax;
    }

    // grand total before discount
    $tx_total_grand_before_discount = $tx_total_after_tax-$tx_total_discount;

    //grand total after discount
    $tx_total_grand = $tx_total_after_tax-$tx_total_discount;

    //data for billing
    $data_billing = array(
      'tx_id' => $tx_id,
      'user_id' => $this->session->userdata('user_id'),
      'user_realname' => $this->session->userdata('user_realname'),
      'tx_total_buy_average' => $tx_total_buy_average,
      'tx_total_before_tax' => $tx_total_before_tax,
      'tx_total_after_tax' => $tx_total_after_tax,
      'tx_total_discount' => $tx_total_discount,
      'tx_total_tax' => $tx_total_tax,
      'tx_total_profit_before_tax' => $tx_total_profit_before_tax,
      'tx_total_profit_after_tax' => $tx_total_profit_after_tax,
      'tx_total_grand' => $tx_total_grand
    );

    //update billing
    $this->m_res_cashier->update_billing($tx_id, $data_billing);

    echo json_encode($data_billing);

  }

  public function print_bill()
  {
    $tx_id = $this->input->post('tx_id');
    $billing = $this->m_res_cashier->get_receipt($tx_id);
    $client = $this->m_res_client->get_all();

    $this->load->library("EscPos.php");

    if ($client->client_is_taxed == 1) {
      try {
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
  
        $printer = new Escpos\Printer($connector);

        //print image
        if ($client->client_logo !='') {
          $img = Escpos\EscposImage::load("img/".$client->client_logo);
          $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
          $printer -> bitImage($img);
          $printer -> feed();
        }
        
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> text($client->client_brand);
        $printer -> feed();
        $printer -> text($client->client_street.','.$client->client_district);
        $printer -> feed();
        $printer -> text($client->client_city);
        $printer -> feed();
        $printer -> text('NPWP : '.$client->client_npwp);
        $printer -> feed();
        $printer -> text('TXS-'.$billing->tx_receipt_no);
        $printer -> feed();
        $printer -> text($billing->customer_name);
        $printer -> feed();
        $printer -> text('Meja : '.$billing->tx_table_no);
        $printer -> feed();
        $printer -> text('--------------------------------');
        $printer -> feed();
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind(date("Y-m-d")).' '.date("H:i:s"));
        $printer -> feed();
        $printer -> text('--------------------------------');
        foreach ($billing->detail as $row) {
          $status = ($row->is_return == 1) ? '(Retur) ' : '' ;
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($status.$row->item_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text($row->tx_amount.' X '.num_to_price(round($row->item_price_after_tax,0,PHP_ROUND_HALF_UP)).' = '.num_to_price(round($row->tx_subtotal_after_tax,0,PHP_ROUND_HALF_UP)));
          $printer -> feed();
        };
        $space_array = array(
          strlen(num_to_price($billing->tx_total_after_tax)),
          strlen(num_to_price($billing->tx_payment)),
          strlen(num_to_price($billing->tx_change)),
          strlen(num_to_price($billing->tx_down_payment)),
          strlen(num_to_price($billing->tx_total_discount)),
          strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment))
        );
        $l_max = max($space_array);
        $l_1 = $l_max - strlen(num_to_price($billing->tx_total_after_tax));
        $s_1 = '';
        for ($i=0; $i < $l_1; $i++) {
          $s_1 .= ' ';
        };
        $l_2 = $l_max - strlen(num_to_price($billing->tx_payment));
        $s_2 = '';
        for ($i=0; $i < $l_2; $i++) {
          $s_2 .= ' ';
        };
        $l_3 = $l_max - strlen(num_to_price($billing->tx_change));
        $s_3 = '';
        for ($i=0; $i < $l_3; $i++) {
          $s_3 .= ' ';
        };
        $l_4 = $l_max - strlen(num_to_price($billing->tx_down_payment));
        $s_4 = '';
        for ($i=0; $i < $l_4; $i++) {
          $s_4 .= ' ';
        };
        $l_5 = $l_max - strlen(num_to_price($billing->tx_total_discount));
        $s_5 = '';
        for ($i=0; $i < $l_5; $i++) {
          $s_5 .= ' ';
        };
        $l_6 = $l_max - strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment));
        $s_6 = '';
        for ($i=0; $i < $l_6; $i++) {
          $s_6 .= ' ';
        };
        $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
        $printer -> text('--------------------------------');
        $printer -> text('Total Bersih = '.$s_1.num_to_price(round($billing->tx_total_after_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Diskon = '.$s_5.num_to_price($billing->tx_total_discount));
        $printer -> feed();
        $printer -> text('Uang Muka = '.$s_4.num_to_price($billing->tx_down_payment));
        $printer -> feed();
        $printer -> text('Sisa Bayar = '.$s_6.num_to_price($billing->tx_total_grand-$billing->tx_down_payment));
        $printer -> feed(2);
        $printer -> text('Dibayar = '.$s_2.num_to_price(round($billing->tx_payment,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Kembalian = '.$s_3.num_to_price(round($billing->tx_change,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);
        if ($billing->buyget != null) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text("Anda berhak mendapatkan :");
          $printer -> feed();
          foreach ($billing->buyget as $row) {
            $printer -> text('- '.$row->item_name.' ('.$row->get_amount.')');
            $printer -> feed();
          }
          $printer -> feed();
        }
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> feed();
        // $printer -> text('HPP = '.num_to_price(round($billing->tx_total_before_tax,0,PHP_ROUND_HALF_UP)));
        // $printer -> feed();
        // $printer -> text('Pajak Restoran = '.num_to_price(round($billing->tx_total_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> text('Harga sudah termasuk pajak 10%.');
        $printer -> feed();
        $printer -> text('Terimakasih atas kunjungan anda.');
        $printer -> feed(4);
        $printer -> pulse(0, 120, 240);
  
        /* Close printer */
        $printer -> close();
      } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
      }
    }else{
      try {
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
  
        $printer = new Escpos\Printer($connector);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //print image
        if ($client->client_logo !='') {
          $img = Escpos\EscposImage::load("img/".$client->client_logo);
          $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
          $printer -> bitImage($img);
          $printer -> feed();
        }
        $printer -> text($client->client_brand);
        $printer -> feed();
        $printer -> text($client->client_street.','.$client->client_district);
        $printer -> feed();
        $printer -> text($client->client_city);
        $printer -> feed();
        $printer -> text('NPWP : '.$client->client_npwp);
        $printer -> feed();
        $printer -> text('TXS-'.$billing->tx_receipt_no);
        $printer -> feed();
        $printer -> text($billing->customer_name);
        $printer -> feed();
        $printer -> text('--------------------------------');
        $printer -> feed();
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind($billing->tx_date).' '.$billing->tx_time);
        $printer -> feed();
        $printer -> text('--------------------------------');
        foreach ($billing->detail as $row) {
          $status = ($row->is_return == 1) ? '(Retur) ' : '' ;
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($status.$row->item_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text($row->tx_amount.' X '.num_to_price(round($row->item_price_before_tax,0,PHP_ROUND_HALF_UP)).' = '.num_to_price(round($row->tx_subtotal_before_tax,0,PHP_ROUND_HALF_UP)));
          $printer -> feed();
        };
        $space_array = array(
          strlen(num_to_price($billing->tx_total_before_tax)),
          strlen(num_to_price($billing->tx_total_tax)),
          strlen(num_to_price($billing->tx_total_after_tax)),
          strlen(num_to_price($billing->tx_down_payment)),
          strlen(num_to_price($billing->tx_total_discount)),
          strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment))
        );
        $l_max = max($space_array);
        $l_1 = $l_max - strlen(num_to_price($billing->tx_total_before_tax));
        $s_1 = '';
        for ($i=0; $i < $l_1; $i++) {
          $s_1 .= ' ';
        };
        $l_2 = $l_max - strlen(num_to_price($billing->tx_total_tax));
        $s_2 = '';
        for ($i=0; $i < $l_2; $i++) {
          $s_2 .= ' ';
        };
        $l_3 = $l_max - strlen(num_to_price($billing->tx_total_after_tax));
        $s_3 = '';
        for ($i=0; $i < $l_3; $i++) {
          $s_3 .= ' ';
        };
        $l_4 = $l_max - strlen(num_to_price($billing->tx_down_payment));
        $s_4 = '';
        for ($i=0; $i < $l_4; $i++) {
          $s_4 .= ' ';
        };
        $l_5 = $l_max - strlen(num_to_price($billing->tx_total_discount));
        $s_5 = '';
        for ($i=0; $i < $l_5; $i++) {
          $s_5 .= ' ';
        };
        $l_6 = $l_max - strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment));
        $s_6 = '';
        for ($i=0; $i < $l_6; $i++) {
          $s_6 .= ' ';
        };
        $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
        $printer -> text('--------------------------------');
        $printer -> text('Subtotal = '.$s_1.num_to_price(round($billing->tx_total_before_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Pajak Restoran = '.$s_2.num_to_price(round($billing->tx_total_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);

        $printer -> text('Total = '.$s_3.num_to_price(round($billing->tx_total_after_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Diskon = '.$s_5.num_to_price($billing->tx_total_discount));
        $printer -> feed();
        $printer -> text('Uang Muka = '.$s_4.num_to_price($billing->tx_down_payment));
        $printer -> feed();
        $printer -> text('Sisa Bayar = '.$s_6.num_to_price($billing->tx_total_grand-$billing->tx_down_payment));

        $printer -> feed(2);
        $printer -> text('Dibayar = '.num_to_price(round($billing->tx_payment,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $l_7 = $l_max - strlen(num_to_price($billing->tx_change));
        $s_7 = '';
        for ($i=0; $i < $l_7; $i++) {
          $s_7 .= ' ';
        };
        $printer -> text('Kembalian = '.$s_7.num_to_price(round($billing->tx_change,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);
        if ($billing->buyget != null) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text("Anda berhak mendapatkan :");
          $printer -> feed();
          foreach ($billing->buyget as $row) {
            $printer -> text('- '.$row->item_name.' ('.$row->get_amount.')');
            $printer -> feed();
          }
          $printer -> feed();
        }
        $printer -> text('Terimakasih atas kunjungan anda.');
        $printer -> feed(4);
        $printer -> pulse(0, 120, 240);
  
        /* Close printer */
        $printer -> close();
      } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
      }
    }
  }

  public function print_return()
  {
    $tx_id = $this->input->post('tx_id');
    $bill = $this->m_res_cashier->get_billing_by_id($tx_id);
    $data = array(
      'tx_change' => $bill->tx_payment-$bill->tx_total_grand
    );
    $this->m_res_cashier->update_billing($tx_id,$data);
    $this->print_bill();
  }

  public function print_dapur()
  {
    $tx_id = $this->input->post('tx_id');
    $billing = $this->m_res_cashier->get_receipt($tx_id);
    $client = $this->m_res_client->get_all();

    $this->load->library("EscPos.php");

    try {
      $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");

      $printer = new Escpos\Printer($connector);
      $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
      $printer -> text('STRUK DAPUR');
      $printer -> feed();
      $printer -> text('Pelanggan : '.$billing->customer_name);
      $printer -> feed();
      $printer -> text('Meja : '.$billing->tx_table_no);
      $printer -> feed();
      $printer -> text('--------------------------------');
      $printer -> feed();
      $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
      $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind(date("Y-m-d")).' '.date("H:i:s"));
      $printer -> feed();
      $printer -> text('--------------------------------');
      foreach ($billing->detail as $row) {
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> text($row->tx_amount.' X '.$row->item_name);
        $printer -> feed();
      };
      $printer -> text('--------------------------------');
      $printer -> feed(4);
      /* Close printer */
      $printer -> close();
    } catch (Exception $e) {
      echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }
  }

  public function print_receipt_dp()
  {
    $tx_id = $this->input->post('tx_id');
    $billing = $this->m_res_cashier->get_receipt($tx_id);
    $client = $this->m_res_client->get_all();

    $this->load->library("EscPos.php");

    if ($client->client_is_taxed == 1) {
      try {
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
  
        $printer = new Escpos\Printer($connector);

        //print image
        if ($client->client_logo !='') {
          $img = Escpos\EscposImage::load("img/".$client->client_logo);
          $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
          $printer -> bitImage($img);
          $printer -> feed();
        }
        
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> text($client->client_brand);
        $printer -> feed();
        $printer -> text($client->client_street.','.$client->client_district);
        $printer -> feed();
        $printer -> text($client->client_city);
        $printer -> feed();
        $printer -> text('NPWP : '.$client->client_npwp);
        $printer -> feed();
        $printer -> text('TXS-'.$billing->tx_receipt_no);
        $printer -> feed();
        $printer -> text($billing->customer_name);
        $printer -> feed();
        $printer -> text('Meja : '.$billing->tx_table_no);
        $printer -> feed();
        $printer -> text('Struk DP');
        $printer -> feed();
        $printer -> text('--------------------------------');
        $printer -> feed();
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind(date("Y-m-d")).' '.date("H:i:s"));
        $printer -> feed();
        $printer -> text('--------------------------------');
        foreach ($billing->detail as $row) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->item_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text($row->tx_amount.' X '.num_to_price(round($row->item_price_after_tax,0,PHP_ROUND_HALF_UP)).' = '.num_to_price(round($row->tx_subtotal_after_tax,0,PHP_ROUND_HALF_UP)));
          $printer -> feed();
        };
        $space_array = array(
          strlen(num_to_price($billing->tx_total_after_tax)),
          strlen(num_to_price($billing->tx_payment)),
          strlen(num_to_price($billing->tx_change)),
          strlen(num_to_price($billing->tx_down_payment)),
          strlen(num_to_price($billing->tx_total_discount)),
          strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment))
        );
        $l_max = max($space_array);
        $l_1 = $l_max - strlen(num_to_price($billing->tx_total_after_tax));
        $s_1 = '';
        for ($i=0; $i < $l_1; $i++) {
          $s_1 .= ' ';
        };
        $l_2 = $l_max - strlen(num_to_price($billing->tx_payment));
        $s_2 = '';
        for ($i=0; $i < $l_2; $i++) {
          $s_2 .= ' ';
        };
        $l_3 = $l_max - strlen(num_to_price($billing->tx_change));
        $s_3 = '';
        for ($i=0; $i < $l_3; $i++) {
          $s_3 .= ' ';
        };
        $l_4 = $l_max - strlen(num_to_price($billing->tx_down_payment));
        $s_4 = '';
        for ($i=0; $i < $l_4; $i++) {
          $s_4 .= ' ';
        };
        $l_5 = $l_max - strlen(num_to_price($billing->tx_total_discount));
        $s_5 = '';
        for ($i=0; $i < $l_5; $i++) {
          $s_5 .= ' ';
        };
        $l_6 = $l_max - strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment));
        $s_6 = '';
        for ($i=0; $i < $l_6; $i++) {
          $s_6 .= ' ';
        };
        $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
        $printer -> text('--------------------------------');
        $printer -> text('Total Bersih = '.$s_1.num_to_price(round($billing->tx_total_after_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Diskon = '.$s_5.num_to_price($billing->tx_total_discount));
        $printer -> feed();
        $printer -> text('Uang Muka = '.$s_4.num_to_price($billing->tx_down_payment));
        $printer -> feed();
        $printer -> text('Sisa Bayar = '.$s_6.num_to_price($billing->tx_total_grand-$billing->tx_down_payment));
        $printer -> feed(2);
        // $printer -> text('Dibayar = '.$s_2.num_to_price(round($billing->tx_payment,0,PHP_ROUND_HALF_UP)));
        // $printer -> feed();
        // $printer -> text('Kembalian = '.$s_3.num_to_price(round($billing->tx_change,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);
        if ($billing->buyget != null) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text("Anda berhak mendapatkan :");
          $printer -> feed();
          foreach ($billing->buyget as $row) {
            $printer -> text('- '.$row->item_name.' ('.$row->get_amount.')');
            $printer -> feed();
          }
          $printer -> feed();
        }
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> feed();
        // $printer -> text('HPP = '.num_to_price(round($billing->tx_total_before_tax,0,PHP_ROUND_HALF_UP)));
        // $printer -> feed();
        // $printer -> text('Pajak Restoran = '.num_to_price(round($billing->tx_total_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> text('Harga sudah termasuk pajak 10%.');
        $printer -> feed();
        $printer -> text('Terimakasih atas kunjungan anda.');
        $printer -> feed(4);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer -> feed(4);
        $printer -> pulse(0, 120, 240);
  
        /* Close printer */
        $printer -> close();
      } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
      }
    }else{
      try {
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58");
  
        $printer = new Escpos\Printer($connector);
        $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //print image
        if ($client->client_logo !='') {
          $img = Escpos\EscposImage::load("img/".$client->client_logo);
          $printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
          $printer -> bitImage($img);
          $printer -> feed();
        }
        $printer -> text($client->client_brand);
        $printer -> feed();
        $printer -> text($client->client_street.','.$client->client_district);
        $printer -> feed();
        $printer -> text($client->client_city);
        $printer -> feed();
        $printer -> text('NPWP : '.$client->client_npwp);
        $printer -> feed();
        $printer -> text('TXS-'.$billing->tx_receipt_no);
        $printer -> feed();
        $printer -> text($billing->customer_name);
        $printer -> feed();
        $printer -> text('Struk DP');
        $printer -> feed();
        $printer -> text('--------------------------------');
        $printer -> feed();
        $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
        $printer -> text(substr($billing->user_realname,0,12).' '.date_to_ind($billing->tx_date).' '.$billing->tx_time);
        $printer -> feed();
        $printer -> text('--------------------------------');
        foreach ($billing->detail as $row) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text($row->item_name);
          $printer -> feed();
          $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
          $printer -> text($row->tx_amount.' X '.num_to_price(round($row->item_price_before_tax,0,PHP_ROUND_HALF_UP)).' = '.num_to_price(round($row->tx_subtotal_before_tax,0,PHP_ROUND_HALF_UP)));
          $printer -> feed();
        };
        $space_array = array(
          strlen(num_to_price($billing->tx_total_before_tax)),
          strlen(num_to_price($billing->tx_total_tax)),
          strlen(num_to_price($billing->tx_total_after_tax)),
          strlen(num_to_price($billing->tx_down_payment)),
          strlen(num_to_price($billing->tx_total_discount)),
          strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment))
        );
        $l_max = max($space_array);
        $l_1 = $l_max - strlen(num_to_price($billing->tx_total_before_tax));
        $s_1 = '';
        for ($i=0; $i < $l_1; $i++) {
          $s_1 .= ' ';
        };
        $l_2 = $l_max - strlen(num_to_price($billing->tx_total_tax));
        $s_2 = '';
        for ($i=0; $i < $l_2; $i++) {
          $s_2 .= ' ';
        };
        $l_3 = $l_max - strlen(num_to_price($billing->tx_total_after_tax));
        $s_3 = '';
        for ($i=0; $i < $l_3; $i++) {
          $s_3 .= ' ';
        };
        $l_4 = $l_max - strlen(num_to_price($billing->tx_down_payment));
        $s_4 = '';
        for ($i=0; $i < $l_4; $i++) {
          $s_4 .= ' ';
        };
        $l_5 = $l_max - strlen(num_to_price($billing->tx_total_discount));
        $s_5 = '';
        for ($i=0; $i < $l_5; $i++) {
          $s_5 .= ' ';
        };
        $l_6 = $l_max - strlen(num_to_price($billing->tx_total_grand-$billing->tx_down_payment));
        $s_6 = '';
        for ($i=0; $i < $l_6; $i++) {
          $s_6 .= ' ';
        };
        $printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);
        $printer -> text('--------------------------------');
        $printer -> text('Subtotal = '.$s_1.num_to_price(round($billing->tx_total_before_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Pajak Restoran = '.$s_2.num_to_price(round($billing->tx_total_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);

        $printer -> text('Total = '.$s_3.num_to_price(round($billing->tx_total_after_tax,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $printer -> text('Diskon = '.$s_5.num_to_price($billing->tx_total_discount));
        $printer -> feed();
        $printer -> text('Uang Muka = '.$s_4.num_to_price($billing->tx_down_payment));
        $printer -> feed();
        $printer -> text('Sisa Bayar = '.$s_6.num_to_price($billing->tx_total_grand-$billing->tx_down_payment));

        $printer -> feed(2);
        // $printer -> text('Dibayar = '.num_to_price(round($billing->tx_payment,0,PHP_ROUND_HALF_UP)));
        $printer -> feed();
        $l_7 = $l_max - strlen(num_to_price($billing->tx_change));
        $s_7 = '';
        for ($i=0; $i < $l_7; $i++) {
          $s_7 .= ' ';
        };
        // $printer -> text('Kembalian = '.$s_7.num_to_price(round($billing->tx_change,0,PHP_ROUND_HALF_UP)));
        $printer -> feed(2);
        if ($billing->buyget != null) {
          $printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
          $printer -> text("Anda berhak mendapatkan :");
          $printer -> feed();
          foreach ($billing->buyget as $row) {
            $printer -> text('- '.$row->item_name.' ('.$row->get_amount.')');
            $printer -> feed();
          }
          $printer -> feed();
        }
        // $printer -> text('Terimakasih atas kunjungan anda.');
        $printer -> feed(4);
        $printer -> pulse(0, 120, 240);
  
        /* Close printer */
        $printer -> close();
      } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
      }
    }
  }

}
