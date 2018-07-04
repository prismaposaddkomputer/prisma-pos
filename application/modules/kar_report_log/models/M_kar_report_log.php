<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_report_log extends CI_Model {

	public function annual($year)
  {
		$log = $this->db->query(
			"SELECT
				*
			FROM
				kar_log a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_log a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_log a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_log a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_log a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
			->join('kar_payment_type', 'kar_log.payment_type_id = kar_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('kar_log')->row();
		$log->detail = $this->db->where('tx_id', $tx_id)->get('kar_log_detail')->result();
		$log->buyget = $this->db
			->select('kar_log_buyget.*,kar_item.item_name,kar_promo.promo_name')
			->join('kar_item', 'kar_log_buyget.get_item_id = kar_item.item_id')
			->join('kar_promo_buyget', 'kar_log_buyget.promo_buyget_id = kar_promo_buyget.promo_buyget_id')
			->join('kar_promo', 'kar_promo_buyget.promo_id = kar_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('kar_log_buyget')->result();

		$log->buyitem = $this->db
			->select('kar_log_buyitem.*,kar_promo.promo_name')
			->join('kar_promo_buyitem', 'kar_log_buyitem.promo_buyitem_id = kar_promo_buyitem.promo_buyitem_id')
			->join('kar_promo', 'kar_promo_buyitem.promo_id = kar_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('kar_log_buyitem')->result();

		$log->buyall = $this->db
		  ->select('kar_log_buyall.*,kar_promo.promo_name')
		  ->join('kar_promo_buyall', 'kar_log_buyall.promo_buyall_id = kar_promo_buyall.promo_buyall_id')
		  ->join('kar_promo', 'kar_promo_buyall.promo_id = kar_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('kar_log_buyall')->result();

		return $log;
	}

}
