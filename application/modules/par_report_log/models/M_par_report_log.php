<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_log extends CI_Model {

	public function annual($year)
  {
		$log = $this->db->query(
			"SELECT
				*
			FROM
				par_log a
			JOIN
				par_user b ON a.user_id = b.user_id
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
				par_log a
			JOIN
				par_user b ON a.user_id = b.user_id
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
				par_log a
			JOIN
				par_user b ON a.user_id = b.user_id
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
				par_log a
			JOIN
				par_user b ON a.user_id = b.user_id
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
				par_log a
			JOIN
				par_user b ON a.user_id = b.user_id
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
			->join('par_payment_type', 'par_log.payment_type_id = par_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('par_log')->row();
		$log->detail = $this->db->where('tx_id', $tx_id)->get('par_log_detail')->result();
		$log->buyget = $this->db
			->select('par_log_buyget.*,par_item.item_name,par_promo.promo_name')
			->join('par_item', 'par_log_buyget.get_item_id = par_item.item_id')
			->join('par_promo_buyget', 'par_log_buyget.promo_buyget_id = par_promo_buyget.promo_buyget_id')
			->join('par_promo', 'par_promo_buyget.promo_id = par_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('par_log_buyget')->result();

		$log->buyitem = $this->db
			->select('par_log_buyitem.*,par_promo.promo_name')
			->join('par_promo_buyitem', 'par_log_buyitem.promo_buyitem_id = par_promo_buyitem.promo_buyitem_id')
			->join('par_promo', 'par_promo_buyitem.promo_id = par_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('par_log_buyitem')->result();

		$log->buyall = $this->db
		  ->select('par_log_buyall.*,par_promo.promo_name')
		  ->join('par_promo_buyall', 'par_log_buyall.promo_buyall_id = par_promo_buyall.promo_buyall_id')
		  ->join('par_promo', 'par_promo_buyall.promo_id = par_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('par_log_buyall')->result();

		return $log;
	}

}
