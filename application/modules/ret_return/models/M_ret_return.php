<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_return extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->order_by('tx_id','desc')
				->get('ret_return',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('return_name',$search_term,'both')
				->where('is_deleted','0')
				->order_by('tx_id','desc')
				->get('ret_return',$number,$offset)
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
			->get('ret_return')->row();
	}

	public function insert($data)
	{
		return $this->db->insert('ret_return',$data);
	}

	public function get_detail($id)
	{
		$data = $this->db->where('tx_id',$id)->get('ret_return')->row();
		$data->detail = $this->db->where('tx_id',$id)->get('ret_return_detail')->result();

		return $data;
	}

	public function insert_detail($data)
	{
		return $this->db->insert('ret_return_detail',$data);
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_return')->num_rows();
		}else{
			return $this->db->like('return_name',$search_term,'both')->get('ret_return')->num_rows();
		}
	}

}
