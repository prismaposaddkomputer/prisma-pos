<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_category extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('par_category',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('category_name',$search_term,'both')
				->where('is_deleted','0')
				->get('par_category',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('par_category')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('category_id',$id)->get('par_category')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('category_id','desc')->get('par_category')->row();
  }

  public function insert($data)
  {
    $this->db->insert('par_category',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('category_id',$id)->update('par_category',$data);
  }

  public function delete($id)
  {
    $this->db->where('category_id',$id)->update('par_category',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('par_category')->num_rows();
		}else{
			return $this->db->like('category_name',$search_term,'both')->get('par_category')->num_rows();
		}
	}

}
