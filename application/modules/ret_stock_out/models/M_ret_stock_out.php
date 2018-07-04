<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_stock_out extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		$type_id = $this->session->userdata('type_id');
		if($search_term == null){
			return $this->db
				->join('ret_tx_type','ret_stock_out.tx_type = ret_tx_type.tx_type')
				->order_by('tx_date','desc')
				->order_by('tx_id','desc')
				->get('ret_stock_out',$number,$offset)
				->result();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->join('ret_tx_type','ret_stock_out.tx_type = ret_tx_type.tx_type')
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->order_by('tx_date','desc')
				->order_by('tx_id','desc')
				->get('ret_stock_out',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_stock_out')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('stock_out_id',$id)->get('ret_stock_out')->row();
  }

  public function get_last()
  {
    return $this->db
			->order_by('tx_id','desc')
			->get('ret_stock_out')->row();
  }

	public function get_detail($tx_id,$tx_type)
	{
    $result = $this->db
			->join('ret_tx_type','ret_stock_out.tx_type = ret_tx_type.tx_type')
			->where('tx_id',$tx_id)
			->get('ret_stock_out')->row();
		$result->recap = $this->get_stock($tx_id,$tx_type);
    return $result;
	}


	public function get_stock($tx_id,$tx_type)
	{
    return $this->db
			->join('ret_item','ret_stock.item_id = ret_item.item_id')
			->where('tx_id', $tx_id)
			->where('tx_type', $tx_type)
			->get('ret_stock')->result();
	}

  public function insert($data)
  {
    $this->db->insert('ret_stock_out',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('stock_out_id',$id)->update('ret_stock_out',$data);
  }

  public function delete($id)
  {
    $this->db->where('stock_out_id',$id)->update('ret_stock_out',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_stock_out')->num_rows();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->get('ret_stock_out')->num_rows();
		}
	}

}
