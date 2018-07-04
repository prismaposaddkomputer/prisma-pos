<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_payment_type extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->order_by('payment_type_id','desc')
				->get('res_payment_type',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('payment_type_name',$search_term,'both')
				->order_by('payment_type_id','desc')
				->get('res_payment_type',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_payment_type')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('payment_type_id',$id)->get('res_payment_type')->row();
  }

  public function get_last()
  {
    return $this->db
			->order_by('payment_type_id','desc')
			->get('res_payment_type')->row();
  }

  public function get_last_item($id)
  {
    return $this->db
      ->where('item_id',$id)
			->order_by('payment_type_id','desc')
			->get('res_payment_type')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_payment_type',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('payment_type_id',$id)->update('res_payment_type',$data);
  }

  public function delete($id)
  {
    $this->db->where('payment_type_id',$id)->update('res_payment_type',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_payment_type')->num_rows();
		}else{
			return $this->db->like('payment_type_name',$search_term,'both')->get('res_payment_type')->num_rows();
		}
	}

}
