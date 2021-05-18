<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getAlluser()
    {
        return $this->db->get('user')->result_array();
    }


    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }


    public function editU()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');


        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Your profile updated!
      </div>');
        redirect('user/card');
    }


    public function changeP()
    {
        $current_password = $this->input->post('password');
        $new_password = $this->input->post('pass1');

        if ($current_password == $new_password) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        new password cannot be the same!
    </div>');
            redirect('user/change');
        } else {
            // pasword sudah oke
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

            $this->db->set('password', $password_hash);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Password changed!
                      </div>');
            redirect('user/change');
        }
    }



    public function useraturan()
    {
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
    }


    public function passaturan()
    {
        $this->form_validation->set_rules('password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('pass1', 'New Password', 'trim|required|min_length[3]|matches[pass2]', [
            'matches' => 'The New Password does not match !'
        ]);
        $this->form_validation->set_rules('pass2', 'Confirm Password', 'trim|required|min_length[3]|matches[pass1]', [
            'matches' => 'The New Password does not match !'
        ]);
    }


    public function paseror()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    wrong current password!
                  </div>');
        redirect('user/change');
    }


    public function jumlahUser()
    {
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
