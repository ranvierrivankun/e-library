<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kunjungan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_Kunjungan_model', 'dkm');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data Kunjungan E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_kunjungan/index');
		$this->load->view('templates/footer');
	}

	public function table_data_kunjungan()
	{
		$table 	= $this->dkm->table_kunjungan();
		$filter = $this->dkm->filter_table_kunjungan();
		$total 	= $this->dkm->total_table_kunjungan();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$detail = "<a class='btn btn-sm btn-light detail' data-id_kunjungan='$tb->id_kunjungan'>
			<i class='tf-icons bx bx-detail'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$detail</a></center>";
			$td[] = $tb->nama;
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

	public function modal_detail()
	{
		$id_kunjungan 	= $this->input->post('id_kunjungan');
		$detail 		= $this->db->select('*')->from('data_kunjungan')->where('id_kunjungan', $id_kunjungan)->join('data_user', 'id_user=user_id')->get()->row();

		$id_user		= $detail->user_id;

		$getKelas		= $this->db->select('*')->from('data_user')->where('id_user', $id_user)->join('kelas', 'id_kelas=user_kelas')->get()->row();

		$data['detail'] 				= $detail;
		$data['getKelas'] 				= $getKelas;
		$this->load->view('admin/data_kunjungan/modal_detail', $data, FALSE);
	}
}