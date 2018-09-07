<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_booking extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_booking',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('booking_code',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_booking',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_booking')->result();
	}

	
	public function get_all_tamu()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_guest')->result();
	}

	public function get_room()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_room')->result();
	}

	public function get_payment()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_payment')->result();
	}

	public function get_tipe()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_category')->result();
	}

	public function get_all_service()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_service')->result();
	}

	public function get_all_room()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_room')->result();
	}

	public function get_all_noroom()
	{
		return $this->db
			->where('is_deleted','0')
			->get('kar_room')->result();
	}


  public function get_by_id($id)
  {
    return $this->db->where('booking_id',$id)->get('kar_booking')->row();
	}
		
	public function get_by_idr($id)
  {
    return $this->db->where('booking_id',$id)->get('kar_booking_room')->row();
	}
	
	public function get_by_ids($id)
  {
    return $this->db->where('booking_id',$id)->get('kar_booking_service')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('booking_id','desc')->get('kar_booking')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_booking',$data);
  }

	public function insert_payment($data)
  {
    $this->db->insert('kar_payment',$data);
  }


  public function update($id,$data)
  {
    $this->db->where('booking_id',$id)->update('kar_booking',$data);
  }

  public function delete($id)
  {
    $this->db->where('booking_id',$id)->update('kar_booking',array('is_deleted' => '1'));
	}
	
	public function deletePay($id)
  {
    $this->db->where('booking_id',$id)->update('kar_payment',array('is_deleted' => '1'));
	}
	
	public function deleteRoom($id)
  {
    $this->db->where('room_id',$id)->update('kar_room',array('is_active' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_booking')->num_rows();
		}else{
			return $this->db->like('booking_code',$search_term,'both')->get('kar_booking')->num_rows();
		}
	}

	function cari_tamu($q){
		if($q == null){
			return $this->db
					->where('is_deleted','0')
					->where('is_active','1')
					->limit(10)
					->get('kar_guest')->result();
		}else{
			return $this->db
				->where('is_deleted','0')
				->where('is_active','1')
				->like('guest_name',$q)
				->limit(10)
				->get('kar_guest')->result();
		}
	}

}
