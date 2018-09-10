<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_reservation extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->order_by('billing_id','desc')
				->get('hot_billing',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('guest_name',$search_term,'both')
				->where('is_deleted','0')
				->order_by('billing_id','desc')
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

	public function get_billing($id)
	{
		$data = $this->db->where('billing_id',$id)->get('hot_billing')->row();
		$data->room = $this->db->where('billing_id',$id)->get('hot_billing_room')->result();
		$data->extra = $this->db->where('billing_id',$id)->get('hot_billing_extra')->result();
		$data->service = $this->db->where('billing_id',$id)->get('hot_billing_service')->result();
		$data->non_tax = $this->db->where('billing_id',$id)->get('hot_billing_non_tax')->result();
		$data->fnb = $this->db->where('billing_id',$id)->get('hot_billing_fnb')->result();
		
		return $data;
	}

	public function new_billing($billing_receipt_no)
	{
		$data = array(
			'billing_id' => NULL,
			'billing_receipt_no' => $billing_receipt_no
		);
		$this->db->insert('hot_billing', $data);
	}

	public function update($billing_id,$data)
	{
		$this->db->where('billing_id',$billing_id)->update('hot_billing',$data);
	}

	public function empty_detail($billing_id)
	{
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_room');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_extra');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_service');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_fnb');
		$this->db->where('billing_id',$billing_id)->delete('hot_billing_non_tax');
	}

	public function room_detail($room_id)
	{
		$room = $this->db->query(
			"SELECT * FROM hot_room a
			JOIN hot_room_type b ON a.room_type_id = b.room_type_id
			WHERE a.room_id = '$room_id'"
		)->row();

		return $room;
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

	public function update_billing_room($id,$data)
	{
		$this->db
			->where('billing_room_id',$id)
			->update('hot_billing_room',$data);
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

	public function add_service($data)
	{
		$this->db->insert('hot_billing_service', $data);
	}

	public function service_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_service')->result();
	}

	public function get_billing_service($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_service')->result();
	}

	public function delete_service($id)
	{
		$this->db->where('billing_service_id',$id)->delete('hot_billing_service');
	}

	public function count_service($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_service 
			FROM hot_billing_service 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_service;
	}

	public function add_fnb($data)
	{
		$this->db->insert('hot_billing_fnb', $data);
	}

	public function fnb_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_fnb')->result();
	}

	public function get_billing_fnb($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_fnb')->result();
	}

	public function delete_fnb($id)
	{
		$this->db->where('billing_fnb_id',$id)->delete('hot_billing_fnb');
	}

	public function count_fnb($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_fnb 
			FROM hot_billing_fnb 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_fnb;
	}

	public function add_non_tax($data)
	{
		$this->db->insert('hot_billing_non_tax', $data);
	}

	public function non_tax_list($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_non_tax')->result();
	}

	public function get_billing_non_tax($billing_id)
	{
		return $this->db
			->where('billing_id',$billing_id)
			->get('hot_billing_non_tax')->result();
	}

	public function delete_non_tax($id)
	{
		$this->db->where('billing_non_tax_id',$id)->delete('hot_billing_non_tax');
	}

	public function count_non_tax($billing_id)
	{
		$data = $this->db->query(
			"SELECT COUNT(*) AS count_non_tax 
			FROM hot_billing_non_tax 
			WHERE billing_id = '$billing_id'"
		)->row();

		return $data->count_non_tax;
	}

	public function discount_room()
	{
		return $this->db
			->where('discount_category',0)
			->or_where('discount_category',2)
			->get('hot_discount')->result();
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_billing')->num_rows();
		}else{
			return $this->db->like('guest_name',$search_term,'both')->get('hot_billing')->num_rows();
		}
	}

}
