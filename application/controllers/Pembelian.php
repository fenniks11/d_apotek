<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'functions.php';

class Pembelian extends CI_Controller
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

        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['judul'] = 'Daftar Pembelian Obat';
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

        $this->db->like('nama_sup', $data['keyword']);
        $this->db->from('obat');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->order_by('tgl_beli', 'DESC');
        $config['base_url'] = 'http://localhost/d_apotek/pembelian/daftar/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 3;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        // purchase
        $data['purchase'] = $this->m_apotek->purchase($config['per_page'],  $data['start'],  $data['keyword']);

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('pembelian/daftar');
        $this->load->view('template/admin/footer', $data);
    }

    public function ambilData()
    {
        $dataObat = $this->m_apotek->ambilData();
        echo json_encode($dataObat);
    }

    public function tambah()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email', 'user_id')])->row_array();


        $data['judul'] = 'Tambah Pembelian Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['get_sup'] =  $this->m_apotek->get_suplier();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('pembelian/tambah');
        $this->load->view('template/admin/footer', $data);
    }

    public function add_purchase()
    {
        $no_ref = generateRandString();
        $id_obat = $this->input->post('id_obat');
        $harga_beli = $this->input->post('harga_beli');
        $banyak = $this->input->post('banyak');
        $subtotal = $this->input->post('subtotal');
        $id_sup = $this->input->post('id_suplier');
        // $tgl_beli = now();
        $grandtotal = $this->input->post('grandtotal');
        $user_id = $this->input->post('user_id');
        foreach ($id_obat as $i => $val) {
            $dataObat[] = array(
                'no_ref' => $no_ref,
                'id_obat' => $val,
                'harga_beli' => $harga_beli[$i],
                'banyak' => $banyak[$i],
                'subtotal' => $subtotal[$i],
                'id_suplier' => $id_sup,
                'grandtotal' => $grandtotal,
                'user_id' => $user_id
            );
            $this->db->set('stok', 'stok+' . $banyak[$i], FALSE);
            $this->db->where('id_obat', $val);
            $updated = $this->db->update('detail_obat');
        }
        $this->db->insert_batch('purchase', $dataObat);
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data Obat Berhasil Ditambahkan.</div>');
        redirect('pembelian/daftar');
    }

    function getmedbysupplier()
    {
        $nama_sup = $this->input->post('nama_sup');
        $data = $this->m_apotek->getmedbysupplier($nama_sup);
        echo json_encode($data);
    }

    public function purchase_page($no_ref)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Cetak Nota Pembelian';
        $where = array('no_ref' => $no_ref);
        $data['purchase'] = $this->m_apotek->ambil_purchase($where, 'purchase')->result();
        $data['show_purchase'] = $this->m_apotek->show_purchase($where, 'purchase')->result();
        // $data['pembelian'] = $this->m_apotek->allPurchase($where);

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('pembelian/purchase_page', $data);
        $this->load->view('template/admin/footer', $data);
    }
    public function grafik()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Grafik Pembelian Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('pembelian/grafik');
        $this->load->view('template/admin/footer', $data);
    }

    // dijalankan saat suplier di klik
    public function pilih_suplier()
    {
        $data['suplier'] = $this->m_apotek->get_suplier($this->uri->segment(3));
        $this->load->view('pembelian/v_drop_down_suplier', $data);
    }

    // dijalankan saat kabupaten di klik
    public function pilih_obat()
    {
        $data['obat'] = $this->m_apotek->get_obat($this->uri->segment(3));
        $this->load->view('pembelian/v_drop_down_obat', $data);
    }
    public function get_stok()
    {
        $data['stok'] = $this->m_apotek->get_stok($this->uri->segment(3));
        $this->load->view('pembelian/v_get_stok', $data);
        // print_r($data['stok']);
        // die;
    }

    // dijalankan saat kecamatan di klik
    public function pilih_jenisObat()
    {
        $data['jenis_obat'] = $this->m_apotek->get_jenisObat($this->uri->segment(3));
        $this->load->view('pembelian/v_drop_down_jenisObat', $data);
    }

    // Hapus Nota Pembelian
    function hapus($no_ref)
    {

        $where = array('no_ref' => $no_ref);
        $this->m_apotek->delete_data($where, 'purchase');

        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Data Berhasil Dihapus.</div>');
        redirect('pembelian/daftar');
    }
}
