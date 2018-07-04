<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_unit extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('ret_unit',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('unit_name',$search_term,'both')
				->where('is_deleted','0')
				->get('ret_unit',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_unit')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('unit_id',$id)->get('ret_unit')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('unit_id','desc')->get('ret_unit')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_unit',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('unit_id',$id)->update('ret_unit',$data);
  }

  public function delete($id)
  {
    $this->db->where('unit_id',$id)->update('ret_unit',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_unit')->num_rows();
		}else{
			return $this->db->like('unit_name',$search_term,'both')->get('ret_unit')->num_rows();
		}
	}

}
