<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MX_Controller {

  public function logout_action()
	{
    $data_log = array(
      "user_id" => $this->session->userdata('user_id'),
      "user_realname" => $this->session->userdata('user_realname'),
      "log_type" => 'Sign Out',
      "log_date" => date('Y-m-d'),
      "log_time" => date('H:i:s')
    );

    switch ($this->session->userdata('type_id')) {
      // retail
      case '1':
        $this->load->model('ret_log/m_ret_log');
        $this->m_ret_log->insert($data_log);
        break;

      // restauranrt
      case '2':
        $this->load->model('res_log/m_res_log');
        $this->m_res_log->insert($data_log);
        break;

      // hotel
      case '3':
        $this->load->model('hot_log/m_hot_log');
        $this->m_hot_log->insert($data_log);
        break;

      // karaoke
      case '4':
        $this->load->model('kar_log/m_kar_log');
        $this->m_kar_log->insert($data_log);
        break;

      case '5':
        $this->load->model('par_log/m_par_log');
        $this->m_par_log->insert($data_log);
        break;
    }

		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_realname');
		$this->session->unset_userdata('user_level');
		$this->session->sess_destroy();

		redirect(base_url());
	}

}
