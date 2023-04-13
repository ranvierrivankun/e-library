<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	/*cek nis*/
	public function cek_nis($nis)
	{
		$query = $this->db->get_where('data_user', ['nis' => $nis]);
		return $query->num_rows();
	}

	/*get password user*/
	public function get_password($nis)
	{
		$data = $this->db->get_where('data_user', ['nis' => $nis])->row_array();
		return $data['password'];
	}

	/*get userdata*/
	public function userdata($nis)
	{
		return $this->db->get_where('data_user', ['nis' => $nis])->row_array();
	}
}