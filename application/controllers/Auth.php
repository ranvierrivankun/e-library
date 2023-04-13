<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	/*Mengecek Session Login*/
	private function _has_login()
	{
		if ($this->session->has_userdata('login_session')) {
			redirect('home');
		}
	}

	/*View & Form Login*/
	public function index()
	{
		$this->_has_login();

		$this->form_validation->set_rules('nis', 'NIS', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		/*Ambil Data dari Form di View*/
		$nis 		= $this->input->post('nis');
		$getUser 	= $this->db->get_where('data_user', ['nis' => $nis])->row_array();

		if ($this->form_validation->run() == false) {
			$data['title'] = 'E-Library Diponegoro';
			$this->load->view('auth/header', $data);
			$this->load->view('auth/index');
			$this->load->view('auth/footer');
		} else {
			$input = $this->input->post(null, true);

			$cek_nis = $this->auth->cek_nis($input['nis']);
			if ($cek_nis > 0) {
				$password = $this->auth->get_password($input['nis']);
				if($getUser['status'] == 1){
					if (password_verify($input['password'], $password)) {
						$user_db = $this->auth->userdata($input['nis']);
						$userdata = [
							'user'  => $user_db['id_user'],
							'nama'  => $user_db['nama'],
							'role'  => $user_db['role'],
							'timestamp' => time()
						];
						$this->session->set_userdata('login_session', $userdata);
						redirect('home');
					}
				} else {
					set_pesan('Akun Non-Aktif', false);
					redirect('auth');
				}
			} else {
				set_pesan('Akun Tidak Ada', false);
				redirect('auth');
			}
			set_pesan('Password Salah', false);
			redirect('auth');
		}
	}

	/*Logout Akun*/
	public function logout()
	{
		$this->session->unset_userdata('login_session');
		set_pesan('Berhasil Logout');
		redirect('auth');
	}




}