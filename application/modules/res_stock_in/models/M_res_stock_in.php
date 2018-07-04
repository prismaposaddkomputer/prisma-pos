<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_stock_in extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->join('res_tx_type','res_stock_in.tx_type = res_tx_type.tx_type')
				->order_by('tx_date','desc')
				->order_by('tx_id','desc')
				->get('res_stock_in',$number,$offset)
				->result();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->join('res_tx_type','res_stock_in.tx_type = res_tx_type.tx_type')
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->order_by('tx_date','desc')
				->order_by('tx_id','desc')
				->get('res_stock_in',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_stock_in')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('stock_in_id',$id)->get('res_stock_in')->row();
  }

  public function get_last()
  {
    return $this->db
			->order_by('tx_id','desc')
			->get('res_stock_in')->row();
  }

	public function get_detail($tx_id,$tx_type)
	{
    $result = $this->db
			->join('res_tx_type','res_stock_in.tx_type = res_tx_type.tx_type')
			->where('tx_id',$tx_id)
			->get('res_stock_in')->row();
		$result->recap = $this->get_stock($tx_id,$tx_type);
    return $result;
	}


	public function get_stock($tx_id,$tx_type)
	{
    return $this->db
			->join('res_item','res_stock.item_id = res_item.item_id')
			->where('tx_id', $tx_id)
			->where('tx_type', $tx_type)
			->get('res_stock')->result();
	}

  public function insert($data)
  {
    $this->db->insert('res_stock_in',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('stock_in_id',$id)->update('res_stock_in',$data);
  }

  public function delete($id)
  {
    $this->db->where('stock_in_id',$id)->update('res_stock_in',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_stock_in')->num_rows();
		}else{
			$tanggal = explode(" - ", $search_term);
			$date_start = ind_to_date($tanggal[0]);
			$date_end = ind_to_date($tanggal[1]);
			return $this->db
				->where('tx_date >=', $date_start)
				->where('tx_date <=', $date_end)
				->get('res_stock_in')->num_rows();
		}
	}

}
