<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_peminjaman extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Laporan_peminjaman_model', 'lpm');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Laporan E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/laporan_peminjaman/index');
		$this->load->view('templates/footer');
	}

	public function table_laporan_peminjaman()
	{
		$tgl1 			= $this->input->post('tgl1');
		$data['tgl1'] 	= $tgl1;
		$tgl2 			= $this->input->post('tgl2');
		if($tgl2 != "") {
			$tgl2text 		= " sd ".date('d-m-Y', strtotime($tgl2));
		} else {
			$tgl2text 		= "";
		}
		$data['tgl2'] 		= $tgl2text;

		$get_laporan 			= $this->lpm->get_laporan($tgl1, $tgl2);
		$data['get_laporan'] 	= $get_laporan;

		$this->load->view('admin/laporan_peminjaman/table_laporan_peminjaman', $data, FALSE);
	}

	public function table_laporan_excel()
	{
		$tgl1 			= $this->input->post('tgl1');
		$tgl1text		= date('d-m-Y', strtotime($tgl1));
		$data['tgl1'] 	= $tgl1;
		$tgl2 			= $this->input->post('tgl2');
		if($tgl2 != "") {
			$tgl2text 		= " sd ".date('d-m-Y', strtotime($tgl2));
		} else {
			$tgl2text 		= "";
		}
		$data['tgl2'] 		= $tgl2text;

		$filename 			= "Laporan Peminjaman & Pengembalian {$tgl1text}{$tgl2text}";
		$data['filename'] 	= $filename;

		$get_laporan 			= $this->lpm->get_laporan($tgl1, $tgl2);
		$data['get_laporan'] 	= $get_laporan;

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xls"'); 
		header('Cache-Control: max-age=0');

		$this->load->view('admin/laporan_peminjaman/table_laporan_peminjaman', $data, FALSE);
	}

}