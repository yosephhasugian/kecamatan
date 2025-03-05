<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengawas_model extends CI_Model {
    public function get_pegawai() {
        return $this->db->get('pegawai')->result_array();
    }

    public function get_laporan()
    {
    $query = $this->db->get('kinerja');
    return $query->result(); // Mengembalikan hasil query ke controller
}
public function get_pegawai_by_pengawas($user_id_pengawas) {
    $this->db->select('user_id, nama');
    $this->db->from('pegawai');
    $this->db->where('id_pengawas', $pengawas_id); // Hanya pegawai yang diawasi pengawas ini
    return $this->db->get()->result_array();
}
public function get_users_only($nama_pengawas) {
    // Ambil ID pengawas berdasarkan nama
    $this->db->select('id');
    $this->db->from('pengawas');
    $this->db->where('nama_pengawas', $nama_pengawas);
    $pengawas = $this->db->get()->row(); 

    if (!$pengawas) {
        return []; // Jika pengawas tidak ditemukan, kembalikan array kosong
    }

    // Gunakan ID pengawas untuk mencari pegawai yang diawasi
    $this->db->select('user_id, nama');
    $this->db->from('pegawai');
    $this->db->where('role', 'user');
    $this->db->where('id_pengawas', $pengawas->id); // Pakai ID pengawas, bukan nama

    return $this->db->get()->result_array();
}

public function get_kinerja_by_user_id($user_id) {
    $this->db->select('*');
    $this->db->from('kinerja');
    $this->db->where('user_id', $user_id);
    $this->db->order_by('tanggal', 'DESC');

    $query = $this->db->get();
    return $query->result();
}

public function count_kinerja_by_user_id_and_month($user_id, $month, $year) {
    $this->db->where('user_id', $user_id);
    $this->db->where('MONTH(tanggal)', $month);
    $this->db->where('YEAR(tanggal)', $year);
    return $this->db->count_all_results('kinerja');
}

public function count_validated_kinerja_by_user_id_and_month($user_id, $month, $year) {
    $this->db->where('user_id', $user_id);
    $this->db->where('MONTH(tanggal)', $month);
    $this->db->where('YEAR(tanggal)', $year);
    $this->db->where('status !=', 'Belum Validasi');
    return $this->db->count_all_results('kinerja');
}

public function get_kinerja($id_pengawas, $bulan, $tahun) {
    $this->db->select('
        pegawai.nama, 
        pegawai.jabatan, 
        pegawai.id_pengawas,
        pengawas.nama_pengawas, 
        COUNT(kinerja.id) as jumlah_hari,
        SUM(CASE WHEN kinerja.status = "Disetujui" THEN 1 ELSE 0 END) as sudah_validasi,
        SUM(CASE WHEN kinerja.status = "Belum Validasi" THEN 1 ELSE 0 END) as belum_validasi,
        SUM(CASE WHEN kinerja.status = "Ditolak" THEN 1 ELSE 0 END) as ditolak
    ');
    $this->db->from('pegawai');
    $this->db->join('pengawas', 'pengawas.id = pegawai.id_pengawas', 'left');
    $this->db->join('kinerja', 'kinerja.user_id = pegawai.user_id', 'left');
    
    // Tambahkan filter ID pengawas
    $this->db->where('pegawai.id_pengawas', $id_pengawas);

    // Filter berdasarkan bulan dan tahun jika ada data kinerja
    if (!empty($bulan) && !empty($tahun)) {
        $this->db->where('MONTH(kinerja.tanggal)', $bulan);
        $this->db->where('YEAR(kinerja.tanggal)', $tahun);
    }

    $this->db->group_by('pegawai.user_id');
    
    return $this->db->get()->result();
}


public function get_nama_pengawas_by_user_id($user_id) {
    $this->db->select('nama');
    $this->db->from('pegawai');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->nama;
    } else {
        return '';
    }
}

public function get_all_pegawai() {
    $this->db->select('user_id, nama');
    $query = $this->db->get('pegawai');
    return $query->result_array();
}

public function get_kinerja_by_user_id_and_month($user_id, $month, $year) {
    $this->db->where('user_id', $user_id);
    $this->db->where('MONTH(tanggal)', $month);
    $this->db->where('YEAR(tanggal)', $year);
    $query = $this->db->get('kinerja');
    return $query->result_array();


}


public function getPengawasId($user_id) {
    $this->db->select('id');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('pengawas');

    if ($query->num_rows() > 0) {
        return $query->row()->id;
    }
    return null;
}

public function getUsersByPengawas($id_pengawas) {
    $this->db->select('user_id, nama, jabatan');
    $this->db->where('id_pengawas', $id_pengawas);
    return $this->db->get('pegawai')->result_array();
}



public function getRekapKinerja($bulan, $tahun) {
    $this->db->select('nama, jabatan, id_pengawas');
    $this->db->from('pegawai');
    $this->db->where('MONTH(tanggal)', $bulan); 
    $this->db->where('YEAR(tanggal)', $tahun); 
    $query = $this->db->get();
    return $query->result();
}



public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update('kinerja', ['status' => $status]);
    }
    public function get_kinerja_debug() {
        $query = $this->db->get('kinerja');
        $result = $query->result_array();

        // Debug: Tampilkan jumlah kolom dari hasil query
        if (!empty($result)) {
            echo "<pre style='color: green;'>✅ Data berhasil diambil! Jumlah kolom: " . count($result[0]) . "</pre>";
            echo "<pre style='color: blue;'>" . print_r($result, true) . "</pre>";
        } else {
            echo "<pre style='color: red;'>❌ ERROR: Tidak ada data kinerja yang ditemukan!</pre>";
        }

        return $result;
    }

    // Debug: Cek apakah tabel memiliki kolom yang sesuai
    public function check_table_columns() {
        $query = $this->db->query("SHOW COLUMNS FROM kinerja");
        $columns = $query->result_array();

        echo "<pre style='color: green;'>📊 Struktur Tabel `kinerja`:</pre>";
        echo "<pre style='color: blue;'>" . print_r($columns, true) . "</pre>";
    }

}
?>