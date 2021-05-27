<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cari extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login(); // fungsi helper utk menghalangi user yg tidak berhak untuk mengakses
        $this->data['exp'] = $this->m_apotek->countex();
        $this->data['nullstock'] = $this->m_apotek->countstock();
    }

    public function index()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['judul'] = 'Pencarian..';

        // PAGINATION
        $this->load->library('pagination'); //inisialisasi load library

        // ambil data keyword
        if (!($this->uri->segment(2))) {
            $data['keyword'] = $this->session->unset_userdata('keyword');
        }
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('nama_obat', $data['keyword']);
        $this->db->from('obat');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->order_by('obat.id_obat', 'DESC');
        $config['base_url'] = 'http://localhost/d_apotek/cari/index/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 4;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatPerPage($config['per_page'],  $data['start'],  $data['keyword']);
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('template/admin/pencarian', $data);
        $this->load->view('template/admin/footer', $data);
    }

    function fetch()
    {
        // $this->load->model('m_apote');
        echo $this->m_apotek->fetch_data($this->uri->segment(3));
    }
}
