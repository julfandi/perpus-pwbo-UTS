<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    // Mengambil semua data kategori
    public function get_all() {
        return $this->db->get('kategori')->result();
    }

    // Menambah data kategori baru
    public function insert($data) {
        return $this->db->insert('kategori', $data);
    }

    // Menghapus data kategori
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kategori');
    }

    // Mengambil data spesifik (untuk keperluan edit nantinya)
    public function get_by_id($id) {
        return $this->db->get_where('kategori', ['id' => $id])->row();
    }

    // Mengubah data Kategori
    public function update($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('kategori', $data);
}
}