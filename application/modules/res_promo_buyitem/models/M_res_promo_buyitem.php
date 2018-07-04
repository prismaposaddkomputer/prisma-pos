<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_promo_buyitem extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->order_by('promo_buyitem_id','desc')
				->get('res_promo_buyitem',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('promo_buyitem_name',$search_term,'both')
				->order_by('promo_buyitem_id','desc')
				->get('res_promo_buyitem',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_promo_buyitem')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('promo_buyitem_id',$id)->get('res_promo_buyitem')->row();
  }

  public function get_last()
  {
    return $this->db
			->order_by('promo_buyitem_id','desc')
			->get('res_promo_buyitem')->row();
  }

  public function get_last_item($id)
  {
    return $this->db
      ->where('item_id',$id)
			->order_by('promo_buyitem_id','desc')
			->get('res_promo_buyitem')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_promo_buyitem',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('promo_id',$id)->update('res_promo_buyitem',$data);
  }

  public function delete($id)
  {
    $this->db->where('promo_buyitem_id',$id)->update('res_promo_buyitem',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_promo_buyitem')->num_rows();
		}else{
			return $this->db->like('promo_buyitem_name',$search_term,'both')->get('res_promo_buyitem')->num_rows();
		}
	}

}
