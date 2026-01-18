<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Jika sudah login, langsung ke dashboard
        if($this->session->userdata('logged_in')) redirect('dashboard');
        $this->load->view('login');
    }

    public function login_proses() {
        $user_input = $this->input->post('username');
        $pass_input = $this->input->post('password');

        // Cari di database
        $user = $this->db->get_where('user', ['username' => $user_input])->row();

        // Cek apakah user ada DAN password cocok
        if ($user && $pass_input == $user->password) {
            $session_data = [
                'id_user'   => $user->id,
                'username'  => $user->username,
                'nama'      => $user->nama_lengkap,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } else {
            // Jika salah, kirim pesan error
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}