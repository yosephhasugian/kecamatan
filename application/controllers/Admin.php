<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
        $this->load->model('Pegawai_model');
        $data['pimpinan'] = $this->Admin_model->get_pimpinan();
        $data['content'] = $this->load->view('admin/user_list', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function index_pengawas() {
        $data['title'] = "Daftar Pengawasa";
        $this->load->model('Pegawai_model');
        $data['pengawas'] = $this->Admin_model->get_pengawas();
        $data['content'] = $this->load->view('admin/pengawas_index', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function index_jabatan() {
        $data['title'] = "Daftar JAbatan";
        $this->load->model('Pegawai_model');
        $data['jabatan'] = $this->Admin_model->get_jabatan();
        $data['content'] = $this->load->view('admin/jabatan_index', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function tambah() {
        $data['title'] = "Tambah User";
        $this->load->model('Pegawai_model');
        $data['content'] = $this->load->view('admin/user_form', [], true);
        $this->load->view('layouts/main', $data);
    }

    public function tambah_pengawas() {
        $data['title'] = "Tambah User";
        $this->load->model('Pegawai_model');
        $data['content'] = $this->load->view('admin/pengawas_tambah', [], true);
        $this->load->view('layouts/main', $data);
    }

    public function tambah_jabatan() {
        $data['title'] = "Tambah Tambah Jabatan";
        $this->load->model('Pegawai_model');
        $data['content'] = $this->load->view('admin/jabatan_tambah', [], true);
        $this->load->view('layouts/main', $data);
    }

    

    public function simpan() {
        $this->form_validation->set_rules('nama_pimpinan', 'nama_pimpinan', 'required');
        $this->form_validation->set_rules('nip_pimpinan', 'Nip Pimpinan', 'required');
      
        

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama_pimpinan' => $this->input->post('nama_pimpinan'),
                'nip_pimpinan' => $this->input->post('nip_pimpinan'),
                'satuan' => $this->input->post('satuan'),
             
            ];
            $this->Admin_model->insert_user($data);
            redirect('admin');
        }
    }

    public function simpan_pengawas() {
        $this->form_validation->set_rules('nama_pengawas', 'nama_pengawas', 'required');
      
        

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama_pengawas' => $this->input->post('nama_pengawas'),
                'nip_pengawas' => $this->input->post('nip_pengawas'),
             
            ];
            $this->Admin_model->insert_pengawas($data);
            redirect('Admin/index_pengawas');
        }
    }

    public function simpan_jabatan() {
        $this->form_validation->set_rules('nama_jabatan', 'nama_jabatan', 'required');
      
        

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama_jabatan' => $this->input->post('nama_jabatan'),
             
            ];
            $this->Admin_model->insert_jabatan($data);
            redirect('Admin/index_jabatan');
        }
    }

    public function hapus($id) {
        $this->Admin_model->delete_user($id);
        redirect('admin');
    }

    public function hapus_pengawas($id) {
        $this->Admin_model->delete_pengawas($id);
        redirect('admin/index_pengawas');
    }

    public function hapus_jabatan($id) {
        $this->Admin_model->delete_jabatan($id);
        redirect('admin/index_jabatan');
    }

    public function edit($id) {
        $data['title'] = "Edit User";
        $this->load->model('Pegawai_model');
        $data['user'] = $this->Admin_model->get_pimpinan_by_id($id);
        
        if (!$data['user']) {
            show_404();
        }
    
        $data['content'] = $this->load->view('admin/user_edit', $data, true);
        $this->load->view('layouts/main', $data);
    }
    
    public function edit_pengawas($id) {
        $data['title'] = "Edit User";
        $this->load->model('Pegawai_model');
        $data['pengawas'] = $this->Admin_model->get_pengawas_by_id($id);
        
        if (!$data['pengawas']) {
            show_404();
        }
    
        $data['content'] = $this->load->view('admin/pengawas_edit', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('nama_pimpinan', 'Nama Pimpinana', 'required');
       
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama_pimpinan' => $this->input->post('nama_pimpinan'),
                'nip_pimpinan' => $this->input->post('nip_pimpinan'),
                'satuan' => $this->input->post('satuan'),
            ];
    
           
            $this->Admin_model->update_user($id, $data);
            redirect('admin');
        }
    }

    public function update_pengawas() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('nama_pengawas', 'Nama Pengawas', 'required');
       
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama_pengawas' => $this->input->post('nama_pengawas'),
                'nip_pengawas' => $this->input->post('nip_pengawas'),
            ];
    
           
            $this->Admin_model->update_pengawas($id, $data);
            redirect('admin/index_pengawas');
        }
    }
    
}
?>
