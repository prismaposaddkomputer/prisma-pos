<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_role extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted', 0)
				->get('ret_role',$number,$offset)
				->result();
		}else{
			return $this->db
				->where('is_deleted', 0)
				->like('role_name',$search_term,'both')
				->get('ret_role',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted', 0)
			->get('ret_role')
			->result();
	}

  public function get_by_id($id)
  {
    return $this->db
			->where('role_id',$id)
			->get('ret_role')
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
			->get('ret_role')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_role',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('role_id',$id)->update('ret_role',$data);
  }

  public function delete($id)
  {
    $this->db->where('role_id',$id)->update('ret_role', array('is_deleted' => 1));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_role')->num_rows();
		}else{
			return $this->db->like('role_name',$search_term,'both')->get('ret_role')->num_rows();
		}
	}

}
