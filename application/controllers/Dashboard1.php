<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard1 extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Cek apakah user sudah login dan role = admin
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = "Daftar User";
        $data['users'] = $this->Admin_model->get_users();
        $data['content'] = $this->load->view('dashboard1_view', $data, true);
        $this->load->view('layouts/main', $data);
    }
}