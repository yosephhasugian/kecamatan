<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan_model extends CI_Model {
    public function get_pegawai() {
        return $this->db->get('pegawai')->result_array();
    }

    public function get_laporan()
    {
    $query = $this->db->get('kinerja');
    return $query->result(); // Mengembalikan hasil query ke controller
}
public function get_pegawai_by_pengawas($user_id_pengawas) {
    $this->db->where('pengawas', $user_id_pengawas);
    return $this->db->get('pegawai')->result_array();
}

public function get_users() {
    return $this->db->get('users')->result_array();
}

public function get_users_by_jabatan($jabatan) {
        $this->db->select('user_id, nama, jabatan');
        $this->db->where('jabatan', $jabatan);
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }

    public function get_kinerja_by_user_id($user_id) {
        $this->db->select('id, tanggal, jam_mulai, jam_selesai, kinerja, foto, status');
        $this->db->from('kinerja');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('tanggal', 'DESC');
    
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_kinerja_user_only() {
    $this->db->select('kinerja.*, pegawai.nama, pegawai.role');
    $this->db->from('kinerja');
    $this->db->join('pegawai', 'pegawai.user_id = kinerja.user_id');
    $this->db->join('jabatan', 'jabatan.id = pegawai.jabatan', 'left');
    $this->db->where('pegawai.role', 'user'); // ✅ INI FILTER UTAMA
    $this->db->order_by('kinerja.tanggal', 'DESC');

    return $this->db->get()->result();
}


    public function get_rekap_kinerja($bulan, $tahun) {
        $this->db->select('
                pegawai.user_id,
                pegawai.nama, 
                pegawai.jabatan, 
                pegawai.id_pengawas,
                pengawas.nama_pengawas,
                jabatan.nama_jabatan,
                COUNT(kinerja.id) as jumlah_hari,
                SUM(CASE WHEN kinerja.status = "Disetujui" THEN 1 ELSE 0 END) as sudah_validasi,
                SUM(CASE WHEN kinerja.status = "Belum Validasi" THEN 1 ELSE 0 END) as belum_validasi,
                SUM(CASE WHEN kinerja.status = "Ditolak" THEN 1 ELSE 0 END) as ditolak
        ');
        $this->db->from('pegawai');
        $this->db->join('pengawas', 'pengawas.id = pegawai.id_pengawas', 'left');
        $this->db->join('kinerja', 'kinerja.user_id = pegawai.user_id', 'left');
        $this->db->join('jabatan', 'jabatan.id = pegawai.jabatan', 'left');
    
        // Filter hanya data kinerja berdasarkan bulan & tahun
        if (!empty($bulan) && !empty($tahun)) {
            $this->db->where('MONTH(kinerja.tanggal)', $bulan);
            $this->db->where('YEAR(kinerja.tanggal)', $tahun);
        }
    
        $this->db->group_by('pegawai.user_id');
    
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
}
?>