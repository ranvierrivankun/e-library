<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulir_kunjungan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
	}

	public function index()
	{
		$data['title'] = 'Formulir Kunjungan E-Library';
		$this->load->view('formulir_kunjungan/index', $data);
	}

	public function proses_tambah()
	{
		/*Ambil NIS dari Form*/
		$nis 				= $this->input->post('nis');

		/*Mencari Data User*/
		$data_user 			= $this->db->select('*')->from('data_user')->where('nis', $nis)->get()->row();

		$proses 			= $this->bd->edit('data_user', 'nis', $nis)->num_rows();

		if($proses > 0) {
			$user_id			= $data_user->id_user;
			$tanggal_kunjungan 	= date('Y-m-d');
			$jam_kunjungan 		= date('H:i:s');
			$tujuan_kunjungan 	= $this->input->post('tujuan_kunjungan');

			$data['user_id']			= $user_id;
			$data['tanggal_kunjungan']	= $tanggal_kunjungan;
			$data['jam_kunjungan']		= $jam_kunjungan;
			$data['tujuan_kunjungan']	= $tujuan_kunjungan;

			$save = $this->bd->save('data_kunjungan', $data);
			$output['status'] 			= true;
		} else {
			$output['status'] 		= false;
			$output['keterangan'] 	= "Peringatan! NIS ".$nis." Tidak Terdaftar, Silahkan Daftar Terlebih Dahulu.";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}