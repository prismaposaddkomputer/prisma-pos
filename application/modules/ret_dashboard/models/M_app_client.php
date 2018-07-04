<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_app_client extends CI_Model {

	public function get_all()
	{
		return $this->db->get('app_client')->row();
	}

  public function get_by_id($id)
  {
    return $this->db->where('client_id',$id)->get('app_client')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('client_id','desc')->get('app_client')->row();
  }

  public function insert($data)
  {
    $this->db->insert('app_client',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('client_id',$id)->update('app_client',$data);
  }

  public function delete($id)
  {
    $this->db->where('client_id',$id)->delete('app_client');
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('app_client')->num_rows();
		}else{
			return $this->db->like('client_name',$search_term,'both')->get('app_client')->num_rows();
		}
	}

}
