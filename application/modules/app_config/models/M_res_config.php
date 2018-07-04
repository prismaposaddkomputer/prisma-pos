<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_res_config extends CI_Model {

  public function get_permission($role_id, $module_controller)
  {
    $query = $this->db
      ->select('module_icon,_create, _read, _update, _delete')
      ->where('res_module.module_controller', $module_controller)
      ->where('res_permission.role_id', $role_id)
      ->join('res_module','res_permission.module_id = res_module.module_id')
      ->get('res_permission');
    return $query->row();
  }

  public function get_list($module_parent=null)
	{
		$role_id = $this->session->userdata('role_id');

		$sql_where = '';
		$sql_where .= ($module_parent != "") ? " AND a.module_parent = '$module_parent'" : " AND a.module_parent = '' ";

		$query = $this->db->query(
			"SELECT a.module_id, a.module_name, a.module_icon, a.module_folder,
			 a.module_controller, a.module_url
			 FROM res_module a
			 JOIN res_permission b ON a.module_id = b.module_id
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


}
