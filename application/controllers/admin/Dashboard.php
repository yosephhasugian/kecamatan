<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model'); // Pastikan model dimuat

        // Cek apakah user sudah login dan memiliki role user
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function index() {
        $$this->load->view('admin/dashboard');
    }

    public function pegawai() {
        $this->load->view('admin/pegawai_index');
    }

    public function lihat() {
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        if (!$user_id) {
            redirect('auth/login'); // Redirect jika belum login
        }

        // Ambil data kinerja sesuai user yang login
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user($user_id);
        $data['title'] = "Lihat Kinerja";

        // Load view `dashboard_lihat` untuk user
        $data['content'] = $this->load->view('user/lihat', $data, TRUE);
        $this->load->view('layouts/main', $data);
    }
   

}
