<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_stock_recap extends CI_Model {

  public function get_stock_last($date_start)
  {
    $query = $this->db->query(
      "SELECT
        res_item.item_id,
        IFNULL(s.stock_last, 0) AS stock_last
      FROM res_item
      LEFT JOIN (
        SELECT item_id, (sum(stock_in)+sum(stock_out)+sum(stock_adjustment)) AS stock_last
        FROM res_stock
        WHERE tx_date < '$date_start'
        GROUP BY item_id
      ) s ON (res_item.item_id = s.item_id)"
    );
    return $query->result_array();
  }

  public function get_stock_recap($search_term = null)
  {

    if($search_term == null){
      $date_start = date('Y-m-d');
      $date_end = date('Y-m-d');
    }else{
      $date = explode(" - ", $search_term);
			$date_start = ind_to_date($date[0]);
			$date_end = ind_to_date($date[1]);
    }

    $query_stock_last = $this->db->query(
      "SELECT
        res_item.item_id,
        IFNULL(s.stock_last, 0) AS stock_last
      FROM res_item
      LEFT JOIN (
        SELECT item_id, (sum(stock_in)+sum(stock_out)+sum(stock_adjustment)) AS stock_last
        FROM res_stock
        WHERE tx_date < '$date_start'
        GROUP BY item_id
      ) s ON (res_item.item_id = s.item_id)"
    );

    $stock_last = $query_stock_last->result_array();

    $query = $this->db->query(
      "SELECT
        res_item.item_id,
        res_item.item_name,
        IFNULL(s.stock_in, 0) AS stock_in,
        IFNULL(s.stock_out, 0) AS stock_out,
        IFNULL(s.stock_adjustment, 0) AS stock_adjustment
      FROM res_item
      LEFT JOIN (
        SELECT
          item_id,
          sum(stock_in) AS stock_in,
          sum(stock_out) AS stock_out,
          sum(stock_adjustment) AS stock_adjustment
        FROM res_stock
        WHERE tx_date >= '$date_start' AND tx_date <= '$date_end'
        GROUP BY item_id
      ) s ON (res_item.item_id = s.item_id)"
    );

    $res = $query->result_array();

    foreach ($res as $key => $val) {
      $res[$key]['stock_last'] = $stock_last[$key]['stock_last'];
      $res[$key]['stock_now'] = $stock_last[$key]['stock_last']+$res[$key]['stock_in']+$res[$key]['stock_out']+$res[$key]['stock_adjustment'];
    }

    return $res;
  }

}
