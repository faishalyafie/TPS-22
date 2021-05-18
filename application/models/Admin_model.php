<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	public function getAllUser()
	{
		return $this->db->get('user')->result_array();
	}


	public function getUserById($id)
	{
		return $this->db->get_where('user', ['id' => $id])->row_array();
	}


	public function Adduser()
	{
		if ($this->input->post('role') == "Admin") {
			$i = 1;
		} else {
			$i = 2;
		};

		$data = [
			'name' => htmlspecialchars($this->input->post('name', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'image' => 'default.jpg',
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
			'role_id'       => $i,
			'is_active'     => 1,
			'date_created'  => time()
		];
		$this->db->insert('user', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New User Has Been Added!
          </div>');
		redirect('admin/user');
	}


	public function Edituser()
	{

		if ($this->input->post('role') == "Admin") {
			$i = 1;
		} else {
			$i = 2;
		};

		if ($this->input->post('aktiv') == "Active") {
			$a = 1;
		} else {
			$a = 0;
		};

		$data = [
			'name' => htmlspecialchars($this->input->post('name', true)),
			'email' => htmlspecialchars($this->input->post('email', true)),
			'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
			'role_id'       => $i,
			'is_active'     => $a
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User Has Been Edited!
          </div>');
		redirect('admin/user');
	}


	public function delUser($id)
	{
		$this->db->delete('user', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User Has Been Deleted!
          </div>');
		redirect('admin');
	}


	public function cari()
	{
		$cari = $this->input->post('cari', true);
		$this->db->like('name', $cari);
		return $this->db->get('user')->result_array();
	}


	public function Add_aturan()
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
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('keterangan', 'Description', 'required|trim');
		$this->form_validation->set_rules('role', 'Status', 'required|trim');
	}


	public function Edt_aturan()
	{
		// form_validation
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('keterangan', 'Description', 'required|trim');
		$this->form_validation->set_rules('role', 'Status', 'required|trim');
		$this->form_validation->set_rules('aktiv', 'Aktivation', 'required|trim');
	}

	public function getUser($limit, $start)
	{
		return $this->db->get('user', $limit, $start)->result_array();
	}

	public function hitunguser()
	{
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}

	public function jumlahdpt()
	{
		$query = $this->db->get('data');
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
}
