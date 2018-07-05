<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_report_selling_category extends CI_Model {

	public function annual($year)
  {
		$query = $this->db->query(
			"SELECT
				a.category_id,
				a.category_name,
				IFNULL(e.tx_amount, 0) AS tx_amount
			FROM
				res_category a
			LEFT JOIN(
				SELECT
					category_id,
					SUM(tx_amount) AS tx_amount
				FROM
					res_billing_detail b
				JOIN
					res_billing c ON b.tx_id = c.tx_id
				JOIN
					res_item d ON b.item_id = d.item_id
				WHERE
					tx_date LIKE '$year%'
				GROUP BY
					d.category_id
			) e ON a.category_id = e.category_id"
		)->result();

		return $query;
	}

	public function monthly($month)
  {
		$query = $this->db->query(
			"SELECT
				a.category_id,
				a.category_name,
				IFNULL(e.tx_amount, 0) AS tx_amount
			FROM
				res_category a
			LEFT JOIN(
				SELECT
					category_id,
					SUM(tx_amount) AS tx_amount
				FROM
					res_billing_detail b
				JOIN
					res_billing c ON b.tx_id = c.tx_id
				JOIN
					res_item d ON b.item_id = d.item_id
				WHERE
					tx_date LIKE '$month%'
				GROUP BY
					d.category_id
			) e ON a.category_id = e.category_id"
		)->result();

		return $query;
	}

	public function weekly($date_start, $date_end)
	{
		$query = $this->db->query(
			"SELECT
				a.category_id,
				a.category_name,
				IFNULL(e.tx_amount, 0) AS tx_amount
			FROM
				res_category a
			LEFT JOIN(
				SELECT
					category_id,
					SUM(tx_amount) AS tx_amount
				FROM
					res_billing_detail b
				JOIN
					res_billing c ON b.tx_id = c.tx_id
				JOIN
					res_item d ON b.item_id = d.item_id
				WHERE
					tx_date >= '$date_start' AND
					tx_date <= '$date_end'
				GROUP BY
					d.category_id
			) e ON a.category_id = e.category_id"
		)->result();

		return $query;
	}

	public function daily($date)
  {
		$query = $this->db->query(
			"SELECT
				a.category_id,
				a.category_name,
				IFNULL(e.tx_amount, 0) AS tx_amount
			FROM
				res_category a
			LEFT JOIN(
				SELECT
					category_id,
					SUM(tx_amount) AS tx_amount
				FROM
					res_billing_detail b
				JOIN
					res_billing c ON b.tx_id = c.tx_id
				JOIN
					res_item d ON b.item_id = d.item_id
				WHERE
					tx_date = '$date'
				GROUP BY
					d.category_id
			) e ON a.category_id = e.category_id"
		)->result();

		return $query;
	}

	public function range($date_start, $date_end)
	{
		$query = $this->db->query(
			"SELECT
				a.category_id,
				a.category_name,
				IFNULL(e.tx_amount, 0) AS tx_amount
			FROM
				res_category a
			LEFT JOIN(
				SELECT
					category_id,
					SUM(tx_amount) AS tx_amount
				FROM
					res_billing_detail b
				JOIN
					res_billing c ON b.tx_id = c.tx_id
				JOIN
					res_item d ON b.item_id = d.item_id
				WHERE
					tx_date >= '$date_start' AND
					tx_date <= '$date_end'
				GROUP BY
					d.category_id
			) e ON a.category_id = e.category_id"
		)->result();

		return $query;
	}

}
