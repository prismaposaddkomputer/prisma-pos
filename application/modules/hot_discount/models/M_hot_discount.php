<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_discount extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('hot_discount',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('discount_name',$search_term,'both')
				->where('is_deleted','0')
				->get('hot_discount',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_discount')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('discount_id',$id)->get('hot_discount')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('discount_id','desc')->get('hot_discount')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_discount',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('discount_id',$id)->update('hot_discount',$data);
  }

  public function delete($id)
  {
    $this->db->where('discount_id',$id)->update('hot_discount',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_discount')->num_rows();
		}else{
			return $this->db->like('discount_name',$search_term,'both')->get('hot_discount')->num_rows();
		}
	}

}
