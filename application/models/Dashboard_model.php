<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data kinerja
    public function get_all_kinerja() {
        return $this->db->get('kinerja')->result_array();
    }
public function get_kinerja() {
    return $this->db->get('kinerja')->result(); // Mengembalikan objek
}

public function getUserById($user_id) {
    $this->db->select('
        p.user_id, 
        p.nama, 
        p.id_pjlp, 
        p.jabatan, 
        pengawas.nama_pengawas, 
        pengawas.nip_pengawas, 
        pimpinan.nama_pimpinan, 
        pimpinan.nip_pimpinan,
         pimpinan.satuan
    ');
    $this->db->from('pegawai p');
    $this->db->join('pengawas', 'pengawas.id = p.id_pengawas', 'left');
    $this->db->join('pimpinan', 'pimpinan.id = p.pimpinan', 'left');
    $this->db->where('p.user_id', $user_id);

    $query = $this->db->get();
    return $query->row_array(); // Mengembalikan satu baris data sebagai array asosiatif
}

     // Ambil data kinerja berdasarkan username
     public function get_kinerja_by_user($user_id, $start, $end)
{
    $sql = "SELECT id, tanggal, jam_mulai, jam_selesai, kinerja, status 
            FROM kinerja 
            WHERE user_id = ? 
            AND tanggal BETWEEN ? AND ?";
    
    return $this->db->query($sql, [$user_id, $start, $end])->result();
}

public function count_kinerja_status($user_id)
{
    $sql = "SELECT status, COUNT(*) as jumlah 
            FROM kinerja 
            WHERE user_id = ? 
            GROUP BY status";
    return $this->db->query($sql, [$user_id])->result_array();
}


    //menghitung jumlah kegiatan per hari
    public function get_kinerja_count_per_day() {
        $this->db->select('tanggal, COUNT(*) as jumlah');
        $this->db->from('kinerja');
        $this->db->group_by('tanggal');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_kinerja($data) {
        $this->db->insert('kinerja', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            log_message('error', 'Gagal menyimpan data kinerja. Query: ' . $this->db->last_query());
            return false;
        }
    }
    

    // Ambil jumlah data per tanggal untuk kalender
    public function get_kinerja_grouped_by_date() {
        $this->db->select('tanggal, COUNT(*) as total');
        $this->db->group_by('tanggal');
        return $this->db->get('kinerja')->result_array();
    }

    // Hitung status kinerja
    public function get_laporan_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('tanggal', 'ASC'); // Urutkan berdasarkan tanggal
        return $this->db->get('kinerja')->result();
    }
    
    public function get_laporan()
    {
    $query = $this->db->get('kinerja');
    return $query->result(); // Mengembalikan hasil query ke controller
}

// Fungsi untuk menyimpan data petugas ke database
public function simpan_petugas($data) {
    return $this->db->insert('users', $data);
}

// Fungsi untuk menampilkan semua data petugas dari database
public function get_all_petugas() {
    $this->db->select('*');
    $this->db->from('users'); // Ganti dengan nama tabel yang benar
    $query = $this->db->get();
    return $query->result_array(); // Pastikan mengembalikan array
}

   // 🔹 Menghapus Data Petugas
   public function delete_petugas($id) {
    $this->db->where('id', $id);
    return $this->db->delete('users');
}

public function delete($id)
{
    $this->db->delete('kinerja', ['id' => $id]);
}

public function get_by_id($id)
{
    return $this->db->get_where('kinerja', ['id' => $id])->row();
}

public function getRekapKinerja()
{
    $this->db->select('u.nama, u.jabatan,u.pengawas,
        COUNT(DISTINCT CASE WHEN k.status IN ("Disetujui", "Ditolak", "Belum Validasi") THEN k.tanggal END) AS jumlah_hari, 
        COUNT(DISTINCT CASE WHEN k.status = "Disetujui" THEN k.tanggal END) AS sudah_validasi,
        COUNT(DISTINCT CASE WHEN k.status = "Belum Validasi" THEN k.tanggal END) AS belum_validasi,
        COUNT(DISTINCT CASE WHEN k.status = "Ditolak" THEN k.tanggal END) AS ditolak
    ');
    $this->db->from('kinerja k'); // Alias 'k' untuk tabel kinerja
    $this->db->join('users u', 'u.user_id = k.user_id', 'left'); // Alias 'u' untuk tabel users
    $this->db->group_by('k.user_id'); // Gunakan 'k.user_id'

    return $this->db->get()->result();
}


public function cekUser($user)
{
    $this->db->select('password');
    $this->db->where('username', $user);
    return $this->db->get('pegawai');
}

public function updatePassword($user, $newPassword)
{
    $this->db->set('password', $newPassword);
    $this->db->where('username', $user);
    return $this->db->update('pegawai');
}



}