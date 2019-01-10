<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_paket extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_paket',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('paket_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_paket',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_paket')->result();
	}

  public function get_by_id($id)
  {
		$data = $this->db->where('paket_id',$id)->get('kar_paket')->row();
		$data->fnb = $this->db
			->join('kar_fnb b', 'a.fnb_id = b.fnb_id')
			->where('a.paket_id',$id)->get('kar_paket_fnb a')->result();
		return $data;
  }

  public function get_last()
  {
    return $this->db->order_by('paket_id','desc')->get('kar_paket')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_paket',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('paket_id',$id)->update('kar_paket',$data);
  }

  public function delete($id)
  {
    $this->db->where('paket_id',$id)->update('kar_paket',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_paket')->num_rows();
		}else{
			return $this->db->like('paket_name',$search_term,'both')->get('kar_paket')->num_rows();
		}
	}

	public function add_fnb($data)
	{
		$this->db->insert('kar_paket_fnb',$data);
	}

	public function del_fnb($id)
	{
		$this->db
			->where('paket_fnb_id',$id)
			->delete('kar_paket_fnb');
	}

}
