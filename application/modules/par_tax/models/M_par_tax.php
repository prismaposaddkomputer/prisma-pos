<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_tax extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('par_tax',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('tax_name',$search_term,'both')
				->where('is_deleted','0')
				->get('par_tax',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('par_tax')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('tax_id',$id)->get('par_tax')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('tax_id','desc')->get('par_tax')->row();
  }

  public function insert($data)
  {
    $this->db->insert('par_tax',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('tax_id',$id)->update('par_tax',$data);
  }

  public function delete($id)
  {
    $this->db->where('tax_id',$id)->update('par_tax',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('par_tax')->num_rows();
		}else{
			return $this->db->like('tax_name',$search_term,'both')->get('par_tax')->num_rows();
		}
	}

}
