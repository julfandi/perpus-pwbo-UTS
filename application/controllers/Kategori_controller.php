<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
        // Load model
        $this->load->model('Kategori_model');
        // Load library yang dibutuhkan
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = "Kategori";
        $data['kategori'] = $this->Kategori_model->get_all();
        
        // Memanggil template sesuai referensi Dashboard kamu
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('kategori/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori')
            ];
            $this->Kategori_model->insert($data);
            redirect('kategori_controller');
        }
    }

    public function hapus($id) {
        $this->Kategori_model->delete($id);
        redirect('kategori_controller');
    }

    public function edit() {
    $id = $this->input->post('id');
    $data = [
        'nama_kategori' => $this->input->post('nama_kategori')
    ];
    $this->Kategori_model->update($id, $data);
    redirect('kategori');
}
}