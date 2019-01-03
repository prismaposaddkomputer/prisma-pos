<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_denda extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('hot_denda',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('denda_name',$search_term,'both')
				->where('is_deleted','0')
				->get('hot_denda',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_denda')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('denda_id',$id)->get('hot_denda')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('denda_id','desc')->get('hot_denda')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_denda',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('denda_id',$id)->update('hot_denda',$data);
  }

  public function delete($id)
  {
    $this->db->where('denda_id',$id)->update('hot_denda',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_denda')->num_rows();
		}else{
			return $this->db->like('denda_name',$search_term,'both')->get('hot_denda')->num_rows();
		}
	}

}
