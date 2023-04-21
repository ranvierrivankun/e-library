<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pengembalian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_pengembalian_model', 'dpm');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data Peminjaman E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_pengembalian/index');
		$this->load->view('templates/footer');
	}

	public function table_pengembalian_buku()
	{
		$table 	= $this->dpm->table_pengembalian_buku();
		$filter = $this->dpm->filter_table_pengembalian_buku();
		$total 	= $this->dpm->total_table_pengembalian_buku();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$detail = "<a class='btn btn-sm btn-light detail' data-id_pengembalian='$tb->id_pengembalian'>
			<i class='tf-icons bx bx-detail'></i>
			</a>";

			$terima = "<a class='btn btn-sm text-success' href='javascript:void(0)' onclick='terima_pengembalian($tb->id_pengembalian)''>
			<i class='tf-icons bx bx-check'></i>
			</a>";

			$ifelse="";
			if ($tb->tanggal_diterima_pengembalian === null) {
				$td[] = "<center><div class='btn-group'>$detail $terima</a></center>";
			} else {
				$td[] = "<center><div class='btn-group'>$detail</a></center>";
			}

			

			$td[] = $tb->nama;
			$td[] = $tb->judul_buku;
			$td[] = $tb->tanggal_pengembalian.' '.$tb->jam_pengembalian; 

			$td[] = rupiah($tb->tarif_denda);

			$ifelse="";
			if ($tb->denda_id === '1') {
				$td[] = "<span class='badge bg-label-success'>$tb->nama_denda</span>";
			} else if ($tb->denda_id === '2') {
				$td[] = "<span class='badge bg-label-danger'>$tb->nama_denda</span>";
			} else if ($tb->denda_id === '3') {
				$td[] = "<span class='badge bg-label-warning'>$tb->nama_denda</span>";
			} else if ($tb->denda_id === '4') {
				$td[] = "<span class='badge bg-label-primary'>$tb->nama_denda</span>";
			} 

			$ifelse="";
			if ($tb->tanggal_diterima_pengembalian === null) {
				$td[] = "<span class='badge bg-label-danger'>TERTUNDA</span>";
			} else {
				$td[] = "<span class='badge bg-label-info'>PENGEMBALIAN DITERIMA</span>";
			} 
			
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

	public function select_peminjaman()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->dpm->select_peminjaman($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function modal_tambah()
	{
		$this->load->view('admin/data_pengembalian/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$peminjaman_id 			= $this->input->post('peminjaman_id');

		/*Mencari buku_id*/
		$proses 				= $this->db->select('*')->from('data_peminjaman')->where('id_peminjaman', $peminjaman_id)->get()->row();

		$user_id 				= $proses->user_id;
		$buku_id 				= $proses->buku_id;

		$tanggal_pengembalian 	= date('Y-m-d');
		$jam_pengembalian 		= date('H:i:s');

		$denda_id 				= $this->input->post('denda_id');

		$tanggal_diterima_pengembalian 	= date('Y-m-d');
		$admin_id	 					= userdata('id_user');

		$data['user_id']				= $user_id;
		$data['buku_id']				= $buku_id;
		$data['peminjaman_id']			= $peminjaman_id;
		
		$data['tanggal_pengembalian']	= $tanggal_pengembalian;
		$data['jam_pengembalian']		= $jam_pengembalian;

		$data['denda_id']				= $denda_id;

		$data['tanggal_diterima_pengembalian']			= $tanggal_diterima_pengembalian;
		$data['admin_id']								= $admin_id;

		$save = $this->bd->save('data_pengembalian', $data);
		$output['status'] 	= true;

		/*Penambahan Jumlah Buku Ketika Dikembalikan*/
		$proses2	= $this->db->select('*')->from('data_buku')->where('id_buku', $buku_id)->get()->row();

		/*Jika Kondisi Buku Baik*/
		if($proses->kondisi_buku_pinjam == 1) {

			/*Jika Buku Hilang maka tidak bertambah*/
			if($denda_id == 3){
			} else {
				$total 						= $proses2->buku_baik+1;
				$data_update['buku_baik']	= $total;
				$update = $this->bd->update('data_buku', $data_update, 'id_buku', $buku_id);
			}

			/*Jika Kondisi Buku Rusak*/
		} else if($proses->kondisi_buku_pinjam == 2) {

			/*Jika Buku Hilang maka tidak bertambah*/
			if($denda_id == 3){
			} else {
				$total 						= $proses2->buku_rusak+1;
				$data_update['buku_rusak']	= $total;
				$update = $this->bd->update('data_buku', $data_update, 'id_buku', $buku_id);
			}

		}

		/*Status Peminjaman & Status Pengembalian*/
		$data_peminjaman['status_peminjaman']		= '3';
		$data_peminjaman['status_pengembalian']		= '2';

		$update = $this->bd->update('data_peminjaman', $data_peminjaman, 'id_peminjaman', $peminjaman_id);

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function terima_pengembalian()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_pengembalian 	= $this->input->post('id',true);

			$proses	= $this->db->select('*')->from('data_pengembalian')->where('id_pengembalian', $id_pengembalian)->get()->row();
			$id_peminjaman = $proses->peminjaman_id;

			/*Status Peminjaman & Status Pengembalian*/
			$data_peminjaman['status_peminjaman']	= '3';
			$data_peminjaman['status_pengembalian']	= '2';

			/*Table Pengembalian*/
			$data['tanggal_diterima_pengembalian']	= date('Y-m-d');
			$data['admin_id']						= userdata('id_user');
			$update = $this->bd->update('data_peminjaman', $data_peminjaman, 'id_peminjaman', $id_peminjaman);
			$update = $this->bd->update('data_pengembalian', $data, 'id_pengembalian', $id_pengembalian);

			$msg['sukses'] 	= 'Peminjaman Berhasil Diterima';
			echo json_encode($msg);
		}
	}

}