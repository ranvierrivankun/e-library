<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Kunjungan_model', 'km');
		cek_login();
	}

	public function index()
	{
		$data['title'] = 'Kunjungan E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('kunjungan/index');
		$this->load->view('templates/footer');
	}

	public function table_kunjungan()
	{
		$table 	= $this->km->table_kunjungan();
		$filter = $this->km->filter_table_kunjungan();
		$total 	= $this->km->total_table_kunjungan();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$detail = "<a class='btn btn-sm btn-light detail' data-id_kunjungan='$tb->id_kunjungan'>
			<i class='tf-icons bx bx-detail'></i>
			</a>";

			$td[] = $tb->tanggal_kunjungan.' '.$tb->jam_kunjungan;
			$td[] = $tb->tujuan_kunjungan;
			
			$data[] = $td;
		}

		$output = [
			'draw' => $this->input->post('draw'),
			'recordsTotal' => $total,
			'recordsFiltered' => $filter,
			'data'=> $data,
		];
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}