<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman_buku_model extends CI_Model
{
	public function table_peminjaman_buku()
	{
		$id_user	= userdata('id_user');
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
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
		$this->db->where('user_id', $id_user);
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->order_by('id_peminjaman', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_peminjaman_buku()
	{
		$id_user	= userdata('id_user');
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
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
		$this->db->where('user_id', $id_user);
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->order_by('id_peminjaman', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_peminjaman_buku()
	{
		$id_user	= userdata('id_user');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
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
		$this->db->where('user_id', $id_user);
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->order_by('id_peminjaman', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function select_data_buku($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_buku');
		$this->db->where("judul_buku like '%".$searchTerm."%' ");
		$this->db->order_by('id_buku', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_buku'], "text"=>$q['judul_buku']);
		}
		return $data;
	}
}