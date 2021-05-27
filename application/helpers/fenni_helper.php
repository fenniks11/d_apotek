<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    } //else {
    //     $role_id = $ci->session->userdata('role_id');
    // }
}
