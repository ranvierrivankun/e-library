<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_denda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_denda_model', 'ddm');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data Denda E-Library';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_denda/index');
		$this->load->view('templates/footer');
	}

	public function table_data_denda()
	{
		$table 	= $this->ddm->table_data_denda();
		$filter = $this->ddm->filter_table_data_denda();
		$total 	= $this->ddm->total_table_data_denda();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm text-dark edit' data-id_denda='$tb->id_denda'>
			<i class='tf-icons bx bx-edit'></i>
			</a>";

			$delete = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='delete_denda($tb->id_denda)''>
			<i class='tf-icons bx bx-trash'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit</a></center>";
			$td[] = $tb->nama_denda;
			$td[] = $tb->tarif_denda;
			
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
		$this->load->view('admin/data_denda/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$nama_denda 	= $this->input->post('nama_denda');
		$tarif_denda 	= $this->input->post('tarif_denda');

		$proses 		= $this->bd->edit('data_denda', 'nama_denda', $nama_denda)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Denda ".$nama_denda." Sudah terdaftar";

		} else {
			$data['nama_denda']		= $nama_denda;
			$data['tarif_denda']	= $tarif_denda;

			$save = $this->bd->save('data_denda', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit()
	{
		$id_denda 		= $this->input->post('id_denda');
		$edit 			= $this->db->select('*')->from('data_denda')->where('id_denda', $id_denda)->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('admin/data_denda/modal_edit', $data, FALSE);
	}

	public function proses_edit()
	{
		$id_denda 			= $this->input->post('id_denda');

		$nama_denda 			= $this->input->post('nama_denda');
		$tarif_denda 			= $this->input->post('tarif_denda');

		$proses 				= $this->bd->edit('data_denda', 'nama_denda', $nama_denda)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Denda ".$nama_denda." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_denda', ['id_denda' => $id_denda])->row_array();

			if($nama_denda == null) {
				$nama_denda_edit 	= $query['nama_denda'];
			} else {
				$nama_denda_edit 	=  $this->input->post('nama_denda');
			}

			$data['nama_denda']		= $nama_denda_edit;
			$data['tarif_denda']	= $tarif_denda;

			$update = $this->bd->update('data_denda', $data, 'id_denda', $id_denda);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function delete_denda()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_denda 	= $this->input->post('id',true);
			$hapus 		= $this->bd->delete('data_denda','id_denda', $id_denda);

			if($hapus){
				$msg = [ 'sukses' => 'Denda Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

}