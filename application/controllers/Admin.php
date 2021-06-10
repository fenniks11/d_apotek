<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        cek_login(); // fungsi helper utk menghalangi user yg tidak berhak untuk mengakses
        $this->data['exp'] = $this->m_apotek->countex();
        $this->data['nullstock'] = $this->m_apotek->countstock();

        //Controller penting   
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('data_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = 'Admin';
        $data['exp'] = $this->data['exp'];
        $data['nullstock'] = $this->data['nullstock'];
        $data['tot_sup'] = $this->m_apotek->count_sup();
        $data['tot_kat'] = $this->m_apotek->count_kat();
        $data['stockobat'] = $this->m_apotek->count_med();
        $data['jenis'] = $this->m_apotek->count_jenis();
        $data['tot_user'] = $this->m_apotek->count_user();
        $data['tot_obat_terjual'] = $this->m_apotek->count_obatTerjual();
        $this->load->view('template/admin/header', $data);
        $this->load->view('template/admin/navbar', $data);
        $this->load->view('template/admin/aside', $data);
        $this->load->view('template/admin/content', $data);
        $this->load->view('template/admin/footer', $data);
    }

    // Pengecekan Resep Masuk
    public function cek_resep()
    {
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
        $this->form_validation->set_rules('status', 'Aksi', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->db->select('*');
            $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
            $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['judul'] = 'Cek Resep';
            $data['resep'] = $this->m_apotek->getResep();
            // print_r($data['resep']);
            // die;
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/admin/navbar', $data);
            $this->load->view('template/admin/aside', $data);
            $this->load->view('template/admin/cek_resep', $data);
            $this->load->view('template/admin/footer');
        } else {
            $resep = [
                'status' => $this->input->post('status'),
                'keterangan' => $this->input->post('keterangan'),
                'user_id' => $this->input->post('admin')
            ];
            $data['resep'] = $this->m_apotek->getResep();
            $this->db->where('id_resep', $data['resep'][0]['id_resep']);
            $this->db->update('resep', $resep);

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data resep berhasil diubah.</div>');
            redirect('admin/cek_resep');
        }
    }

    public function proses_pesanan($id_resep)
    {
        $data['resep'] = $this->m_apotek->getResep();
        $id_resep = $data['resep'][0]['id_resep'];

        $this->db->where('id_resep', $id_resep);
        $this->db->set('status', '4');
        $updated = $this->db->update('resep');

        // print_r($updated);
        // die;
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Data resep berhasil diubah.</div>');
        redirect('admin/cek_resep');
    }
}
