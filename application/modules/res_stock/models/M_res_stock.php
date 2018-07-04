<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_stock extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->order_by('stock_id','desc')
				->get('res_stock',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('stock_name',$search_term,'both')
				->order_by('stock_id','desc')
				->get('res_stock',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_stock')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('stock_id',$id)->get('res_stock')->row();
  }

  public function get_last()
  {
    return $this->db
			->order_by('stock_id','desc')
			->get('res_stock')->row();
  }

  public function get_last_item($id)
  {
    return $this->db
      ->where('item_id',$id)
			->order_by('stock_id','desc')
			->get('res_stock')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_stock',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('stock_id',$id)->update('res_stock',$data);
  }

  public function delete($id)
  {
    $this->db->where('stock_id',$id)->update('res_stock',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_stock')->num_rows();
		}else{
			return $this->db->like('stock_name',$search_term,'both')->get('res_stock')->num_rows();
		}
	}

}
