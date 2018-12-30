<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_billing_service extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('hot_billing_service',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('billing_service_name',$search_term,'both')
				->where('is_deleted','0')
				->get('hot_billing_service',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_billing_service')->result();
	}

  public function get_by_id($id)
  {
    // return $this->db->where('billing_service_id',$id)->get('hot_billing_service')->row();
    $client = $this->m_hot_client->get_all();
    //
    $sql = "SELECT 
    			* 
    		FROM hot_billing_service
    		WHERE billing_service_id=?";
    $query = $this->db->query($sql, $id);
    $row = $query->row();
    //
    $row->client_is_taxed = $client->client_is_taxed;
    //
    return $row;
  }

  public function get_last()
  {
    return $this->db->order_by('billing_service_id','desc')->get('hot_billing_service')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_billing_service',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('billing_service_id',$id)->update('hot_billing_service',$data);
  }

  public function delete($id)
  {
    $this->db->where('billing_service_id',$id)->update('hot_billing_service',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_billing_service')->num_rows();
		}else{
			return $this->db->like('billing_service_name',$search_term,'both')->get('hot_billing_service')->num_rows();
		}
	}

}
