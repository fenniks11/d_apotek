<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Obat extends CI_Controller
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

    public function index()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['judul'] = 'Daftar Obat';

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
        $this->db->order_by('tgl_beli', 'DESC');
        $config['base_url'] = 'http://localhost/d_apotek/obat/index/';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 3;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatPerPage($config['per_page'],  $data['start'],  $data['keyword']);
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('obat/daftar_obat', $data);
        $this->load->view('template/admin/footer', $data);
    }
    public function obat_tersedia()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['judul'] = 'Daftar Obat Tersedia';

        // PAGINATION
        $this->load->library('pagination'); //inisialisasi load library

        $config['base_url'] = 'http://localhost/d_apotek/obat/obat_tersedia/';
        $config['total_rows'] = $this->m_apotek->count_obat();
        $data['total_rows'] =  $config['total_rows'];
        $config['per_page'] = 5;

        //INISIALISASI
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        // END PAGINATION
        $data['obat'] =  $this->m_apotek->obatTersedia($config['per_page'],  $data['start']);

        // print_r($data['obat']);
        // print_r($data['total_rows']);
        // print_r($data['obat']);
        // die;

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('obat/daftar_obat_tersedia', $data);
        $this->load->view('template/admin/footer', $data);
    }

    public function tambah()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required|trim');
        $this->form_validation->set_rules('suplier', 'Suplier Obat', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat Obat', 'required|trim');
        $this->form_validation->set_rules('harga_default', 'Harga Obat', 'required|trim|integer');
        $this->form_validation->set_rules('stok', 'Stok Obat', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori Obat', 'required|trim|callback_select_validate');
        $this->form_validation->set_rules('harga_beli', 'Harga Pembelian Obat', 'required|trim|integer');
        $this->form_validation->set_message('select_validate', 'Pilih Salah Satu Nilai');
        $this->form_validation->set_rules('jenis', 'Jenis Obat', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis Obat', 'required|trim|callback_select_validate');
        $this->form_validation->set_rules('tgl_expired', 'Tanggal Expired Obat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Tambah Obat';
            $data['exp'] = $this->data['exp'];
            $data['nullstock'] = $this->data['nullstock'];
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('obat/tambah_obat', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $config['upload_path'] = './assets/gambar_obat/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $data['judul'] = 'Tambah Obat';
                $this->load->view('template/admin/header', $data);
                $this->load->view('template/admin/navbar', $data);
                $this->load->view('template/admin/aside', $data);
                $this->load->view('obat/tambah_obat', $data);
                $this->load->view('template/admin/footer', $data);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar_obat/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $dataObat = [
                    'nama_obat' => $this->input->post('nama_obat'),
                    'id_suplier' => $this->input->post('suplier'),
                    'harga_beli' => $this->input->post('harga_beli'),
                    'harga_default' => $this->input->post('harga_default'),
                    'berat' => $this->input->post('berat'),
                    'id_kategori' => $this->input->post('kategori'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                    'tgl_expired' => $this->input->post('tgl_expired')
                ];
                $this->m_apotek->add($dataObat);
                $id_obat = $this->db->insert_id();

                $dataDetailObat = [
                    'id_obat' => $id_obat,
                    'id_jenis' => $this->input->post('jenis'),
                    'stok' => $this->input->post('stok'),
                    'persediaan' => 'Y'
                ];

                $this->m_apotek->addDetailObat($dataDetailObat);

                $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data Obat Berhasil Ditambahkan.</div>');
                redirect('obat');
            }
        }
    }

    public function edit_obat($id_obat)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('nama_obat', 'Nama Obat', 'required|trim');
        $this->form_validation->set_rules('suplier', 'Suplier Obat', 'required|trim');
        $this->form_validation->set_rules('berat', 'Berat Obat', 'required|trim');
        $this->form_validation->set_rules('harga_default', 'Harga Obat', 'required|trim|integer');
        $this->form_validation->set_rules('stok', 'Stok Obat', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori Obat', 'required|trim|callback_select_validate');
        $this->form_validation->set_rules('harga_beli', 'Harga Pembelian Obat', 'required|trim|integer');
        $this->form_validation->set_message('select_validate', 'Pilih Salah Satu Nilai');
        $this->form_validation->set_rules('jenis', 'Jenis Obat', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis Obat', 'required|trim|callback_select_validate');
        $this->form_validation->set_rules('tgl_expired', 'Tanggal Expired Obat', 'required|trim');
        $this->form_validation->set_rules('persediaan', 'Persediaan Obat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Edit Data Obat';
            $data['detailObat_id'] =  $this->m_apotek->detail_obat($id_obat);
            $data['error'] = $this->upload->display_errors();
            $data['exp'] = $this->data['exp'];
            $data['nullstock'] = $this->data['nullstock'];
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('obat/edit_obat', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $config['upload_path'] = './assets/gambar_obat/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $data['judul'] = 'Edit Data Obat';
                $data['detailObat_id'] =  $this->m_apotek->detail_obat($id_obat);
                $data['error'] = $this->upload->display_errors();
                $data['exp'] = $this->data['exp'];
                $data['nullstock'] = $this->data['nullstock'];
                $this->load->view('template/admin/header', $data);
                $this->load->view('template/admin/navbar', $data);
                $this->load->view('template/admin/aside', $data);
                $this->load->view('obat/edit_obat', $data);
                $this->load->view('template/admin/footer', $data);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar_obat/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = [
                    'id_obat' => $id_obat,
                    'nama_obat' => $this->input->post('nama_obat'),
                    'id_suplier' => $this->input->post('suplier'),
                    'harga_beli' => $this->input->post('harga_beli'),
                    'harga_default' => $this->input->post('harga_default'),
                    'berat' => $this->input->post('berat'),
                    'id_kategori' => $this->input->post('kategori'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                    'tgl_expired' => $this->input->post('tgl_expired'),

                ];
                $this->m_apotek->edit_obat($data);

                $dataObat_detail = [
                    'id_obat' => $id_obat,
                    'stok' => $this->input->post('stok'),
                    'persediaan' => $this->input->post('persediaan')
                ];

                $this->m_apotek->editDetail_Obat($dataObat_detail);

                $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data Obat Berhasil Diubah.</div>');
                redirect('obat');
            }
            $upload_data = array('uploads' => $this->upload->data());
            $config['image_library'] = 'gd2';
            $config['source_image'] = '../assets/gambar_obat/' . $upload_data['uploads']['file_name'];
            $this->load->library('image_lib', $config);

            $data = [
                'id_obat' => $id_obat,
                'nama_obat' => $this->input->post('nama_obat'),
                'id_suplier' => $this->input->post('suplier'),
                'harga_beli' => $this->input->post('harga_beli'),
                'harga_default' => $this->input->post('harga_default'),
                'berat' => $this->input->post('berat'),
                'id_kategori' => $this->input->post('kategori'),
                'tgl_expired' => $this->input->post('tgl_expired'),

            ];

            $this->m_apotek->edit_obat($data);

            $dataObat_detail = [
                'id_obat' => $id_obat,
                'stok' => $this->input->post('stok'),
                'persediaan' => $this->input->post('persediaan')
            ];

            $this->m_apotek->editDetail_Obat($dataObat_detail);

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data Obat Berhasil Diubah.</div>');
            redirect('obat');
        }
    }


    function select_validate($selectOpt)
    {
        $selectOpt = [
            $this->input->post('suplier'),
            $this->input->post('kategori'),
            $this->input->post('jenis'),
        ];
        if ($selectOpt == "none") {

            return false;
        } else {
            return true;
        }
        $this->load->view('obat/tambah_obat', $selectOpt);
    }


    public function detail_obat($id_obat)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Detail Obat';
        $data['detailObat_id'] =  $this->m_apotek->detail_obat($id_obat);
        $data['error'] = $this->upload->display_errors();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('obat/detail_obat', $data);
        $this->load->view('template/admin/footer', $data);
    }

    public function daftar_obat_habis()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Daftar Obat Habis';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['stokHabis'] = $this->m_apotek->stokHabis()->result();
        // print_r($data['stokHabis']);
        // die;
        $data['stokHampirHabis'] = $this->m_apotek->stok_hampir_habis()->result();
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('obat/obat_habis', $data);
        $this->load->view('template/admin/footer', $data);
    }

    public function daftar_obat_exp()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Daftar Obat Kadaluarsa';
        $data['obat_exp'] = $this->m_apotek->obat_expired()->result();
        $data['hampir_exp'] = $this->m_apotek->hampirExp()->result();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $this->session->set_flashdata('message', '<div class = "alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"> Obat Sudah kadaluarsan, harap Menambahkan obat yang baru.</div>');
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('obat/obat_exp', $data);
        $this->load->view('template/admin/footer', $data);
    }

    public function hapus_obat($id_obat)
    {
        $obat = $this->m_apotek->detail_obat($id_obat);
        if ($obat->gambar != "") {
            unlink('./assets/gambar_obat/' . $obat->gambar);
        }

        $data = array('id_obat' => $id_obat);
        $this->m_apotek->delete($data);
        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Data Obat Berhasil Dihapus.</div>');
        redirect('obat');
    }
}
