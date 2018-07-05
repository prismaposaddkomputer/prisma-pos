<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_report_income extends CI_Model {

	public function report_range($date_start,$date_end)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_subtotal) AS billing_subtotal,
					SUM(billing_tax) AS billing_tax,
					SUM(billing_total_grand) AS billing_total_grand,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out >= '$date_start%' AND
					billing_date_out <= '$date_end'
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_daily($date)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_subtotal) AS billing_subtotal,
					SUM(billing_tax) AS billing_tax,
					SUM(billing_total_grand) AS billing_total_grand,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out = '$date%'
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_weekly($date_start,$date_end)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_subtotal) AS billing_subtotal,
					SUM(billing_tax) AS billing_tax,
					SUM(billing_total_grand) AS billing_total_grand,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out >= '$date_start%' AND
					billing_date_out <= '$date_end'
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_monthly($month)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_subtotal) AS billing_subtotal,
					SUM(billing_tax) AS billing_tax,
					SUM(billing_total_grand) AS billing_total_grand,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out LIKE '$month%'
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}

	public function report_annual($year)
  {
		$billing = $this->db
			->query(
				"SELECT
					billing_date_out AS billing_date,
					SUM(billing_subtotal) AS billing_subtotal,
					SUM(billing_tax) AS billing_tax,
					SUM(billing_total_grand) AS billing_total_grand,
					COUNT(billing_tnkb) AS billing_count
				FROM par_billing
				WHERE
					billing_date_out LIKE '$year%'
				GROUP BY
					billing_date_out"
			)->result();

		return $billing;
	}



}
