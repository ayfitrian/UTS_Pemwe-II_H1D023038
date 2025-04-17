<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Fungsi untuk mengambil user berdasarkan email
    public function get_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    // Fungsi untuk menambahkan user baru (untuk registrasi)
    public function insert($data) {
        return $this->db->insert('users', $data);
    }

    // Fungsi untuk memperbarui status voting user
    public function update_vote_status($user_id) {
        return $this->db->update('users', ['has_voted' => 1], ['id' => $user_id]);
    }

    // Fungsi untuk mengecek apakah user sudah pernah melakukan voting atau belum
    public function has_voted($user_id) {
        $this->db->select('has_voted');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();

        return $query->row()->has_voted;
    }

    // Fungsi untuk mendapatkan semua data user berdasarkan role (admin atau user)
    public function get_all_users_by_role($role) {
        return $this->db->get_where('users', ['role' => $role])->result();
    }
    
    // Fungsi untuk mengambil data user berdasarkan ID
    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', ['id' => $user_id])->row();
    }

    // Fungsi untuk mengambil data user berdasarkan email dan password (untuk login)
    public function get_user_by_email_and_password($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('users')->row(); // Mengambil 1 row
    }

    public function login($email, $password) {
        // Query untuk mencari user berdasarkan email dan password
        $this->db->where('email', $email);
        $this->db->where('password', md5($password)); // Pastikan password di-enkripsi dengan md5
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            return $query->row();  // Mengembalikan user jika ditemukan
        } else {
            return false;  // Mengembalikan false jika tidak ada user yang cocok
        }
    }
    
    public function vote($user_id, $candidate_id) {
        // Tandai user sudah memilih
        $this->db->where('id', $user_id);
        $this->db->update('users', ['has_voted' => 1]);
    
        // Tambahkan suara ke kandidat
        $this->db->where('id', $candidate_id);
        $this->db->set('votes', 'votes+1', FALSE); // tambah 1 tanpa escape
        return $this->db->update('candidates');
    }
    
}
