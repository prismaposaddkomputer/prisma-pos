<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_client extends CI_Model {

	public function get_all()
	{
		return $this->db->get('ret_client')->row();
	}

  public function get_by_id($id)
  {
    return $this->db->where('client_id',$id)->get('ret_client')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('client_id','desc')->get('ret_client')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_client',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('client_id',$id)->update('ret_client',$data);
  }

  public function delete($id)
  {
    $this->db->where('client_id',$id)->delete('ret_client');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_client')->num_rows();
		}else{
			return $this->db->like('client_name',$search_term,'both')->get('ret_client')->num_rows();
		}
	}

}
