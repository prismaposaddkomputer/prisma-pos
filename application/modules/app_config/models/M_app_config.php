<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_app_config extends CI_Model {

  public function get_install()
  {
    return $this->db->get('app_install')->row();
  }


}
