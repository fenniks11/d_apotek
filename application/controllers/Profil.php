<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login(); // fungsi helper utk menghalangi user yg tidak berhak untuk mengakses
        // cek_menu();
        $data['user'] = $this->db->get_where('data_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('M_mahasiswa', '', TRUE);
    }

    public function index()
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $this->db->join('provinsi', 'alm_user.provinsi = provinsi.id_provinsi');
        $this->db->join('kabupaten', 'alm_user.kabkot = kabupaten.id_kabupaten');
        $this->db->join('kecamatan', 'alm_user.kecamatan = kecamatan.id_kecamatan');
        $this->db->join('kelurahan', 'alm_user.kelurahan = kelurahan.id_kelurahan');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Kelola Profile Anda';

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/profil', $data);
        $this->load->view('template/footer', $data);
    }

    public function edit($user_id)
    {
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $data['judul'] = 'Edit Profile Anda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user_id = array(
            'user_id' =>  $data['user']['user_id']
        );
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('template/edit_profil', $data);
            $this->load->view('template/footer', $data);
        } else {
            $nama = $this->input->post('nama');

            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/images/profile/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 2000;
                $this->upload->initialize($config);
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/images/profile/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                if ($this->upload->do_upload('gambar')) {
                    $gambar_baru = $this->upload->data('file_name');
                    // var_dump($gambar_baru);
                    $this->db->set('gambar', $gambar_baru);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where($user_id);
            $update = $this->db->update('user');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data berhasil diubah.</div>');
            redirect('profil');
        }
    }
    // dijalankan saat provinsi di klik
    public function pilih_kabupaten()
    {
        $data['kabupaten'] = $this->M_mahasiswa->ambil_kabupaten($this->uri->segment(3));
        $this->load->view('template/auth/v_drop_down_kabupaten', $data);
    }

    // dijalankan saat kabupaten di klik
    public function pilih_kecamatan()
    {
        $data['kecamatan'] = $this->M_mahasiswa->ambil_kecamatan($this->uri->segment(3));
        $this->load->view('template/auth/v_drop_down_kecamatan', $data);
    }

    // dijalankan saat kecamatan di klik
    public function pilih_kelurahan()
    {
        $data['kelurahan'] = $this->M_mahasiswa->ambil_kelurahan($this->uri->segment(3));
        $this->load->view('template/auth/v_drop_down_kelurahan', $data);
    }
    public function edit_alamat($user_id)
    {
        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $this->db->join('provinsi', 'alm_user.provinsi = provinsi.id_provinsi');
        $this->db->join('kabupaten', 'alm_user.kabkot = kabupaten.id_kabupaten');
        $this->db->join('kecamatan', 'alm_user.kecamatan = kecamatan.id_kecamatan');
        $this->db->join('kelurahan', 'alm_user.kelurahan = kelurahan.id_kelurahan');
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = 'Edit Alamat Anda';
        $user_id = array(
            'user_id' =>  $data['user']['user_id']
        );

        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        if ($this->form_validation->run() == false) {
            $data['provinsi'] = $this->M_mahasiswa->ambil_provinsi();
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('template/edit_alamat', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data_alm_user = [
                'provinsi' => $this->input->post('provinsi_id'),
                'kabkot' => $this->input->post('kabupaten_id'),
                'kecamatan' => $this->input->post('kecamatan_id'),
                'kelurahan' => $this->input->post('kelurahan_id'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->db->set($data_alm_user);
            $this->db->where($user_id);
            $this->db->update('alm_user');
        }
    }
}
