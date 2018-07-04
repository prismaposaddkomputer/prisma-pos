<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_customer extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('res_customer',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('customer_name',$search_term,'both')
				->where('is_deleted','0')
				->get('res_customer',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_customer')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('customer_id',$id)->get('res_customer')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('customer_id','desc')->get('res_customer')->row();
  }

	public function get_first()
	{
		return $this->db->order_by('customer_id','asc')->get('res_customer')->row();
	}

  public function insert($data)
  {
    $this->db->insert('res_customer',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('customer_id',$id)->update('res_customer',$data);
  }

  public function delete($id)
  {
    $this->db->where('customer_id',$id)->update('res_customer',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_customer')->num_rows();
		}else{
			return $this->db->like('customer_name',$search_term,'both')->get('res_customer')->num_rows();
		}
	}

}
