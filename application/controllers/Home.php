<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		cek_login();
	}

	/*View Home*/
	public function index()
	{
		$data['title'] = 'Home E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}

	/*Modal Change Password*/
	public function modal_change_password()
	{
		$id_user 				= $this->input->post('id_user');
		$changepass 			= $this->bd->edit('data_user', 'id_user', $id_user)->row();

		$data['changepass'] 	= $changepass;
		$this->load->view('home/modal_change_password', $data, FALSE);
	}

	/*Proses Change Password*/
	public function proses_change_password()
	{
		$id_user 					= userdata('id_user');
		$password_lama 				= $this->input->post('password_lama');
		$password_baru_1 			= $this->input->post('password_baru_1');

		$cek_password_lama 			= $this->bd->where('data_user', 'id_user', $id_user)->row();

		if (password_verify($password_lama, $cek_password_lama->password)) {
			$data['password'] 		= password_hash($password_baru_1, PASSWORD_DEFAULT);
			$this->bd->update('data_user', $data, 'id_user', $id_user);

			$output['status'] 		= true;
			$output['keterangan'] 	= "Password Berhasil diganti!";
			$this->session->unset_userdata('login_session');

		} else {
			$output['status'] 		= false;
			$output['keterangan'] 	= "Password Lama Salah";
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}