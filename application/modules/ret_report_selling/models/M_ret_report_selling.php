<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_report_selling extends CI_Model {

	public function annual($year)
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
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax,
				SUM(tx_total_grand) AS tx_total_grand
			FROM ret_billing
			WHERE
				tx_date LIKE '$year%' AND
				tx_status = 1
			GROUP BY YEAR(tx_date)
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function monthly($month)
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
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax,
				SUM(tx_total_grand) AS tx_total_grand
			FROM ret_billing
			WHERE
				tx_date LIKE '$month%' AND
				tx_status = 1
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function weekly($date_start, $date_end)
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
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax,
				SUM(tx_total_grand) AS tx_total_grand
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

	public function daily($date)
  {
		$selling = $this->db
			->join('ret_payment_type','ret_billing.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_status', 1)
			->where('tx_date =', $date)
			->order_by('tx_id','desc')
			->get('ret_billing')->result();

		return $selling;
	}

	public function range($date_start, $date_end)
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
				SUM(tx_total_profit_after_tax) AS tx_total_profit_after_tax,
				SUM(tx_total_grand) AS tx_total_grand
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

	public function detail($tx_id)
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

}
