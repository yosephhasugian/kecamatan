<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pimpinan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Cek apakah user sudah login dan role = admin
        if (!$this->session->userdata('username') || $this->session->userdata('role') !== 'pimpinan') {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = "Validasi Kinerja Petugas";
        $this->load->model('Pegawai_model');
        $data['kinerja_data'] = $this->Pimpinan_model->get_laporan();
        $this->load->model('Pegawai_model');
        $this->load->model('Pimpinan_model');
        $data['periode'] = date('F Y'); // Periode saat ini (Bulan Tahun)
       // Ambil bulan & tahun dari form (GET)
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        // Format periode untuk ditampilkan
        $periode = "";
        if (!empty($bulan) && !empty($tahun)) {
            $periode = date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun));
        }
        $data['rekap'] = $this->Pimpinan_model->get_rekap_kinerja($bulan, $tahun);

        $data['hide_sidebar'] = true;

$this->load->view('pimpinan/dashboard', $data);
    }

    public function detail_kinerja($user_id) {
        $this->load->model('Pimpinan_model');
        $this->load->model('Pegawai_model');
        $data['title'] = "Detail Kinerja Petugas";
        $data['kinerja_data'] = $this->Pimpinan_model->get_kinerja_by_user_id($user_id);
    

        $data['content'] = $this->load->view('pimpinan/tampil', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function export_excel()
{
    $this->load->library('excel');

    $bulan = $this->input->get('bulan');
    $tahun = $this->input->get('tahun');
    $periode = $this->get_periode_label($bulan, $tahun);
    $rekap = $this->Pimpinan_model->get_rekap_kinerja($bulan, $tahun);

    $spreadsheet = $this->excel->create();
    $sheet = $spreadsheet->getActiveSheet();

    // Judul dan Periode
    $sheet->setCellValue('A1', 'Laporan Kinerja Petugas');
    $sheet->mergeCells('A1:I1');
    $sheet->setCellValue('A2', 'Periode: ' . $periode);
    $sheet->mergeCells('A2:I2');

    // Header tabel
    $sheet->fromArray([
        'No', 'Nama', 'Jabatan', 'Pengawas', 'Aktivitas',
        'Sudah Validasi', 'Belum Validasi', 'Ditolak', 'Status'
    ], null, 'A4');

    // Data
    $row = 5;
    $no = 1;
    foreach ($rekap as $r) {
        $status = ($r->jumlah_hari == $r->sudah_validasi) ? 'Selesai' : 'Belum';
        $sheet->fromArray([
            $no++,
            $r->nama,
            $r->nama_jabatan,
            $r->nama_pengawas,
            $r->jumlah_hari . ' Hari',
            $r->sudah_validasi . ' Hari',
            $r->belum_validasi . ' Hari',
            $r->ditolak . ' Hari',
            $status
        ], null, 'A' . $row++);
    }

    // Download
    $this->excel->download($spreadsheet, "Laporan_Kinerja_{$periode}.xls");
}
private function get_periode_label($bulan, $tahun)
{
    if (!$bulan || !$tahun) return 'Semua Periode';
    return date('F', mktime(0, 0, 0, $bulan, 1)) . ' ' . $tahun;
}
}
?>
