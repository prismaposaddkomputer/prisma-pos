<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_user extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
			  ->select('hot_user.*, hot_role.role_name')
				->join('hot_role','hot_user.role_id = hot_role.role_id')
				->order_by('user_id')
				->get('hot_user',$number,$offset)
				->result();
		}else{
			return $this->db
			  ->select('hot_user.*, hot_role.role_name')
				->join('hot_role','hot_user.role_id = hot_role.role_id')
				->like('user_name',$search_term,'both')
				->or_like('role_name',$search_term,'both')
				->order_by('user_id')
				->get('hot_user',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db->order_by('user_id', 'ASC')->get('hot_user')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('user_id',$id)->get('hot_user')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('user_id','desc')->get('hot_user')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_user',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('user_id',$id)->update('hot_user',$data);
  }

  public function delete($id)
  {
    $this->db->where('user_id',$id)->delete('hot_user');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_user')->num_rows();
		}else{
			return $this->db->like('user_name',$search_term,'both')->get('hot_user')->num_rows();
		}
	}

}
