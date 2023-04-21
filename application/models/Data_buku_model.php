<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_buku_model extends CI_Model
{

	public function table_data_buku()
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
			pengarang_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			isbn_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tahun_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_penerbit LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('data_buku');
		$this->db->join('data_penerbit','id_penerbit=penerbit_buku');
		$this->db->join('data_kategori','id_kategori=kategori_buku');
		$this->db->order_by('id_buku', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_data_buku()
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
			pengarang_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			isbn_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tahun_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_penerbit LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_buku');
		$this->db->join('data_penerbit','id_penerbit=penerbit_buku');
		$this->db->join('data_kategori','id_kategori=kategori_buku');
		$this->db->order_by('id_buku', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_buku()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			judul_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			pengarang_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			isbn_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			tahun_buku LIKE ' . "'%" . $search . "%'" . '
			OR
			nama_penerbit LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_buku');
		$this->db->join('data_penerbit','id_penerbit=penerbit_buku');
		$this->db->join('data_kategori','id_kategori=kategori_buku');
		$this->db->order_by('id_buku', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function select_penerbit_buku($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_penerbit');
		$this->db->where("nama_penerbit like '%".$searchTerm."%' ");
		$this->db->order_by('id_penerbit', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_penerbit'], "text"=>$q['nama_penerbit']);
		}
		return $data;
	}

	public function select_kategori_buku($searchTerm)
	{
		$this->db->select('*');
		$this->db->from('data_kategori');
		$this->db->where("nama_kategori like '%".$searchTerm."%' ");
		$this->db->order_by('id_kategori', 'ASC');
		$role;
		$query = $this->db->get()->result_array();

		$data = array();
		foreach($query as $q){
			$data[] = array("id"=>$q['id_kategori'], "text"=>$q['nama_kategori']);
		}
		return $data;
	}

}