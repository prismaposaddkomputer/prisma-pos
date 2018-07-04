<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_bank extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->select('ret_bank.*')
				->select('ret_payment_type.payment_type_name')
				->join('ret_payment_type','ret_bank.payment_type_id = ret_payment_type.payment_type_id')
				->where('ret_bank.is_deleted','0')
				->get('ret_bank',$number,$offset)
				->result();
		}else{
			return $this->db
				->select('ret_bank.*')
				->select('ret_payment_type.payment_type_name')
				->join('ret_payment_type','ret_bank.payment_type_id = ret_payment_type.payment_type_id')
				->like('bank_name',$search_term,'both')
				->where('ret_bank.is_deleted','0')
				->get('ret_bank',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_bank')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('bank_id',$id)->get('ret_bank')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('bank_id','desc')->get('ret_bank')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_bank',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('bank_id',$id)->update('ret_bank',$data);
  }

  public function delete($id)
  {
    $this->db->where('bank_id',$id)->update('ret_bank',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_bank')->num_rows();
		}else{
			return $this->db->like('bank_name',$search_term,'both')->get('ret_bank')->num_rows();
		}
	}

}
