<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_booking extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('hot_booking',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('booking_code',$search_term,'both')
				->where('is_deleted','0')
				->get('hot_booking',$number,$offset)
				->result();
		}
  }

	public function get_tipe()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_category')->result();
	}


	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_booking')->result();
	}

	
	public function get_all_tamu()
	{
		return $this->db
			->where('is_deleted','0')
			->get('hot_guest')->result();
	}

	public function get_all_service()
	{
		return $this->db
			->where('is_deleted','0')
			->get('hot_service')->result();
	}

	public function get_all_room()
	{
		return $this->db
			->where('is_deleted','0')
			->get('hot_room')->result();
	}

	public function get_all_diskon()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_diskon')->result();
	}


  public function get_by_id($id)
  {
    return $this->db->where('booking_id',$id)->get('hot_booking')->row();
	}
	
	
	public function get_by_idr($id)
  {
    return $this->db->where('booking_id',$id)->get('hot_booking_room')->row();
	}
	
	public function get_by_ids($id)
  {
    return $this->db->where('booking_id',$id)->get('hot_booking_service')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('booking_id','desc')->get('hot_booking')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_booking',$data);
  }

	public function insert_payment($data)
  {
    $this->db->insert('hot_payment',$data);
  }


  public function update($id,$data)
  {
    $this->db->where('booking_id',$id)->update('hot_booking',$data);
  }

  public function delete($id)
  {
    $this->db->where('booking_id',$id)->update('hot_booking',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_booking')->num_rows();
		}else{
			return $this->db->like('booking_code',$search_term,'both')->get('hot_booking')->num_rows();
		}
	}

	function cari_tamu($q){
		if($q == null){
			return $this->db
					->where('is_deleted','0')
					->where('is_active','1')
					->limit(10)
					->get('hot_guest')->result();
		}else{
			return $this->db
				->where('is_deleted','0')
				->where('is_active','1')
				->like('guest_name',$q)
				->limit(10)
				->get('hot_guest')->result();
		}
	}

}
