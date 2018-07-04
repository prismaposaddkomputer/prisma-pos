<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_dashboard extends CI_Model {

  public function selling_today()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
			"SELECT
				SUM(tx_total_after_tax) AS tx_total_after_tax,
				SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax
			FROM ret_billing
			WHERE
				tx_date = '$date_now' AND
				tx_status = 1
			GROUP BY tx_date"
		);

		return $query->row();
  }

  public function total_item_today()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
	    "SELECT
				SUM(tx_amount) AS total_item
	    FROM ret_billing_detail a
			JOIN ret_billing b
			ON a.tx_id = b.tx_id
	    WHERE
	      tx_date = '$date_now' AND
	      tx_status = 1"
	  );

    return $query->row();
  }

  public function graph_sell_date()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
				tx_date
			FROM ret_billing
			WHERE
        tx_date LIKE '$month_now%' AND
				tx_status = 1
			GROUP BY tx_date"
		);

		return $query->result();
  }

  public function graph_sell_amount()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
				SUM(tx_total_after_tax) AS tx_total_after_tax
			FROM ret_billing
			WHERE
        tx_date LIKE '$month_now%' AND
				tx_status = 1
			GROUP BY tx_date"
		);

		return $query->result();
  }

  public function graph_profit_month()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        MONTHNAME(tx_date) AS tx_month
      FROM ret_billing
      WHERE
        tx_date LIKE '$year_now%' AND
        tx_status = 1
      GROUP BY YEAR(tx_date),MONTH(tx_date)"
		);

		return $query->result();
  }

  public function graph_profit_amount()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        SUM(tx_total_profit_before_tax) AS tx_total_profit_before_tax
      FROM ret_billing
      WHERE
        tx_date LIKE '$year_now%' AND
        tx_status = 1
      GROUP BY YEAR(tx_date),MONTH(tx_date)"
		);

		return $query->result();
  }

  public function most_sell()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
        SUM(tx_amount) AS tx_amount,
        item_name
      FROM ret_billing_detail a
      JOIN ret_billing b ON a.tx_id = b.tx_id
      WHERE
        tx_date LIKE '$month_now%' AND
        tx_status = 1
      GROUP BY item_id
      ORDER BY tx_amount DESC
      LIMIT 5"
		);

		return $query->result();
  }

  public function new_item()
  {
    $query = $this->db->query(
			"SELECT
        *
      FROM ret_item a
      ORDER BY created DESC
      LIMIT 5"
		);

		return $query->result();
  }

}
