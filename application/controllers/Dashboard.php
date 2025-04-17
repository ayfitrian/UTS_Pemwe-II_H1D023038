<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Pastikan pengguna sudah login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        // Memuat model Candidate_model, Vote_model, dan User_model
        $this->load->model('Candidate_model');
        $this->load->model('Vote_model');
        $this->load->model('User_model');  // Menambahkan User_model di sini
        $this->load->helper('url');  // Memuat helper URL
        $this->load->library('form_validation');  // Memuat library form_validation
    }

    // Fungsi untuk halaman Dashboard Admin
    public function index() {
        // Cek role user
        if ($this->session->userdata('role') == 'admin') {
            // Ambil data kandidat
            $data['candidates'] = $this->Candidate_model->get_all_candidates();
            
            // Mengambil statistik pemilihan
            $data['vote_stats'] = $this->Vote_model->get_vote_stats();

            // Menyediakan data untuk grafik statistik
            $data['chart_data'] = json_encode($data['vote_stats']);

            // Memuat tampilan dashboard admin
            $this->load->view('admin_dashboard', $data);
        } else {
            // Redirect ke dashboard user jika bukan admin
            redirect('dashboard/user_dashboard');
        }
    }

    // Fungsi untuk halaman Dashboard User
    public function user_dashboard() {
        // Cek apakah user sudah login
        if (!$this->session->userdata('user_id') || $this->session->userdata('role') != 'user') {
            redirect('auth/login');
        }
    
        // Ambil kandidat
        $this->load->model('Candidate_model');
        $data['candidates'] = $this->Candidate_model->get_all_candidates();
    
        // Load halaman dashboard user
        $this->load->view('user_dashboard', $data);
    }
    
    
    
    // Fungsi untuk menampilkan statistik pemilihan
    public function vote_candidate() {
        $user_id = $this->session->userdata('user_id');
        $candidate_id = $this->input->post('candidate_id');
    
        // Cek apakah user sudah memilih
        if ($this->User_model->has_voted($user_id)) {
            $this->session->set_flashdata('error', 'Anda sudah memilih kandidat!');
            redirect('dashboard/user_dashboard');
        }
    
        // Simpan vote ke database
        $this->User_model->vote($user_id, $candidate_id);
    
        // Update status user sudah memilih
        $this->User_model->update_vote_status($user_id);
    
        $this->session->set_flashdata('message', 'Pemilihan berhasil!');
        redirect('dashboard/vote_stats');
    }
    // Fungsi untuk halaman tambah kandidat
    public function add_candidate() {
        // Aturan validasi
        $this->form_validation->set_rules('name', 'Nama Kandidat', 'required');
        $this->form_validation->set_rules('visi', 'Visi', 'required');
        $this->form_validation->set_rules('misi', 'Misi', 'required');

        // Cek apakah form valid
        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form tambah kandidat
            $this->load->view('admin_add_candidate');
        } else {
            // Jika validasi berhasil, proses penyimpanan data ke database
            $candidate_data = [
                'name' => $this->input->post('name'),
                'visi' => $this->input->post('visi'),
                'misi' => $this->input->post('misi')
            ];

            // Memanggil model untuk menyimpan data kandidat
            $this->Candidate_model->add_candidate($candidate_data);

            // Set pesan flash data untuk feedback
            $this->session->set_flashdata('message', 'Kandidat berhasil ditambahkan.');

            // Redirect ke halaman daftar kandidat setelah berhasil
            redirect('dashboard');
        }
    }

    // Fungsi untuk halaman edit kandidat
    public function edit_candidate($id) {
        if ($this->session->userdata('role') == 'admin') {
            // Ambil data kandidat
            $data['candidate'] = $this->Candidate_model->get_candidate_by_id($id);

            // Validasi form
            $this->form_validation->set_rules('name', 'Nama Kandidat', 'required');
            $this->form_validation->set_rules('visi', 'Visi', 'required');
            $this->form_validation->set_rules('misi', 'Misi', 'required');

            if ($this->form_validation->run() == TRUE) {
                $update_data = [
                    'name' => $this->input->post('name'),
                    'visi' => $this->input->post('visi'),
                    'misi' => $this->input->post('misi')
                ];
                $this->Candidate_model->update_candidate($id, $update_data);
                redirect('dashboard');
            }

            // Menampilkan form edit kandidat
            $this->load->view('admin_edit_candidate', $data);
        } else {
            redirect('dashboard/user_dashboard');
        }
    }

    // Fungsi untuk menghapus kandidat
    public function delete_candidate($id) {
        if ($this->session->userdata('role') == 'admin') {
            $this->Candidate_model->delete_candidate($id);
            $this->session->set_flashdata('message', 'Kandidat berhasil dihapus!');
            redirect('dashboard');
        } else {
            redirect('dashboard/user_dashboard');
        }
    }

    public function vote_stats() {
        $this->load->model('Candidate_model');
        $data['candidates'] = $this->Candidate_model->get_all_candidates();
    
        $this->load->view('vote_stats', $data);  // pastikan file vote_stats.php ada di /application/views/
    }
    
    public function admin_dashboard() {
        // Pastikan hanya admin yang bisa akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        $this->load->view('admin_dashboard');
    }

    public function user_dashboard() {
        // Pastikan hanya user biasa yang bisa akses
        if ($this->session->userdata('role') !== 'user') {
            redirect('auth/login');
        }

        $this->load->view('dashboard');
    }

}
