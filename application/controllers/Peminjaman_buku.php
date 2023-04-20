<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_buku extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Peminjaman_buku_model', 'pbm');
		cek_login();
	}

	public function index()
	{
		$data['title'] = 'My Profile E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('peminjaman_buku/index');
		$this->load->view('templates/footer');
	}

	public function table_peminjaman_buku()
	{
		$table 	= $this->pbm->table_peminjaman_buku();
		$filter = $this->pbm->filter_table_peminjaman_buku();
		$total 	= $this->pbm->total_table_peminjaman_buku();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$detail = "<a class='btn btn-sm btn-light detail' data-id_peminjaman='$tb->id_peminjaman'>
			<i class='tf-icons bx bx-detail'></i>
			</a>";

			$delete = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='delete_peminjaman($tb->id_peminjaman)''>
			<i class='tf-icons bx bx-trash'></i>
			</a>";

			$ifelse="";
			if ($tb->status_peminjaman === '1') {
				$td[] = "<center><div class='btn-group'>$delete</a></center>";
			} else if ($tb->status_peminjaman === '2') {
				$td[] = "<center><div class='btn-group'>$detail</a></center>";
			} 

			$td[] = $tb->judul_buku;
			$td[] = $tb->tanggal_peminjaman.' '.$tb->jam_peminjaman; 

			$ifelse="";
			if ($tb->kondisi_buku_pinjam === '1') {
				$td[] = "<span class='badge bg-label-success'>KONDISI BAIK</span>";
			} else if ($tb->kondisi_buku_pinjam === '2') {
				$td[] = "<span class='badge bg-label-danger'>KONDISI RUSAK</span>";
			} 

			$ifelse="";
			if ($tb->status_peminjaman === '1') {
				$td[] = "<center><span class='badge bg-label-warning'>TERTUNDA</span></center>";
			} else if ($tb->status_peminjaman === '2') {
				$td[] = "<center><span class='badge bg-label-primary'>DITERIMA</span></center>";
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

	public function select_data_buku()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->pbm->select_data_buku($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function modal_tambah()
	{
		$this->load->view('peminjaman_buku/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$user_id 		= userdata('id_user');
		$buku_id 		= $this->input->post('buku_id');

		$tanggal_peminjaman = date('Y-m-d');
		$jam_peminjaman 	= date('H:i:s');

		$kondisi_buku_pinjam 	= $this->input->post('kondisi_buku_pinjam');

		$proses 	= $this->db->select('*')->from('data_peminjaman')->where('buku_id', $buku_id)->where('user_id', $user_id)->get()->num_rows();
		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Kamu Sedang Meminjam Buku ini";
		} else {

			$proses2	= $this->db->select('*')->from('data_buku')->where('id_buku', $buku_id)->get()->row();

			/*Jika Buku yang dipinjam Baik*/
			if($kondisi_buku_pinjam == 1) {

				/*Jika Buku Kondisi Baik Habis*/
				if($proses2->buku_baik == 0) {
					$output['status'] 	= false;
					$output['keterangan'] = "Peringatan! Buku Habis";
				} else {

					$data['user_id']				= $user_id;
					$data['buku_id']				= $buku_id;
					$data['tanggal_peminjaman']		= $tanggal_peminjaman;
					$data['jam_peminjaman']			= $jam_peminjaman;
					$data['kondisi_buku_pinjam']	= $kondisi_buku_pinjam;
					$data['status_peminjaman']		= '1';

					$save = $this->bd->save('data_peminjaman', $data);

					/*Pengurangan Jumlah Buku Ketika Dipinjam*/
					$total 						= $proses2->buku_baik-1;
					$data_update['buku_baik']	= $total;
					$update = $this->bd->update('data_buku', $data_update, 'id_buku', $buku_id);

					$output['status'] 	= true;

				}

				/*Jika Buku yang dipinjam Rusak*/
			} else if($kondisi_buku_pinjam == 2) {

				/*Jika Buku Kondisi Rusak Habis*/
				if($proses2->buku_rusak == 0) {
					$output['status'] 	= false;
					$output['keterangan'] = "Peringatan! Buku Habis";
				} else {

					$data['user_id']				= $user_id;
					$data['buku_id']				= $buku_id;
					$data['tanggal_peminjaman']		= $tanggal_peminjaman;
					$data['jam_peminjaman']			= $jam_peminjaman;
					$data['kondisi_buku_pinjam']	= $kondisi_buku_pinjam;
					$data['status_peminjaman']		= '1';

					$save = $this->bd->save('data_peminjaman', $data);

					/*Pengurangan Jumlah Buku Ketika Dipinjam*/
					$total 						= $proses2->buku_rusak-1;
					$data_update['buku_rusak']	= $total;
					$update = $this->bd->update('data_buku', $data_update, 'id_buku', $buku_id);
					
					$output['status'] 	= true;

				}
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
	

	public function modal_detail()
	{
		$id_peminjaman 	= $this->input->post('id_peminjaman');

		$detail 		= $this->bd->edit('data_peminjaman', 'id_peminjaman', $id_peminjaman)->row();
		$getPeminjam 	= $this->db->select('*')->from('data_peminjaman')->where('id_peminjaman', $id_peminjaman)->join('data_user', 'id_user=user_id')->get()->row();
		$getAdmin 	= $this->db->select('*')->from('data_peminjaman')->where('id_peminjaman', $id_peminjaman)->join('data_user', 'id_user=admin_id')->get()->row();

		$getBuku 		= $this->db->select('*')->from('data_peminjaman')->where('id_peminjaman', $id_peminjaman)->join('data_buku', 'id_buku=buku_id')->get()->row();
		$getPenerbitKategori 	= $this->db->select('*')->from('data_buku')->where('id_buku', $getBuku->buku_id)->join('data_penerbit', 'id_penerbit=penerbit_buku')->join('data_kategori', 'id_kategori=kategori_buku')->get()->row();

		$data['detail'] 				= $detail;
		$data['getPeminjam']			= $getPeminjam;
		$data['getAdmin']				= $getAdmin;
		$data['getBuku']				= $getBuku;
		$data['getPenerbitKategori']	= $getPenerbitKategori;

		$this->load->view('peminjaman_buku/modal_detail', $data, FALSE);
	}

	public function delete_peminjaman()
	{
		if ($this->input->is_ajax_request() == true) {

			$id_peminjaman 	= $this->input->post('id',true);

			/*Mencari buku_id didalam table data_peminjaman*/
			$proses 	= $this->db->select('*')->from('data_peminjaman')->where('id_peminjaman', $id_peminjaman)->get()->row();
			$buku_id 	= $proses->buku_id;

			/*Penambahan Jumlah Buku Ketika Didelete*/
			$proses2	= $this->db->select('*')->from('data_buku')->where('id_buku', $buku_id)->get()->row();

			/*Jika Kondisi Buku Baik*/
			if($proses->kondisi_buku_pinjam == 1) {
				$total 						= $proses2->buku_baik+1;
				$data_update['buku_baik']	= $total;

				/*Jika Kondisi Buku Rusak*/
			} else if($proses->kondisi_buku_pinjam == 2) {
				$total 						= $proses2->buku_rusak+1;
				$data_update['buku_rusak']	= $total;

			}
			
			$hapus 			= $this->bd->delete('data_peminjaman','id_peminjaman', $id_peminjaman);
			$hapus 			= $this->bd->update('data_buku', $data_update, 'id_buku', $buku_id);

			$msg['sukses'] 	= 'Peminjaman Berhasil Dihapus';
			echo json_encode($msg);
		}
	}

}