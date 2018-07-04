<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ret_permission extends CI_Model {

	public function get_all($id)
	{
		$query = $this->db->query(
			"SELECT a.module_id, a.module_name, a.module_icon, a.module_url, b.module_id as module_id_2,
			b._create, b._read, b._update, b._delete FROM ret_module a
			LEFT JOIN ret_permission b ON a.module_id = b.module_id AND b.role_id = '$id'
			ORDER BY a.module_id ASC"
		);
		return $query->result();
	}

	public function get_list($module_parent=null)
	{
		$role_id = $this->session->userdata('role_id');

		$sql_where = '';
		$sql_where .= ($module_parent != "") ? " AND a.module_parent = '$module_parent'" : " AND a.module_parent = '' ";

		$query = $this->db->query(
			"SELECT a.module_id, a.module_name, a.module_icon, a.module_folder,
			 a.module_controller, a.module_url
			 FROM ret_module a
			 JOIN ret_permission b ON a.module_id = b.module_id
			 WHERE b.role_id = '$role_id'
			 $sql_where
			 ORDER BY a.module_id ASC"
		);
		if($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $key => $val) {
				$result[$key]['child'] = $this->get_list($result[$key]['module_id']);
			}
			return $result;
		} else {
			return array();
		}
	}

  public function get_by_id($id)
  {
    return $this->db->where('permission_id',$id)->get('ret_permission')->row();
  }

	public function get_by_field($data)
	{
		return $this->db->get_where('ret_permission',$data)->row();
	}

  public function get_last()
  {
    return $this->db->order_by('permission_id','desc')->get('ret_permission')->row();
  }

  public function insert($data)
  {
    $this->db->insert('ret_permission',$data);
  }

  public function update($id,$data)
  {
    $this->db->where('permission_id',$id)->update('ret_permission',$data);
  }

  public function delete($id)
  {
    $this->db->where('permission_id',$id)->delete('ret_permission');
  }

	public function empty_list($id)
	{
		$this->db->where('role_id',$id)->delete('ret_permission');
	}

	function num_rows($search_term = null){
		if($search_term == null){
			return $this->db->get('ret_permission')->num_rows();
		}else{
			return $this->db->like('permission_name',$search_term,'both')->get('ret_permission')->num_rows();
		}
	}

}
