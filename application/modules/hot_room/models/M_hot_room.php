<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hot_room extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('hot_room.is_deleted','0')
				->join('hot_room_type','hot_room.room_type_id = hot_room_type.room_type_id')
				->get('hot_room',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('room_name',$search_term,'both')
				->where('hot_room.is_deleted','0')
				->join('hot_room_type','hot_room.room_type_id = hot_room_type.room_type_id')
				->get('hot_room',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_room')->result();
	}

	public function get_all_category()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('hot_category')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('room_id',$id)->get('hot_room')->row();
  }

  public function get_last()
  {
    return $this->db->order_by('room_id','desc')->get('hot_room')->row();
  }

  public function insert($data)
  {
    $this->db->insert('hot_room',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('room_id',$id)->update('hot_room',$data);
  }

  public function delete($id)
  {
    $this->db->where('room_id',$id)->update('hot_room',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('hot_room')->num_rows();
		}else{
			return $this->db->like('room_name',$search_term,'both')->get('hot_room')->num_rows();
		}
	}

}
