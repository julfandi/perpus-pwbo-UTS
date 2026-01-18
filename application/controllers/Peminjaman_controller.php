<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
        $this->load->model(['Peminjaman_model', 'Buku_model', 'Anggota_model']);
    }

    public function index() {
        $data['title'] = "Peminjaman";
        $data['peminjaman'] = $this->Peminjaman_model->get_all();
        $data['buku']       = $this->Buku_model->get_all();
        $data['anggota']    = $this->Anggota_model->get_all();
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('peminjaman/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data = [
            'anggota_id' => $this->input->post('anggota_id'),
            'buku_id'    => $this->input->post('buku_id'),
            'tgl_pinjam' => date('Y-m-d'),
            'status'     => 'dipinjam',
            'denda'      => 0
        ];
        $this->Peminjaman_model->insert($data);
        redirect('peminjaman');
    }

    public function kembalikan($id, $buku_id) {
        // Ambil data pinjam untuk hitung denda
        $pinjam = $this->db->get_where('peminjaman', ['id' => $id])->row();
        $tgl_pinjam = new DateTime($pinjam->tgl_pinjam);
        $tgl_kembali = new DateTime(date('Y-m-d'));
        
        // Selisih hari
        $selisih = $tgl_kembali->diff($tgl_pinjam)->days;
        $batas_pinjam = 7; // Contoh batas 7 hari
        $denda_per_hari = 1000;
        $total_denda = 0;

        if ($selisih > $batas_pinjam) {
            $total_denda = ($selisih - $batas_pinjam) * $denda_per_hari;
        }

        $this->Peminjaman_model->proses_kembali($id, $buku_id, $total_denda);
        redirect('peminjaman');
    }
}