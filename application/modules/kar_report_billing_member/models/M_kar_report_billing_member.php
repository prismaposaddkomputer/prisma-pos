<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_report_billing_member extends CI_Model {

	public function get_member()
	{
		return $this->db
			->get('kar_member')->result();
	}

	public function annual($year, $member_id)
  {
		$billing = $this->db->query(
			"SELECT
				MONTH(tx_date) AS tx_month,
				YEAR(tx_date) AS tx_year,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_grand) AS tx_total_grand
			FROM kar_billing
			WHERE
				tx_date LIKE '$year%' AND
				tx_status = 2 AND
				member_id = '$member_id'
			GROUP BY YEAR(tx_date)
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function monthly($month, $member_id)
  {
		$billing = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_grand) AS tx_total_grand
			FROM kar_billing
			WHERE
				tx_date LIKE '$month%' AND
				tx_status = 2 AND
				member_id = '$member_id'
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function weekly($date_start, $date_end, $member_id)
	{
		$billing = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_grand) AS tx_total_grand
			FROM kar_billing
			WHERE
				tx_date >= '$date_start' AND
				tx_date <= '$date_end' AND
				tx_status = 2 AND
				member_id = '$member_id'
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function daily($date, $member_id)
  {
		$billing = $this->db
			->join('kar_payment_type','kar_billing.payment_type_id = kar_payment_type.payment_type_id')
			->where('tx_status', 2)
			->where('tx_date =', $date)
			->where('member_id =', $member_id)
			->order_by('tx_id','desc')
			->get('kar_billing')->result();

		return $billing;
	}

	public function range($date_start, $date_end, $member_id)
	{
		$billing = $this->db->query(
			"SELECT
				tx_date,
				SUM(tx_total_before_tax) AS tx_total_before_tax,
				SUM(tx_total_tax) AS tx_total_tax,
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_discount) AS tx_total_discount,
				SUM(tx_total_grand) AS tx_total_grand
			FROM kar_billing
			WHERE
				tx_date >= '$date_start' AND
				tx_date <= '$date_end' AND
				tx_status = 2 AND
				member_id = '$member_id'
			GROUP BY tx_date
			ORDER BY tx_date DESC"
		)->result();

		return $billing;
	}

	public function detail($tx_id)
	{
		$billing = $this->db
			->join('kar_room','kar_billing.room_id = kar_room.room_id')
			->join('kar_room_type','kar_room.room_type_id = kar_room_type.room_type_id')
			->join('kar_payment_type','kar_billing.payment_type_id = kar_payment_type.payment_type_id')
			->where('tx_id',$tx_id)
			->get('kar_billing')->row();

		$billing->service_charge = $this->db
			->where('tx_id',$tx_id)
			->get('kar_billing_service_charge')->result();

		return $billing;
	}

}
