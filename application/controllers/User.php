<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$data['user'] =    $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/card', $data);
		$this->load->view('templates/footer');
	}
}
