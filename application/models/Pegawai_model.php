<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
    public function get_all_pegawai() {
        $this->db->select('
            pegawai.*, 
            jabatan.nama_jabatan, 
            pengawas.nama_pengawas, 
            pimpinan.nama_pimpinan
        ');
        $this->db->from('pegawai');
        $this->db->join('jabatan', 'pegawai.jabatan = jabatan.id', 'left');
        $this->db->join('pengawas', 'pegawai.id_pengawas = pengawas.id', 'left'); // JOIN ke pengawas
        $this->db->join('pimpinan', 'pegawai.pimpinan = pimpinan.id', 'left'); // JOIN ke pimpinan
        return $this->db->get()->result_array();
    }
    

    public function get_all_jabatan() {
        return $this->db->get('jabatan')->result_array();
    }
    
    public function get_all_pengawas() {
        return $this->db->get('pengawas')->result_array();
    }
    
    public function get_all_pimpinan() {
        return $this->db->get('pimpinan')->result_array();
    }

    public function insert_pegawai($data) {
        // Ambil user_id terakhir
        $this->db->select('user_id');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pegawai');
    
        if ($query->num_rows() > 0) {
            $last_id = $query->row()->user_id;
            $last_number = (int) substr($last_id, 3);
            $new_id = 'USR' . str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'USR0001';
        }
    
        $data['user_id'] = $new_id;
    
        $this->db->insert('pegawai', $data);
    
        
    }
    
    public function get_pegawai_by_id($id) {
        return $this->db->get_where('pegawai', ['id' => $id])->row_array();
    }

    public function update_pegawai($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pegawai', $data);
    }

    public function delete_pegawai($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pegawai');
    }
    public function get_nama_by_user_id($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('pegawai');

        if ($query->num_rows() > 0) {
            return $query->row()->nama;
        } else {
            return null;
        }
    }
    
    
}
?>
