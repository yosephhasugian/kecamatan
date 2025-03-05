<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($username) {
        $this->db->select('*');
        $this->db->from('pegawai'); // Pastikan tabel benar
        $this->db->where('username', $username);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array(); // Kembalikan sebagai array
        }
        return false;
    }

    public function getUserById($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('pegawai');

        

        return $query->row(); // Ambil 1 baris data pegawai
    }

    public function get_laporan_by_user($user_id, $tanggal_mulai, $tanggal_selesai) {
    $this->db->where('user_id', $user_id);
    $this->db->where('tanggal >=', $tanggal_mulai);
    $this->db->where('tanggal <=', $tanggal_selesai);
    $this->db->order_by('tanggal', 'ASC'); // Urutkan berdasarkan tanggal
    $query = $this->db->get('kinerja');
    
    return $query->result();
}

}
