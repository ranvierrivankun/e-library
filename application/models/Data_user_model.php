<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_user_model extends CI_Model
{

	public function table_data_user()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			kode_anggota LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nis LIKE ' . "'%" . $search . "%'" . '
			OR
			nama LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		if($awal == -1){
			$batas = "";
		}else{
			$batas = $this->db->limit($awal, $akhir);
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_user');
		$this->db->join('kelas','id_kelas=user_kelas');
		$this->db->order_by('id_user', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_data_user()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			kode_anggota LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nis LIKE ' . "'%" . $search . "%'" . '
			OR
			nama LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_user');
		$this->db->join('kelas','id_kelas=user_kelas');
		$this->db->order_by('id_user', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_user()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			kode_anggota LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nis LIKE ' . "'%" . $search . "%'" . '
			OR
			nama LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_user');
		$this->db->join('kelas','id_kelas=user_kelas');
		$this->db->order_by('id_user', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function select_user_kelas($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('kelas');
		$this->db->where("kelas_jurusan like '%".$searchTerm."%' ");
		$this->db->order_by('id_kelas', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kelas'], "text"=>$q['kelas_jurusan']);
		}
		return $data;
	}
	
}