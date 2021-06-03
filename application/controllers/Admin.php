<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login(); // fungsi helper utk menghalangi user yg tidak berhak untuk mengakses
        $this->data['exp'] = $this->m_apotek->countex();
        $this->data['nullstock'] = $this->m_apotek->countstock();

        //Controller penting   
    }

    public function index()
    {
        // Join ke 3 table untuk memperoleh data user dan
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Admin';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['tot_sup'] = $this->m_apotek->count_sup();
        $data['tot_kat'] = $this->m_apotek->count_kat();
        $data['stockobat'] = $this->m_apotek->count_med();
        $data['jenis'] = $this->m_apotek->count_jenis();
        $data['tot_user'] = $this->m_apotek->count_user();
        $data['tot_obat_terjual'] = $this->m_apotek->count_obatTerjual();
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('template/admin/content', $data);
        $this->load->view('template/admin/footer', $data);
    }
}
