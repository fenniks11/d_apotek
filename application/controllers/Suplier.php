<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suplier extends CI_Controller
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

        $data['judul'] = 'Daftar Suplier Obat';
        $data['daftar_sup'] = $this->m_apotek->suplier()->result();
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('template/user/aside', $data);
        $this->load->view('suplier/daftar', $data);
        $this->load->view('template/user/footer', $data);
    }

    public function tambah()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Tambah Suplier Obat';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('nama_sup', 'Nama Suplier', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Suplier', 'required|trim');
        $this->form_validation->set_rules('telp', 'Nomor Telepon Suplier', 'required|trim|is_natural|min_length[7]|max_length[12]|is_unique[suplier.telp]');
        $nama_sup = $this->input->post('nama_sup');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/user/header', $data);
            $this->load->view('template/user/navbar', $data);
            $this->load->view('template/user/aside', $data);
            $this->load->view('suplier/tambah', $data);
            $this->load->view('template/user/footer', $data);
        } else {
            $data = array(
                'nama_sup' => $nama_sup,
                'alamat' => $alamat,
                'telp' => $telp
            );

            $this->m_apotek->insert_data($data, 'suplier');

            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Suplier Obat Berhasil Ditambahkan.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('suplier/daftar');
        }
    }

    public function edit_sup($id_suplier)
    {

        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Edit Suplier Obat';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $where = array('id_suplier' => $id_suplier);
        $data['suplier'] = $this->m_apotek->edit_data($where, 'suplier')->result();

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('nama_sup', 'Nama Suplier', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Suplier', 'required|trim');
        $this->form_validation->set_rules('telp', 'Nomor Telepon Suplier', 'required|trim|is_natural|min_length[7]|max_length[12]|is_unique[suplier.telp]');
        $id_suplier = $this->input->post('id_suplier');
        $nama_sup = $this->input->post('nama_sup');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/user/header', $data);
            $this->load->view('template/user/navbar', $data);
            $this->load->view('template/user/aside', $data);
            $this->load->view('suplier/edit', $data);
            $this->load->view('template/user/footer', $data);
        } else {
            $data = array(
                'nama_sup' => $nama_sup,
                'alamat' => $alamat,
                'telp' => $telp,

            );

            $where = array(
                'id_suplier' => $id_suplier
            );
            $this->m_apotek->update_data($where, $data, 'suplier');

            $this->session->set_flashdata('message', ' <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg">
                        <div class = "alert alert-success" role="alert">
                        Suplier Obat Berhasil Diubah.
                        </div>
                    </div>
                </div>
            </div>');

            redirect('suplier/daftar');
        }
    }

    public function hapus_sup($id_suplier)
    {
        $where = array('id_suplier' => $id_suplier);
        $data['suplier'] = $this->m_apotek->edit_data($where, 'suplier')->result();
        $data = array('id_suplier' => $id_suplier);
        $this->m_apotek->del_sup($data);
        $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Suplier Obat Berhasil Dihapus.</div>');
        redirect('suplier/daftar');
    }
}
