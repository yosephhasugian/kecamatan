<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public function get_pimpinan() {
        return $this->db->get('pimpinan')->result_array();
    }

    public function get_pengawas() {
        return $this->db->get('pengawas')->result_array();
    }

    public function get_jabatan() {
        return $this->db->get('jabatan')->result_array();
    }


    public function insert_user($data) {
        return $this->db->insert('pimpinan', $data);
    }

    public function insert_pengawas($data) {
        return $this->db->insert('pengawas', $data);
    }

    public function insert_jabatan($data) {
        return $this->db->insert('jabatan', $data);
    }

    public function delete_user($id) {
        return $this->db->where('id', $id)->delete('pimpinan');
    }

    public function delete_pengawas($id) {
        return $this->db->where('id', $id)->delete('pengawas');
    }

    public function delete_jabatan($id) {
        return $this->db->where('id', $id)->delete('jabatan');
    }

    public function get_pimpinan_by_id($id) {
        return $this->db->get_where('pimpinan', ['id' => $id])->row_array();
    }
    
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pimpinan', $data);
    }

    public function update_pengawas($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pengawas', $data);
    }

    public function get_kinerja($start, $end) {
        $this->db->where('tanggal >=', $start);
        $this->db->where('tanggal <=', $end);
        $query = $this->db->get('kinerja');
        $events = [];
        foreach ($query->result() as $row) {
            $events[] = [
                'title' => $row->kinerja,
                'start' => $row->tanggal . 'T' . $row->jam_mulai,
                'end' => $row->tanggal . 'T' . $row->jam_selesai,
                'color' => ($row->status == 'Disetujui') ? '#28a745' : (($row->status == 'Ditolak') ? '#dc3545' : '#ffc107')
            ];
        }
        return $events;
    }

    public function insert_kinerja($data) {
        $this->db->insert('kinerja', $data);
    }

    public function get_status_counts() {
        $this->db->select("status, COUNT(*) as count");
        $this->db->group_by("status");
        $query = $this->db->get("kinerja");
        $result = ['Belum Validasi' => 0, 'Disetujui' => 0, 'Ditolak' => 0, 'total_aktivitas' => 0, 'total_waktu' => 0];

        foreach ($query->result() as $row) {
            $result[$row->status] = $row->count;
            $result['total_aktivitas'] += $row->count;
        }

        $this->db->select("SUM(TIME_TO_SEC(TIMEDIFF(jam_selesai, jam_mulai)) / 60) as total_waktu", false);
        $total_time_query = $this->db->get("kinerja")->row();
        $result['total_waktu'] = (int) $total_time_query->total_waktu;

        return $result;
    }

    public function get_pengawas_by_id($id) {
        return $this->db->get_where('pengawas', ['id' => $id])->row_array();
    }
    
}
?>
