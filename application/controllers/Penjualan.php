<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'functions.php';
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

        $data['judul'] = 'Penjualan';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        // // PAGINATION
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

        $this->db->like('member_email', $data['keyword']);
        $this->db->from('invoice');
        $this->db->order_by('tgl_beli', 'DESC');
        $config['base_url'] = 'http://localhost/d_apotek/penjualan/daftar/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 5;

        // inisialisasi
        $this->pagination->initialize($config);

        // start Paginiation
        $data['start'] = $this->uri->segment(3);

        // end pagination
        $data['penjualan'] = $this->m_apotek->invoice($config['per_page'],  $data['start'], $data['keyword']);
        // print_r($data['penjualan']);
        // die;

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('penjualan/daftar', $data);
        $this->load->view('template/admin/footer', $data);
    }

    function invoice_page($no_ref)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Cetak Nota Penjualan';
        $data['penjualan'] = $this->m_apotek->allInvoice();
        $member_email = $data['penjualan'][0]['member_email'];

        // mengambil data nama user dan alamatnya.
        $data['get_user'] = $this->m_apotek->getUser($member_email);
        $where = array('no_ref' => $no_ref);
        $data['invoice'] = $this->m_apotek->show_data($where, 'invoice')->result();
        $data['show_invoice'] = $this->m_apotek->show_invoice($where)->result();
        // 
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('penjualan/invoice_page', $data);
        $this->load->view('template/admin/footer', $data);
    }


    public function form_tambah()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email', 'user_id')])->row_array();
        $data['judul'] = 'Tambah Penjualan Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('penjualan/tambah', $data);
        $this->load->view('template/admin/footer', $data);
    }
    public function add_invoice()
    {
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $no_ref = generateRandString();
        $user_id = $this->input->post('user_id');
        $nama_obat = $this->input->post('nama_obat');
        $harga_jual = $this->input->post('harga_jual');
        $banyak = $this->input->post('banyak');
        $subtotal = $this->input->post('subtotal');
        $member_email = $this->input->post('member_email');
        $grandtotal = $this->input->post('grandtotal');
        foreach ($nama_obat as $i => $val) {
            $data_jual[] = array(
                'no_ref' => $no_ref,
                'user_id' => $user_id,
                'nama_obat' => $val,
                'harga_jual' => $harga_jual[$i],
                'banyak' => $banyak[$i],
                'subtotal' => $subtotal[$i],
                'member_email' => $member_email,
                'grandtotal' => $grandtotal
            );
            $this->db->set('stok', 'stok-' . $banyak[$i], FALSE);
            $this->db->where($nama_obat, $val);
            $updated = $this->db->update('detail_obat');
        }

        $this->db->insert_batch('invoice', $data_jual);
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data Obat Berhasil Ditambahkan.</div>');
        redirect('penjualan/daftar');
    }
    public function user_search()
    {
        $this->load->view('penjualan/ajax-user-search.php');
    }
    public function obat_search()
    {
        $this->load->view('penjualan/ajax-obat-search.php');
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

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('penjualan/grafik');
        $this->load->view('template/admin/footer', $data);
    }

    function hapus($no_ref)
    {

        $where = array('no_ref' => $no_ref);
        $this->m_apotek->delete_data($where, 'invoice');

        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Data Berhasil Dihapus.</div>');
        redirect('penjualan/daftar');
    }
}
