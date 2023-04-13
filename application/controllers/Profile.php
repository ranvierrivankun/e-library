<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_builder', 'bd');
		cek_login();
	}

	public function index()
	{
		$data['title'] = 'My Profile E-Library';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/topbar');
		$this->load->view('profile/index');
		$this->load->view('templates/footer');
	}

	public function proses_edit()
	{
		$id_user 				= $this->input->post('id_user');

		$nis 					= $this->input->post('nis');
		$nama 					= $this->input->post('nama');
		$alamat 				= $this->input->post('alamat');

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

			$upload_image = $_FILES['foto']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '5048';
				$config['upload_path'] = './assets/img/foto';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$old_image = $query['foto'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/foto/' . $old_image);
					}

					$new_image 		= $this->upload->data('file_name');
					$data['foto']	= $new_image;
				} else {
					set_pesan('Gagal ganti Foto', false);
					echo json_encode(array("status" => FALSE));
				}
			}

			$data['nis']			= $nis_edit;
			$data['nama']			= $nama;
			$data['alamat']			= $alamat;

			$this->db->where('id_user', $id_user);
			$update = $this->db->update('data_user', $data);

			$output['status'] 	= true;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

}