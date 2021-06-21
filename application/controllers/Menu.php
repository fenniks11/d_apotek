<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login(); // fungsi helper utk menghalangi user yg tidak berhak untuk mengakses
        cek_menu(); // fungsi helper utk menghalangi user yg tidak berhak untuk mengakses
        $this->data['exp'] = $this->m_apotek->countex();
        $this->data['nullstock'] = $this->m_apotek->countstock();

        //Controller penting   
    }

    public function index()
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

        $this->db->like('menu', $data['keyword']);
        $this->db->from('user_menu');
        $config['base_url'] = 'http://localhost/d_apotek/menu/index/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 3;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // $this->db->select('user_menu.*, user_access_menu.menu_id, user_access_menu.role_id, user_role.nama_role');
        // $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
        // $this->db->join('user_role', 'user_access_menu.role_id = user_role.role_id');
        // $this->db->order_by('user_menu.id', 'DESC');
        // $data['menu'] = $this->db->get('user_menu', $config['per_page'],  $data['start'],  $data['keyword'])->result_array();
        $data['menu'] = $this->m_apotek->get_menu($config['per_page'],  $data['start'],  $data['keyword']);
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('menu/menu', $data);
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
            $menu_id = $this->db->insert_id();
            $data = array(
                'menu_id' => $menu_id,
                'role_id' => $this->input->post('role_id')
            );
            $this->m_apotek->insert_data($data, 'user_access_menu');

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
        $config['per_page'] = 40;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['sub_menu'] = $this->m_apotek->get_subMenu($config['per_page'],  $data['start'],  $data['keyword']);
        // print_r($data['sub_menu']);
        // die;
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('menu/sub_menu', $data);
        $this->load->view('template/admin/footer', $data);
    }

    public function tambah_subMenu()
    {
        $this->form_validation->set_rules('menu_id', 'Judul Menu', 'required|trim');
        $this->form_validation->set_rules('judul', 'Judul Sub Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'Url Sub Menu', 'required|trim');
        if ($this->form_validation->run() == false) {
            redirect('menu/sub_menu');
        } else {
            $data = array(
                'menu_id' => $this->input->post('menu_id'),
                'judul' => $this->input->post('judul'),
                'url' => $this->input->post('url'),
                'is_active' => 1
            );

            $this->m_apotek->insert_data($data, 'user_sub_menu');

            $this->session->set_flashdata('message', ' <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg">
                    <div class = "alert alert-success" role="alert">
                    Menu baru berhasil ditambahkan.
                    </div>
                </div>
            </div>
        </div>');

            redirect('menu/sub_menu');
        }
    }

    public function edit_menu($menu_id)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $data['judul'] = 'Menu';
        $where = array('user_menu.id' => $menu_id);
        $this->db->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id');
        $this->db->join('user_role', 'user_role.role_id = user_access_menu.role_id');
        $data['menu'] = $this->db->get_where('user_menu', $where)->row_array();
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('menu', 'Judul Menu', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon Menu', 'required|trim');
        $this->form_validation->set_rules('role_id', 'User Role', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');
        $menu_id = $this->input->post('menu_id');
        $menu = $this->input->post('menu');
        $icon = $this->input->post('icon');
        $role_id = $this->input->post('role_id');
        $is_active = $this->input->post('is_active');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Menu';
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $menu = array(
                'menu' => $menu,
                'icon' => $icon,
                'is_active' => $is_active
            );
            $where1 = array(
                'id' => $menu_id
            );
            $where2 = array(
                'menu_id' => $menu_id
            );
            $update = $this->db->update('user_menu', $menu, $where1);
            // print_r($update);
            $akses = array(
                'role_id' => $role_id
            );
            $update = $this->db->update('user_access_menu', $akses, $where2);
            // print_r($update);
            // die;
            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Menu baru berhasil diubah.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('menu');
        }
    }
    public function edit_submenu($id)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $data['judul'] = 'Menu';
        $where = array('user_sub_menu.id' => $id);
        $data['sub_menu'] = $this->db->get_where('user_sub_menu', $where)->row_array();
        // print_r($data['sub_menu']);
        // die;

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('judul', 'Judul Sub menu', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');
        $id = $this->input->post('id');
        $judul = $this->input->post('judul');
        $url = $this->input->post('url');
        $is_active = $this->input->post('is_active');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Menu';
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('menu/edit_sub_menu', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $sub_menu = array(
                'judul' => $judul,
                'url' => $url,
                'is_active' => $is_active
            );
            $where = array(
                'id' => $id
            );
            $update = $this->db->update('user_sub_menu', $sub_menu, $where);
            print_r($update);
            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Menu baru berhasil diubah.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('menu/sub_menu');
        }
    }
}
