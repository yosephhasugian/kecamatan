<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Pegawai extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Cek apakah user sudah login dan role = admin
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = "Daftar User";
        $data['pegawai'] = $this->Pegawai_model->get_all_pegawai();
        $data['jabatan'] = $this->Pegawai_model->get_all_jabatan();
        $data['pengawas'] = $this->Pegawai_model->get_all_pengawas();
        $data['pimpinan'] = $this->Pegawai_model->get_all_pimpinan();
        
        $data['content'] = $this->load->view('admin/pegawai_index', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function tambah() {
        $data['title'] = "Tambah Pegawai";
        $this->load->model('Pegawai_model');
        $data['jabatan'] = $this->Pegawai_model->get_all_jabatan();
        $data['pengawas'] = $this->Pegawai_model->get_all_pengawas();
        $data['pimpinan'] = $this->Pegawai_model->get_all_pimpinan();

    
        $data['content'] = $this->load->view('admin/pegawai_tambah', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function simpan() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('id_pjlp', 'ID PJLP', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('pengawas', 'Pengawas', 'required');
        $this->form_validation->set_rules('pimpinan', 'Pimpinan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'id_pjlp' => $this->input->post('id_pjlp'),
                'jabatan' => $this->input->post('jabatan'),
                'id_pengawas' => $this->input->post('pengawas'),
                'pimpinan' => $this->input->post('pimpinan'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];
            
            $this->Pegawai_model->insert_pegawai($data);
            redirect('pegawai');
        }
    }

    public function hapus($id) {
        $this->Pegawai_model->delete_pegawai($id);
        redirect('pegawai');
    }

    public function edit($id) {
        $data['title'] = "Edit Pegawai";
        $data['pegawai'] = $this->Pegawai_model->get_pegawai_by_id($id);
        
        $data['jabatan'] = $this->Pegawai_model->get_all_jabatan();
        $data['pengawas'] = $this->Pegawai_model->get_all_pengawas();
        $data['pimpinan'] = $this->Pegawai_model->get_all_pimpinan();
        
        if (!$data['pegawai']) {
            show_404();
        }
    
        $data['content'] = $this->load->view('admin/pegawai_edit', $data, true);
        $this->load->view('layouts/main', $data);
    }
    
    public function update($id) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('id_pjlp', 'ID PJLP', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('pengawas', 'Pengawas', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'id_pjlp' => $this->input->post('id_pjlp'),
                'jabatan' => $this->input->post('jabatan'),
                'id_pengawas' => $this->input->post('pengawas'),
                'pimpinan' => $this->input->post('pimpinan'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role'),
            ];
    
            if (!empty($this->input->post('password'))) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
    
            $this->Pegawai_model->update_pegawai($id, $data);
            redirect('pegawai');
        }
    }
    
}
?>
