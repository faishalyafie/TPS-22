<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

	public function Rtambahdata()
	{
		$data = [
			'name' => htmlspecialchars($this->input->post('name', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'image' => 'default.jpg',
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			'role_id'       => 2,
			'is_active'     => 1,
			'date_created'  => time()
		];
		$this->db->insert('user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Congratulation! your account has been created. Please Login
      </div>');
		redirect('auth');
	}


	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// query db
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		// jika user active
		if ($user) {
			// jika user active
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email'     => $user['email'],
						'role_id'   => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password !
                  </div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    This email has not been activated!
                  </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email is not registered!
              </div>');
			redirect('auth');
		}
	}


	public function Raturan()
	{
		// form_validation
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registerd!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
	}


	public function Laturan()
	{
		// form_validation
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
			'min_length' => 'Password too short!'
		]);
	}
}
