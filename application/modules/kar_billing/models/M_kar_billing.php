<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_billing extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->where('billing_status !=','0')
				->order_by('billing_id','desc')
				->get('kar_billing',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('guest_name',$search_term,'both')
				->where('is_deleted','0')
				->where('billing_status !=','0')
				->order_by('billing_id','desc')
				->get('kar_billing',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->where('billing_status !=','0')
			->order_by('billing_id','desc')
			->get('kar_billing')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('billing_id',$id)->get('kar_billing')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('billing_id','desc')->get('kar_billing')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_billing',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('billing_id',$id)->update('kar_billing',$data);
  }

  public function delete($id)
  {
    $this->db->where('billing_id',$id)->update('kar_billing',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_billing')->num_rows();
		}else{
			return $this->db->like('guest_name',$search_term,'both')->get('kar_billing')->num_rows();
		}
	}

}
