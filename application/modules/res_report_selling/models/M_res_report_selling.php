<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_report_selling extends CI_Model {

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
			FROM res_billing
			WHERE
				tx_date LIKE '$year%' AND
				tx_status = 1
			GROUP BY MONTH(tx_date)
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
			FROM res_billing
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

	public function daily($date)
  {
		$selling = $this->db
			->join('res_payment_type','res_billing.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_status', 1)
			->where('tx_date =', $date)
			->order_by('tx_id','desc')
			->get('res_billing')->result();

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

	public function detail($tx_id)
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

	public function most_sell($date)
  {

    $query = $this->db->query(
			"SELECT
        SUM(tx_amount) AS tx_amount,
        item_name
      FROM res_billing_detail a
      JOIN res_billing b ON a.tx_id = b.tx_id
      WHERE
        tx_date LIKE '$date%' AND
        tx_status = 1
      GROUP BY item_id
      ORDER BY tx_amount DESC"
		);

		return $query->result();
  }

}
