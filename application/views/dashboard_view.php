<?php
$data['title'] = 'Dashboard'; // Judul Halaman
$data['content'] = $this->load->view('dashboard_content', [], true); // Load Konten Dashboard
$this->load->view('layouts/main', $data); // Load Template Layout
?>
