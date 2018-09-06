<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_billing_extra extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_billing_extra',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('billing_extra_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_billing_extra',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_billing_extra')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('billing_extra_id',$id)->get('kar_billing_extra')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('billing_extra_id','desc')->get('kar_billing_extra')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_billing_extra',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('billing_extra_id',$id)->update('kar_billing_extra',$data);
  }

  public function delete($id)
  {
    $this->db->where('billing_extra_id',$id)->update('kar_billing_extra',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_billing_extra')->num_rows();
		}else{
			return $this->db->like('billing_extra_name',$search_term,'both')->get('kar_billing_extra')->num_rows();
		}
	}

}
