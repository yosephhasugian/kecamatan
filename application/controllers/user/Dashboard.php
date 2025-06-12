<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Dashboard_model'); // Pastikan model dimuat

        // Cek apakah user sudah login dan memiliki role user
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'user') {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        if (!$user_id) {
            redirect('auth/login'); // Redirect jika belum login
        }
        $this->load->model('Pegawai_model');
        // Ambil semua data kinerja user yang sedang login
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan($user_id);
        $data['title'] = "Dashboard User"; 

        // Load halaman utama dashboard user
        $data['content'] = $this->load->view('user/index', $data, TRUE);
        $this->load->view('layouts/main', $data);
    }

    

    public function lihat() {
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        if (!$user_id) {
            redirect('auth/login'); // Redirect jika belum login
        }
        $this->load->model('Pegawai_model');
       
        // Ambil data kinerja sesuai user yang login
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user($user_id);
        $data['title'] = "Lihat Kinerja";

        // Load view `dashboard_lihat` untuk user
        $data['content'] = $this->load->view('user/lihat', $data, TRUE);
        $this->load->view('layouts/main', $data);
    }

    public function password() {
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        if (!$user_id) {
            redirect('auth/login'); // Redirect jika belum login
        }
        $this->load->model('Pegawai_model');
       
        // Ambil data kinerja sesuai user yang login
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user($user_id);
        $data['title'] = "Lihat Kinerja";

        // Load view `dashboard_lihat` untuk user
        $data['content'] = $this->load->view('user/password', $data, TRUE);
        $this->load->view('layouts/main', $data);
    }

    public function hapus_kinerja($id)
{
    $this->load->model('Dashboard_model');

    $kinerja = $this->Dashboard_model->get_by_id($id);
    
    if ($kinerja) {
        // Hapus file foto jika ada
        if (!empty($kinerja->foto)) {
            $foto_path = FCPATH . 'uploads/kinerja/' . $kinerja->foto;
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }
        }

        // Hapus data dari database
        $this->Dashboard_model->delete($id);
        $this->session->set_flashdata('success', 'Data kinerja berhasil dihapus.');
    } else {
        $this->session->set_flashdata('error', 'Data tidak ditemukan.');
    }

    redirect('user/Dashboard');
}

    public function dash() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('auth/login');
        }
    
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user($user_id);
        $data['title'] = "Dashboard User"; // Perbaiki judul
        $data['content'] = $this->load->view('user/dashboard', $data, TRUE);
        $this->load->view('layouts/main', $data);
    }

    public function get_kinerja_by_date() {
        $start = $this->input->get("start");
        $end = $this->input->get("end");
        $user_id = $this->session->userdata("user_id");
    
        if (!$user_id) {
            echo json_encode([]);
            return;
        }
    
        // Query untuk mengambil jumlah kegiatan per tanggal dan status validasi
        $this->db->select("tanggal, COUNT(*) as jumlah_kegiatan, 
                            CASE 
                                WHEN SUM(CASE WHEN status = 'Ditolak' THEN 1 ELSE 0 END) > 0 THEN 'Ditolak'
                                WHEN SUM(CASE WHEN status = 'Disetujui' THEN 1 ELSE 0 END) > 0 THEN 'Disetujui'
                                ELSE 'Belum Validasi'
                            END as status_priority");
        $this->db->from("kinerja");
        $this->db->where("tanggal >=", $start);
        $this->db->where("tanggal <=", $end);
        $this->db->where("user_id", $user_id);
        $this->db->group_by("tanggal");
        $query = $this->db->get();
    
        $data = [];
        foreach ($query->result() as $row) {
            // Default warna kuning untuk "Belum Validasi"
            $className = "fc-event-unvalidated"; 
    
            if ($row->status_priority == "Ditolak") { 
                $className = "fc-event-rejected"; 
            } elseif ($row->status_priority == "Disetujui") { 
                $className = "fc-event-validated"; 
            } 
    
            $data[] = [
                "title" => $row->jumlah_kegiatan . " Kegiatan",
                "start" => $row->tanggal,
                "className" => $className
            ];
        }
    
        echo json_encode($data);
    }
    
    
    public function simpan_kinerja() {
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        $this->form_validation->set_rules('kinerja', 'Kinerja', 'required');
    
        // Cek apakah foto diunggah
        if (empty($_FILES['foto']['name'])) {
            echo json_encode(["status" => "error", "message" => "Foto wajib diunggah!"]);
            return;
        }
    
        // Cek ukuran file
        if ($_FILES['foto']['size'] > 5120000) { // 5MB
            echo json_encode(["status" => "error", "message" => "File terlalu besar! Maksimal 5MB."]);
            return;
        }
    
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(["status" => "error", "message" => validation_errors()]);
            return;
        }
    
        // **1. Cek Durasi Waktu**
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $startTime = strtotime($jam_mulai);
        $endTime = strtotime($jam_selesai);
        $durasi = ($endTime - $startTime) / 3600; // Durasi dalam jam (perbedaan dalam detik dibagi 3600 untuk jam)
    
        // Cek apakah durasi lebih dari 8 dan kurang dari 10 jam
       
    
        // **2. PROSES UPLOAD GAMBAR**
        $foto = NULL;
        if (!empty($_FILES['foto']['name'])) { // Cek apakah ada file diunggah
            $config['upload_path']   = './uploads/kinerja/'; // Folder penyimpanan
            $config['allowed_types']        = 'jpg|jpeg|png|gif|bmp|tiff|svg|webp|pdf';
            $config['max_size']      = 40960; // Maksimal 2MB
            $config['file_name']     = time() . "_" . $_FILES['foto']['name']; // Nama file unik
    
            $this->load->library('upload', $config); // Load library upload
    
            if ($this->upload->do_upload('foto')) {
                $foto = $this->upload->data('file_name'); // Ambil nama file
            } else {
                echo json_encode(["status" => "error", "message" => $this->upload->display_errors()]);
                return;
            }
        }
    
        // **3. SIMPAN DATA KE DATABASE**
        $data = [
            'tanggal'    => $this->input->post('tanggal'),
            'jam_mulai'  => $this->input->post('jam_mulai'),
            'jam_selesai'=> $this->input->post('jam_selesai'),
            'kinerja'    => $this->input->post('kinerja'),
            'user_id'    => $this->session->userdata("user_id"),
            'status'     => "Belum Validasi",
            'foto'       => $foto // Simpan nama file ke database
        ];
    
        log_message('debug', 'Data yang akan disimpan: ' . json_encode($data));
    
        if ($this->Dashboard_model->insert_kinerja($data)) {
            log_message('debug', 'Data berhasil disimpan.');
            echo json_encode(["status" => "success"]);
        } else {
            log_message('error', 'Gagal menyimpan data.');
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan data."]);
        }
    }

    

    public function get_kinerja_status() {
        $user_id = $this->session->userdata('user_id'); // Pastikan hanya data user tertentu
        if (!$user_id) {
            echo json_encode(["error" => "User tidak ditemukan"]);
            return;
        }
    
        // Ambil bulan dan tahun sekarang
        $current_month = date('m'); // Bulan saat ini
        $current_year = date('Y');  // Tahun saat ini
    
        // Tentukan bulan dan tahun untuk bulan sebelumnya
        $previous_month = $current_month - 1;
        if ($previous_month == 0) {  // Jika bulan saat ini adalah Januari (bulan 1), maka bulan sebelumnya adalah Desember tahun sebelumnya
            $previous_month = 12;
            $previous_year = $current_year - 1;
        } else {
            $previous_year = $current_year;
        }
    
        // Hitung total aktivitas berdasarkan user_id dan bulan/tahun sebelumnya
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(tanggal)', $previous_month); // Filter berdasarkan bulan
        $this->db->where('YEAR(tanggal)', $previous_year);  // Filter berdasarkan tahun
        $total_aktivitas = $this->db->count_all_results('kinerja');
    
        // Hitung total waktu kerja user untuk bulan sebelumnya (dalam menit)
        $this->db->select("SUM(TIMESTAMPDIFF(MINUTE, jam_mulai, jam_selesai)) as total_waktu");
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(tanggal)', $previous_month); // Filter berdasarkan bulan
        $this->db->where('YEAR(tanggal)', $previous_year);  // Filter berdasarkan tahun
        $query = $this->db->get("kinerja")->row();
        $total_waktu_menit = $query->total_waktu ?? 0; // Default ke 0 jika tidak ada data
    
        // Konversi total waktu kerja dari menit ke jam
        $total_waktu_jam = round($total_waktu_menit / 60, 2); // Pembulatan 2 desimal
    
        // Hitung status kinerja (Belum Validasi, Disetujui, Ditolak) di bulan sebelumnya
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->where('user_id', $user_id);
        $this->db->where('MONTH(tanggal)', $previous_month);
        $this->db->where('YEAR(tanggal)', $previous_year);
        $this->db->group_by('status');
        $query = $this->db->get('kinerja');
        $status_counts = $query->result_array();
    
        // Memasukkan status counts ke dalam array hasil
        $status_data = [];
        foreach ($status_counts as $status_count) {
            $status_data[] = [
                'status' => $status_count['status'],
                'jumlah' => (int) $status_count['jumlah']
            ];
        }
    
        // Gabungkan semua data ke dalam respons
        $response = array_merge([
            "total_aktivitas" => $total_aktivitas,
            "total_waktu_jam" => $total_waktu_jam
        ], $status_data);
    
        echo json_encode($response);
    }


public function laporan() {
    $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
    if (!$user_id) {
        redirect('auth/login'); // Redirect jika belum login
    }

    // Load model
    $this->load->model('User_model');
    $this->load->model('Pegawai_model');

    // Ambil data pegawai berdasarkan user_id
    $data['user'] = $this->User_model->getUserById($user_id);

    // Cek apakah data user ditemukan
            if (empty($data['user'])) {
                show_error('Data user tidak ditemukan!', 404);
            }
        // Ambil input tanggal dari GET
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_selesai = $this->input->get('tanggal_selesai');

        // Jika tanggal tidak diisi, set default ke bulan ini
        if (!$tanggal_mulai || !$tanggal_selesai) {
            $tanggal_mulai = date('Y-m-01'); // Awal bulan ini
            $tanggal_selesai = date('Y-m-t'); // Akhir bulan ini
        }


    
    // Ambil data kinerja sesuai user yang login dan filter tanggal
    $data['kinerja_data'] = $this->User_model->get_laporan_by_user($user_id, $tanggal_mulai, $tanggal_selesai);

    // Set periode laporan
    $data['periode'] = date('d-m-Y', strtotime($tanggal_mulai)) . " s/d " . date('d-m-Y', strtotime($tanggal_selesai));

    // Set judul halaman
    $data['title'] = "Laporan Kinerja";

    $data['content'] = $this->load->view('user/laporan', $data, TRUE);
    $this->load->view('layouts/main', $data);
}




public function update_kinerja()
{
    $id = $this->input->post('id');
    $tanggal = $this->input->post('tanggal');
    $jam_mulai = $this->input->post('jam_mulai');
    $jam_selesai = $this->input->post('jam_selesai');
    $kinerja = $this->input->post('kinerja');

    // Ambil data lama (khusus foto)
    $kinerja_lama = $this->db->get_where('kinerja', ['id' => $id])->row();
    $foto_lama = $kinerja_lama ? $kinerja_lama->foto : '';

    $data = array(
        'tanggal'    => $tanggal,
        'jam_mulai'  => $jam_mulai,
        'jam_selesai'=> $jam_selesai,
        'kinerja'    => $kinerja,
        'user_id'    => $this->session->userdata('user_id'),
        'status'     => "Belum Validasi"
    );

    // Upload foto jika ada
    if (!empty($_FILES['foto']['name'])) {
        $config['upload_path']   = './uploads/kinerja/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $upload_data    = $this->upload->data();
            $data['foto']   = $upload_data['file_name'];

            // Hapus file lama kalau perlu (opsional)
            if (!empty($foto_lama) && file_exists('./uploads/kinerja/' . $foto_lama)) {
                unlink('./uploads/kinerja/' . $foto_lama);
            }
        } else {
            // Kalau upload gagal, tetap pakai foto lama
            $data['foto'] = $foto_lama;
        }
    } else {
        // Tidak ada file baru, pakai foto lama
        $data['foto'] = $foto_lama;
    }

    $this->db->where('id', $id);
    $this->db->update('kinerja', $data);

    redirect('user/Dashboard/lihat');
}

public function print_laporan() {
    $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
    if (!$user_id) {
        redirect('auth/login'); // Redirect kalau belum login
    }

    $this->load->model('Dashboard_model');

    // Ambil data user
    $data['user'] = $this->Dashboard_model->getUserById($user_id);

    // Ambil filter tanggal dari GET
    $tanggal_mulai = $this->input->get('tanggal_mulai');
    $tanggal_selesai = $this->input->get('tanggal_selesai');

    if ($tanggal_mulai && $tanggal_selesai) {
        // Kalau ada filter tanggal
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user_and_date($user_id, $tanggal_mulai, $tanggal_selesai);
        $data['periode'] = date('d-m-Y', strtotime($tanggal_mulai)) . " s/d " . date('d-m-Y', strtotime($tanggal_selesai));
    } else {
        // Kalau tidak ada filter tanggal
        $data['kinerja_data'] = $this->Dashboard_model->get_laporan_by_user($user_id);
        $data['periode'] = "Semua Data";
    }

    $data['title'] = "Laporan Kinerja";

    $this->load->view('user/print_laporan', $data);
}

public function getuser()
{
    $this->load->model('Dashboard_model');

    $user = $this->session->userdata("username");
    $old = $this->input->post('oldpass');
    $new = $this->input->post('newpass');
    $renew = $this->input->post('repass');

    // Validasi input tidak boleh kosong
    if (empty($old) || empty($new) || empty($renew)) {
        $this->session->set_flashdata('error', 'Semua kolom harus diisi!');
        redirect('user/Dashboard/password');
    }

    // Cek password lama di database
    $userData = $this->Dashboard_model->cekUser($user);

    if ($userData->num_rows() == 1) {
        $userRow = $userData->row();
        
        if (password_verify($old, $userRow->password)) { // Bandingkan password lama
            // Cek apakah password baru sama dengan re-password
            if ($new === $renew) {
                // Enkripsi password baru sebelum disimpan
                $hashPass = password_hash($new, PASSWORD_DEFAULT);

                // Update password di database
                $update = $this->Dashboard_model->updatePassword($user, $hashPass);
                
                if ($update) {
                    $this->session->set_flashdata('success', 'Password berhasil diperbarui!');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui password.');
                }
            } else {
                $this->session->set_flashdata('error', 'Password baru tidak cocok dengan re-password!');
            }
        } else {
            $this->session->set_flashdata('error', 'Password lama salah!');
        }
    } else {
        $this->session->set_flashdata('error', 'User tidak ditemukan!');
    }

    redirect('user/Dashboard/password');
}


}

