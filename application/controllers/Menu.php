<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
        $data['user'] = $this->db->get_where('data_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['judul'] = 'Menu';
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('template/admin/footer', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('menu', 'Judul Menu', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon Menu', 'required|trim');
        if ($this->form_validation->run() == false) {
            redirect('menu');
        } else {
            $data = array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'is_active' => 1
            );
            $this->m_apotek->insert_data($data, 'user_menu');

            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Menu baru berhasil ditambahkan.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('menu');
        }
    }

    public function sub_menu()
    {

        $data['user'] = $this->db->get_where('data_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Menu';

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

        $this->db->like('judul', $data['keyword']);
        $this->db->from('user_sub_menu');
        $this->db->order_by('menu_id');
        $config['base_url'] = 'http://localhost/d_apotek/menu/sub_menu/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 4;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['sub_menu'] = $this->m_apotek->get_subMenu($config['per_page'],  $data['start'],  $data['keyword']);
        // print_r($data['sub_menu']);
        // die;
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('menu/sub_menu', $data);
        $this->load->view('template/admin/footer', $data);
    }
}
