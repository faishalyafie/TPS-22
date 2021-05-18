<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        // $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        // $menu_id = $queryMenu['id'];
        // //$menu_m = $queryMenu['menu'];

        // $userAccess = $ci->db->get_where('user_aksesmenu', [
        //     'role_id' => $role_id, //2
        //     'menu_id' => $menu_id //1
        // ]);

        // // if ($userAccess->num_rows() < 1) {
        // //     redirect('auth/blocked');
        // // }

        if ($role_id == 2) {
            if ($menu == "admin") {
                redirect('auth/blocked');
            } elseif ($menu == "menu") {
                redirect('auth/blocked');
            }
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_aksesmenu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function ceklogin()
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');

    if ($role_id == 1) {
        if ($ci->session->userdata('email')) {
            redirect('admin');
        }
    } else {
        if ($ci->session->userdata('email')) {
            redirect('user');
        }
    }
}
