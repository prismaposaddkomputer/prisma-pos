<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_void extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->order_by('tx_id','desc')
				->get('res_void',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('void_name',$search_term,'both')
				->where('is_deleted','0')
				->order_by('tx_id','desc')
				->get('res_void',$number,$offset)
				->result();
		}
  }

	public function get_billing($id)
	{
		$query = $this->db
			->join('res_payment_type','res_billing.payment_type_id = res_payment_type.payment_type_id')
			->where('tx_receipt_no',$id)
			->get('res_billing')->row();

		if ($query != null) {
			$query->detail = $this->db
			->where('tx_id',$query->tx_id)
			->get('res_billing_detail')->result();
		}

		return $query;
	}

	public function get_last()
	{
		return $this->db
			->order_by('tx_id','desc')
			->get('res_void')->row();
	}

	public function insert($data)
	{
		return $this->db->insert('res_void',$data);
	}

	public function get_detail($id)
	{
		$data = $this->db->where('tx_id',$id)->get('res_void')->row();
		$data->detail = $this->db->where('tx_id',$id)->get('res_void_detail')->result();

		return $data;
	}

	public function insert_detail($data)
	{
		return $this->db->insert('res_void_detail',$data);
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_void')->num_rows();
		}else{
			return $this->db->like('void_name',$search_term,'both')->get('res_void')->num_rows();
		}
	}

}
