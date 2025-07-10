<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengawas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pengawas_model');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Cek apakah user sudah login dan role = admin
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'pengawas') {
            redirect('auth/login');
        }
    }

    public function index() {
    $data['title'] = "Validasi Kinerja Petugas";
    $this->load->model('Pegawai_model'); // Pastikan ini di-load jika digunakan di tempat lain
    $this->load->model('Pengawas_model'); // Pastikan model Pengawas_model di-load
    $this->load->model('User_model');     // Pastikan model User_model di-load

    // Ambil nama pengawas dari session
    $nama_pengawas = $this->session->userdata('nama');
    if (!$nama_pengawas) {
        $nama_pengawas = $this->User_model->get_nama_by_user_id($this->session->userdata('user_id'));
        $this->session->set_userdata('nama', $nama_pengawas);
    }

    // Ambil pegawai yang sesuai dengan pengawas yang login
    // Pastikan metode get_users_only ini mengembalikan daftar pengguna yang diawasi oleh pengawas yang sedang login
    $data['users'] = $this->Pengawas_model->get_users_only($nama_pengawas);

    // Ambil user_id dari parameter GET
    $user_id = $this->input->get('user_id_pegawai');
    $month = date('m');
    $year = date('Y');

    // Inisialisasi kinerja_data sebagai array kosong untuk menghindari error jika tidak ada data
    $data['kinerja_data'] = [];

    // Jika ada user_id yang dipilih dari dropdown, ambil data kinerjanya
    if ($user_id) {
        $data['kinerja_data'] = $this->Pengawas_model->get_kinerja_by_user_id($user_id);

        // Logika untuk menyaring user jika semua kinerja mereka sudah divalidasi
        // Ini mungkin tidak relevan untuk tampilan awal datatabel,
        // tapi penting jika Anda ingin menghapus user dari dropdown setelah selesai validasi
        $total_kinerja = $this->Pengawas_model->count_kinerja_by_user_id_and_month($user_id, $month, $year);
        $validated_kinerja = $this->Pengawas_model->count_validated_kinerja_by_user_id_and_month($user_id, $month, $year);

        if ($total_kinerja > 0 && $total_kinerja == $validated_kinerja) {
            // Ini akan menghapus user yang saat ini dipilih dari dropdown.
            // Pastikan ini adalah perilaku yang Anda inginkan.
            // Jika Anda hanya ingin menampilkannya di bagian ringkasan "Selesai",
            // Anda bisa menghapus blok kode ini.
            $data['users'] = array_filter($data['users'], function ($user) use ($user_id) {
                return $user['user_id'] != $user_id;
            });
        }
    } else {
        // Jika tidak ada user_id yang dipilih, apa yang harus ditampilkan di datatabel?
        // Opsi 1: Tampilkan semua kinerja dari semua pegawai yang diawasi (jika memungkinkan)
        // Ini mungkin akan memuat banyak data.
        // $all_supervised_user_ids = array_column($data['users'], 'user_id');
        // if (!empty($all_supervised_user_ids)) {
        //     $data['kinerja_data'] = $this->Pengawas_model->get_kinerja_by_user_ids($all_supervised_user_ids);
        // }

        // Opsi 2 (yang Anda lakukan sekarang): Biarkan kinerja_data kosong
        // Ini akan menyebabkan datatabel kosong sampai ada user yang dipilih.
        // Ini adalah perilaku yang Anda lihat.
        $data['kinerja_data'] = [];
    }

    // Jika Anda ingin data tabel tetap terisi saat halaman pertama kali diakses
    // atau ketika tidak ada user_id yang dipilih secara spesifik,
    // Anda perlu mengisi $data['kinerja_data'] di sini dengan data default.
    // Contoh: ambil kinerja_data dari user pertama yang diawasi, atau semua kinerja yang belum divalidasi
    // dari semua user yang diawasi.
    if (empty($user_id) && !empty($data['users'])) {
        // Ambil kinerja dari user pertama di daftar 'users' secara default
        // Jika Anda ingin tampilan default yang berisi data, ini adalah cara yang baik.
        $default_user_id = $data['users'][0]['user_id'];
        $data['kinerja_data'] = $this->Pengawas_model->get_kinerja_by_user_id($default_user_id);
        // Anda mungkin juga ingin mengatur $user_id agar dropdown-nya otomatis terpilih
        $user_id = $default_user_id; // Ini akan memastikan dropdown terpilih pada pemuatan awal
    }


    // Variabel untuk menyimpan user_id yang sedang dipilih, untuk me-repopulate dropdown
    // Ini harus selalu ada, baik dari GET maupun dari nilai default
    $data['selected_user_id_for_dropdown'] = $user_id;

    $data['content'] = $this->load->view('pengawas/validasi', $data, true);
    $this->load->view('layouts/main', $data);
}

    public function validasi() {
        $this->load->model('Pegawai_model');
        $data['title'] = "Validasi Kinerja Petugas";
        $nama_pengawas = $this->session->userdata('nama');

        if (!$nama_pengawas) {
            $user_id = $this->session->userdata('user_id');
            $nama_pengawas = $this->Pengawas_model->get_nama_pengawas_by_user_id($user_id);
            $this->session->set_userdata('nama', $nama_pengawas);
        }

                
        $user_id = $this->input->post('user_id_pegawai');
        $month = date('m');
        $year = date('Y');

        if ($user_id) {
            $data['kinerja_data'] = $this->Pengawas_model->get_kinerja_by_user_id($user_id);
            $total_kinerja = $this->Pengawas_model->count_kinerja_by_user_id_and_month($user_id, $month, $year);
            $validated_kinerja = $this->Pengawas_model->count_validated_kinerja_by_user_id_and_month($user_id, $month, $year);

            if ($total_kinerja == $validated_kinerja) {
                $data['users'] = array_filter($data['users'], function ($user) use ($user_id) {
                    return $user['user_id'] != $user_id;
                });
            }
        } else {
            $data['kinerja_data'] = [];
        }

        $data['content'] = $this->load->view('pengawas/validasi', $data, true);
        $this->load->view('layouts/main', $data);
    }

    // Fungsi proses_validasi ...


    public function proses_validasi($id) {
        // Cek apakah request menggunakan metode POST
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
            return;
        }
    
        // Ambil data yang dikirimkan dari AJAX
        $status = $this->input->post('status');
        $user_id_pegawai = $this->input->post('user_id_pegawai');
    
        // Cek apakah status valid
        if (!$status || !in_array($status, ['Disetujui', 'Ditolak'])) {
            echo json_encode(["status" => "error", "message" => "Status tidak valid"]);
            return;
        }
    
        // Debugging: Log semua data yang dikirimkan
        log_message('debug', 'Validasi kinerja ID: ' . $id . ' Status: ' . $status);
    
        // Update database
        $this->db->where('id', $id);
        $update = $this->db->update('kinerja', ['status' => $status]);
    
        // Debugging: Cek apakah update berhasil
        if (!$update) {
            log_message('error', 'Gagal update kinerja ID: ' . $id);
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui database"]);
            return;
        }
    
        // Jika sukses, kirim respons JSON ke AJAX
        echo json_encode(["status" => "success", "message" => "Validasi berhasil", "updated_status" => $status]);
    }
      
    public function dashboard() {
        $data['title'] = "Validasi Kinerja Petugas";
        
        $data['kinerja_data'] = $this->Pengawas_model->get_laporan();
        $this->load->model('Pegawai_model');
        $this->load->model('Pengawas_model');
        $data['periode'] = date('F Y'); // Periode saat ini (Bulan Tahun)
       // Ambil bulan & tahun dari form (GET)
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        // Format periode untuk ditampilkan
        $periode = "";
        if (!empty($bulan) && !empty($tahun)) {
            $periode = date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun));
        }
        $data['rekap'] = $this->Pengawas_model->get_rekap_kinerja($bulan, $tahun);

        

        $data['content'] = $this->load->view('pengawas/dashboard', $data, true);
        $this->load->view('layouts/main', $data);
    }
    
    public function detail_kinerja($user_id) {
        $this->load->model('Pengawas_model');
        $this->load->model('Pegawai_model');
        $data['title'] = "Detail Kinerja Petugas";
        $data['kinerja_data'] = $this->Pengawas_model->get_kinerja_by_user_id($user_id);
    

        $data['content'] = $this->load->view('pengawas/tampil', $data, true);
        $this->load->view('layouts/main', $data);
    }
    
}
?>