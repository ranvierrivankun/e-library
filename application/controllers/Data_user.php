<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		$this->load->model('Data_user_model', 'dum');
		cek_login();
		cek_login_admin();
	}

	public function index()
	{
		$data['title'] = 'Data User E-Library';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('admin/data_user/index');
		$this->load->view('templates/footer');
	}

	public function table_data_user()
	{
		$table 	= $this->dum->table_data_user();
		$filter = $this->dum->filter_table_data_user();
		$total 	= $this->dum->total_table_data_user();

		$data 	= [];

		foreach ($table as $tb) {
			$td = [];

			$edit = "<a class='btn btn-sm text-dark edit' data-id_user='$tb->id_user'>
			<i class='tf-icons bx bx-edit'></i>
			</a>";

			$delete = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='delete_user($tb->id_user)''>
			<i class='tf-icons bx bx-trash'></i>
			</a>";

			$reset = "<a class='btn btn-sm text-danger' href='javascript:void(0)' onclick='reset_password($tb->id_user)''>
			<i class='tf-icons bx bx-reset'></i>";

			$td[] = "<center><div class='btn-group'>$edit $reset $delete</a></center>";
			$td[] = $tb->kode_anggota;
			$td[] = $tb->nis;
			$td[] = $tb->nama;
			$td[] = $tb->kelas_jurusan;

			$ifelse="";
			if ($tb->status === '1') {
				$td[] = "<center><span class='badge bg-label-success'>Aktif</span></center>";
			} else if ($tb->status === '2') {
				$td[] = "<center><span class='badge bg-label-danger'>Non-Aktif</span></center>";
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
	
	public function select_user_kelas()
	{
		$searchTerm 	= $this->input->post('searchTerm');
		$response 		= $this->dum->select_user_kelas($searchTerm);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function modal_tambah()
	{
		$this->load->view('admin/data_user/modal_tambah', FALSE);
	}

	public function proses_tambah()
	{
		$kode_anggota 	= $this->input->post('kode_anggota');
		$nis 			= $this->input->post('nis');
		$nama 			= $this->input->post('nama');
		$user_kelas 	= $this->input->post('user_kelas');
		$alamat 		= $this->input->post('alamat');

		$pass			= '123';
		$password 		= password_hash($pass, PASSWORD_DEFAULT);	//Password awal 123
		$foto 			= 'default.png';	//Foto Awal
		$role 			= '2';				//Role Anggota
		$status 		= '1';				//User Active

		$proses 		= $this->bd->edit('data_user', 'nis', $nis)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! NIS ".$nis." Sudah terdaftar";

		} else {

			$data['kode_anggota']	= $kode_anggota;
			$data['nis']			= $nis;
			$data['nama']			= $nama;
			$data['user_kelas']		= $user_kelas;
			$data['alamat']			= $alamat;

			$data['password']		= $password;
			$data['foto']			= $foto;
			$data['role']			= $role;
			$data['status']			= $status;

			$save = $this->bd->save('data_user', $data);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function modal_edit()
	{
		$id_user 		= $this->input->post('id_user');
		$edit 			= $this->db->select('*')->from('data_user')->where('id_user', $id_user)->join('kelas', 'user_kelas=id_kelas')->get()->row();

		$data['edit'] 	= $edit;
		$this->load->view('admin/data_user/modal_edit', $data, FALSE);
	}

	public function proses_edit()
	{
		$id_user 			= $this->input->post('id_user');

		$status 			= $this->input->post('status');
		$nis 				= $this->input->post('nis');
		$nama 				= $this->input->post('nama');
		$user_kelas 		= $this->input->post('user_kelas');
		$alamat 			= $this->input->post('alamat');

		$proses 				= $this->bd->edit('data_user', 'nis', $nis)->num_rows();

		if($proses > 0) {
			$output['status'] 	= false;
			$output['keterangan'] = "Peringatan! NIS ".$nis." Sudah terdaftar";

		} else {

			$query 				= $this->db->get_where('data_user', ['id_user' => $id_user])->row_array();

			if($nis == null) {
				$nis_edit = $query['nis'];
			} else {
				$nis_edit 		=  $this->input->post('nis');
			}

			$data['status']			= $status;
			$data['nis']			= $nis_edit;
			$data['nama']			= $nama;
			$data['user_kelas'] 	= $user_kelas;
			$data['alamat']			= $alamat;

			$update = $this->bd->update('data_user', $data, 'id_user', $id_user);

			$output['status'] 	= true;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function delete_user()
	{
		if ($this->input->is_ajax_request() == true) {
			$id_user 	= $this->input->post('id',true);
			$hapus 		= $this->bd->delete('data_user','id_user', $id_user);

			if($hapus){
				$msg = [ 'sukses' => 'User Berhasil Dihapus'
			];
		}
		echo json_encode($msg);
	}
}

public function reset_password()
{
	if ($this->input->is_ajax_request() == true) {
		$id = $this->input->post('id',true);

		$password = 123;
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$this->db->set('password', $password_hash);
		$this->db->where('id_user', $id);
		$reset =  $this->db->update('data_user');

		if($reset){
			$msg = [ 'sukses' => 'Password user Berhasil di Reset Menjadi 123'
		];
	}
	echo json_encode($msg);
}
}

}