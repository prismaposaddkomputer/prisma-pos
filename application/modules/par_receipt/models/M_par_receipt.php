<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_par_receipt extends CI_Model {

	public function get_all()
	{
		return $this->db->get('par_receipt')->row();
	}

  public function get_by_id($id)
  {
    return $this->db->where('receipt_id',$id)->get('par_receipt')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('receipt_id','desc')->get('par_receipt')->row();
  }

  public function insert($data)
  {
    $this->db->insert('par_receipt',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('receipt_id',$id)->update('par_receipt',$data);
  }

  public function delete($id)
  {
    $this->db->where('receipt_id',$id)->delete('par_receipt');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('par_receipt')->num_rows();
		}else{
			return $this->db->like('receipt_name',$search_term,'both')->get('par_receipt')->num_rows();
		}
	}

}
