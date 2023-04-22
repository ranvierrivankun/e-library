<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_kunjungan_model extends CI_Model
{
	public function get_laporan($tgl1, $tgl2)
	{
		if($tgl1 != "" && $tgl2 != "") {
			$this->db->where("tanggal_kunjungan BETWEEN '$tgl1' AND '$tgl2' ");
		} elseif($tgl1 != "" && $tgl2 == "") {
			$this->db->where('tanggal_kunjungan', $tgl1);
		} else {
			$this->db->where('tanggal_kunjungan', $tgl1);
		}

		$this->db->select('*');
		$this->db->from('data_kunjungan');
		$this->db->join('data_user','id_user=user_id');
		$this->db->order_by('id_kunjungan', 'DESC');

		return $this->db->get()->result();
	}
}