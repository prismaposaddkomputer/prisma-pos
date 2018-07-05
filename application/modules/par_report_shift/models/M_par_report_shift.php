<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_shift extends CI_Model {

	public function annual($year)
  {
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				par_shift a
			JOIN
				par_user b ON a.user_id = b.user_id
			WHERE
				a.shift_in_date LIKE '$year%'
			ORDER BY
				shift_id DESC"
		)->result();

		return $shift;
	}

	public function monthly($month)
  {
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				par_shift a
			JOIN
				par_user b ON a.user_id = b.user_id
			WHERE
				a.shift_in_date LIKE '$month%'
			ORDER BY
				shift_id DESC"
		)->result();

		return $shift;
	}

	public function weekly($date_start, $date_end)
	{
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				par_shift a
			JOIN
				par_user b ON a.user_id = b.user_id
			WHERE
				a.shift_in_date >= '$date_start' AND
				a.shift_in_date <= '$date_end'
			ORDER BY
				shift_id DESC"
		)->result();

		return $shift;
	}

	public function daily($date)
  {
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				par_shift a
			JOIN
				par_user b ON a.user_id = b.user_id
			WHERE
				a.shift_in_date = '$date'
			ORDER BY
				shift_id DESC"
		)->result();

		return $shift;
	}

	public function range($date_start, $date_end)
	{
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				par_shift a
			JOIN
				par_user b ON a.user_id = b.user_id
			WHERE
				a.shift_in_date >= '$date_start' AND
				a.shift_in_date <= '$date_end'
			ORDER BY
				shift_id DESC"
		)->result();

		return $shift;
	}

	public function detail($tx_id)
	{
		$shift = $this->db
			->join('par_payment_type', 'par_shift.payment_type_id = par_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('par_shift')->row();
		$shift->detail = $this->db->where('tx_id', $tx_id)->get('par_shift_detail')->result();
		$shift->buyget = $this->db
			->select('par_shift_buyget.*,par_item.item_name,par_promo.promo_name')
			->join('par_item', 'par_shift_buyget.get_item_id = par_item.item_id')
			->join('par_promo_buyget', 'par_shift_buyget.promo_buyget_id = par_promo_buyget.promo_buyget_id')
			->join('par_promo', 'par_promo_buyget.promo_id = par_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('par_shift_buyget')->result();

		$shift->buyitem = $this->db
			->select('par_shift_buyitem.*,par_promo.promo_name')
			->join('par_promo_buyitem', 'par_shift_buyitem.promo_buyitem_id = par_promo_buyitem.promo_buyitem_id')
			->join('par_promo', 'par_promo_buyitem.promo_id = par_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('par_shift_buyitem')->result();

		$shift->buyall = $this->db
		  ->select('par_shift_buyall.*,par_promo.promo_name')
		  ->join('par_promo_buyall', 'par_shift_buyall.promo_buyall_id = par_promo_buyall.promo_buyall_id')
		  ->join('par_promo', 'par_promo_buyall.promo_id = par_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('par_shift_buyall')->result();

		return $shift;
	}

}
