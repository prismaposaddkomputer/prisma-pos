<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_billing_room extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_billing_room',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('billing_room_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_billing_room',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_billing_room')->result();
	}

  public function get_by_id($id)
  {
    // return $this->db->where('billing_room_id',$id)->get('kar_billing_room')->row();
    $client = $this->m_kar_client->get_all();
    //
    $sql = "SELECT 
    			* 
    		FROM kar_billing_room
    		WHERE billing_room_id=?";
    $query = $this->db->query($sql, $id);
    $row = $query->row();
    //
    $row->client_is_taxed = $client->client_is_taxed;
    //
    return $row;
	}
	
	public function get_by_billing_id($id)
  {
    return $this->db->where('billing_id',$id)->get('kar_billing_room')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('billing_room_id','desc')->get('kar_billing_room')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_billing_room',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('billing_room_id',$id)->update('kar_billing_room',$data);
  }

  public function delete($id)
  {
    $this->db->where('billing_room_id',$id)->update('kar_billing_room',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_billing_room')->num_rows();
		}else{
			return $this->db->like('billing_room_name',$search_term,'both')->get('kar_billing_room')->num_rows();
		}
	}

}
