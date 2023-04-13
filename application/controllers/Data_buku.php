<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_buku extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data Buku E-Library';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_buku/index');
		$this->load->view('templates/footer');
	}

}