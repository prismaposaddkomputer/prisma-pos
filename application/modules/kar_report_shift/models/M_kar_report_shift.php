<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_report_shift extends CI_Model {

	public function annual($year)
  {
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				kar_shift a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_shift a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_shift a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_shift a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
				kar_shift a
			JOIN
				kar_user b ON a.user_id = b.user_id
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
			->join('kar_payment_type', 'kar_shift.payment_type_id = kar_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('kar_shift')->row();
		$shift->detail = $this->db->where('tx_id', $tx_id)->get('kar_shift_detail')->result();
		$shift->buyget = $this->db
			->select('kar_shift_buyget.*,kar_item.item_name,kar_promo.promo_name')
			->join('kar_item', 'kar_shift_buyget.get_item_id = kar_item.item_id')
			->join('kar_promo_buyget', 'kar_shift_buyget.promo_buyget_id = kar_promo_buyget.promo_buyget_id')
			->join('kar_promo', 'kar_promo_buyget.promo_id = kar_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('kar_shift_buyget')->result();

		$shift->buyitem = $this->db
			->select('kar_shift_buyitem.*,kar_promo.promo_name')
			->join('kar_promo_buyitem', 'kar_shift_buyitem.promo_buyitem_id = kar_promo_buyitem.promo_buyitem_id')
			->join('kar_promo', 'kar_promo_buyitem.promo_id = kar_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('kar_shift_buyitem')->result();

		$shift->buyall = $this->db
		  ->select('kar_shift_buyall.*,kar_promo.promo_name')
		  ->join('kar_promo_buyall', 'kar_shift_buyall.promo_buyall_id = kar_promo_buyall.promo_buyall_id')
		  ->join('kar_promo', 'kar_promo_buyall.promo_id = kar_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('kar_shift_buyall')->result();

		return $shift;
	}

}
