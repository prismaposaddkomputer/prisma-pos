<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_income_user extends CI_Model {

	public function report_range($date_start,$date_end,$user_id)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_total) AS billing_total,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out >= '$date_start%' AND
					billing_date_out <= '$date_end' AND
					(user_id_in = '$user_id' OR user_id_out='$user_id')
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_daily($date,$user_id)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_total) AS billing_total,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out = '$date%' AND
					(user_id_in = '$user_id' OR user_id_out='$user_id')
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_weekly($date_start,$date_end,$user_id)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_total) AS billing_total,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out >= '$date_start%' AND
					billing_date_out <= '$date_end' AND
					(user_id_in = '$user_id' OR user_id_out='$user_id')
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_monthly($month,$user_id)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_total) AS billing_total,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out LIKE '$month%' AND
					(user_id_in = '$user_id' OR user_id_out='$user_id')
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_annual($year,$user_id)
  {
		$billing = $this->db
			->query(
				"SELECT
					MONTH(billing_date_out) AS billing_month,
					SUM(billing_total) AS billing_total,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out LIKE '$year%' AND
					(user_id_in = '$user_id' OR user_id_out='$user_id')
				GROUP BY
					YEAR(billing_date_out)"
			)->result();

		return $billing;
	}



}
