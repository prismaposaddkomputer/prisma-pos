<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_install extends MY_Install {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_app_install');
  }

  public function index()
  {
    $this->render('index');
  }

  public function step1()
  {
    $data['type'] = $this->m_app_install->get_type();
    $this->render('step1', $data);
  }

  public function update_type()
  {
    $data = $_POST;
    $this->m_app_install->update($data);
    redirect(base_url().'app_install/step2');
  }

  public function step2()
  {
    $this->load->model('app_config/m_app_config');
    $data['install'] = $this->m_app_config->get_install();
    $this->render('step2', $data);
  }

  public function update_client()
  {
    $data = $_POST;

    $this->load->model('app_config/m_app_config');
    $install = $this->m_app_config->get_install();

    switch ($install->type_id) {
      case '1':
        $this->m_app_install->update_ret_client($data);
        break;

      case '2':
        $this->m_app_install->update_res_client($data);
        break;

      case '3':
        $this->m_app_install->update_hot_client($data);
        break;

      case '4':
        $this->m_app_install->update_kar_client($data);
        break;

      case '5':
        $this->m_app_install->update_par_client($data);
        break;
    }

    $this->m_app_install->update(array('install_status' => 1));
    redirect(base_url().'app_auth/login/index');
  }

}
