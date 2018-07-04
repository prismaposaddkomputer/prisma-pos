<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_supplier extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('res_supplier',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('supplier_name',$search_term,'both')
				->where('is_deleted','0')
				->get('res_supplier',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_supplier')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('supplier_id',$id)->get('res_supplier')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('supplier_id','desc')->get('res_supplier')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_supplier',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('supplier_id',$id)->update('res_supplier',$data);
  }

  public function delete($id)
  {
    $this->db->where('supplier_id',$id)->update('res_supplier',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_supplier')->num_rows();
		}else{
			return $this->db->like('supplier_name',$search_term,'both')->get('res_supplier')->num_rows();
		}
	}

}
