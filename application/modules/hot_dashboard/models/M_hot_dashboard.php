<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_dashboard extends CI_Model {

  public function booking_today()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
			"SELECT
				count(booking_id) AS total_booking
			FROM hot_booking
			WHERE
				date_booking = '$date_now' AND
				is_active = 1 AND
        is_deleted = 0
			GROUP BY date_booking"
		);

		return $query->row();
  }

  public function count_guest_member() {
      $sql = "SELECT
                COUNT(guest_id) AS count_data
              FROM hot_guest
              WHERE
                guest_type = '1' AND
                is_active = '1'";
      $query = $this->db->query($sql);
      $result = $query->row_array();
      // 
      return $result['count_data'];
  }

  public function count_all_billing_id() {
      $sql = "SELECT
                COUNT(billing_id) AS count_data
              FROM hot_billing
              WHERE
                billing_status != '0'";
      $query = $this->db->query($sql);
      $result = $query->row_array();
      // 
      return $result['count_data'];
  }

  public function count_billing_id_today($today) {
      $sql = "SELECT
                COUNT(billing_id) AS count_data
              FROM hot_billing
              WHERE
                billing_date_in LIKE '$today%' AND
                billing_status != '0'
              GROUP BY billing_date_in
              ORDER BY billing_date_in ASC";
      $query = $this->db->query($sql);
      $result = $query->row_array();
      // 
      return $result['count_data'];
  }

  public function count_billing_id_chart_monthly($month) {
      $sql = "SELECT
                COUNT(billing_id) AS count_data
              FROM hot_billing
              WHERE
                billing_date_in LIKE '$month%' AND
                billing_status != '0'
              GROUP BY billing_date_in
              ORDER BY billing_date_in ASC";
      $query = $this->db->query($sql);
      $result = $query->result_array();
      // 
      return $result;
  }

  public function chart_monthly($month)
  {
    $billing = $this->db->query(
      "SELECT
        *,
        SUM(billing_total) AS billing_total
      FROM hot_billing
      WHERE
        billing_date_in LIKE '$month%' AND
        billing_status != '0'
      GROUP BY billing_date_in
      ORDER BY billing_date_in ASC"
    )->result();

    return $billing;
  }

  public function total_guest_today()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
	    "SELECT
				count(guest_id) AS total_guest
	    FROM hot_guest
	    WHERE
	      date(created) = '$date_now' AND
	      is_active = 0 AND
        is_deleted = 0
        GROUP BY created"
	  );

    return $query->row();
  }

  public function total_room_available()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
	    "SELECT
				count(room_id) AS total_room
	    FROM hot_room
	    WHERE
	      is_active = 1 AND
        is_deleted = 0"
	  );

    return $query->row();
  }

  public function total_service_available()
  {
    $date_now = date('Y-m-d');

    $query = $this->db->query(
	    "SELECT
				count(service_id) AS total_service
	    FROM hot_service
	    WHERE
	      is_active = 1 AND
        is_deleted = 0"
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
        MONTHNAME(date_booking) AS tx_month
      FROM hot_booking
      WHERE
        date_booking LIKE '$year_now%' AND
        is_active = 1 and
        is_deleted = 0
      GROUP BY YEAR(date_booking),MONTH(date_booking)"
		);

		return $query->result();
  }

  public function graph_profit_amount()
  {
    $year_now = date('Y');

    $query = $this->db->query(
			"SELECT
        count(booking_id) AS total_booking
      FROM hot_booking
      WHERE
        date_booking LIKE '$year_now%' AND
        is_active = 1 and
        is_deleted = 0
      GROUP BY YEAR(date_booking),MONTH(date_booking)"
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
