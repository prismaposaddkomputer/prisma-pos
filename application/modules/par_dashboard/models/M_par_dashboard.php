<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_dashboard extends CI_Model {

  public function num_in()
  {
    $date = date('Y-m-d');

    $billing = $this->db->query(
      "SELECT
        COUNT(billing_tnkb) AS total
      FROM
        par_billing
      WHERE
        billing_date_in = '$date'
      "
    );

    return $billing->row();
  }

  public function num_out()
  {
    $date = date('Y-m-d');

    $billing = $this->db->query(
      "SELECT
        COUNT(billing_tnkb) AS total
      FROM
        par_billing
      WHERE
        billing_date_out = '$date'
      "
    );

    return $billing->row();
  }

  public function income_today()
  {
    $date = date('Y-m-d');

    $billing = $this->db->query(
      "SELECT
        COUNT(billing_total_grand) AS total
      FROM
        par_billing
      WHERE
        billing_date_out = '$date'
      "
    );

    return $billing->row();
  }

  public function graph_income_date()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
				billing_date_out
			FROM par_billing
			WHERE
        billing_date_out LIKE '$month_now%' AND
				billing_status_out = 1
			GROUP BY billing_date_out"
		);

		return $query->result();
  }

  public function graph_income_date_amount()
  {
    $month_now = date('Y-m');

    $query = $this->db->query(
			"SELECT
				SUM(billing_total_grand) AS total
			FROM par_billing
			WHERE
        billing_date_out LIKE '$month_now%' AND
				billing_status_out = 1
			GROUP BY billing_date_out"
		);

		return $query->result();
  }

  public function graph_income_month()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        MONTHNAME(billing_date_out) AS month
      FROM par_billing
      WHERE
        billing_date_out LIKE '$year_now%' AND
        billing_status_out = 1
      GROUP BY YEAR(billing_date_out),MONTH(billing_date_out)"
		);

		return $query->result();
  }

  public function graph_income_month_amount()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        SUM(billing_total_grand) AS total
      FROM par_billing
      WHERE
        billing_date_out LIKE '$year_now%' AND
        billing_status_out = 1
      GROUP BY YEAR(billing_date_out),MONTH(billing_date_out)"
		);

		return $query->result();
  }

  public function last_park_in()
  {
    $date = date('Y-m-d');

    $query = $this->db->query(
      "SELECT *
      FROM par_billing
      WHERE billing_date_in = '$date'
      ORDER BY billing_id DESC
      LIMIT 5"
    );

    return $query->result();
  }

  public function last_park_out()
  {
    $date = date('Y-m-d');

    $query = $this->db->query(
      "SELECT *
      FROM par_billing
      WHERE billing_date_out = '$date'
      ORDER BY billing_id DESC
      LIMIT 5"
    );

    return $query->result();
  }

}
