<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_report extends CI_Model {

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
			->join('res_payment_type','res_billing.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_status', 1)
			->where('tx_date >=', $date_start)
			->where('tx_date <=', $date_end)
			->order_by('tx_id','desc')
			->get('res_billing')->result();

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
			FROM res_billing
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
			FROM res_billing
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
			FROM res_billing
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
			->join('res_payment_type','res_billing.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_status', 1)
			->where('tx_date =', $date)
			->order_by('tx_id','desc')
			->get('res_billing')->result();

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
			FROM res_billing
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
			->join('res_payment_type', 'res_billing.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('res_billing')->row();
		$billing->detail = $this->db->where('tx_id', $tx_id)->get('res_billing_detail')->result();
		$billing->buyget = $this->db
			->select('res_billing_buyget.*,res_item.item_name,res_promo.promo_name')
			->join('res_item', 'res_billing_buyget.get_item_id = res_item.item_id')
			->join('res_promo_buyget', 'res_billing_buyget.promo_buyget_id = res_promo_buyget.promo_buyget_id')
			->join('res_promo', 'res_promo_buyget.promo_id = res_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('res_billing_buyget')->result();

		$billing->buyitem = $this->db
			->select('res_billing_buyitem.*,res_promo.promo_name')
			->join('res_promo_buyitem', 'res_billing_buyitem.promo_buyitem_id = res_promo_buyitem.promo_buyitem_id')
			->join('res_promo', 'res_promo_buyitem.promo_id = res_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('res_billing_buyitem')->result();

		$billing->buyall = $this->db
		  ->select('res_billing_buyall.*,res_promo.promo_name')
		  ->join('res_promo_buyall', 'res_billing_buyall.promo_buyall_id = res_promo_buyall.promo_buyall_id')
		  ->join('res_promo', 'res_promo_buyall.promo_id = res_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('res_billing_buyall')->result();

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
			FROM res_billing_detail a
			JOIN res_billing b ON a.tx_id = b.tx_id
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
			FROM res_billing
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
	    FROM res_billing_detail a
			JOIN res_billing b
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
