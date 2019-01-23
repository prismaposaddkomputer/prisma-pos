<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Auth {

	public function index()
	{
		$this->render('login');
	}

	public function action()
	{
		$this->load->model('app_config/m_app_config');
		$this->load->model('m_app_auth');

		$config = $this->m_app_config->get_install();
		$sess_data['type_id'] = $config->type_id;

    $data = array (
			'user_name' => $this->input->post('user_name',TRUE),
			'user_password' => md5($this->input->post('user_password')),
			'is_active' => 1
		);

		switch ($sess_data['type_id']) {
			// retail
			case 1:
				$result = $this->m_app_auth->login_action_retail($data);
				break;

			// restauranrt
			case 2:
				$result = $this->m_app_auth->login_action_restaurant($data);
				break;

			// hotel
			case 3:
				$result = $this->m_app_auth->login_action_hotel($data);
				break;

			// karaoke
			case 4:
				$result = $this->m_app_auth->login_action_karaoke($data);
        break;

      case 5:
				$result = $this->m_app_auth->login_action_parking($data);
				break;
		}

		if($result->num_rows() == 1){
			foreach ($result->result() as $sess) {
				$sess_data['user_id'] = $sess->user_id;
				$sess_data['role_id'] = $sess->role_id;
			  $sess_data['user_realname'] = $sess->user_realname;
				$data_log = array(
					"user_id" => $sess->user_id,
					"user_realname" => $sess->user_realname,
					"log_type" => 'Sign In',
					"log_date" => date('Y-m-d'),
					"log_time" => date('H:i:s')
				);
			}

			$sess_data['logged'] = true;
			$this->session->set_userdata($sess_data);


			switch ($sess_data['type_id']) {
				// retail
				case 1:
					$this->load->model('ret_log/m_ret_log');
					$this->m_ret_log->insert($data_log);
					redirect(base_url().'ret_dashboard/index');
					break;

				// restauranrt
				case 2:
					$this->load->model('res_log/m_res_log');
					$this->m_res_log->insert($data_log);
					redirect(base_url().'res_dashboard/index');
					break;

				// hotel
				case 3:
					$this->load->model('hot_log/m_hot_log');
					$this->m_hot_log->insert($data_log);
					redirect(base_url().'hot_dashboard/index');
					break;

				// karaoke
				case 4:
					$this->load->model('kar_log/m_kar_log');
					$this->m_kar_log->insert($data_log);
					redirect(base_url().'kar_dashboard/index');
          break;

        case 5:
					$this->load->model('par_log/m_par_log');
					$this->m_par_log->insert($data_log);
					redirect(base_url().'par_dashboard/index');
					break;
			}
			// redirect(base_url().'app_dashboard');
		}else{
			$this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Maaf Anda gagal masuk!</div>');
			redirect(base_url().'app_auth/login/index');
		}
  }

}
