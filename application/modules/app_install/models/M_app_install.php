<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_app_install extends CI_Model {

  public function get_install()
  {
    return $this->db
      ->get('app_install')
      ->row_array();
  }

  public function get_type()
  {
    return $this->db
      ->get('app_type')
      ->result_array();
  }

  public function update($data)
  {
    return $this->db
      ->update('app_install', $data);
  }

  public function update_ret_client($data)
  {
    $this->db
      ->update('ret_client', $data);
  }

  public function update_res_client($data)
  {
    $this->db
      ->update('res_client', $data);
  }

  public function update_hot_client($data)
  {
    $this->db
      ->update('hot_client', $data);
  }

  public function update_kar_client($data)
  {
    $this->db
      ->update('kar_client', $data);
  }

  public function update_par_client($data)
  {
    $this->db
      ->update('par_client', $data);
  }

}
