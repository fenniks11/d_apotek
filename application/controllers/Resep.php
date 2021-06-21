<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'functions.php';

class Resep extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_menu();
        $this->load->library('form_validation');
        $this->load->model('M_mahasiswa', '', TRUE);
        $this->load->model('M_apotek', '', TRUE);
    }
    public function index()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Halaman Utama User';

        $member_email = $data['user']['email'];
        // mengambil data nama user dan alamatnya.
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

        $this->db->like('no_ref', $data['keyword']);
        $this->db->select('tgl_beli, no_ref, grandtotal');
        $this->db->distinct();
        $this->db->from('pembelian_obat_user');
        $this->db->where('member_email', $member_email);
        $this->db->order_by('tgl_beli', 'DESC');
        $config['base_url'] = 'http://localhost/d_apotek/resep/index/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 5;

        // inisialisasi
        $this->pagination->initialize($config);

        // start Paginiation
        $data['start'] = $this->uri->segment(3);

        $where = array('member_email' => $member_email);
        if ($data['keyword']) {
            $this->db->like('no_ref', $data['keyword']);
        }
        $this->db->limit($config['per_page'],  $data['start'], $data['keyword']);
        $this->db->select('tgl_beli, no_ref, grandtotal');
        $this->db->distinct();
        $this->db->select('member_email');
        $data['show_invoice'] = $this->db->get_where('pembelian_obat_user', $where)->result_array();
        // print_r($data['show_invoice']);
        // die;
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/user/content', $data);
        $this->load->view('template/footer');
    }

    function invoice_page($no_ref)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Nota Pembelian Obat';
        $data['penjualan'] = $this->m_apotek->allInvoice();
        $member_email = $data['penjualan'][0]['member_email'];

        // mengambil data nama user dan alamatnya.
        $data['get_user'] = $this->m_apotek->getUser($member_email);
        $where = array('no_ref' => $no_ref);
        $data['invoice'] = $this->m_apotek->show_data('invoice', $where)->result();
        $data['show_invoice'] = $this->m_apotek->show_invoice('show_invoice', $where)->result();
        // 
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/user/nota.php', $data);
        $this->load->view('template/footer');
    }
    public function cekout()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Cekout';
        $data['obat'] =  $this->m_apotek->daftar_obat();
        $no_ref = generateRandString();
        $nama_obat = $this->input->post('nama_obat');
        $harga_jual = $this->input->post('harga_jual');
        $banyak = $this->input->post('banyak');
        $subtotal = $this->input->post('subtotal');
        $member_email = $this->input->post('member_email');
        $grandtotal = $this->input->post('grandtotal');

        foreach ($nama_obat as $i => $val) {
            $data_jual[] = array(
                'no_ref' => $no_ref,
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
        $this->cart->destroy();
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data Obat Berhasil Ditambahkan.</div>');
        redirect('resep');
    }

    public function unggah_resep()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Unggah Resep Dokter';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/user/unggah_resep', $data);
        $this->load->view('template/footer');
    }

    public function proses_resep()
    {

        $config['upload_path'] = './assets/gambar_resep/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 4096;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
            $data['error'] = $this->upload->display_errors();
            redirect('user/unggah_resep');
        } else {
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/gambar_resep/' . $upload_data['uploads']['file_name'];
            $data = [
                'member_id' => $this->input->post('id'),
                'gambar' => $upload_data['uploads']['file_name'],
                'status' => 2
            ];

            $this->m_apotek->insert_data($data, 'resep');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Resep Berhasil Diunggah. Tunggu konfirmasi admin.</div>');
            redirect('resep/user_resep');
        }
    }

    public function user_resep()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Resep';

        $where = $data['user']['user_id'];
        $this->db->where('member_id', $where);
        $this->db->order_by('waktu', 'DESC');
        $data['resep'] = $this->db->get_where('resep', 'status != 4')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/aside', $data);
        $this->load->view('template/user/resep', $data);
        $this->load->view('template/footer');
    }

    public function cekout_resep($id_resep)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where = $data['user']['user_id'];
        $this->db->where('member_id', $where);
        $this->db->order_by('waktu', 'DESC');
        $data['resep'] = $this->db->get('resep')->result_array();

        $config['upload_path'] = './assets/bukti_pembayaran/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 4096;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
            $data['error'] = $this->upload->display_errors();
            redirect('user/user_resep');
        } else {
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/bukti_pembayaran/' . $upload_data['uploads']['file_name'];
            $data = [
                'id_resep' => $this->input->post('id_resep'),
                'user_id' => $this->input->post('member_id'),
                'gambar' => $upload_data['uploads']['file_name']
            ];

            $this->m_apotek->insert_data($data, 'bukti_tf');

            $this->db->set('status', '3');
            $this->db->where('id_resep', $id_resep);
            $this->db->update('resep');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Terimakasih sudah mempercayakan D APOTEK untuk memproses resep kamu. Admin akan segera mengirim pesanan kamu.</div>');
            redirect('user/user_resep');
        }
    }
    function hapus($no_ref)
    {

        $where = array('no_ref' => $no_ref);
        $this->m_apotek->delete_data($where, 'pembelian_obat_user');

        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Data Berhasil Dihapus.</div>');
        redirect('resep/index');
    }
}
