<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_peminjaman_model extends CI_Model
{
	public function get_laporan($tgl1, $tgl2)
	{
		if($tgl1 != "" && $tgl2 != "") {
			$this->db->where("tanggal_peminjaman BETWEEN '$tgl1' AND '$tgl2' ");
		} elseif($tgl1 != "" && $tgl2 == "") {
			$this->db->where('tanggal_peminjaman', $tgl1);
		} else {
			$this->db->where('tanggal_peminjaman', $tgl1);
		}

		$this->db->select('*');
		$this->db->where('status_peminjaman', 3);
		$this->db->where('status_pengembalian', 2);
		$this->db->from('data_peminjaman as a');
		$this->db->join('data_pengembalian as c','c.peminjaman_id=id_peminjaman');
		$this->db->join('data_denda','id_denda=c.denda_id');
		$this->db->join('data_user as b','b.id_user=a.user_id');
		$this->db->join('data_buku','id_buku=a.buku_id');
		$this->db->join('kelas','id_kelas=b.user_kelas');
		$this->db->order_by('id_peminjaman', 'DESC');

		return $this->db->get()->result();
	}
}