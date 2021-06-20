<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_dan_jenis extends CI_Controller
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

    // READ DATA JENIS DAN KATEGORI

    public function daftar()
    {

        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Kategori dan Jenis Obat';
        $data['daftar_kat'] = $this->m_apotek->kategori()->result();
        $data['daftar_jenis'] = $this->m_apotek->jenis()->result();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('kategori_jenis/daftar', $data);
        $this->load->view('template/admin/footer', $data);
    }

    // CREATE, UPDATE, DELETE DATA FOR JENIS
    public function tambah_kategori()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Tambah Kategori Obat';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('des', 'Deskripsi Kategori', 'required|trim');
        $nama_kategori = $this->input->post('nama_kategori');
        $des = $this->input->post('des');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('kategori_jenis/tambah_kat', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $data = array(
                'nama_kategori' => $nama_kategori,
                'des' => $des

            );

            $this->m_apotek->insert_data($data, 'kategori');

            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Kategori Obat Berhasil Ditambahkan.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('kategori_dan_jenis/daftar');
        }
    }

    public function edit_kategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Edit Kategori Obat';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $where = array('id_kategori' => $id_kategori);
        $data['kategori'] = $this->m_apotek->edit_data($where, 'kategori')->result();
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('des', 'Deskripsi Kategori', 'required|trim');

        $id_kategori = $this->input->post('id_kategori');
        $nama_kategori = $this->input->post('nama_kategori');
        $des = $this->input->post('des');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('kategori_jenis/edit_kat', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $data = array(
                'nama_kategori' => $nama_kategori,
                'des' => $des

            );

            $where = array(
                'id_kategori' => $id_kategori
            );

            $this->m_apotek->update_data($where, $data, 'kategori');

            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Kategori Obat Berhasil Diubah.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('kategori_dan_jenis/daftar');
        }
    }

    public function hapus_kategori($id_kategori)
    {
        $where = array('id_kategori' => $id_kategori);
        $data['kategori'] = $this->m_apotek->edit_data($where, 'kategori')->result();
        $data = array('id_kategori' => $id_kategori);
        $this->m_apotek->del_kat($data);
        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Data Obat Berhasil Dihapus.</div>');
        redirect('kategori_dan_jenis/daftar');
    }

    // CREATE, UPDATE, DELETE DATA FOR JENIS
    public function tambah_jenis()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Tambah Jenis Obat';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('jenis', 'Jenis Obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('kategori_jenis/tambah_jenis', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $data = [
                'jenis' => $this->input->post('jenis')
            ];

            $this->db->insert('jenis_obat', $data);
            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Jenis Obat Berhasil Ditambahkan.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('kategori_dan_jenis/daftar');
        }
    }

    public function edit_jenis($id_jenis)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Edit Jenis Obat';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $where = array('id_jenis' => $id_jenis);
        $data['jenis'] = $this->m_apotek->edit_data($where, 'jenis_obat')->result();

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('jenis', 'Jenis Obat', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('kategori_jenis/edit_jenis', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $data = [
                'jenis' => $this->input->post('jenis')
            ];
            $where = [
                'id_jenis' => $id_jenis
            ];

            $this->m_apotek->update_data($where, $data, 'jenis_obat');

            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Jenis Obat Berhasil Diubah.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('kategori_dan_jenis/daftar');
        }
    }

    public function hapus_jenis($id_jenis)
    {
        $where = array('id_jenis' => $id_jenis);
        $data['jenis'] = $this->m_apotek->edit_data($where, 'jenis_obat')->result();
        $data = array('id_jenis' => $id_jenis);
        $this->m_apotek->del_jenis($data);
        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Jenis Obat Berhasil Dihapus.</div>');
        redirect('kategori_dan_jenis/daftar');
    }
}
