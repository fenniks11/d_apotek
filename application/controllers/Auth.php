<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_mahasiswa', '', TRUE);
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $this->load->view('template/admin/header', $data);
            $this->load->view('template/auth/login', $data);
            $this->load->view('template/admin/footer', $data);
        } else {
            $this->_validasi();
        }
    }

    private function _validasi()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->db->select('*');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        $id = $user['user_id'];
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('detail_user', 'user.user_id = detail_user.user_id');
        $this->db->join('user_role', 'detail_user.role_id = user_role.role_id', 'left');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id', 'left');
        $this->db->where('user.user_id', $id);
        $detail_user = $this->db->get();

        //jika usernya ada
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('dashboard');
                    }
                } else { // jika password salah
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Password anda salah!</div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Email ini sudah tidak aktif!</div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Email ini belum terdaftar!</div>');
            redirect('auth/login');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('telp', 'Nomor Hp', 'required|trim|is_natural|min_length[7]|max_length[12]|is_unique[user.telp]');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password minimal 3 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['provinsi'] = $this->M_mahasiswa->ambil_provinsi();
            $data['judul'] = 'Register';
            $this->load->view('template/auth/header', $data);
            $this->load->view('template/auth/register', $data);
            $this->load->view('template/auth/footer', $data);
        } else {
            $this->db->trans_begin();
            $datauser = [
                'nama' => htmlspecialchars($this->input->post('nama', true)), //nilai true untuk menghindari xss 
                'email' => htmlspecialchars($this->input->post('email', true)), //nilai true untuk menghindari xss 
                'gambar' => 'default.png',
                'telp' => $this->input->post('telp'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->M_mahasiswa->insert_user($datauser, 'user');
            // $this->db->insert('user', $datauser);
            $user_id = $this->db->insert_id();

            $data_detail_user = [
                'user_id' => $user_id,
                'role_id' => 2,
                'is_active' => 1
            ];
            $this->M_mahasiswa->insert_detail_user($data_detail_user, 'detail_user');
            // $this->db->insert('detail_user', $data_detail_user);


            $data_alm_user = [
                'user_id' => $user_id,
                'provinsi' => $this->input->post('provinsi_id'),
                'kabkot' => $this->input->post('kabupaten_id'),
                'kecamatan' => $this->input->post('kecamatan_id'),
                'kelurahan' => $this->input->post('kelurahan_id'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->M_mahasiswa->insert_alm_user($data_alm_user, 'alm_user');

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Selamat, kamu sudah terdaftar. Silakan login!</div>');
            redirect('auth/login');
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
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Kamu berhasil keluar. Silakan login kembali!</div>');
        redirect('dashboard');
    }


    public function blocked()
    {
        echo 'akses blok!';
    }
}
