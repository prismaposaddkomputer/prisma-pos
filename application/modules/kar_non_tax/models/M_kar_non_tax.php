<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_non_tax extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_non_tax',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('non_tax_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_non_tax',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_non_tax')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('non_tax_id',$id)->get('kar_non_tax')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('non_tax_id','desc')->get('kar_non_tax')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_non_tax',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('non_tax_id',$id)->update('kar_non_tax',$data);
  }

  public function delete($id)
  {
    $this->db->where('non_tax_id',$id)->update('kar_non_tax',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_non_tax')->num_rows();
		}else{
			return $this->db->like('non_tax_name',$search_term,'both')->get('kar_non_tax')->num_rows();
		}
	}

}
