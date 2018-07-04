<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_promo extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->select('ret_promo.*')
				->select('ret_promo_type.promo_type_code')
				->join('ret_promo_type','ret_promo.promo_type_id = ret_promo_type.promo_type_id')
				->where('ret_promo.is_deleted','0')
				->order_by('promo_id','DESC')
				->get('ret_promo',$number,$offset)
				->result();
		}else{
			return $this->db
				->select('ret_promo.*')
				->select('ret_promo_type.promo_type_code')
				->join('ret_promo_type','ret_promo.promo_type_id = ret_promo_type.promo_type_id')
				->like('promo_name',$search_term,'both')
				->where('ret_promo.is_deleted','0')
				->order_by('promo_id','DESC')
				->get('ret_promo',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('ret_promo')->result();
	}

  public function get_by_id($id)
  {
		$promo = $this->db->where('promo_id',$id)->get('ret_promo')->row();
		if ($promo->promo_type_id == 1) {
			return $this->db
				->join('ret_promo_buyget','ret_promo_buyget.promo_id = ret_promo_buyget.promo_id','left')
				->where('ret_promo.promo_id',$id)
				->get('ret_promo')
				->row();
		}else if ($promo->promo_type_id == 2) {
			return $this->db
				->join('ret_promo_buyitem','ret_promo_buyitem.promo_id = ret_promo_buyitem.promo_id','left')
				->where('ret_promo.promo_id',$id)
				->get('ret_promo')
				->row();
		}else if ($promo->promo_type_id == 3) {
			return $this->db
				->join('ret_promo_buyall','ret_promo_buyall.promo_id = ret_promo_buyall.promo_id','left')
				->where('ret_promo.promo_id',$id)
				->get('ret_promo')
				->row();
		}
  }

  public function get_last()
  {
    return $this->db->order_by('promo_id','desc')->get('ret_promo')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_promo',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('promo_id',$id)->update('ret_promo',$data);
  }

  public function delete($id)
  {
    $this->db->where('promo_id',$id)->update('ret_promo',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_promo')->num_rows();
		}else{
			return $this->db->like('promo_name',$search_term,'both')->get('ret_promo')->num_rows();
		}
	}

}
