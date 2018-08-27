<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_reservation extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('hot_billing',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('reservation_name',$search_term,'both')
				->where('is_deleted','0')
				->get('hot_billing',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_billing')->result();
	}

	public function new_billing($billing_receipt_no)
	{
		$data = array(
			'billing_id' => NULL,
			'billing_receipt_no' => $billing_receipt_no
		);
		$this->db->insert('hot_billing', $data);
	}

	public function empty_detail($billing_id)
	{
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_room');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_extra');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_service');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_fnb');
	}

	public function room_detail($room_id)
	{
		return $this->db->query(
			"SELECT * FROM hot_room a
			JOIN hot_room_type b ON a.room_type_id = b.room_type_id
			WHERE a.room_id = '$room_id'"
		)->row();
	}

	public function add_room($data)
	{
		$this->db->insert('hot_billing_room', $data);
	}

	public function room_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_room')->result();
	}

	public function get_billing_room($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_room')->result();
	}

	public function delete_room($id)
	{
		$this->db->where('billing_room_id',$id)->delete('hot_billing_room');
	}

	public function count_room($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_room 
			FROM hot_billing_room 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_room;
	}

	public function add_extra($data)
	{
		$this->db->insert('hot_billing_extra', $data);
	}

	public function extra_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_extra')->result();
	}

	public function get_billing_extra($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_extra')->result();
	}

	public function delete_extra($id)
	{
		$this->db->where('billing_extra_id',$id)->delete('hot_billing_extra');
	}

	public function count_extra($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_extra 
			FROM hot_billing_extra 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_extra;
	}

}
