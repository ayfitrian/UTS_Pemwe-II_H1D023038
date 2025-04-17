<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Mengambil semua data kandidat
    public function get_all_candidates() {
        $query = $this->db->get('candidates');  // Mengambil semua data kandidat dari tabel 'candidates'
        return $query->result();  // Mengembalikan data dalam bentuk array objek
    }

    // Menambah kandidat baru
    public function add_candidate($data) {
        return $this->db->insert('candidates', $data);  // Menyimpan data kandidat baru ke tabel 'candidates'
    }

    // Mengambil data kandidat berdasarkan ID
    public function get_candidate_by_id($id) {
        $this->db->where('id', $id);  // Menambahkan kondisi untuk mengambil kandidat berdasarkan ID
        $query = $this->db->get('candidates');  // Mengambil data dari tabel 'candidates'
        return $query->row();  // Mengembalikan satu hasil sebagai objek
    }

    // Mengupdate data kandidat
    public function update_candidate($id, $data) {
        $this->db->where('id', $id);  // Menambahkan kondisi berdasarkan ID kandidat
        return $this->db->update('candidates', $data);  // Mengupdate data kandidat di tabel 'candidates'
    }

    // Menghapus kandidat berdasarkan ID
    public function delete_candidate($id) {
        $this->db->where('id', $id);  // Menambahkan kondisi berdasarkan ID kandidat
        return $this->db->delete('candidates');  // Menghapus kandidat dari tabel 'candidates'
    }
}
