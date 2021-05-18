<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Data_model', 'data');
		$this->load->model('Admin_model', 'admin');
	}


	public function index()
	{
		$data['title'] = 'Undangan Data DPT';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->data->getAlldata();
		$config['total_rows'] = 400;
		$config['per_page'] = 20;
		$this->pagination->initialize($config);

		if ($this->input->post('cari')) {
			$data['data'] = $this->data->Caridata();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/index', $data);
		$this->load->view('templates/footer');
	}

	public function datang()
	{
		$data['title'] = 'Pengunjung Data DPT';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->data->getAlldata();

		if ($this->input->post('cari')) {
			$data['data'] = $this->data->Caridata();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/datang', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$data['title'] = 'Data DPT';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['status'] = ['Sudah hadir', 'Belum hadir'];
		$data['data'] = $this->data->getDataById($id);

		$this->form_validation->set_rules('hadir', 'Kehadiran', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('data/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->data->Editdata($id);
		}
	}
}
