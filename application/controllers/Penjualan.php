<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->library('form_validation');
        $this->load->model('M_mahasiswa', '', TRUE);
        $this->load->model('M_apotek', '', TRUE);
        $this->data['exp'] = $this->m_apotek->countex();
        $this->data['nullstock'] = $this->m_apotek->countstock();
    }

    public function daftar()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Daftar Penjualan Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('penjualan/daftar');
        $this->load->view('template/user/footer', $data);
    }
    public function tambah()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Tambah Penjualan Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('penjualan/tambah');
        $this->load->view('template/user/footer', $data);
    }
    public function user_search()
    {
        $this->load->view('penjualan/ajax-user-search.php');
    }
    public function obat_search()
    {
        // $data['get_obat'] = $this->m_apotek->ambil_obat();
        $this->load->view('penjualan/ajax-obat-search.php');
        //     if (isset($_GET['term'])) {
        //         $getObat = $this->m_apotek->ambil_obat($conn, $_GET['term']);
        //         $obatList = array();
        //         foreach ($getObat as $obat) {
        //             $obatList[] = $obat['id_obat'];
        //             $obatList[] = $obat['nama_obat'];
        //         }
        //         echo json_encode($obatList);
        //     }
    }
    public function grafik()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Grafik Penjualan Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('penjualan/grafik');
        $this->load->view('template/user/footer', $data);
    }
}
