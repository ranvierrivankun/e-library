<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kategori extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_kategori_model', 'ktm');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data Kategori E-Library';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_kategori/index');
		$this->load->view('templates/footer');
	}

	public function table_data_kategori()
	{
		$table 	= $this->ktm->table_data_kategori();
		$filter = $this->ktm->filter_table_data_kategori();
		$total 	= $this->ktm->total_table_data_kategori();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm text-dark edit' data-id_kategori='$tb->id_kategori'>
			<i class='tf-icons bx bx-edit'></i>
			</a>";

			$delete = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='delete_kategori($tb->id_kategori)''>
			<i class='tf-icons bx bx-trash'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->nama_kategori;
			
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

	public function modal_tambah()
	{
		$this->load->view('admin/data_kategori/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$nama_kategori 	= $this->input->post('nama_kategori');

		$proses 		= $this->bd->edit('data_kategori', 'nama_kategori', $nama_kategori)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Kategori ".$nama_kategori." Sudah terdaftar";

		} else {
			$data['nama_kategori']		= $nama_kategori;

			$save = $this->bd->save('data_kategori', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit()
	{
		$id_kategori 		= $this->input->post('id_kategori');
		$edit 			= $this->db->select('*')->from('data_kategori')->where('id_kategori', $id_kategori)->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('admin/data_kategori/modal_edit', $data, FALSE);
	}

	public function proses_edit()
	{
		$id_kategori 			= $this->input->post('id_kategori');

		$nama_kategori 			= $this->input->post('nama_kategori');

		$proses 				= $this->bd->edit('data_kategori', 'nama_kategori', $nama_kategori)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Kategori ".$nama_kategori." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_kategori', ['id_kategori' => $id_kategori])->row_array();

			if($nama_kategori == null) {
				$nama_kategori_edit 	= $query['nama_kategori'];
			} else {
				$nama_kategori_edit 	=  $this->input->post('nama_kategori');
			}

			$data['nama_kategori']		= $nama_kategori_edit;

			$update = $this->bd->update('data_kategori', $data, 'id_kategori', $id_kategori);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function delete_kategori()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_kategori 	= $this->input->post('id',true);
			$hapus 		= $this->bd->delete('data_kategori','id_kategori', $id_kategori);

			if($hapus){
				$msg = [ 'sukses' => 'Kategori Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}
}