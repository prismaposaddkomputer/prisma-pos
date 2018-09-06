<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kar_room_type extends CI_Model {

	public function get_list($number,$offset,$search_term = null)
  {
		if($search_term == null){
			return $this->db
				->where('is_deleted','0')
				->get('kar_room_type',$number,$offset)
				->result();
		}else{
			return $this->db
				->like('room_type_name',$search_term,'both')
				->where('is_deleted','0')
				->get('kar_room_type',$number,$offset)
				->result();
		}
  }

	public function get_all()
	{
		return $this->db
			->where('is_deleted','0')
			->where('is_active','1')
			->get('kar_room_type')->result();
	}

  public function get_by_id($id)
  {
    return $this->db->where('room_type_id',$id)->get('kar_room_type')->row();
  }

  public function get_list_room_by_type_id($room_type_id)
  {
    $sql = "SELECT 
                COUNT(a.room_id) AS count_data
            FROM kar_room a 
            WHERE 1 AND a.room_type_id=?";
    $query = $this->db->query($sql, $room_type_id);
    $result = $query->row_array();
    //
    return $result['count_data'];
  }

  public function get_last()
  {
    return $this->db->order_by('room_type_id','desc')->get('kar_room_type')->row();
  }

  public function insert($data)
  {
  	// insert ke tabel kar_room_type
  	$kar_room_type = $data;
  	// insert ke tabel kar_room
  	$kar_room = $data;

    //unset data
    unset($kar_room_type['room_no']);

    //insert ke database
    $this->db->insert('kar_room_type',$kar_room_type);
  	//get last id
    $last_id = $this->db->insert_id();

    //kar_room
    $kar_room['created_by'] = $this->session->userdata('user_realname');
    if(!isset($kar_room['is_active'])){
      $kar_room['is_active'] = 0;
    }
    //
    $room_no = $kar_room['room_no'];
    //
    for ($i=0; $i < $room_no ; $i++) { 
    	$kar_room['room_id'] = $last_id.str_pad($i+1, 2, '0', STR_PAD_LEFT);
    	$kar_room['room_type_id'] = $last_id;
    	$kar_room['room_name'] = $kar_room_type['room_type_name'].' - '.str_pad($i+1, 2, '0', STR_PAD_LEFT);
    	$kar_room['room_no'] = str_pad($i+1, 1, '0', STR_PAD_LEFT);
    	//unset data
    	unset($kar_room['room_type_name'], $kar_room['room_type_charge'], $kar_room['room_type_desc']);
    	//insert ke database
    	$this->db->insert('kar_room',$kar_room);
    }

  }

  public function update($data)
  {
  	$kar_room_type = $data;
    $id = $kar_room_type['room_type_id'];
    $kar_room_type['updated_by'] = $this->session->userdata('user_realname');
    if(!isset($kar_room_type['is_active'])){
      $kar_room_type['is_active'] = 0;
    }

  	//get data
  	$get_awal = $this->get_list_room_by_type_id($id);
  	$get_baru = $kar_room_type['room_no'];
  	//

    unset($kar_room_type['room_no']);

  	//update database kar_room_type
    $this->db->where('room_type_id',$id)->update('kar_room_type',$kar_room_type);

  	//create array
  	$awal = array();
  	for ($i=0; $i < $get_awal ; $i++) { 
  		array_push($awal, $i+1);
  	}

  	$baru = array();
  	for ($i=0; $i < $get_baru ; $i++) { 
  		array_push($baru, $i+1);
  	}
    	//
  	$n_awal = count($awal);
  	$n_baru = count($baru);

  	if($n_awal != $n_baru){
  	    if ($n_awal < $n_baru) {
  			//Penambahan data
  			$diff = array_diff($baru,$awal);
  			for ($i=0; $i < $n_baru; $i++) { 
  				if (in_array($baru[$i], $awal)) {
  					$this->update_kar_room($id, $baru[$i]);
  				}else{
  					$this->insert_kar_room($id, $baru[$i]);
  				}
  			}
  	    } else {
  			//Pengurangan data
  			$diff = array_diff($awal,$baru);
  			for ($i=0; $i < $n_awal; $i++) { 
  				if (in_array($awal[$i], $baru)) {
  					$this->update_kar_room($id, $awal[$i]);
  				}else{
            $this->delete_kar_room($id, $awal[$i]);
          }
        }
        }  
    } 
    // else {
    //   for ($i=0; $i < 10 ; $i++) { 
    //     $this->update_kar_room_by_type_id($id, $i+1);
    //   }
    // }


  }

  public function insert_kar_room($id, $room_no)
  {	
  	$kar_room = $_POST;
  	//kar_room
    $kar_room['created_by'] = $this->session->userdata('user_realname');
    if(!isset($kar_room['is_active'])){
      $kar_room['is_active'] = 0;
    }
    //
    
  	$kar_room['room_id'] = $id.str_pad($room_no, 2, '0', STR_PAD_LEFT);
  	$kar_room['room_type_id'] = $id;
  	$kar_room['room_name'] = $kar_room['room_type_name'].' - '.str_pad($room_no, 2, '0', STR_PAD_LEFT);
  	$kar_room['room_no'] = str_pad($room_no, 1, '0', STR_PAD_LEFT);
  	//unset data
  	unset($kar_room['room_type_name'], $kar_room['room_type_charge'], $kar_room['room_type_desc']);
  	//insert ke database
  	$this->db->insert('kar_room',$kar_room);
    
  }

  public function delete_kar_room($id, $room_no) {
		//
		$room_id = $id.str_pad($room_no, 2, '0', STR_PAD_LEFT);
		//
		$this->db->where('room_id', $room_id);
		$this->db->delete('kar_room');
  }

  public function update_kar_room($id, $room_no) {
		$kar_room = $_POST;
		//
		$kar_room['room_name'] = $kar_room['room_type_name'].' - '.str_pad($room_no, 2, '0', STR_PAD_LEFT);
		$room_id = $id.str_pad($room_no, 2, '0', STR_PAD_LEFT);
		//unset data
		unset($kar_room['room_type_name'], $kar_room['room_type_charge'], $kar_room['room_type_desc'], $kar_room['room_no']);
		//
		$this->db->where('room_id', $room_id);
		$this->db->update('kar_room', $kar_room);
  }

  public function update_kar_room_by_type_id($id, $room_no) {
    $kar_room = $_POST;
    //
    $kar_room['room_name'] = $kar_room['room_type_name'].' - '.str_pad($room_no, 2, '0', STR_PAD_LEFT);
    //unset data
    unset($kar_room['room_type_name'], $kar_room['room_type_charge'], $kar_room['room_type_desc'], $kar_room['room_no']);
    //
    $this->db->where('room_type_id',$id)->update('kar_room', $kar_room);
  }

  public function delete($id)
  {
    $this->db->where('room_type_id',$id)->update('kar_room_type',array('is_deleted' => '1'));
    $this->db->where('room_type_id',$id)->update('kar_room',array('is_deleted' => '1'));
  }

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('kar_room_type')->num_rows();
		}else{
			return $this->db->like('room_type_name',$search_term,'both')->get('kar_room_type')->num_rows();
		}
	}

}
