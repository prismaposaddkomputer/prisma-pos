<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_report_log extends CI_Model {

	public function annual($year)
  {
		$log = $this->db->query(
			"SELECT
				*
			FROM
				res_log a
			JOIN
				res_user b ON a.user_id = b.user_id
			WHERE
				a.log_date LIKE '$year%'
			ORDER BY
				log_id DESC"
		)->result();

		return $log;
	}

	public function monthly($month)
  {
		$log = $this->db->query(
			"SELECT
				*
			FROM
				res_log a
			JOIN
				res_user b ON a.user_id = b.user_id
			WHERE
				a.log_date LIKE '$month%'
			ORDER BY
				log_id DESC"
		)->result();

		return $log;
	}

	public function weekly($date_start, $date_end)
	{
		$log = $this->db->query(
			"SELECT
				*
			FROM
				res_log a
			JOIN
				res_user b ON a.user_id = b.user_id
			WHERE
				a.log_date >= '$date_start' AND
				a.log_date <= '$date_end'
			ORDER BY
				log_id DESC"
		)->result();

		return $log;
	}

	public function daily($date)
  {
		$log = $this->db->query(
			"SELECT
				*
			FROM
				res_log a
			JOIN
				res_user b ON a.user_id = b.user_id
			WHERE
				a.log_date = '$date'
			ORDER BY
				log_id DESC"
		)->result();

		return $log;
	}

	public function range($date_start, $date_end)
	{
		$log = $this->db->query(
			"SELECT
				*
			FROM
				res_log a
			JOIN
				res_user b ON a.user_id = b.user_id
			WHERE
				a.log_date >= '$date_start' AND
				a.log_date <= '$date_end'
			ORDER BY
				log_id DESC"
		)->result();

		return $log;
	}

	public function detail($tx_id)
	{
		$log = $this->db
			->join('res_payment_type', 'res_log.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('res_log')->row();
		$log->detail = $this->db->where('tx_id', $tx_id)->get('res_log_detail')->result();
		$log->buyget = $this->db
			->select('res_log_buyget.*,res_item.item_name,res_promo.promo_name')
			->join('res_item', 'res_log_buyget.get_item_id = res_item.item_id')
			->join('res_promo_buyget', 'res_log_buyget.promo_buyget_id = res_promo_buyget.promo_buyget_id')
			->join('res_promo', 'res_promo_buyget.promo_id = res_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('res_log_buyget')->result();

		$log->buyitem = $this->db
			->select('res_log_buyitem.*,res_promo.promo_name')
			->join('res_promo_buyitem', 'res_log_buyitem.promo_buyitem_id = res_promo_buyitem.promo_buyitem_id')
			->join('res_promo', 'res_promo_buyitem.promo_id = res_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('res_log_buyitem')->result();

		$log->buyall = $this->db
		  ->select('res_log_buyall.*,res_promo.promo_name')
		  ->join('res_promo_buyall', 'res_log_buyall.promo_buyall_id = res_promo_buyall.promo_buyall_id')
		  ->join('res_promo', 'res_promo_buyall.promo_id = res_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('res_log_buyall')->result();

		return $log;
	}

}
