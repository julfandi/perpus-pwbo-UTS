<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    public function get_all() {
        $this->db->select('peminjaman.*, anggota.nama_anggota, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('anggota', 'anggota.id = peminjaman.anggota_id');
        $this->db->join('buku', 'buku.id = peminjaman.buku_id');
        $this->db->order_by('peminjaman.id', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        // Kurangi stok buku saat dipinjam
        $this->db->set('stok', 'stok-1', FALSE);
        $this->db->where('id', $data['buku_id']);
        $this->db->update('buku');

        return $this->db->insert('peminjaman', $data);
    }

    public function proses_kembali($id, $buku_id, $denda) {
        // Update status, tgl_kembali, dan denda
        $data = [
            'status' => 'kembali',
            'tgl_kembali' => date('Y-m-d'),
            'denda' => $denda
        ];
        $this->db->where('id', $id);
        $this->db->update('peminjaman', $data);

        // Tambah stok buku kembali
        $this->db->set('stok', 'stok+1', FALSE);
        $this->db->where('id', $buku_id);
        $this->db->update('buku');
    }
}