<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    public function get_all() {
        // Menggunakan GROUP_CONCAT untuk menyatukan banyak kategori menjadi satu string
        $this->db->select('buku.*, GROUP_CONCAT(kategori.nama_kategori SEPARATOR ", ") as daftar_kategori');
        $this->db->from('buku');
        $this->db->join('buku_kategori', 'buku_kategori.buku_id = buku.id', 'left');
        $this->db->join('kategori', 'kategori.id = buku_kategori.kategori_id', 'left');
        $this->db->group_by('buku.id');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert('buku', $data);
        return $this->db->insert_id(); // Mengembalikan ID buku yang baru masuk
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('buku', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('buku');
    }

    // Fungsi khusus untuk tabel penghubung
    public function insert_kategori_batch($data) {
        return $this->db->insert_batch('buku_kategori', $data);
    }

    public function delete_kategori_by_buku($buku_id) {
        $this->db->where('buku_id', $buku_id);
        return $this->db->delete('buku_kategori');
    }

    public function get_kategori_ids($buku_id) {
        $query = $this->db->select('kategori_id')->where('buku_id', $buku_id)->get('buku_kategori');
        $result = [];
        foreach ($query->result() as $row) {
            $result[] = $row->kategori_id;
        }
        return $result;
    }
}