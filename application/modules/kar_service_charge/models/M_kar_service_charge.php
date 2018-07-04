<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_service_charge extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db				
				->where('kar_service_charge.is_deleted','0')
				->get('kar_service_charge',$number,$offset)
				->result();
		}else{
			return $this->db				
				->like('service_charge_name',$search_term,'both')
				->where('kar_service_charge.is_deleted','0')
				->get('kar_service_charge',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_service_charge')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('service_charge_id',$id)->get('kar_service_charge')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('service_charge_id','desc')->get('kar_service_charge')->row();
  }

	public function get_first()
	{
		return $this->db->order_by('service_charge_id','asc')->get('kar_service_charge')->row();
	}

  public function insert($data)
  {
    $this->db->insert('kar_service_charge',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('service_charge_id',$id)->update('kar_service_charge',$data);
  }

  public function delete($id)
  {
    $this->db->where('service_charge_id',$id)->update('kar_service_charge',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_service_charge')->num_rows();
		}else{
			return $this->db->like('service_charge_name',$search_term,'both')->get('kar_service_charge')->num_rows();
		}
	}

}
