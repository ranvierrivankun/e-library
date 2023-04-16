<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_penerbit extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_penerbit_model', 'dpm');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data Penerbit E-Library';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_penerbit/index');
		$this->load->view('templates/footer');
	}

	public function table_data_penerbit()
	{
		$table 	= $this->dpm->table_data_penerbit();
		$filter = $this->dpm->filter_table_data_penerbit();
		$total 	= $this->dpm->total_table_data_penerbit();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm text-dark edit' data-id_penerbit='$tb->id_penerbit'>
			<i class='tf-icons bx bx-edit'></i>
			</a>";

			$delete = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='delete_penerbit($tb->id_penerbit)''>
			<i class='tf-icons bx bx-trash'></i>
			</a>";

			$td[] = "<center><div class='btn-group'>$edit $delete</a></center>";
			$td[] = $tb->kode_penerbit;
			$td[] = $tb->nama_penerbit;

			$ifelse="";
			if ($tb->status_penerbit === '1') {
				$td[] = "<center><span class='badge bg-label-primary'>Penerbit Terverifikasi</span></center>";
			} else if ($tb->status_penerbit === '2') {
				$td[] = "<center><span class='badge bg-label-danger'>Penerbit Belum Terverifikasi</span></center>";
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

	public function modal_tambah()
	{
		$this->load->view('admin/data_penerbit/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$kode_penerbit 	= $this->input->post('kode_penerbit');
		$nama_penerbit 	= $this->input->post('nama_penerbit');
		$status_penerbit = $this->input->post('status_penerbit');

		$proses 		= $this->bd->edit('data_penerbit', 'nama_penerbit', $nama_penerbit)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Penerbit ".$nama_penerbit." Sudah terdaftar";

		} else {

			$data['kode_penerbit']		= $kode_penerbit;
			$data['nama_penerbit']		= $nama_penerbit;
			$data['status_penerbit']	= $status_penerbit;


			$save = $this->bd->save('data_penerbit', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit()
	{
		$id_penerbit 		= $this->input->post('id_penerbit');
		$edit 			= $this->db->select('*')->from('data_penerbit')->where('id_penerbit', $id_penerbit)->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('admin/data_penerbit/modal_edit', $data, FALSE);
	}

	public function proses_edit()
	{
		$id_penerbit 			= $this->input->post('id_penerbit');

		$nama_penerbit 			= $this->input->post('nama_penerbit');
		$status_penerbit 		= $this->input->post('status_penerbit');

		$proses 				= $this->bd->edit('data_penerbit', 'nama_penerbit', $nama_penerbit)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! Nama Penerbit ".$nama_penerbit." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_penerbit', ['id_penerbit' => $id_penerbit])->row_array();

			if($nama_penerbit == null) {
				$nama_penerbit_edit 	= $query['nama_penerbit'];
			} else {
				$nama_penerbit_edit 	=  $this->input->post('nama_penerbit');
			}

			$data['nama_penerbit']		= $nama_penerbit_edit;
			$data['status_penerbit']	= $status_penerbit;

			$update = $this->bd->update('data_penerbit', $data, 'id_penerbit', $id_penerbit);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function delete_penerbit()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_penerbit 	= $this->input->post('id',true);
			$hapus 		= $this->bd->delete('data_penerbit','id_penerbit', $id_penerbit);

			if($hapus){
				$msg = [ 'sukses' => 'Penerbit Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

}