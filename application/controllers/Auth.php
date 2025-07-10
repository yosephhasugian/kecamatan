<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');

    }
    public function index()
    {
        $this->login();
   }

    public function login() {
        $this->load->view('login_view');
    }

    public function do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->User_model->get_user($username);
    
        if ($user && password_verify($password, $user['password'])) {
            $this->session->set_userdata([
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'nama' => $user['nama'],
                'jabatan' => $user['jabatan'],
                'role' => $user['role']
            ]);
    
            
    
            switch ($user['role']) {
                case 'admin': redirect(base_url('admin/index')); break;
                case 'pimpinan': redirect(base_url('pimpinan/index')); break;
                case 'pengawas': redirect(base_url('pengawas/index')); break;
                default: redirect(base_url('user/dashboard'));
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth/login');
        }
    }
    

public function logout() {
    $this->session->unset_userdata(['username', 'role', 'user_id']);
    $this->session->sess_destroy();
    redirect('auth/login'); // Redirect setelah logout
}

}