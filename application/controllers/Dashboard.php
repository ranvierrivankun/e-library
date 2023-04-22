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
		$totalPeminjamanDikembalikan			= $this->db->select('*')->from('data_peminjaman')->where('status_peminjaman', '3')->get()->num_rows();
		$data['totalPeminjaman']			= $totalPeminjaman;
		$data['totalPeminjamanTertunda']	= $totalPeminjamanTertunda;
		$data['totalPeminjamanDiterima']	= $totalPeminjamanDiterima;
		$data['totalPeminjamanDikembalikan']= $totalPeminjamanDikembalikan;

		$totalPengembalian					= $this->db->select('*')->from('data_pengembalian')->get()->num_rows();
		$totalPengembalianTertunda			= $this->db->select('*')->from('data_peminjaman')->where('status_pengembalian', '1')->get()->num_rows();
		$totalPengembalianDiterima			= $this->db->select('*')->from('data_peminjaman')->where('status_pengembalian', '2')->get()->num_rows();
		$data['totalPengembalian']			= $totalPengembalian;
		$data['totalPengembalianTertunda']	= $totalPengembalianTertunda;
		$data['totalPengembalianDiterima']	= $totalPengembalianDiterima;

		$totalDenda							= $this->db->select('SUM(tarif_denda) as tarif_denda')->from('data_pengembalian')->join('data_denda', 'id_denda=denda_id')->get()->row()->tarif_denda;
		$totalRusak			= $this->db->select('*')->from('data_pengembalian')->where('denda_id', '2')->get()->num_rows();
		$totalHilang			= $this->db->select('*')->from('data_pengembalian')->where('denda_id', '3')->get()->num_rows();
		$data['totalDenda']					= $totalDenda;
		$data['totalRusak']					= $totalRusak;
		$data['totalHilang']				= $totalHilang;

		$totalKunjungan						= $this->db->select('*')->from('data_kunjungan')->get()->num_rows();
		$data['totalKunjungan']				= $totalKunjungan;

		$totalPeminjamanPengguna			= $this->db->select('*')->from('data_peminjaman')->where('user_id', $id_user)->get()->num_rows();
		$totalPengembalianPengguna			= $this->db->select('*')->from('data_pengembalian')->where('user_id', $id_user)->get()->num_rows();
		$totalDendaPengguna					= $this->db->select('SUM(tarif_denda) as tarif_denda')->from('data_pengembalian')->join('data_denda', 'id_denda=denda_id')->where('user_id', $id_user)->get()->row()->tarif_denda;
		$totalRusakPengguna					= $this->db->select('*')->from('data_pengembalian')->where('denda_id', '2')->where('user_id', $id_user)->get()->num_rows();
		$totalHilangPengguna				= $this->db->select('*')->from('data_pengembalian')->where('denda_id', '3')->where('user_id', $id_user)->get()->num_rows();
		$totalKunjunganPengguna				= $this->db->select('*')->from('data_kunjungan')->where('user_id', $id_user)->get()->num_rows();
		$data['totalPeminjamanPengguna']	= $totalPeminjamanPengguna;
		$data['totalPengembalianPengguna']	= $totalPengembalianPengguna;
		$data['totalDendaPengguna']			= $totalDendaPengguna;
		$data['totalRusakPengguna']			= $totalRusakPengguna;
		$data['totalHilangPengguna']		= $totalHilangPengguna;
		$data['totalKunjunganPengguna']		= $totalKunjunganPengguna;

		$data['title'] = 'Dashboard E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
	}

}