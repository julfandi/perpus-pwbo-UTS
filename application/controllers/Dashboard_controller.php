<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
        // Load semua model untuk mengambil data statistik
        $this->load->model(['Buku_model', 'Anggota_model', 'Peminjaman_model']);
    }

    public function index() {
        $data['title'] = "Dashboard";
        // Mengambil total buku
        $data['total_buku'] = $this->db->count_all('buku');
        
        // Mengambil total anggota
        $data['total_anggota'] = $this->db->count_all('anggota');
        
        // Mengambil jumlah yang sedang dipinjam
        $data['total_dipinjam'] = $this->db->where('status', 'dipinjam')->count_all_results('peminjaman');
        
        // Mengambil total denda terkumpul
        $this->db->select_sum('denda');
        $query = $this->db->get('peminjaman');
        $data['total_denda'] = $query->row()->denda;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}