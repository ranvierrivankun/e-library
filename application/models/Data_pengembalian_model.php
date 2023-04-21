<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pengembalian_model extends CI_Model
{
	public function table_pengembalian_buku()
	{
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
		$this->db->from('data_pengembalian as a');
		$this->db->join('data_peminjaman as b','b.id_peminjaman=a.peminjaman_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('data_denda','id_denda=a.denda_id');
		$this->db->join('data_user','id_user=a.user_id');
		$this->db->order_by('id_pengembalian', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_pengembalian_buku()
	{
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
			OR
			nama LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_pengembalian as a');
		$this->db->join('data_peminjaman as b','b.id_peminjaman=a.peminjaman_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('data_denda','id_denda=a.denda_id');
		$this->db->join('data_user','id_user=a.user_id');
		$this->db->order_by('id_pengembalian', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_pengembalian_buku()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tanggal_peminjaman LIKE ' . "'%" . $search . "%'" . '
			OR
			nama LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_pengembalian as a');
		$this->db->join('data_peminjaman as b','b.id_peminjaman=a.peminjaman_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('data_denda','id_denda=a.denda_id');
		$this->db->join('data_user','id_user=a.user_id');
		$this->db->order_by('id_pengembalian', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function select_peminjaman($searchTerm)
	{

		$this->db->select('*');
		$this->db->from('data_peminjaman');
		$this->db->join('data_user','id_user=user_id');
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->where('status_peminjaman', '2');
		$this->db->where('status_pengembalian', null);
		$this->db->where("nama like '%".$searchTerm."%' ");
		$this->db->order_by('id_peminjaman', 'ASC');
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_peminjaman'], "text"=>$q['nama'].' - '.$q['judul_buku']);
		}
		return $data;
	}
}