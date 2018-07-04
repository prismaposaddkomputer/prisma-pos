<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_cashier extends CI_Model {

  public function get_all_room()
  {
    $query = $this->db->query(
      "SELECT
      	a.*,
        c.tx_id,c.tx_receipt_no,c.user_realname,c.tx_time_start,c.tx_time_end,c.member_name,c.tx_status,c.tx_total_grand,
        d.room_type_name
      FROM
      	kar_room a
      LEFT JOIN
      	(SELECT * FROM kar_billing b WHERE b.tx_status != 2) c ON c.room_id = a.room_id
      JOIN
        kar_room_type d ON a.room_type_id = d.room_type_id
      ORDER BY
        a.room_type_id ASC,
        a.room_id ASC,
      	c.tx_id DESC"
    );
		return $query->result();
  }

  public function get_room_by_type($id)
  {
    $query = $this->db->query(
      "SELECT
        a.*,
        c.tx_id,c.user_realname,c.tx_time_start,c.tx_time_end,c.member_name,c.tx_status,c.tx_total_grand,
        d.room_type_name
      FROM
      	kar_room a
      LEFT JOIN
      	(SELECT * FROM kar_billing b WHERE b.tx_status != 2) c ON c.room_id = a.room_id
      JOIN
        kar_room_type d ON a.room_type_id = d.room_type_id
      WHERE
        a.room_type_id = '$id'
      ORDER BY
      	c.tx_id DESC"
    );
		return $query->result();
  }

  public function get_room_by_id($id)
  {
    $query = $this->db->query(
      "SELECT
        a.*,
        c.tx_time_start,c.tx_time_end,c.member_name,
        d.*
      FROM
      	kar_room a
      LEFT JOIN
      	(SELECT * FROM kar_billing b WHERE b.tx_status != 2) c ON c.room_id = a.room_id
      JOIN
        kar_room_type d ON a.room_type_id = d.room_type_id
      WHERE
        a.room_id = '$id'
      ORDER BY
      	c.tx_id DESC"
    );
		return $query->row();
  }

  public function insert_service_charge($data)
  {
    $this->db->insert('kar_billing_service_charge', $data);
  }

  public function get_service_charge($id)
  {
    return $this->db->where('tx_id',$id)->get('kar_billing_service_charge')->result();
  }

  public function finish_action($id)
  {
    $this->db->where('tx_id',$id)->update('kar_billing',array('tx_status' => '2'));
  }

}
