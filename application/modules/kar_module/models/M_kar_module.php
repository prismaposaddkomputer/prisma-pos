<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_module extends CI_Model {

	public function get_list($search_term = null)
  {
		if($search_term == null){
			return $this->db
				->get('kar_module')
				->result();
		}else{
			return $this->db
				->like('module_name',$search_term,'both')
				->get('kar_module')
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->get('kar_module')
			->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('module_id',$id)->get('kar_module')->row();
  }

	public function get_by_parent($id)
	{
		return 0;
	}

  public function get_last()
  {
    return $this->db->order_by('module_id','desc')->get('kar_module')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_module',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('module_id',$id)->update('kar_module',$data);
  }

  public function delete($id)
  {
    $this->db->where('module_id',$id)->delete('kar_module');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_module')->num_rows();
		}else{
			return $this->db->like('module_name',$search_term,'both')->get('kar_module')->num_rows();
		}
	}

}
