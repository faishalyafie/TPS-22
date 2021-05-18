<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{

	public function getAlldata()
	{
		return $this->db->get('data')->result_array();
	}


	public function getDataById($id)
	{
		return $this->db->get_where('data', ['id' => $id])->row_array();
	}

	public function Caridata()
	{
		$cari = $this->input->post('cari', true);
		$this->db->like('dpt', $cari);
		return $this->db->get('data')->result_array();
	}

	public function Editdata()
	{

		if ($this->input->post('hadir') == "Sudah hadir") {
			$i = 2;
		} else {
			$i = 1;
		};

		$data = [
			'kehadiran'       => $i,
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('data', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User Has Been Edited!
          </div>');
		redirect('data');
	}

	public function Edt_aturan()
	{
		// form_validation
		$this->form_validation->set_rules('aktiv', 'Aktivation', 'required|trim');
	}
}
