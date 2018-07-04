<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This class is for installation
 */
class MY_Install extends MX_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model("app_install/m_app_install");
    $install = $this->m_app_install->get_install();

    // if installation success redirect to login
    if ($install['install_status'] == 1) {
      redirect(base_url().'app_auth/login/index');
    }
  }

  function render($content, $data = NULL){
    $data['header'] = $this->load->view('app_template/install/header', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/install/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/install/index', $data);
  }

}

/**
 * This class is for authentication
 */
class MY_Auth extends MX_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model("app_install/m_app_install");
    $install = $this->m_app_install->get_install();

    // if installation success redirect to login
    if ($install['install_status'] == 0) {
      redirect(base_url().'app_install/index');
    }
  }

  function render($content, $data = NULL){
    $data['header'] = $this->load->view('app_template/auth/header', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/auth/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/auth/index', $data);
  }

}

/**
 * This class is for retail
 */

class MY_Retail extends MX_Controller{

  function view($content, $data = NULL){

    // Pagination config
    $config_pagination['first_link']       = 'First';
    $config_pagination['last_link']        = 'Last';
    $config_pagination['next_link']        = 'Next';
    $config_pagination['prev_link']        = 'Prev';
    $config_pagination['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config_pagination['full_tag_close']   = '</ul></nav></div>';
    $config_pagination['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config_pagination['num_tag_close']    = '</span></li>';
    $config_pagination['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config_pagination['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config_pagination['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config_pagination['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['prev_tagl_close']  = '</span>Next</li>';
    $config_pagination['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config_pagination['first_tagl_close'] = '</span></li>';
    $config_pagination['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['last_tagl_close']  = '</span></li>';

    $this->pagination->initialize($config_pagination);

    $this->load->model('app_config/m_ret_config');
    $this->load->model('ret_client/m_ret_client');
    $client = $this->m_ret_client->get_all();
    $data['keyboard'] = $client->client_keyboard_status;
    $data['client'] = $client;

    $role_id = $this->session->userdata('role_id');
    $data['sidenav'] = $this->m_ret_config->get_list();

    $data['header'] = $this->load->view('app_template/retail/header', $data, TRUE);
    $data['sidebar'] = $this->load->view('app_template/retail/sidebar', $data['sidenav'], TRUE);
    $data['topbar'] = $this->load->view('app_template/retail/topbar', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/retail/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/retail/index', $data);
  }

}


/**
 * This class is for Restaurant
 */

class MY_Restaurant extends MX_Controller{

  function view($content, $data = NULL){

    // Pagination config
    $config_pagination['first_link']       = 'First';
    $config_pagination['last_link']        = 'Last';
    $config_pagination['next_link']        = 'Next';
    $config_pagination['prev_link']        = 'Prev';
    $config_pagination['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config_pagination['full_tag_close']   = '</ul></nav></div>';
    $config_pagination['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config_pagination['num_tag_close']    = '</span></li>';
    $config_pagination['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config_pagination['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config_pagination['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config_pagination['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['prev_tagl_close']  = '</span>Next</li>';
    $config_pagination['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config_pagination['first_tagl_close'] = '</span></li>';
    $config_pagination['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['last_tagl_close']  = '</span></li>';

    $this->pagination->initialize($config_pagination);

    $this->load->model('app_config/m_res_config');

    $role_id = $this->session->userdata('role_id');
    $data['sidenav'] = $this->m_res_config->get_list();

    $this->load->model('res_client/m_res_client');
    $client = $this->m_res_client->get_all();
    $data['keyboard'] = $client->client_keyboard_status;
    $data['client'] = $client;

    $data['header'] = $this->load->view('app_template/restaurant/header', $data, TRUE);
    $data['sidebar'] = $this->load->view('app_template/restaurant/sidebar', $data['sidenav'], TRUE);
    $data['topbar'] = $this->load->view('app_template/restaurant/topbar', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/restaurant/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/parking/index', $data);
  }

}


/**
 * This class is for hotel
 */

class MY_Hotel extends MX_Controller{

  function view($content, $data = NULL){

    // Pagination config
    $config_pagination['first_link']       = 'First';
    $config_pagination['last_link']        = 'Last';
    $config_pagination['next_link']        = 'Next';
    $config_pagination['prev_link']        = 'Prev';
    $config_pagination['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config_pagination['full_tag_close']   = '</ul></nav></div>';
    $config_pagination['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config_pagination['num_tag_close']    = '</span></li>';
    $config_pagination['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config_pagination['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config_pagination['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config_pagination['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['prev_tagl_close']  = '</span>Next</li>';
    $config_pagination['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config_pagination['first_tagl_close'] = '</span></li>';
    $config_pagination['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['last_tagl_close']  = '</span></li>';

    $this->pagination->initialize($config_pagination);

    $this->load->model('app_config/m_hot_config');

    $role_id = $this->session->userdata('role_id');
    $data['sidenav'] = $this->m_hot_config->get_list();

    $this->load->model('res_client/m_res_client');
    $client = $this->m_res_client->get_all();
    $data['keyboard'] = $client->client_keyboard_status;
    $data['client'] = $client;

    $data['header'] = $this->load->view('app_template/hotel/header', $data, TRUE);
    $data['sidebar'] = $this->load->view('app_template/hotel/sidebar', $data['sidenav'], TRUE);
    $data['topbar'] = $this->load->view('app_template/hotel/topbar', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/hotel/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/parking/index', $data);
  }

}

/**
 * This class is for karaoke
 */

class MY_Karaoke extends MX_Controller{

  function view($content, $data = NULL){

    // Pagination config
    $config_pagination['first_link']       = 'First';
    $config_pagination['last_link']        = 'Last';
    $config_pagination['next_link']        = 'Next';
    $config_pagination['prev_link']        = 'Prev';
    $config_pagination['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config_pagination['full_tag_close']   = '</ul></nav></div>';
    $config_pagination['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config_pagination['num_tag_close']    = '</span></li>';
    $config_pagination['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config_pagination['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config_pagination['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config_pagination['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['prev_tagl_close']  = '</span>Next</li>';
    $config_pagination['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config_pagination['first_tagl_close'] = '</span></li>';
    $config_pagination['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['last_tagl_close']  = '</span></li>';

    $this->pagination->initialize($config_pagination);

    $this->load->model('app_config/m_kar_config');

    $role_id = $this->session->userdata('role_id');
    $data['sidenav'] = $this->m_kar_config->get_list();

    $this->load->model('kar_client/m_kar_client');
    $client = $this->m_kar_client->get_all();
    $data['keyboard'] = $client->client_keyboard_status;
    $data['client'] = $client;

    $data['header'] = $this->load->view('app_template/karaoke/header', $data, TRUE);
    $data['sidebar'] = $this->load->view('app_template/karaoke/sidebar', $data['sidenav'], TRUE);
    $data['topbar'] = $this->load->view('app_template/karaoke/topbar', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/karaoke/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/parking/index', $data);
  }

}

/**
 * This class is for parking
 */

class MY_Parking extends MX_Controller{

  function view($content, $data = NULL){

    // Pagination config
    $config_pagination['first_link']       = 'First';
    $config_pagination['last_link']        = 'Last';
    $config_pagination['next_link']        = 'Next';
    $config_pagination['prev_link']        = 'Prev';
    $config_pagination['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config_pagination['full_tag_close']   = '</ul></nav></div>';
    $config_pagination['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config_pagination['num_tag_close']    = '</span></li>';
    $config_pagination['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config_pagination['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config_pagination['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config_pagination['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['prev_tagl_close']  = '</span>Next</li>';
    $config_pagination['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config_pagination['first_tagl_close'] = '</span></li>';
    $config_pagination['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config_pagination['last_tagl_close']  = '</span></li>';

    $this->pagination->initialize($config_pagination);

    $this->load->model('app_config/m_par_config');

    $role_id = $this->session->userdata('role_id');
    $data['sidenav'] = $this->m_par_config->get_list();

    $this->load->model('par_client/m_par_client');
    $client = $this->m_par_client->get_all();
    $data['keyboard'] = $client->client_keyboard_status;
    $data['client'] = $client;

    $data['header'] = $this->load->view('app_template/parking/header', $data, TRUE);
    $data['sidebar'] = $this->load->view('app_template/parking/sidebar', $data['sidenav'], TRUE);
    $data['topbar'] = $this->load->view('app_template/parking/topbar', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/parking/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/parking/index', $data);
  }

}

/**
 * This class is for retail
 */

class MY_Error extends MX_Controller{

  function render($content, $data = NULL){
    $data['header'] = $this->load->view('app_template/error/header', $data, TRUE);
    $data['footer'] = $this->load->view('app_template/error/footer', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view('app_template/error/index', $data);
  }

}
