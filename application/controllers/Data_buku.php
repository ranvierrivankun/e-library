<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_buku extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_buku_model', 'dbm');
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

	public function table_data_buku()
	{
		$table 	= $this->dbm->table_data_buku();
		$filter = $this->dbm->filter_table_data_buku();
		$total 	= $this->dbm->total_table_data_buku();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm text-dark edit' data-id_buku='$tb->id_buku'>
			<i class='tf-icons bx bx-edit'></i>
			</a>";

			$delete = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='delete_buku($tb->id_buku)''>
			<i class='tf-icons bx bx-trash'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->isbn_buku;
			$td[] = $tb->judul_buku;
			$td[] = $tb->pengarang_buku;
			$td[] = $tb->nama_kategori;
			$td[] = $tb->nama_penerbit;
			$td[] = $tb->tahun_buku;
			$td[] = $tb->buku_baik;
			$td[] = $tb->buku_rusak;
			$td[] = $tb->buku_baik+$tb->buku_rusak;
			
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

	public function select_penerbit_buku()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->dbm->select_penerbit_buku($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function select_kategori_buku()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->dbm->select_kategori_buku($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function modal_tambah()
	{
		$this->load->view('admin/data_buku/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$isbn_buku 		= $this->input->post('isbn_buku');
		$judul_buku 	= $this->input->post('judul_buku');
		$pengarang_buku = $this->input->post('pengarang_buku');
		$tahun_buku 	= $this->input->post('tahun_buku');
		$penerbit_buku 	= $this->input->post('penerbit_buku');
		$kategori_buku 	= $this->input->post('kategori_buku');
		$buku_baik 		= $this->input->post('buku_baik');
		$buku_rusak 	= $this->input->post('buku_rusak');

		$proses 		= $this->bd->edit('data_buku', 'isbn_buku', $isbn_buku)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! ISBN ".$isbn_buku." Sudah terdaftar";

		} else {
			$data['isbn_buku']		= $isbn_buku;
			$data['judul_buku']		= $judul_buku;
			$data['pengarang_buku']	= $pengarang_buku;
			$data['tahun_buku']		= $tahun_buku;
			$data['penerbit_buku']	= $penerbit_buku;
			$data['kategori_buku']	= $kategori_buku;
			$data['buku_baik']		= $buku_baik;
			$data['buku_rusak']		= $buku_rusak;

			$save = $this->bd->save('data_buku', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit()
	{
		$id_buku 	= $this->input->post('id_buku');
		$edit 			= $this->db->select('*')->from('data_buku')->where('id_buku', $id_buku)->join('data_penerbit', 'id_penerbit=penerbit_buku')->join('data_kategori', 'id_kategori=kategori_buku')->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('admin/data_buku/modal_edit', $data, FALSE);
	}

	public function proses_edit()
	{
		$id_buku 			= $this->input->post('id_buku');

		$isbn_buku 		= $this->input->post('isbn_buku');
		$judul_buku 	= $this->input->post('judul_buku');
		$pengarang_buku = $this->input->post('pengarang_buku');
		$tahun_buku 	= $this->input->post('tahun_buku');
		$penerbit_buku 	= $this->input->post('penerbit_buku');
		$kategori_buku 	= $this->input->post('kategori_buku');
		$buku_baik 		= $this->input->post('buku_baik');
		$buku_rusak 	= $this->input->post('buku_rusak');

		$proses 				= $this->bd->edit('data_buku', 'isbn_buku', $isbn_buku)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! ISBN ".$isbn_buku." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_buku', ['id_buku' => $id_buku])->row_array();

			if($isbn_buku == null) {
				$isbn_buku_edit 	= $query['isbn_buku'];
			} else {
				$isbn_buku_edit 	=  $this->input->post('isbn_buku');
			}

			$data['isbn_buku']		= $isbn_buku_edit;
			$data['judul_buku']		= $judul_buku;
			$data['pengarang_buku']	= $pengarang_buku;
			$data['tahun_buku']		= $tahun_buku;
			$data['penerbit_buku']	= $penerbit_buku;
			$data['kategori_buku']	= $kategori_buku;
			$data['buku_baik']		= $buku_baik;
			$data['buku_rusak']		= $buku_rusak;

			$update = $this->bd->update('data_buku', $data, 'id_buku', $id_buku);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function delete_buku()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_buku 	= $this->input->post('id',true);
			$hapus 		= $this->bd->delete('data_buku','id_buku', $id_buku);

			if($hapus){
				$msg = [ 'sukses' => 'Buku Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

}