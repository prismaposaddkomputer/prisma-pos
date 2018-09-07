<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_payment extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_payment',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('payment_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_payment',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_payment')->result();
	}

	public function get_all_booking()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_booking')->result();
	}

	public function get_all_tamu()
	{
		return $this->db
			->get('kar_guest')->result();
	}

	
	public function get_payment()
	{
		return $this->db
			->get('kar_payment')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('id',$id)->get('kar_payment')->row();
	}
	
	public function get_by_billing($id)
  {
		return $this->db->query("select
				* from kar_payment a 
				join kar_booking b on a.booking_id=b.booking_id
				join kar_guest c on b.guest_id=c.guest_id
				join kar_room d on b.room_id=d.room_id
				where a.id='$id' 
		")->row();
  }

  public function get_last()
  {
    return $this->db->order_by('id','desc')->get('kar_payment')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_payment',$data);
  }

	public function get_tipe()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_category')->result();
	}


  public function update($id,$data)
  {
    $this->db->where('id',$id)->update('kar_payment',$data);
  }

  public function delete($id)
  {
    $this->db->where('id',$id)->update('kar_payment',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_payment')->num_rows();
		}else{
			return $this->db->like('payment_name',$search_term,'both')->get('kar_payment')->num_rows();
		}
	}

	public function get_client()
	{
		return $this->db->get('kar_client')->row();
	}


}
