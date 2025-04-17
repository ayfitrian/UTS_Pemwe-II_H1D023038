<?
// Controller Admin.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek apakah admin sudah login
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        // Load model
        $this->load->model('Candidate_model');
        $this->load->model('Vote_model');
    }

    public function dashboard() {
        // Ambil statistik pemilihan
        $data['candidates'] = $this->Candidate_model->get_all_candidates();
        $data['vote_stats'] = $this->Vote_model->get_vote_stats(); // Mendapatkan statistik

        // Load view dashboard admin
        $this->load->view('admin_dashboard', $data);
    }
}
