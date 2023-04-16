<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_kategori_model extends CI_Model
{

	public function table_data_kategori()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kategori LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('data_kategori');
		$this->db->order_by('id_kategori', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_data_kategori()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kategori LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kategori');
		$this->db->order_by('id_kategori', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_kategori()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_kategori LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kategori');
		$this->db->order_by('id_kategori', 'DESC');
		return $this->db->get()->num_rows();

	}

}