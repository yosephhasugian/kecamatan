<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model'); // Pastikan model dimuat

        // Cek apakah user sudah login dan memiliki role user
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'pengawas') {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        if (!$user_id) {
            redirect('auth/login'); // Redirect jika belum login
        }

        // Ambil semua data kinerja user yang sedang login
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan($user_id);
        $data['title'] = "Dashboard User"; 

        // Load halaman utama dashboard user
        $data['content'] = $this->load->view('pengawas', $data, TRUE);
        $this->load->view('layouts/main', $data);
    }

public function lihat()
{
    $this->load->model('Dashboard_model'); 

    // Ambil user_id dari session
    $user_id = $this->session->userdata('user_id');
    if (!$user_id) {
        show_error('User tidak ditemukan atau tidak login!', 403);
    }

    // Ambil data laporan hanya untuk user yang sedang login
    $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user($user_id);

    // Load view dengan data yang sesuai
    $data['content'] = $this->load->view('user/dashboard_lihat', $data, TRUE);
    $this->load->view('layouts/main', $data);
}
public function proses_validasi($id)
{
    $this->load->model('Dashboard_model'); // Pastikan model dimuat

    // Ambil status yang dipilih dari form
    $status = $this->input->post('status');

    // Update status di database
    $this->Dashboard_model->update_status($id, $status);

    // Redirect kembali ke halaman validasi
    redirect('Dashboard/validasi');
}

public function validasi()
{
    $this->load->model('User_kinerja'); // Pastikan model dimuat
   
    // Ambil data laporan kinerja
    $data['kinerja_data'] = $this->User_kinerja->get_laporan();

    
    // Load view dengan data lengkap
   

    $data['content'] = $this->load->view('pengawas/validasi', $data, TRUE);
    $this->load->view('layouts/main', $data);
}
    
}

