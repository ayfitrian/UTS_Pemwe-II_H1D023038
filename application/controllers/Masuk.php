<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {

    public function index() {
        $this->load->library('session');

        // Set data session sebagai admin
        $this->session->set_userdata([
            'user_id' => 1,
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        // Redirect ke dashboard admin
        redirect('dashboard/admin_dashboard');
    }
}
