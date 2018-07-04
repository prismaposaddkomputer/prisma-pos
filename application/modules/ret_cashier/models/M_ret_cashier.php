<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_cashier extends CI_Model {

  public function get_first_customer()
  {
    return $this->db
      ->order_by('customer_id','asc')
      ->get('ret_customer')
      ->row();
  }

  public function initial_billing()
  {
    $today = date('Y-m-d');

    //cancel all pending and process transaction before today
    $this->db
      ->query("UPDATE ret_billing
          SET tx_status = -2
          WHERE (tx_status = -1 OR tx_status = 0)
            AND tx_date < '$today'");

    //pending all process transaction today
    $this->db
      ->query("UPDATE ret_billing
          SET tx_status = -1
          WHERE tx_status = 0
            AND tx_date = '$today'");
  }

  public function get_last_billing()
  {
    return $this->db
      ->order_by('tx_id','desc')
      ->get('ret_billing')
      ->row();
  }

  public function get_billing_by_id($id)
  {
    return $this->db
      ->where('tx_id',$id)
      ->get('ret_billing')
      ->row();
  }

  public function get_billing_now($id)
  {
    $billing = $this->db->where('tx_id',$id)->get('ret_billing')->row();
    $billing->detail = $this->db
      ->where('tx_id',$id)
      ->get('ret_billing_detail')->result();
    $billing->buyget = $this->db
      ->join('ret_item','ret_billing_buyget.get_item_id = ret_item.item_id')
      ->where('tx_id',$id)
      ->get('ret_billing_buyget')->result();
    return $billing;
  }

  public function get_receipt($id)
  {

    $billing = $this->db->where('tx_id',$id)->get('ret_billing')->row();
    $billing->detail = $this->db
      ->where('tx_id',$id)
      ->get('ret_billing_detail')->result();
    $billing->buyget = $this->db
      ->join('ret_item','ret_billing_buyget.get_item_id = ret_item.item_id')
      ->where('tx_id',$id)
      ->get('ret_billing_buyget')->result();
    return $billing;
  }

  public function get_last_receipt()
  {
    $user_id = $this->session->userdata('user_id');

    $billing = $this->db
      ->where('user_id',$user_id)
      ->order_by('tx_id','desc')
      ->get('ret_billing')->row();

    $billing->client = $this->db->get('ret_client')->row();
    $billing->receipt = $this->db->get('ret_receipt')->row();
    $billing->detail = $this->db
      ->where('tx_id',$billing->tx_id)
      ->get('ret_billing_detail')->result();
    $billing->buyget = $this->db
      ->join('ret_item','ret_billing_buyget.get_item_id = ret_item.item_id')
      ->where('tx_id',$billing->tx_id)
      ->get('ret_billing_buyget')->result();

    return $billing;
  }

  public function insert_billing($data)
  {
    $this->db->insert('ret_billing',$data);
  }

  public function update_billing($id,$data)
  {
    $this->db->where('tx_id',$id)->update('ret_billing',$data);
  }

  public function get_item_price_buy_average($id)
  {
    $date_now = date('Y-m-d');
    $query = $this->db->query(
      "SELECT ROUND(AVG(stock_price),0) AS item_price_buy_average
      FROM ret_stock
      WHERE
        tx_date <= '$date_now' AND
        stock_price != 0 AND
        item_id = '$id'"
    );
    return $query->row();
  }

  public function insert_detail($data)
  {
    $this->db->insert('ret_billing_detail',$data);
  }

  public function update_detail($id,$data)
  {
    $this->db->where('billing_detail_id',$id)->update('ret_billing_detail',$data);
  }

  public function get_billing_detail($id)
  {
    return $this->db
      ->where('tx_id', $id)
      ->get('ret_billing_detail')
      ->result();
  }

  public function get_all_item()
  {
    return $this->db
      ->select('*, TRUNCATE(ret_item.item_price_before_tax+(ret_item.item_price_before_tax*ret_tax.tax_ratio/100),2) AS item_price_after_tax')
      ->join('ret_tax','ret_item.tax_id = ret_tax.tax_id')
      ->join('ret_category','ret_item.category_id = ret_category.category_id')
			->where('ret_item.is_deleted','0')
			->where('ret_item.is_active','1')
      ->order_by('ret_item.item_name', 'ASC')
			->get('ret_item')->result();
  }

  public function get_item_by_category($id)
  {
    return $this->db
      ->select('*, TRUNCATE(ret_item.item_price_before_tax+(ret_item.item_price_before_tax*ret_tax.tax_ratio/100),2) AS item_price_after_tax')
      ->join('ret_tax','ret_item.tax_id = ret_tax.tax_id')
      ->join('ret_category','ret_item.category_id = ret_category.category_id')
      ->where('ret_item.category_id',$id)
      ->where('ret_item.is_deleted','0')
      ->where('ret_item.is_active','1')
      ->order_by('ret_item.item_name', 'ASC')
      ->get('ret_item')->result();
  }

  public function get_item_search($search_term)
  {
    return $this->db
      ->select('*, TRUNCATE(ret_item.item_price_before_tax+(ret_item.item_price_before_tax*ret_tax.tax_ratio/100),2) AS item_price_after_tax')
      ->join('ret_tax','ret_item.tax_id = ret_tax.tax_id')
      ->join('ret_category','ret_item.category_id = ret_category.category_id')
      ->like('ret_item.item_name',$search_term)
      ->or_like('ret_item.item_barcode',$search_term)
      ->where('ret_item.is_deleted','0')
      ->where('ret_item.is_active','1')
      ->order_by('ret_item.item_name', 'ASC')
      ->get('ret_item')->result();
  }

  public function search_action($search_type, $search_name)
  {
    return $this->db
      ->select('*, TRUNCATE(ret_item.item_price_before_tax+(ret_item.item_price_before_tax*ret_tax.tax_ratio/100),2) AS item_price_after_tax')
      ->join('ret_tax','ret_item.tax_id = ret_tax.tax_id')
      ->join('ret_category','ret_item.category_id = ret_category.category_id')
      ->like('ret_item.'.$search_type,$search_name)
      ->where('ret_item.is_deleted','0')
      ->where('ret_item.is_active','1')
      ->order_by('ret_item.item_name', 'ASC')
      ->get('ret_item')->result();
  }

  public function item_exist($tx_id,$item_id)
  {
    return $this->db
      ->where('tx_id',$tx_id)
      ->where('item_id',$item_id)
      ->get('ret_billing_detail')
      ->row();
  }

  public function add_item_show($id)
  {
    return $this->db
      ->select('*, TRUNCATE(ret_item.item_price_before_tax+(ret_item.item_price_before_tax*ret_tax.tax_ratio/100),2) AS item_price_after_tax')
      ->join('ret_tax','ret_item.tax_id = ret_tax.tax_id')
      ->join('ret_category','ret_item.category_id = ret_category.category_id')
      ->join('ret_unit','ret_item.unit_id = ret_unit.unit_id')
      ->where('ret_item.item_id',$id)
      ->where('ret_item.is_deleted','0')
      ->where('ret_item.is_active','1')
      ->get('ret_item')->row();
  }

  public function edit_item_show($id)
  {
    return $this->db
      ->select('*, TRUNCATE(ret_item.item_price_before_tax+(ret_item.item_price_before_tax*ret_tax.tax_ratio/100),2) AS item_price_after_tax')
      ->join('ret_item','ret_billing_detail.item_id = ret_item.item_id')
      ->join('ret_category','ret_item.category_id = ret_category.category_id')
      ->join('ret_tax','ret_item.tax_id = ret_tax.tax_id')
      ->join('ret_unit','ret_item.unit_id = ret_unit.unit_id')
      ->where('billing_detail_id', $id)
      ->get('ret_billing_detail')
      ->row();
  }

  public function edit_item_action($id, $data)
  {
    $this->db->where('billing_detail_id',$id)->update('ret_billing_detail', $data);
  }

  public function delete_item_action($id)
  {
    $this->db->where('billing_detail_id',$id)->delete('ret_billing_detail');
  }

  public function pending_action($tx_id)
  {
    $this->db->where('tx_id',$tx_id)->update('ret_billing',array('tx_status' => -1));
  }

  public function cancel_action($tx_id, $tx_cancel_notes)
  {
    $this->db->where('tx_id',$tx_id)->update('ret_billing',array('tx_status' => -2,'tx_cancel_notes' => $tx_cancel_notes));
  }

  public function payment_cash_action($tx_id, $data)
  {
    $this->db->where('tx_id',$tx_id)->update('ret_billing', $data);
  }

  public function payment_card_action($tx_id, $data)
  {
    $this->db->where('tx_id',$tx_id)->update('ret_billing', $data);
  }

  public function insert_stock($data)
  {
    $this->db->insert('ret_stock', $data);
  }

  //promo buy get
  public function get_promo_buyget_all($tx_id)
  {
    return $this->db->where('tx_id',$tx_id)->get('ret_billing_buyget')->result();
  }

  public function get_promo_buyget($item_id, $tx_amount)
  {
    $day = strtolower(date('l'));
    $dayfield = 'promo_'.$day;
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $query = $this->db->query(
      "SELECT *
       FROM ret_promo_buyget a
       JOIN ret_promo b ON a.promo_id = b.promo_id
       JOIN ret_promo_type c ON b.promo_type_id = c.promo_type_id
       WHERE
      	'$date' >= b.promo_date_start AND '$date' <= b.promo_date_end AND
        '$time' >= b.promo_time_start AND '$time' <= b.promo_time_end AND
        b.$dayfield = 1 AND
        buy_item_id = '$item_id' AND
        '$tx_amount' >= buy_amount
      "
    );

    return $query->row();
  }

  public function insert_promo_buyget($data)
  {
    $this->db->insert('ret_billing_buyget',$data);
  }

  public function get_billing_buyget($tx_id, $promo_buyget_id)
  {
    return $this->db
      ->where('tx_id', $tx_id)
      ->where('promo_buyget_id', $promo_buyget_id)
      ->get('ret_billing_buyget')->row();
  }

  public function update_promo_buyget($tx_id, $promo_buyget_id, $data)
  {
    $this->db
      ->where('tx_id', $tx_id)
      ->where('promo_buyget_id', $promo_buyget_id)
      ->update('ret_billing_buyget',$data);
  }

  public function delete_promo_buyget($tx_id, $item_id)
  {
    $this->db
      ->where('tx_id', $tx_id)
      ->where('buy_item_id', $item_id)
      ->delete('ret_billing_buyget');
  }

  public function get_promo_buyitem($item_id, $tx_amount)
  {
    $day = strtolower(date('l'));
    $dayfield = 'promo_'.$day;
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $query = $this->db->query(
      "SELECT *
       FROM ret_promo_buyitem a
       JOIN ret_promo b ON a.promo_id = b.promo_id
       JOIN ret_promo_type c ON b.promo_type_id = c.promo_type_id
       WHERE
      	'$date' >= b.promo_date_start AND '$date' <= b.promo_date_end AND
        '$time' >= b.promo_time_start AND '$time' <= b.promo_time_end AND
        b.$dayfield = 1 AND
        buy_item_id = '$item_id' AND
        '$tx_amount' >= buy_amount
      "
    );

    return $query->row();
  }

  public function insert_promo_buyitem($data)
  {
    $this->db->insert('ret_billing_buyitem',$data);
  }

  public function get_billing_buyitem($tx_id, $promo_buyitem_id)
  {
    return $this->db
      ->where('tx_id', $tx_id)
      ->where('promo_buyitem_id', $promo_buyitem_id)
      ->get('ret_billing_buyitem')->row();
  }

  public function update_promo_buyitem($tx_id, $promo_buyitem_id, $data)
  {
    $this->db
      ->where('tx_id', $tx_id)
      ->where('promo_buyitem_id', $promo_buyitem_id)
      ->update('ret_billing_buyitem',$data);
  }

  public function delete_promo_buyitem($tx_id, $item_id)
  {
    $this->db
      ->where('tx_id', $tx_id)
      ->where('buy_item_id', $item_id)
      ->delete('ret_billing_buyitem');
  }

  public function get_promo_buyall($tx_amount)
  {
    $day = strtolower(date('l'));
    $dayfield = 'promo_'.$day;
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $query = $this->db->query(
      "SELECT *
       FROM ret_promo_buyall a
       JOIN ret_promo b ON a.promo_id = b.promo_id
       JOIN ret_promo_type c ON b.promo_type_id = c.promo_type_id
       WHERE
      	'$date' >= b.promo_date_start AND '$date' <= b.promo_date_end AND
        '$time' >= b.promo_time_start AND '$time' <= b.promo_time_end AND
        b.$dayfield = 1 AND
        '$tx_amount' >= buy_amount
      "
    );

    return $query->row();
  }

  public function insert_promo_buyall($data)
  {
    $this->db->insert('ret_billing_buyall',$data);
  }

  public function get_billing_buyall($tx_id, $promo_buyall_id)
  {
    return $this->db
      ->where('tx_id', $tx_id)
      ->where('promo_buyall_id', $promo_buyall_id)
      ->get('ret_billing_buyall')->row();
  }

  public function update_promo_buyall($tx_id, $promo_buyall_id, $data)
  {
    $this->db
      ->where('tx_id', $tx_id)
      ->where('promo_buyall_id', $promo_buyall_id)
      ->update('ret_billing_buyall',$data);
  }

  public function delete_promo_buyall($tx_id)
  {
    $this->db
      ->where('buy_item_id', $item_id)
      ->delete('ret_billing_buyitem');
  }

  public function check_package($item_id)
  {
    return $this->db
      ->where('item_id',$item_id)
      ->get('ret_item_package')->result();
  }

  public function get_hold_billing($user_id)
  {
    $date = date('Y-m-d');

    return $this->db
      ->where('user_id',$user_id)
      ->where('tx_date',$date)
      ->where('tx_status',-1)
      ->get('ret_billing')->result();
  }

}
