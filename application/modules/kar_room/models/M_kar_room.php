<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_room extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->join('kar_room_type','ON kar_room.room_type_id = kar_room_type.room_type_id')
				->where('kar_room.is_deleted','0')
				->get('kar_room',$number,$offset)
				->result();
		}else{
			return $this->db
				->join('kar_room_type','ON kar_room.room_type_id = kar_room_type.room_type_id')
				->where('kar_room.is_deleted','0')
				->where('is_deleted','0')
				->like('room_name',$search_term,'both')
				->get('kar_room',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->join('kar_room_type','ON kar_room.room_type_id = kar_room_type.room_type_id')
			->where('kar_room.is_deleted','0')
			->where('kar_room.is_active','1')
			->get('kar_room')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('room_id',$id)->get('kar_room')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('room_id','desc')->get('kar_room')->row();
  }

  public function insert($data)
  {
    $this->db->insert('kar_room',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('room_id',$id)->update('kar_room',$data);
  }

	public function set_occupied($id)
	{
		$this->db->where('room_id',$id)->update('kar_room',array('room_is_used'=>'1'));
	}

	public function set_available($id)
	{
		$this->db->where('room_id',$id)->update('kar_room',array('room_is_used'=>'0'));
	}

  public function delete($id)
  {
    $this->db->where('room_id',$id)->update('kar_room',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_room')->num_rows();
		}else{
			return $this->db->like('room_name',$search_term,'both')->get('kar_room')->num_rows();
		}
	}

}
