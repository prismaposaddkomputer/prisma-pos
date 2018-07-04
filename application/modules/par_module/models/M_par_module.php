<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_module extends CI_Model {

	public function get_list($search_term = null)
  {
		if($search_term == null){
			return $this->db
				->get('par_module')
				->result();
		}else{
			return $this->db
				->like('module_name',$search_term,'both')
				->get('par_module')
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->get('par_module')
			->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('module_id',$id)->get('par_module')->row();
  }

	public function get_by_parent($id)
	{
		return 0;
	}

  public function get_last()
  {
    return $this->db->order_by('module_id','desc')->get('par_module')->row();
  }

  public function insert($data)
  {
    $this->db->insert('par_module',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('module_id',$id)->update('par_module',$data);
  }

  public function delete($id)
  {
    $this->db->where('module_id',$id)->delete('par_module');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('par_module')->num_rows();
		}else{
			return $this->db->like('module_name',$search_term,'both')->get('par_module')->num_rows();
		}
	}

}
