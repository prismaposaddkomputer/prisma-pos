<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_fnb extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('hot_fnb',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('fnb_name',$search_term,'both')
				->where('is_deleted','0')
				->get('hot_fnb',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_fnb')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('fnb_id',$id)->get('hot_fnb')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('fnb_id','desc')->get('hot_fnb')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_fnb',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('fnb_id',$id)->update('hot_fnb',$data);
  }

  public function delete($id)
  {
    $this->db->where('fnb_id',$id)->update('hot_fnb',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_fnb')->num_rows();
		}else{
			return $this->db->like('fnb_name',$search_term,'both')->get('hot_fnb')->num_rows();
		}
	}

}
