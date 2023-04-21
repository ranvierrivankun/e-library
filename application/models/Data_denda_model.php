<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_denda_model extends CI_Model
{
	public function table_data_denda()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_denda LIKE ' . "'%" . $search . "%'" . '
			OR
			tarif_denda LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('data_denda');
		$this->db->order_by('id_denda', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_data_denda()
	{
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_denda LIKE ' . "'%" . $search . "%'" . '
			OR
			tarif_denda LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_denda');
		$this->db->order_by('id_denda', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_data_denda()
	{
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			nama_denda LIKE ' . "'%" . $search . "%'" . '
			OR
			tarif_denda LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_denda');
		$this->db->order_by('id_denda', 'DESC');
		return $this->db->get()->num_rows();
	}

}