<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'functions.php';

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // cek jika dia admin, kembalikan dia ke halaman admin!
        if ($data['user']['role_id'] == 1) {
            redirect('admin');
        };
        $data['judul'] = 'Halaman Utama';

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
        $this->db->where('stok > 0 and tgl_expired >= now()');
        $this->db->order_by('obat.id_obat', 'DESC');
        $config['base_url'] = 'http://localhost/d_apotek/dashboard/index/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 6;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatDijual($config['per_page'],  $data['start'],  $data['keyword']);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/index', $data);
        $this->load->view('template/footer');
    }

    public function detail_obat($id_obat)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['detailObat_id'] =  $this->m_apotek->detail_obat($id_obat);
        $judul = $data['detailObat_id']->nama_obat;
        $data['judul'] = $judul;
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/detail_obat', $data);
        $this->load->view('template/footer');
    }

    public function obat_bebas()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Kategori Obat Bebas';

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
        $config['base_url'] = 'http://localhost/d_apotek/dashboard/obat_bebas/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 8;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatBebas($config['per_page'],  $data['start'],  $data['keyword']);
        // print_r($data['obat']);
        // die;
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/obat_bebas', $data);
        $this->load->view('template/footer');
    }
    public function obat_bebas_terbatas()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Kategori Obat Bebas Terbatas';

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
        $config['base_url'] = 'http://localhost/d_apotek/dashboard/obat_bebas_terbatas/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 8;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatBebasTerbatas($config['per_page'],  $data['start'],  $data['keyword']);
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/obat_bebas_terbatas', $data);
        $this->load->view('template/footer');
    }
    public function obat_keras()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Kategori Obat Keras';

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
        $config['base_url'] = 'http://localhost/d_apotek/dashboard/obat_keras/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 8;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatKeras($config['per_page'],  $data['start'],  $data['keyword']);
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/obat_keras', $data);
        $this->load->view('template/footer');
    }

    public function tambah_keranjang($id_obat)
    {
        $obat = $this->m_apotek->find($id_obat);

        $data = array(
            'id'      => $obat->id_obat,
            'qty'     => 1,
            'price'   => $obat->harga_default,
            'name'    => $obat->nama_obat,

        );

        $this->cart->insert($data);
        redirect('dashboard');
    }

    public function detail_keranjang()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Keranjang Anda';
        $data['get_user'] = $this->m_apotek->getDataPembeli($data['user']['email']);
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/user/keranjang', $data);
        $this->load->view('template/footer');
    }

    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('dashboard');
    }
}
