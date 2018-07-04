<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_report_selling_item extends CI_Model {

	public function annual($year)
  {
		$query = $this->db->query(
			"SELECT 
				a.item_id,
				a.item_name,
				IFNULL(d.tx_amount, 0) AS tx_amount
			FROM
				ret_item a
			LEFT JOIN(
				SELECT
					b.item_id,
					SUM(tx_amount) AS tx_amount
				FROM 
					ret_billing_detail b
				JOIN
					ret_billing c ON b.tx_id = c.tx_id
				WHERE
					c.tx_date LIKE '$year%'
				GROUP BY
					b.item_id
			) d ON a.item_id = d.item_id"
		)->result();

		return $query;
	}

	public function monthly($month)
  {
		$query = $this->db->query(
			"SELECT 
				a.item_id,
				a.item_name,
				IFNULL(d.tx_amount, 0) AS tx_amount
			FROM
				ret_item a
			LEFT JOIN(
				SELECT
					b.item_id,
					SUM(tx_amount) AS tx_amount
				FROM 
					ret_billing_detail b
				JOIN
					ret_billing c ON b.tx_id = c.tx_id
				WHERE
					c.tx_date LIKE '$month%'
				GROUP BY
					b.item_id
			) d ON a.item_id = d.item_id"
		)->result();

		return $query;
	}

	public function weekly($date_start, $date_end)
	{		
		$query = $this->db->query(
			"SELECT 
				a.item_id,
				a.item_name,
				IFNULL(d.tx_amount, 0) AS tx_amount
			FROM
				ret_item a
			LEFT JOIN(
				SELECT
					b.item_id,
					SUM(tx_amount) AS tx_amount
				FROM 
					ret_billing_detail b
				JOIN
					ret_billing c ON b.tx_id = c.tx_id
				WHERE
					c.tx_date >= '$date_start' AND
					c.tx_date <= '$date_end'
				GROUP BY
					b.item_id
			) d ON a.item_id = d.item_id"
		)->result();

		return $query;
	}

	public function daily($date)
  {
		$query = $this->db->query(
			"SELECT 
				a.item_id,
				a.item_name,
				IFNULL(d.tx_amount, 0) AS tx_amount
			FROM
				ret_item a
			LEFT JOIN(
				SELECT
					b.item_id,
					SUM(tx_amount) AS tx_amount
				FROM 
					ret_billing_detail b
				JOIN
					ret_billing c ON b.tx_id = c.tx_id
				WHERE
					c.tx_date = '$date'
				GROUP BY
					b.item_id
			) d ON a.item_id = d.item_id"
		)->result();

		return $query;
	}

	public function range($date_start, $date_end)
	{		
		$query = $this->db->query(
			"SELECT 
				a.item_id,
				a.item_name,
				IFNULL(d.tx_amount, 0) AS tx_amount
			FROM
				ret_item a
			LEFT JOIN(
				SELECT
					b.item_id,
					SUM(tx_amount) AS tx_amount
				FROM 
					ret_billing_detail b
				JOIN
					ret_billing c ON b.tx_id = c.tx_id
				WHERE
					c.tx_date >= '$date_start' AND
					c.tx_date <= '$date_end'
				GROUP BY
					b.item_id
			) d ON a.item_id = d.item_id"
		)->result();

		return $query;
	}

}
