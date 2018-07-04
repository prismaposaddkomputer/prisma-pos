<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_dashboard extends CI_Model {

  public function billing_today()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
			"SELECT
				SUM(tx_total_before_tax) AS tx_total_before_tax
			FROM kar_billing
			WHERE
				tx_date = '$date_now' AND
				tx_status = 2
			GROUP BY tx_date"
		);

		return $query->row();
  }

  public function total_billing_today()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
	    "SELECT
				SUM(tx_id) AS total_transaction
	    FROM kar_billing a
	    WHERE
	      a.tx_date = '$date_now' AND
	      a.tx_status = 2"
	  );

    return $query->row();
  }

  public function graph_sell_date()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
				tx_date
			FROM kar_billing
			WHERE
        tx_date LIKE '$month_now%' AND
				tx_status = 2
			GROUP BY tx_date"
		);

		return $query->result();
  }

  public function graph_sell_amount()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
				SUM(tx_total_before_tax) AS tx_total_before_tax
			FROM kar_billing
			WHERE
        tx_date LIKE '$month_now%' AND
				tx_status = 2
			GROUP BY tx_date"
		);

		return $query->result();
  }

  public function graph_sell_month()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        MONTHNAME(tx_date) AS tx_month
      FROM kar_billing
      WHERE
        tx_date LIKE '$year_now%' AND
        tx_status = 2
      GROUP BY YEAR(tx_date),MONTH(tx_date)"
		);

		return $query->result();
  }

  public function graph_profit_amount()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        SUM(tx_total_before_tax) AS tx_total_before_tax
      FROM ret_billing
      WHERE
        tx_date LIKE '$year_now%' AND
        tx_status = 2
      GROUP BY YEAR(tx_date),MONTH(tx_date)"
		);

		return $query->result();
  }

  public function most_sell()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
        SUM(tx_duration) AS tx_duration,
        room_name
      FROM kar_billing_detail a
      WHERE
        tx_date LIKE '$month_now%' AND
        tx_status = 1
      GROUP BY room_id
      ORDER BY tx_amount DESC
      LIMIT 5"
		);

		return $query->result();
  }

  public function new_room()
  {
    $query = $this->db->query(
			"SELECT
        *
      FROM kar_room a
      ORDER BY created DESC
      LIMIT 5"
		);

		return $query->result();
  }

}
