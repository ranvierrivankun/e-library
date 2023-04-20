<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$id_user						= userdata('id_user');

		$totalPengguna					= $this->db->select('*')->from('data_user')->where('role', '2')->get()->num_rows();
		$totalPenggunaAktif				= $this->db->select('*')->from('data_user')->where('role', '2')->where('status', '1')->get()->num_rows();
		$totalPenggunaNonAktif			= $this->db->select('*')->from('data_user')->where('role', '2')->where('status', '2')->get()->num_rows();

		$data['totalPengguna']			= $totalPengguna;
		$data['totalPenggunaAktif'] 	= $totalPenggunaAktif;
		$data['totalPenggunaNonAktif'] 	= $totalPenggunaNonAktif;


		$totalPenerbit					= $this->db->select('*')->from('data_penerbit')->get()->num_rows();
		$totalPenerbitTerverifikasi		= $this->db->select('*')->from('data_penerbit')->where('status_penerbit', '1')->get()->num_rows();
		$totalPenerbitXTerverifikasi	= $this->db->select('*')->from('data_penerbit')->where('status_penerbit', '2')->get()->num_rows();

		$data['totalPenerbit']					= $totalPenerbit;
		$data['totalPenerbitTerverifikasi'] 	= $totalPenerbitTerverifikasi;
		$data['totalPenerbitXTerverifikasi'] 	= $totalPenerbitXTerverifikasi;

		$totalBuku						= $this->db->select('*')->from('data_buku')->get()->num_rows();
		$totalKategori					= $this->db->select('*')->from('data_kategori')->get()->num_rows();
		$data['totalBuku']				= $totalBuku;
		$data['totalKategori']			= $totalKategori;

		$totalPeminjaman					= $this->db->select('*')->from('data_peminjaman')->get()->num_rows();
		$totalPeminjamanTertunda			= $this->db->select('*')->from('data_peminjaman')->where('status_peminjaman', '1')->get()->num_rows();
		$totalPeminjamanDiterima			= $this->db->select('*')->from('data_peminjaman')->where('status_peminjaman', '2')->get()->num_rows();
		$data['totalPeminjaman']			= $totalPeminjaman;
		$data['totalPeminjamanTertunda']	= $totalPeminjamanTertunda;
		$data['totalPeminjamanDiterima']	= $totalPeminjamanDiterima;

		$totalPeminjamanPengguna			= $this->db->select('*')->from('data_peminjaman')->where('user_id', $id_user)->get()->num_rows();

		$data['title'] = 'Dashboard E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
	}

}