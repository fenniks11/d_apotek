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

        $data['judul'] = 'Daftar Pembelian Obat';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        // purchase
        $data['purchase'] = $this->m_apotek->purchase()->result();

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('pembelian/daftar');
        $this->load->view('template/user/footer', $data);
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
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('pembelian/tambah');
        $this->load->view('template/user/footer', $data);
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

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('pembelian/grafik');
        $this->load->view('template/user/footer', $data);
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

    // function export
    public function export_csv()
    {
        // purchase
        $data['purchase'] = $this->m_apotek->purchase()->result();
        $this->load->view('template/user/header', $data);
        $this->load->view('pembelian/export_csv', $data);
        $this->load->view('template/user/footer', $data);
    }

    public function file_csv()
    {
        $config['allowed_types'] = 'pdf|csv';

        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        $file_name = 'historyPembelianObat' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // get data 
        $purchase = $this->m_apotek->purchase();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("No. ", "Tanggal Transaksi", "No. Referensi", "Total");
        fputcsv($file, $header);
        foreach ($purchase->result_array() as $key => $value) {
            fputcsv($file, $value);
        }
        fclose($file);
        exit;
    }
}
