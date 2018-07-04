<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_void extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->order_by('tx_id','desc')
				->get('ret_void',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('void_name',$search_term,'both')
				->where('is_deleted','0')
				->order_by('tx_id','desc')
				->get('ret_void',$number,$offset)
				->result();
		}
  }

	public function get_billing($id)
	{
		$query = $this->db
			->join('ret_payment_type','ret_billing.payment_type_id = ret_payment_type.payment_type_id')
			->where('tx_receipt_no',$id)
			->get('ret_billing')->row();

		if ($query != null) {
			$query->detail = $this->db
			->where('tx_id',$query->tx_id)
			->get('ret_billing_detail')->result();
		}

		return $query;
	}

	public function get_last()
	{
		return $this->db
			->order_by('tx_id','desc')
			->get('ret_void')->row();
	}

	public function insert($data)
	{
		return $this->db->insert('ret_void',$data);
	}

	public function get_detail($id)
	{
		$data = $this->db->where('tx_id',$id)->get('ret_void')->row();
		$data->detail = $this->db->where('tx_id',$id)->get('ret_void_detail')->result();

		return $data;
	}

	public function insert_detail($data)
	{
		return $this->db->insert('ret_void_detail',$data);
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_void')->num_rows();
		}else{
			return $this->db->like('void_name',$search_term,'both')->get('ret_void')->num_rows();
		}
	}

}
