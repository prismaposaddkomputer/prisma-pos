<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_member extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->join('kar_member_type','ON kar_member.member_type_id=kar_member_type.member_type_id')
				->where('kar_member.is_deleted','0')
				->get('kar_member',$number,$offset)
				->result();
		}else{
			return $this->db
				->join('kar_member_type','ON kar_member.member_type_id=kar_member_type.member_type_id')
				->like('member_name',$search_term,'both')
				->where('kar_member.is_deleted','0')
				->get('kar_member',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_member')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('member_id',$id)->get('kar_member')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('member_id','desc')->get('kar_member')->row();
  }

	public function get_first()
	{
		return $this->db->order_by('member_id','asc')->get('kar_member')->row();
	}

  public function insert($data)
  {
    $this->db->insert('kar_member',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('member_id',$id)->update('kar_member',$data);
  }

  public function delete($id)
  {
    $this->db->where('member_id',$id)->update('kar_member',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_member')->num_rows();
		}else{
			return $this->db->like('member_name',$search_term,'both')->get('kar_member')->num_rows();
		}
	}

}
