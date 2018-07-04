<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_report_stock extends CI_Model {

  public function get_stock_last($date)
  {
    $query = $this->db->query(
      "SELECT
        ret_item.item_id,
        IFNULL(s.stock_last, 0) AS stock_last
      FROM ret_item
      LEFT JOIN (
        SELECT item_id, (sum(stock_in)+sum(stock_out)+sum(stock_adjustment)) AS stock_last
        FROM ret_stock
        WHERE tx_date < '$date'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );
    return $query->result_array();
	}

	public function annual($year)
  {
		$date_start = $year.'-01-01';
		$stock_last = $this->get_stock_last($date_start);

    $query = $this->db->query(
      "SELECT
        ret_item.item_id,
        ret_item.item_name,
        IFNULL(s.stock_in, 0) AS stock_in,
        IFNULL(s.stock_out, 0) AS stock_out,
        IFNULL(s.stock_adjustment, 0) AS stock_adjustment
      FROM ret_item
      LEFT JOIN (
        SELECT
          item_id,
          sum(stock_in) AS stock_in,
          sum(stock_out) AS stock_out,
          sum(stock_adjustment) AS stock_adjustment
        FROM ret_stock
        WHERE 
					tx_date LIKE '$year%'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );

    $res = $query->result_array();

    foreach ($res as $key => $val) {
      $res[$key]['stock_last'] = $stock_last[$key]['stock_last'];
      $res[$key]['stock_now'] = $stock_last[$key]['stock_last']+$res[$key]['stock_in']+$res[$key]['stock_out']+$res[$key]['stock_adjustment'];
    }

    return $res;
  }

	public function monthly($month)
  {
		$date_start = $month.'-01';
		$stock_last = $this->get_stock_last($date_start);

    $query = $this->db->query(
      "SELECT
        ret_item.item_id,
        ret_item.item_name,
        IFNULL(s.stock_in, 0) AS stock_in,
        IFNULL(s.stock_out, 0) AS stock_out,
        IFNULL(s.stock_adjustment, 0) AS stock_adjustment
      FROM ret_item
      LEFT JOIN (
        SELECT
          item_id,
          sum(stock_in) AS stock_in,
          sum(stock_out) AS stock_out,
          sum(stock_adjustment) AS stock_adjustment
        FROM ret_stock
        WHERE 
					tx_date LIKE '$month%'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );

    $res = $query->result_array();

    foreach ($res as $key => $val) {
      $res[$key]['stock_last'] = $stock_last[$key]['stock_last'];
      $res[$key]['stock_now'] = $stock_last[$key]['stock_last']+$res[$key]['stock_in']+$res[$key]['stock_out']+$res[$key]['stock_adjustment'];
    }

    return $res;
  }
	
	public function weekly($date_start,$date_end)
  {
    $stock_last = $this->get_stock_last($date_start);

    $query = $this->db->query(
      "SELECT
        ret_item.item_id,
        ret_item.item_name,
        IFNULL(s.stock_in, 0) AS stock_in,
        IFNULL(s.stock_out, 0) AS stock_out,
        IFNULL(s.stock_adjustment, 0) AS stock_adjustment
      FROM ret_item
      LEFT JOIN (
        SELECT
          item_id,
          sum(stock_in) AS stock_in,
          sum(stock_out) AS stock_out,
          sum(stock_adjustment) AS stock_adjustment
        FROM ret_stock
        WHERE 
					tx_date >= '$date_start' AND
					tx_date <= '$date_end'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );

    $res = $query->result_array();

    foreach ($res as $key => $val) {
      $res[$key]['stock_last'] = $stock_last[$key]['stock_last'];
      $res[$key]['stock_now'] = $stock_last[$key]['stock_last']+$res[$key]['stock_in']+$res[$key]['stock_out']+$res[$key]['stock_adjustment'];
    }

    return $res;
  }

  public function daily($date)
  {
    $stock_last = $this->get_stock_last($date);

    $query = $this->db->query(
      "SELECT
        ret_item.item_id,
        ret_item.item_name,
        IFNULL(s.stock_in, 0) AS stock_in,
        IFNULL(s.stock_out, 0) AS stock_out,
        IFNULL(s.stock_adjustment, 0) AS stock_adjustment
      FROM ret_item
      LEFT JOIN (
        SELECT
          item_id,
          sum(stock_in) AS stock_in,
          sum(stock_out) AS stock_out,
          sum(stock_adjustment) AS stock_adjustment
        FROM ret_stock
        WHERE tx_date <= '$date'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );

    $res = $query->result_array();

    foreach ($res as $key => $val) {
      $res[$key]['stock_last'] = $stock_last[$key]['stock_last'];
      $res[$key]['stock_now'] = $stock_last[$key]['stock_last']+$res[$key]['stock_in']+$res[$key]['stock_out']+$res[$key]['stock_adjustment'];
    }

    return $res;
	}
	
	public function range($date_start,$date_end)
  {
    $stock_last = $this->get_stock_last($date_start);

    $query = $this->db->query(
      "SELECT
        ret_item.item_id,
        ret_item.item_name,
        IFNULL(s.stock_in, 0) AS stock_in,
        IFNULL(s.stock_out, 0) AS stock_out,
        IFNULL(s.stock_adjustment, 0) AS stock_adjustment
      FROM ret_item
      LEFT JOIN (
        SELECT
          item_id,
          sum(stock_in) AS stock_in,
          sum(stock_out) AS stock_out,
          sum(stock_adjustment) AS stock_adjustment
        FROM ret_stock
        WHERE 
					tx_date >= '$date_start' AND
					tx_date <= '$date_end'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );

    $res = $query->result_array();

    foreach ($res as $key => $val) {
      $res[$key]['stock_last'] = $stock_last[$key]['stock_last'];
      $res[$key]['stock_now'] = $stock_last[$key]['stock_last']+$res[$key]['stock_in']+$res[$key]['stock_out']+$res[$key]['stock_adjustment'];
    }

    return $res;
  }

}
