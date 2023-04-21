<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kunjungan_model extends CI_Model
{
	public function table_kunjungan()
	{
		$id_user	= userdata('id_user');
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			tanggal_kunjungan LIKE ' . "'%" . $search . "%'" . '
			OR
			tujuan_kunjungan LIKE ' . "'%" . $search . "%'" . '
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
		$this->db->from('data_kunjungan');
		$this->db->where('user_id', $id_user);
		$this->db->join('data_user','id_user=user_id');
		$this->db->order_by('id_kunjungan', 'DESC');
		$batas;
		return $this->db->get()->result();
	}

	public function filter_table_kunjungan()
	{
		$id_user	= userdata('id_user');
		$awal 	= $this->input->post('length');
		$akhir 	= $this->input->post('start');

		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			tanggal_kunjungan LIKE ' . "'%" . $search . "%'" . '
			OR
			tujuan_kunjungan LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kunjungan');
		$this->db->where('user_id', $id_user);
		$this->db->join('data_user','id_user=user_id');
		$this->db->order_by('id_kunjungan', 'DESC');
		return $this->db->get()->num_rows();

	}

	public function total_table_kunjungan()
	{
		$id_user	= userdata('id_user');
		$sv = strtolower($_POST['search']['value']);

		if($sv){
			$search = $sv;
			$cari = 
			'
			tanggal_kunjungan LIKE ' . "'%" . $search . "%'" . '
			OR
			tujuan_kunjungan LIKE ' . "'%" . $search . "%'" . '
			';
			$k_search = $this->db->where("($cari)");
		}else{
			$k_search = "";
		}

		$k_search;
		$this->db->select('*');
		$this->db->from('data_kunjungan');
		$this->db->where('user_id', $id_user);
		$this->db->join('data_user','id_user=user_id');
		$this->db->order_by('id_kunjungan', 'DESC');
		return $this->db->get()->num_rows();

	}
}