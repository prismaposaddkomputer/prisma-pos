<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_promo extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->select('res_promo.*')
				->select('res_promo_type.promo_type_code')
				->join('res_promo_type','res_promo.promo_type_id = res_promo_type.promo_type_id')
				->where('res_promo.is_deleted','0')
				->order_by('promo_id','DESC')
				->get('res_promo',$number,$offset)
				->result();
		}else{
			return $this->db
				->select('res_promo.*')
				->select('res_promo_type.promo_type_code')
				->join('res_promo_type','res_promo.promo_type_id = res_promo_type.promo_type_id')
				->like('promo_name',$search_term,'both')
				->where('res_promo.is_deleted','0')
				->order_by('promo_id','DESC')
				->get('res_promo',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('res_promo')->result();
	}

  public function get_by_id($id)
  {
		$promo = $this->db->where('promo_id',$id)->get('res_promo')->row();
		if ($promo->promo_type_id == 1) {
			return $this->db
				->join('res_promo_buyget','res_promo_buyget.promo_id = res_promo_buyget.promo_id','left')
				->where('res_promo.promo_id',$id)
				->get('res_promo')
				->row();
		}else if ($promo->promo_type_id == 2) {
			return $this->db
				->join('res_promo_buyitem','res_promo_buyitem.promo_id = res_promo_buyitem.promo_id','left')
				->where('res_promo.promo_id',$id)
				->get('res_promo')
				->row();
		}else if ($promo->promo_type_id == 3) {
			return $this->db
				->join('res_promo_buyall','res_promo_buyall.promo_id = res_promo_buyall.promo_id','left')
				->where('res_promo.promo_id',$id)
				->get('res_promo')
				->row();
		}
  }

  public function get_last()
  {
    return $this->db->order_by('promo_id','desc')->get('res_promo')->row();
  }

  public function insert($data)
  {
    $this->db->insert('res_promo',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('promo_id',$id)->update('res_promo',$data);
  }

  public function delete($id)
  {
    $this->db->where('promo_id',$id)->update('res_promo',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('res_promo')->num_rows();
		}else{
			return $this->db->like('promo_name',$search_term,'both')->get('res_promo')->num_rows();
		}
	}

}
