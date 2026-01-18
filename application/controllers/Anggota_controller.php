<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Anggota_controller extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
        redirect('auth');
    }
        $this->load->model('Anggota_model');
    }

    public function index() {
        $data['title'] = "Anggota";
        $data['anggota'] = $this->Anggota_model->get_all();
        
        $this->load->view('template/header', $data );
        $this->load->view('template/sidebar');
        $this->load->view('anggota/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data = [
            'nim'           => $this->input->post('nim'),
            'nama_anggota'  => $this->input->post('nama_anggota'),
            'telepon'       => $this->input->post('telepon')
        ];
        $this->Anggota_model->insert($data);
        redirect('anggota');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = [
            'nim'           => $this->input->post('nim'),
            'nama_anggota'  => $this->input->post('nama_anggota'),
            'telepon'       => $this->input->post('telepon')
        ];
        $this->Anggota_model->update($id, $data);
        redirect('anggota');
    }

    public function hapus($id) {
        $this->Anggota_model->delete($id);
        redirect('anggota');
    }
}