<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_report_shift extends CI_Model {

	public function annual($year)
  {
		$shift = $this->db->query(
			"SELECT
				*
			FROM
				res_shift a
			JOIN
				res_user b ON a.user_id = b.user_id
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
				res_shift a
			JOIN
				res_user b ON a.user_id = b.user_id
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
				res_shift a
			JOIN
				res_user b ON a.user_id = b.user_id
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
				res_shift a
			JOIN
				res_user b ON a.user_id = b.user_id
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
				res_shift a
			JOIN
				res_user b ON a.user_id = b.user_id
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
			->join('res_payment_type', 'res_shift.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('res_shift')->row();
		$shift->detail = $this->db->where('tx_id', $tx_id)->get('res_shift_detail')->result();
		$shift->buyget = $this->db
			->select('res_shift_buyget.*,res_item.item_name,res_promo.promo_name')
			->join('res_item', 'res_shift_buyget.get_item_id = res_item.item_id')
			->join('res_promo_buyget', 'res_shift_buyget.promo_buyget_id = res_promo_buyget.promo_buyget_id')
			->join('res_promo', 'res_promo_buyget.promo_id = res_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('res_shift_buyget')->result();

		$shift->buyitem = $this->db
			->select('res_shift_buyitem.*,res_promo.promo_name')
			->join('res_promo_buyitem', 'res_shift_buyitem.promo_buyitem_id = res_promo_buyitem.promo_buyitem_id')
			->join('res_promo', 'res_promo_buyitem.promo_id = res_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('res_shift_buyitem')->result();

		$shift->buyall = $this->db
		  ->select('res_shift_buyall.*,res_promo.promo_name')
		  ->join('res_promo_buyall', 'res_shift_buyall.promo_buyall_id = res_promo_buyall.promo_buyall_id')
		  ->join('res_promo', 'res_promo_buyall.promo_id = res_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('res_shift_buyall')->result();

		return $shift;
	}

}
