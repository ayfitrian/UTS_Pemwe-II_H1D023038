<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Memuat session library
        $this->load->library('session');
        
        // Memuat form_validation library untuk validasi form
        $this->load->library('form_validation');
        
        // Memuat model User_model
        $this->load->model('User_model');
        
        // Memuat URL helper untuk redirect dan URL functions
        $this->load->helper('url');
    }

    public function register() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            
            if ($this->form_validation->run() == TRUE) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);  // Secure password hashing
    
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'role' => 'user',  // Role default untuk user biasa
                    'has_voted' => 0   // Status belum memilih
                ];
    
                if ($this->User_model->insert($data)) {
                    $this->session->set_flashdata('message', 'Registrasi berhasil! Silakan login.');
                    redirect('auth/login');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat registrasi.');
                    redirect('auth/register');
                }
            }
        }
        $this->load->view('register');
    }
    

    public function login() {
        // Jika sudah login, redirect ke dashboard yang sesuai
        if ($this->session->userdata('user_id')) {
            if ($this->session->userdata('role') == 'admin') {
                redirect('dashboard/admin_dashboard');  // Arahkan ke dashboard admin
            } else {
                redirect('dashboard/user_dashboard');  // Arahkan ke dashboard user
            }
        }
    
        // Validasi form login
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            // Ambil data email dan password dari form
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            // Verifikasi login dengan model User_model
            $user = $this->User_model->login($email, $password);
    
            if ($user) {
                // Set session jika login berhasil
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role
                ]);
    
                // Redirect ke admin dashboard jika role = admin
                if ($user->role == 'admin') {
                    redirect('dashboard/admin_dashboard');  // Arahkan ke dashboard admin
                } else {
                    redirect('dashboard/user_dashboard');  // Arahkan ke dashboard user
                }
            } else {
                // Jika login gagal, tampilkan pesan error
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('auth/login');
            }
        }
    }
    
    // Fungsi Logout User
    public function logout() {
        // Hapus session saat logout
        $this->session->sess_destroy();
        
        // Redirect ke halaman login setelah logout
        redirect('auth/login');
    }
}
