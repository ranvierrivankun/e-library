<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian_buku_model extends CI_Model
{

	public function table_pengembalian_buku()
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
		$this->db->from('data_pengembalian as a');
		$this->db->where('a.user_id', $id_user);
		$this->db->join('data_peminjaman as b','b.id_peminjaman=a.peminjaman_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('data_denda','id_denda=a.denda_id');
		$this->db->order_by('id_pengembalian', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_pengembalian_buku()
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
		$this->db->from('data_pengembalian as a');
		$this->db->where('a.user_id', $id_user);
		$this->db->join('data_peminjaman as b','b.id_peminjaman=a.peminjaman_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('data_denda','id_denda=a.denda_id');
		$this->db->order_by('id_pengembalian', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_pengembalian_buku()
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
		$this->db->from('data_pengembalian as a');
		$this->db->where('a.user_id', $id_user);
		$this->db->join('data_peminjaman as b','b.id_peminjaman=a.peminjaman_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('data_denda','id_denda=a.denda_id');
		$this->db->order_by('id_pengembalian', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function select_peminjaman($searchTerm)
	{
		$id_user = userdata('id_user');

		$this->db->select('*');
		$this->db->from('data_peminjaman');
		$this->db->join('data_buku','id_buku=buku_id');
		$this->db->where('user_id', $id_user);
		$this->db->where('status_peminjaman', '2');
		$this->db->where('status_pengembalian', null);
		$this->db->where("judul_buku like '%".$searchTerm."%' ");
		$this->db->order_by('id_peminjaman', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_peminjaman'], "text"=>$q['judul_buku']);
		}
		return $data;
	}

	public function select_denda($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_denda');
		$this->db->where("nama_denda like '%".$searchTerm."%' ");
		$this->db->order_by('id_denda', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_denda'], "text"=>$q['nama_denda'].' - '.rupiah($q['tarif_denda']));
		}
		return $data;
	}

}