<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_report_shift extends CI_Model {

	public function annual($year)
  {
		$shift = $this->db->query(
			"SELECT 
				*
			FROM
				ret_shift a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_shift a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_shift a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_shift a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
				ret_shift a
			JOIN
				ret_user b ON a.user_id = b.user_id
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
			->join('ret_payment_type', 'ret_shift.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_id', $tx_id)
			->get('ret_shift')->row();
		$shift->detail = $this->db->where('tx_id', $tx_id)->get('ret_shift_detail')->result();
		$shift->buyget = $this->db
			->select('ret_shift_buyget.*,ret_item.item_name,ret_promo.promo_name')
			->join('ret_item', 'ret_shift_buyget.get_item_id = ret_item.item_id')
			->join('ret_promo_buyget', 'ret_shift_buyget.promo_buyget_id = ret_promo_buyget.promo_buyget_id')
			->join('ret_promo', 'ret_promo_buyget.promo_id = ret_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('ret_shift_buyget')->result();

		$shift->buyitem = $this->db
			->select('ret_shift_buyitem.*,ret_promo.promo_name')
			->join('ret_promo_buyitem', 'ret_shift_buyitem.promo_buyitem_id = ret_promo_buyitem.promo_buyitem_id')
			->join('ret_promo', 'ret_promo_buyitem.promo_id = ret_promo.promo_id')
			->where('tx_id', $tx_id)
			->get('ret_shift_buyitem')->result();

		$shift->buyall = $this->db
		  ->select('ret_shift_buyall.*,ret_promo.promo_name')
		  ->join('ret_promo_buyall', 'ret_shift_buyall.promo_buyall_id = ret_promo_buyall.promo_buyall_id')
		  ->join('ret_promo', 'ret_promo_buyall.promo_id = ret_promo.promo_id')
		  ->where('tx_id', $tx_id)
		  ->get('ret_shift_buyall')->result();

		return $shift;
	}

}
