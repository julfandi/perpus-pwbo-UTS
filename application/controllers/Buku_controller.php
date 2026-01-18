<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
        $this->load->model(['Buku_model', 'Kategori_model']);
    }

    public function index() {
        $data['title'] = "Buku";
        $data['buku'] = $this->Buku_model->get_all();
        $data['kategori'] = $this->Kategori_model->get_all();
        
        // Menambahkan data kategori yang terpilih untuk tiap buku (untuk modal edit)
        foreach ($data['buku'] as $b) {
            $b->kategori_terpilih = $this->Buku_model->get_kategori_ids($b->id);
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('buku/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data_buku = [
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'stok' => $this->input->post('stok')
        ];
        
        $buku_id = $this->Buku_model->insert($data_buku);
        $kategori_ids = $this->input->post('kategori_ids');

        if (!empty($kategori_ids)) {
            $data_pivot = [];
            foreach ($kategori_ids as $kat_id) {
                $data_pivot[] = ['buku_id' => $buku_id, 'kategori_id' => $kat_id];
            }
            $this->Buku_model->insert_kategori_batch($data_pivot);
        }
        redirect('buku');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data_buku = [
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'stok' => $this->input->post('stok')
        ];
        
        $this->Buku_model->update($id, $data_buku);
        
        // Update Kategori: Hapus yang lama, masukkan yang baru
        $this->Buku_model->delete_kategori_by_buku($id);
        $kategori_ids = $this->input->post('kategori_ids');
        if (!empty($kategori_ids)) {
            $data_pivot = [];
            foreach ($kategori_ids as $kat_id) {
                $data_pivot[] = ['buku_id' => $id, 'kategori_id' => $kat_id];
            }
            $this->Buku_model->insert_kategori_batch($data_pivot);
        }
        redirect('buku');
    }

    public function hapus($id) {
        $this->Buku_model->delete($id);
        redirect('buku');
    }
}