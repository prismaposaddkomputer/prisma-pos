<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_discount extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_discount',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('discount_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_discount',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_discount')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('discount_id',$id)->get('kar_discount')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('discount_id','desc')->get('kar_discount')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_discount',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('discount_id',$id)->update('kar_discount',$data);
  }

  public function delete($id)
  {
    $this->db->where('discount_id',$id)->update('kar_discount',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_discount')->num_rows();
		}else{
			return $this->db->like('discount_name',$search_term,'both')->get('kar_discount')->num_rows();
		}
	}

}
