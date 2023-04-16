<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_penerbit_model extends CI_Model
{

	public function table_data_penerbit()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			kode_penerbit LIKE ' . "'%" . $search . "%'" . ' 
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
		$this->db->from('data_penerbit');
		$this->db->order_by('id_penerbit', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_data_penerbit()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			kode_penerbit LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_penerbit LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_penerbit');
		$this->db->order_by('id_penerbit', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_penerbit()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			kode_penerbit LIKE ' . "'%" . $search . "%'" . ' 
			OR
			nama_penerbit LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_penerbit');
		$this->db->order_by('id_penerbit', 'DESC');
		return $this->db->get()->num_rows();

	}

}