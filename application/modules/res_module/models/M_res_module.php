<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_module extends CI_Model {

	public function get_list($search_term = null)
  {
		if($search_term == null){
			return $this->db
				->get('res_module')
				->result();
		}else{
			return $this->db
				->like('module_name',$search_term,'both')
				->get('res_module')
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->get('res_module')
			->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('module_id',$id)->get('res_module')->row();
  }

	public function get_by_parent($id)
	{
		return 0;
	}

  public function get_last()
  {
    return $this->db->order_by('module_id','desc')->get('res_module')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_module',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('module_id',$id)->update('res_module',$data);
  }

  public function delete($id)
  {
    $this->db->where('module_id',$id)->delete('res_module');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_module')->num_rows();
		}else{
			return $this->db->like('module_name',$search_term,'both')->get('res_module')->num_rows();
		}
	}

}
