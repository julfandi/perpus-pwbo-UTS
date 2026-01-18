<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

    public function get_all() {
        return $this->db->get('anggota')->result();
    }

    public function insert($data) {
        return $this->db->insert('anggota', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('anggota', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('anggota');
    }
}