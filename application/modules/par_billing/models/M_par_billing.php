<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_billing extends CI_Model {

	public function get_list_in()
  {
		$user_id = $this->session->userdata('user_id');

		return $this->db
			->join('par_category', 'par_billing.category_id = par_category.category_id')
			->join('par_brand', 'par_billing.brand_id = par_brand.brand_id')
			->where('user_id_in', $user_id)
			->where('billing_date_in', date('Y-m-d'))
			->order_by('billing_id','desc')
			->limit(10)
			->get('par_billing')
			->result();
  }

	public function get_list_out()
  {
		$user_id = $this->session->userdata('user_id');

		return $this->db
			->join('par_category', 'par_billing.category_id = par_category.category_id')
			->join('par_brand', 'par_billing.brand_id = par_brand.brand_id')
			->where('user_id_out',$user_id)
			->where('billing_status_out', '1')
			->where('billing_date_in', date('Y-m-d'))
			->order_by('billing_id','desc')
			->limit(10)
			->get('par_billing')
			->result();
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('par_billing')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('billing_id',$id)->get('par_billing')->row();
  }

	public function get_by_tnkb($billing_tnkb)
  {
    return $this->db
			->where('billing_tnkb', $billing_tnkb)
			->where('billing_status_out','0')
			->order_by('billing_id','desc')
			->get('par_billing')
			->row();
  }

  public function get_last()
  {
    return $this->db->order_by('billing_id','desc')->get('par_billing')->row();
  }

  public function insert($data)
  {
    $this->db->insert('par_billing',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('billing_id',$id)->update('par_billing',$data);
  }

  public function delete($id)
  {
    $this->db->where('billing_id',$id)->update('par_billing',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('par_billing')->num_rows();
		}else{
			return $this->db->like('billing_name',$search_term,'both')->get('par_billing')->num_rows();
		}
	}

}
