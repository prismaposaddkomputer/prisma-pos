<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_role extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted', 0)
				->get('kar_role',$number,$offset)
				->result();
		}else{
			return $this->db
				->where('is_deleted', 0)
				->like('role_name',$search_term,'both')
				->get('kar_role',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted', 0)
			->get('kar_role')
			->result();
	}

  public function get_by_id($id)
  {
    return $this->db
			->where('role_id',$id)
			->get('kar_role')
			->row();
  }

	public function get_by_parent($id)
	{
		return 0;
	}

  public function get_last()
  {
    return $this->db
			->order_by('role_id','desc')
			->get('kar_role')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_role',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('role_id',$id)->update('kar_role',$data);
  }

  public function delete($id)
  {
    $this->db->where('role_id',$id)->update('kar_role', array('is_deleted' => 1));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_role')->num_rows();
		}else{
			return $this->db->like('role_name',$search_term,'both')->get('kar_role')->num_rows();
		}
	}

}
