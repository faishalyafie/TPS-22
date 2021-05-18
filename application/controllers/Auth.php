<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}


	public function index()
	{
		ceklogin();
		$this->auth->Laturan();

		if ($this->form_validation->run() == false) {
			$data['title'] = 'User Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->auth->login();
		}
	}


	public function registration()
	{
		ceklogin();
		$this->auth->Raturan();

		if ($this->form_validation->run() == false) {
			$data['title'] = 'User Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$this->auth->Rtambahdata();
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out! </div>');
		redirect('auth');
	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
