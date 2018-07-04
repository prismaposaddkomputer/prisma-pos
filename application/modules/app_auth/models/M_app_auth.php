<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_app_auth extends CI_Model {

  public function login_action_retail($data)
  {
    return $this->db->get_where('ret_user', $data);
  }

  public function login_action_restaurant($data)
  {
    return $this->db->get_where('res_user', $data);
  }

  public function login_action_hotel($data)
  {
    return $this->db->get_where('hot_user', $data);
  }

  public function login_action_karaoke($data)
  {
    return $this->db->get_where('kar_user', $data);
  }

  public function login_action_parking($data)
  {
    return $this->db->get_where('par_user', $data);
  }

}
