<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_peminjaman_model extends CI_Model
{

	public function table_peminjaman_buku()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama LIKE ' . "'%" . $search . "%'" . '
			OR
			judul_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tanggal_peminjaman LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('data_peminjaman');
		$this->db->join('data_user','id_user=user_id');
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->order_by('id_peminjaman', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_peminjaman_buku()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama LIKE ' . "'%" . $search . "%'" . '
			OR
			judul_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tanggal_peminjaman LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_peminjaman');
		$this->db->join('data_user','id_user=user_id');
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->order_by('id_peminjaman', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_peminjaman_buku()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama LIKE ' . "'%" . $search . "%'" . '
			OR
			judul_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tanggal_peminjaman LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_peminjaman');
		$this->db->join('data_user','id_user=user_id');
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->order_by('id_peminjaman', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function select_anggota($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_user');
		$this->db->where('status', '1');
		$this->db->where('role', '2');
		$this->db->where("nama like '%".$searchTerm."%' ");
		$this->db->order_by('id_user', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_user'], "text"=>$q['nama']);
		}
		return $data;
	}

}