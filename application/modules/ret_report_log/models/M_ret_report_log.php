<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_report_log extends CI_Model {

	public function annual($year)
  {
		$log = $this->db->query(
			"SELECT
				*
			FROM
				ret_log a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_log a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_log a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_log a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_log a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
			->join('ret_payment_type', 'ret_log.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('ret_log')->row();
		$log->detail = $this->db->where('tx_id', $tx_id)->get('ret_log_detail')->result();
		$log->buyget = $this->db
			->select('ret_log_buyget.*,ret_item.item_name,ret_promo.promo_name')
			->join('ret_item', 'ret_log_buyget.get_item_id = ret_item.item_id')
			->join('ret_promo_buyget', 'ret_log_buyget.promo_buyget_id = ret_promo_buyget.promo_buyget_id')
			->join('ret_promo', 'ret_promo_buyget.promo_id = ret_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('ret_log_buyget')->result();

		$log->buyitem = $this->db
			->select('ret_log_buyitem.*,ret_promo.promo_name')
			->join('ret_promo_buyitem', 'ret_log_buyitem.promo_buyitem_id = ret_promo_buyitem.promo_buyitem_id')
			->join('ret_promo', 'ret_promo_buyitem.promo_id = ret_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('ret_log_buyitem')->result();

		$log->buyall = $this->db
		  ->select('ret_log_buyall.*,ret_promo.promo_name')
		  ->join('ret_promo_buyall', 'ret_log_buyall.promo_buyall_id = ret_promo_buyall.promo_buyall_id')
		  ->join('ret_promo', 'ret_promo_buyall.promo_id = ret_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('ret_log_buyall')->result();

		return $log;
	}

}
