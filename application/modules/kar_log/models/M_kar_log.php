<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_log extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_log',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('log_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_log',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_log')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('log_id',$id)->get('kar_log')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('log_id','desc')->get('kar_log')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_log',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('log_id',$id)->update('kar_log',$data);
  }

  public function delete($id)
  {
    $this->db->where('log_id',$id)->update('kar_log',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_log')->num_rows();
		}else{
			return $this->db->like('log_name',$search_term,'both')->get('kar_log')->num_rows();
		}
	}

}
