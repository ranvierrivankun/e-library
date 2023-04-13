<?php

function cek_login()
{
	$ci = get_instance();
	if (!$ci->session->has_userdata('login_session')) {
		set_pesan('Silahkan Login', false);
		redirect('auth');
	}
}

function cek_login_admin()
{
	if (userdata('role') == "1") {
		return;
	} else {
		redirect('home');
	}
}

function userdata($field)
{
	$ci = get_instance();
	$ci->load->model('M_builder', 'bd');
	$id_user = $ci->session->userdata('login_session')['user'];
	return $ci->bd->get('data_user', ['id_user' => $id_user])[$field];
}

function set_pesan($pesan, $tipe = true)
{
	$ci = get_instance();
	if ($tipe) {
		$ci->session->set_flashdata('pesan', "<div class='alert alert-success'><strong>SUCCESS!</strong> {$pesan} <button type='button' class='close float-end mb-0' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	} else {
		$ci->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!</strong> {$pesan} <button type='button' class='close float-end mb-0' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	}
}