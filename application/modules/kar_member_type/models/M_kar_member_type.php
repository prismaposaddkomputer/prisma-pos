<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_member_type extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_member_type',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('member_type_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_member_type',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_member_type')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('member_type_id',$id)->get('kar_member_type')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('member_type_id','desc')->get('kar_member_type')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_member_type',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('member_type_id',$id)->update('kar_member_type',$data);
  }

  public function delete($id)
  {
    $this->db->where('member_type_id',$id)->update('kar_member_type',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_member_type')->num_rows();
		}else{
			return $this->db->like('member_type_name',$search_term,'both')->get('kar_member_type')->num_rows();
		}
	}

}
