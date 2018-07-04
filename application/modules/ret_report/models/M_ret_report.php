<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_report extends CI_Model {

	public function report_stock($search_stock = null)
  {

    if($search_stock == null){
      $date_start = date('Y-m-d');
      $date_end = date('Y-m-d');
    }else{
      $date = explode(" - ", $search_stock);
			$date_start = ind_to_date($date[0]);
			$date_end = ind_to_date($date[1]);
    }

    $query_stock_last = $this->db->query(
      "SELECT
        ret_item.item_id,
        IFNULL(s.stock_last, 0) AS stock_last
      FROM ret_item
      LEFT JOIN (
        SELECT item_id, (sum(stock_in)+sum(stock_out)+sum(stock_adjustment)) AS stock_last
        FROM ret_stock
        WHERE tx_date < '$date_start'
        GROUP BY item_id
      ) s ON (ret_item.item_id = s.item_id)"
    );

    $stock_last = $query_stock_last->result_array();

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
        WHERE tx_date >= '$date_start' AND tx_date <= '$date_end'
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

	public function report_selling($search_selling = null)
  {
    if($search_selling == null){
      $date_start = date('Y-m-d');
      $date_end = date('Y-m-d');
    }else{
      $date = explode(" - ", $search_selling);
			$date_start = ind_to_date($date[0]);
			$date_end = ind_to_date($date[1]);
    }

		$selling = $this->db
			->join('ret_payment_type','ret_billing.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_status', 1)
			->where('tx_date >=', $date_start)
			->where('tx_date <=', $date_end)
			->order_by('tx_id','desc')
			->get('ret_billing')->result();

		return $selling;
	}

	public function report_selling_annual($year)
  {
		$billing = $this->db->query(
			"SELECT
				MONTH(tx_date) AS tx_month,
				YEAR(tx_date) AS tx_year,
				SUM(tx_total_buy_average) AS tx_total_buy_average,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax,
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax
			FROM ret_billing
			WHERE
				tx_date LIKE '$year%' AND
				tx_status = 1
			GROUP BY YEAR(tx_date)
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function report_selling_monthly($month)
  {
		$billing = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_buy_average) AS tx_total_buy_average,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax,
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax
			FROM ret_billing
			WHERE
				tx_date LIKE '$month%' AND
				tx_status = 1
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function report_selling_weekly($date_start, $date_end)
	{		
		$billing = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_buy_average) AS tx_total_buy_average,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax,
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax
			FROM ret_billing
			WHERE
				tx_date >= '$date_start' AND
				tx_date <= '$date_end' AND
				tx_status = 1
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function report_selling_daily($date)
  {
		$selling = $this->db
			->join('ret_payment_type','ret_billing.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_status', 1)
			->where('tx_date =', $date)
			->order_by('tx_id','desc')
			->get('ret_billing')->result();

		return $selling;
	}

	public function report_selling_range($date_start, $date_end)
	{		
		$billing = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_buy_average) AS tx_total_buy_average,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax,
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax
			FROM ret_billing
			WHERE
				tx_date >= '$date_start' AND
				tx_date <= '$date_end' AND
				tx_status = 1
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function report_selling_detail($tx_id)
	{
		$billing = $this->db
			->join('ret_payment_type', 'ret_billing.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('ret_billing')->row();
		$billing->detail = $this->db->where('tx_id', $tx_id)->get('ret_billing_detail')->result();
		$billing->buyget = $this->db
			->select('ret_billing_buyget.*,ret_item.item_name,ret_promo.promo_name')
			->join('ret_item', 'ret_billing_buyget.get_item_id = ret_item.item_id')
			->join('ret_promo_buyget', 'ret_billing_buyget.promo_buyget_id = ret_promo_buyget.promo_buyget_id')
			->join('ret_promo', 'ret_promo_buyget.promo_id = ret_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('ret_billing_buyget')->result();

		$billing->buyitem = $this->db
			->select('ret_billing_buyitem.*,ret_promo.promo_name')
			->join('ret_promo_buyitem', 'ret_billing_buyitem.promo_buyitem_id = ret_promo_buyitem.promo_buyitem_id')
			->join('ret_promo', 'ret_promo_buyitem.promo_id = ret_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('ret_billing_buyitem')->result();

		$billing->buyall = $this->db
		  ->select('ret_billing_buyall.*,ret_promo.promo_name')
		  ->join('ret_promo_buyall', 'ret_billing_buyall.promo_buyall_id = ret_promo_buyall.promo_buyall_id')
		  ->join('ret_promo', 'ret_promo_buyall.promo_id = ret_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('ret_billing_buyall')->result();

		return $billing;
	}

	public function report_selling_item($search_selling_item = null)
	{
	  if($search_selling_item == null){
	    $date_start = date('Y-m-d');
	    $date_end = date('Y-m-d');
	  }else{
	    $date = explode(" - ", $search_selling_item);
	    $date_start = ind_to_date($date[0]);
	    $date_end = ind_to_date($date[1]);
	  }

	  $selling_item = $this->db->query(
			"SELECT
				a.item_id,a.item_name,a.tx_amount,
				SUM(a.tx_amount) AS selling_amount,
				SUM(a.tx_subtotal_before_tax) AS selling_subtotal,
				ROUND(AVG(a.item_price_before_tax),2) AS item_price_average
			FROM ret_billing_detail a
			JOIN ret_billing b ON a.tx_id = b.tx_id
			WHERE
				b.tx_status = 1 AND
				b.tx_date >= '$date_start' AND
				b.tx_date <= '$date_end'
			GROUP BY a.item_id
			ORDER BY a.item_id ASC"
		)->result();

	  return $selling_item;
	}

	public function report_profit_daily($search_profit_daily = null)
	{
	  if($search_profit_daily == null){
	    $date_start = date('Y-m-d');
	    $date_end = date('Y-m-d');
	  }else{
	    $date = explode(" - ", $search_profit_daily);
	    $date_start = ind_to_date($date[0]);
	    $date_end = ind_to_date($date[1]);
	  }

		$query = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_buy_average) AS tx_total_buy_average,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax,
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax
			FROM ret_billing
			WHERE
				tx_date >= '$date_start' AND
				tx_date <= '$date_end' AND
				tx_status = 1
			GROUP BY tx_date"
		);

		return $query->result();
	}

	public function report_profit_item ($search_profit_item  = null)
	{
	  if($search_profit_item  == null){
	    $date_start = date('Y-m-d');
	    $date_end = date('Y-m-d');
	  }else{
	    $date = explode(" - ", $search_profit_item );
	    $date_start = ind_to_date($date[0]);
	    $date_end = ind_to_date($date[1]);
	  }

	  $query = $this->db->query(
	    "SELECT
	      a.item_name,
				SUM(tx_subtotal_buy_average) AS tx_subtotal_buy_average,
				SUM(tx_subtotal_before_tax) AS tx_subtotal_before_tax,
				SUM(tx_subtotal_tax) AS tx_subtotal_tax,
				SUM(tx_subtotal_after_tax) AS tx_subtotal_after_tax,
				SUM(tx_subtotal_discount) AS tx_subtotal_discount,
				SUM(tx_subtotal_profit_before_tax) AS tx_subtotal_profit_before_tax,
				SUM(tx_subtotal_profit_after_tax) AS tx_subtotal_profit_after_tax
	    FROM ret_billing_detail a
			JOIN ret_billing b
			ON a.tx_id = b.tx_id
	    WHERE
	      tx_date >= '$date_start' AND
	      tx_date <= '$date_end' AND
	      tx_status = 1
	    GROUP BY item_id"
	  );

	  return $query->result();
	}

}
