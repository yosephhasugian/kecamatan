-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Mar 2025 pada 09.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekinerja`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(4, 'Administrator'),
(6, 'Petugas Admin'),
(10, 'Petugas Announcer'),
(1, 'Petugas IT'),
(7, 'Petugas Keamanan'),
(8, 'Petugas Kebersihan'),
(9, 'Petugas Regu Operasional'),
(5, 'Petugas Tarif Layanan'),
(3, 'Petugas Teknisi'),
(2, 'Staf Admin Lantai 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kinerja`
--

CREATE TABLE `kinerja` (
  `id` int(11) NOT NULL,
  `user_id` varchar(110) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `kinerja` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Belum Validasi','Disetujui','Ditolak') DEFAULT 'Belum Validasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kinerja`
--

INSERT INTO `kinerja` (`id`, `user_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `kinerja`, `foto`, `status`) VALUES
(1, 'USR0005', '2025-02-04', '08:00:00', '10:00:00', 'Sosialisasi Dengan PO Mendali Mas Terkait Integrasi', 'file_1739499942.jpeg', 'Belum Validasi'),
(2, 'USR0005', '2025-02-04', '10:00:00', '12:00:00', 'Sosialisai Dengan PO Agra MAs', 'file_1739499942.jpeg', 'Belum Validasi'),
(3, 'USR0005', '2025-02-04', '13:00:00', '15:00:00', 'Sosialisasi Dengan PO Harapan Jaya', 'file_1737090395.jpeg', 'Belum Validasi'),
(4, 'USR0005', '2025-02-04', '15:00:00', '16:00:00', 'Sosialisai Dengan PO Juragan 99', 'file_1737090259.jpg', 'Belum Validasi'),
(6, 'USR0005', '2025-02-12', '08:00:00', '10:00:00', 'Sosialisai Dengan PO DAmri', 'db3.JPG', 'Disetujui'),
(7, 'USR0005', '2025-02-07', '09:00:00', '11:00:00', 'Test Database lagi', 'file_1739499942.jpeg', 'Disetujui'),
(8, 'USR0005', '2025-02-13', '08:00:00', '10:00:00', 'Menindaklanjuti adanya aduan CRM masuk terkait Fasilitas eskalator di Gedung D TransJakarta tidak berfungsi', 'WhatsApp_Image_2025-02-20_at_13_38_45.jpeg', 'Disetujui'),
(9, 'USR0001', '2025-02-05', '08:00:00', '09:59:00', 'Sosialisisi Dengan Warung', 'WhatsApp_Image_2025-02-13_at_11_30_56.jpeg', 'Disetujui'),
(10, 'USR0001', '2025-02-06', '07:00:00', '09:00:00', 'Test Database', 'user.JPG', 'Disetujui'),
(11, 'USR0002', '2025-02-17', '11:00:00', '11:59:00', 'Cek Lagi Database', 'user_6.JPG', 'Disetujui'),
(12, 'USR0002', '2025-02-17', '13:00:00', '15:00:00', 'Sosialisasi dengan admin petugas PO', 'WhatsApp_Image_2025-02-13_at_11_30_35_(2).jpeg', 'Ditolak'),
(13, 'USR0002', '2025-02-20', '08:00:00', '09:50:00', 'Sosialisai dengan Petugas PO di MZ', 'WhatsApp_Image_2025-02-13_at_11_30_33.jpeg', 'Disetujui'),
(14, 'USR0002', '2025-02-05', '08:00:00', '10:00:00', 'Test Database\r\n', 'WhatsApp_Image_2025-02-13_at_11_30_33.jpeg', 'Belum Validasi'),
(15, 'USR0005', '2025-02-03', '08:00:00', '10:00:00', 'Test Datatabel', 'WhatsApp_Image_2025-02-13_at_11_30_33.jpeg', 'Disetujui'),
(16, 'USR0005', '2025-02-03', '10:00:00', '10:59:00', 'Pengetesan Database', 'gato2.JPG', 'Belum Validasi'),
(17, 'USR0001', '2025-02-07', '07:59:00', '12:00:00', 'Test Datatabel LAgi', '1740569166_kode11.JPG', 'Disetujui'),
(19, 'USR0007', '2025-02-03', '08:00:00', '10:00:00', 'Koordinasi dengan Pihak Loket PO Bus di lantai MZ UP TTPG', NULL, 'Belum Validasi'),
(20, 'USR0007', '2025-02-04', '08:00:00', '10:00:00', 'Koordinasi dengan tim IT terkait sistem jaringan ', NULL, 'Belum Validasi'),
(21, 'USR0007', '2025-02-05', '10:00:00', '12:00:00', 'Melakukan monitoring terkait jaringan CCTV di area keberangkatan', NULL, 'Belum Validasi'),
(22, 'USR0007', '2025-02-06', '08:00:00', '12:00:00', 'Menghadiri Rapat terkait sistem informasi peningkatan kualitas jaringan internet di UP TTPG', NULL, 'Belum Validasi'),
(23, 'USR0007', '2025-02-07', '08:00:00', '12:00:00', 'Melakukan koordinasi dengan tim IT ', NULL, 'Belum Validasi'),
(24, 'USR0007', '2025-02-10', '07:30:00', '09:00:00', 'Mengikuti Apel Senin pagi di UP TTPG', NULL, 'Belum Validasi'),
(25, 'USR0007', '2025-02-11', '08:00:00', '10:00:00', 'Menghadiri rapat koordinasi dengan tim Satpel Kemitraan dan Informasi', NULL, 'Belum Validasi'),
(26, 'USR0007', '2025-02-12', '08:00:00', '10:00:00', 'Melakukan koordinasi dengan pihak loket PO Bus di lantai MZ UP TTPG', NULL, 'Belum Validasi'),
(27, 'USR0007', '2025-02-13', '08:00:00', '10:00:00', 'Melakukan monitoring terkait pemantauan CCTV di area kedatangan UP TTPG', NULL, 'Belum Validasi'),
(28, 'USR0007', '2025-02-14', '08:00:00', '10:00:00', 'Melakukan monitoring sistem jaringan di UP TTPG', NULL, 'Belum Validasi'),
(29, 'USR0007', '2025-02-17', '07:30:00', '09:00:00', 'Mengikuti Apel Senin pagi di UP TTPG', NULL, 'Belum Validasi'),
(30, 'USR0007', '2025-02-18', '08:00:00', '10:00:00', 'Mengikuti Zoom meeting rapat sosialisasi terkait sistem jaringan oleh Diskominfotik', NULL, 'Belum Validasi'),
(31, 'USR0007', '2025-02-19', '08:00:00', '10:00:00', 'Melakukan monitoring pemantauan CCTV di area keberangkatan UP TTPG', NULL, 'Belum Validasi'),
(32, 'USR0007', '2025-02-20', '08:00:00', '10:00:00', 'Menghadiri rapat koordinasi dengan tim satpel kemitraan dan informasi', NULL, 'Belum Validasi'),
(33, 'USR0007', '2025-02-21', '08:00:00', '10:00:00', 'Melakukan koordinasi dengan pihak loket PO Bus di lantai MZ UP TTPG', NULL, 'Belum Validasi'),
(34, 'USR0007', '2025-02-24', '07:30:00', '09:00:00', 'Mengikuti apel senin pagi di UP TTPG', NULL, 'Belum Validasi'),
(35, 'USR0007', '2025-02-25', '09:00:00', '12:00:00', 'Melakukan monitoring pemantauan jaringan area UP TTPG', NULL, 'Belum Validasi'),
(36, 'USR0007', '2025-02-26', '09:00:00', '12:00:00', 'Menghadiri rapat koordinasi dengan tim Satpel Kemitraan dan Infomasi di ruang rapat lantai 4', NULL, 'Disetujui'),
(37, 'USR0007', '2025-02-27', '09:00:00', '12:00:00', 'Melakukan monitoring sistem jaringan di UP TTPG', NULL, 'Disetujui'),
(38, 'USR0007', '2025-02-28', '09:00:00', '12:00:00', 'Melakukan monitoring pemantauan CCTV di area kedatangan UP TTPG', NULL, 'Disetujui'),
(39, 'USR0007', '2025-02-02', '10:00:00', '13:00:00', 'Test DAtatabel', '1740648773_gatot14.JPG', 'Belum Validasi'),
(40, 'USR0007', '2025-02-02', '14:00:00', '16:00:00', 'Test lagi', '1740648945_Screenshot_2025-02-22_095055.png', 'Belum Validasi'),
(43, 'USR0007', '2025-02-02', '10:00:00', '18:00:00', 'Test', '1740649472_gatot14.JPG', 'Belum Validasi'),
(44, 'USR0008', '2025-02-27', '14:00:00', '22:00:00', 'Perbaikan Network area Kedatangan', '1740655314_photo_2024-03-13_20-52-45.jpg', 'Belum Validasi'),
(45, 'USR0008', '2025-02-27', '14:00:00', '15:00:00', 'data ekin', '1740655456_photo_2024-03-13_20-49-30.jpg', 'Belum Validasi'),
(46, 'USR0008', '2025-02-26', '14:00:00', '22:00:00', 'perbaikan camera kedatangan', '1740655924_photo_2025-02-27_18-20-49.jpg', 'Belum Validasi'),
(47, 'USR0008', '2025-02-25', '14:00:00', '22:00:00', 'perbaikan camera kedatangan', '1740655937_photo_2025-02-27_18-20-49.jpg', 'Belum Validasi'),
(48, 'USR0008', '2025-02-24', '14:00:00', '22:00:00', 'perbaikan camera kedatangan', '1740655946_photo_2025-02-27_18-20-49.jpg', 'Belum Validasi'),
(49, 'USR0008', '2025-02-22', '14:00:00', '22:00:00', 'perbaikan camera kedatangan', '1740655973_photo_2025-02-27_18-20-49.jpg', 'Belum Validasi'),
(50, 'USR0008', '2025-02-21', '14:00:00', '22:00:00', 'jalan jalan', '1740656014_photo_2024-06-25_12-52-52.jpg', 'Belum Validasi'),
(51, 'USR0008', '2025-02-23', '14:00:00', '22:00:00', 'data saya ada di mana mana .apakah kamu tau ad di mana saja data saya.boleh gak saya tanya.bila kamu tau data saya ada di mana mana', '1740656205_photo_2025-02-27_18-21-06.jpg', 'Belum Validasi'),
(52, 'USR0008', '2025-02-01', '14:00:00', '22:00:00', 'Apaan tuh', '1740656293_photo_2024-04-24_21-26-52.jpg', 'Belum Validasi'),
(53, 'USR0008', '2025-02-15', '14:00:00', '22:00:00', 'Apaan tuh', '1740656302_photo_2024-04-24_21-26-52.jpg', 'Belum Validasi'),
(54, 'USR0008', '2025-02-14', '14:00:00', '22:00:00', 'Apaan tuh', '1740656305_photo_2024-04-24_21-26-52.jpg', 'Belum Validasi'),
(55, 'USR0008', '2025-02-13', '14:00:00', '22:00:00', 'pemasangan camera', '1740656336_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(56, 'USR0008', '2025-02-12', '14:00:00', '22:00:00', 'pemasangan camera', '1740656341_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(57, 'USR0008', '2025-02-19', '14:00:00', '22:00:00', 'pemasangan camera', '1740656345_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(58, 'USR0008', '2025-02-20', '14:00:00', '22:00:00', 'pemasangan camera', '1740656348_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(59, 'USR0008', '2025-02-18', '14:00:00', '22:00:00', 'pemasangan camera', '1740656351_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(60, 'USR0008', '2025-02-17', '14:00:00', '22:00:00', 'pemasangan camera', '1740656354_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(61, 'USR0008', '2025-02-16', '14:00:00', '22:00:00', 'pemasangan camera', '1740656357_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(62, 'USR0008', '2025-02-09', '14:00:00', '22:00:00', 'pemasangan camera', '1740656360_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(63, 'USR0008', '2025-02-10', '14:00:00', '22:00:00', 'pemasangan camera', '1740656364_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(64, 'USR0008', '2025-02-11', '14:00:00', '22:00:00', 'pemasangan camera', '1740656367_photo_2024-05-13_16-20-34.jpg', 'Belum Validasi'),
(65, 'USR0005', '2025-02-03', '09:01:00', '17:32:00', 'Pengecekkan Server', '1740657818_photo_2024-01-30_18-00-10.jpg', 'Disetujui'),
(66, 'USR0007', '2025-02-01', '07:40:00', '07:55:00', 'monitoring network', '1740702969_Screenshot_2023-05-26_081541.png', 'Belum Validasi'),
(68, 'USR0007', '2025-02-09', '12:00:00', '23:00:00', 'sadsadfasgfgfg', '1740720418_gatot_13.JPG', 'Belum Validasi'),
(69, 'USR0007', '2025-02-16', '08:00:00', '09:15:00', 'Rapat', '1740723072_gatot_12.JPG', 'Belum Validasi'),
(70, 'USR0007', '2025-02-08', '08:00:00', '10:00:00', 'Test', '1740724474_WhatsApp_Image_2025-02-14_at_18_47_36.jpeg', 'Belum Validasi'),
(71, 'USR0009', '2025-02-17', '07:30:00', '16:00:00', 'Memperbaiki palang gate yang patah', '1740725648_WhatsApp_Image_2025-02-28_at_13_42_52.jpeg', 'Belum Validasi'),
(72, 'USR0009', '2025-02-18', '07:30:00', '16:00:00', 'Maintenance cctv camera', '1740725965_WhatsApp_Image_2025-02-28_at_13_42_52.jpeg', 'Belum Validasi'),
(73, 'USR0009', '2025-02-19', '07:30:00', '16:00:00', 'Print suatu dokumen file', '1740726098_WhatsApp_Image_2025-02-28_at_14_00_37.jpeg', 'Belum Validasi'),
(74, 'USR0009', '2025-02-20', '07:30:00', '16:00:00', 'Menampilkan rekaman visual di tv\r\n', '1740726236_WhatsApp_Image_2025-02-28_at_14_02_42.jpeg', 'Belum Validasi'),
(75, 'USR0009', '2025-02-21', '07:30:00', '16:00:00', 'Mengaktifkan on power di ruang server', '1740726398_WhatsApp_Image_2025-02-28_at_13_42_55.jpeg', 'Belum Validasi'),
(77, 'USR0009', '2025-02-24', '07:30:00', '16:00:00', 'Monitoring kamera cctv UP.Terminal Terpadu Pulo Gebang', '1740727072_WhatsApp_Image_2025-02-28_at_14_10_25.jpeg', 'Belum Validasi'),
(79, 'USR0009', '2025-02-25', '07:30:00', '16:00:00', 'Mengganti kabel addaptor yang terbakar ', '1740727475_WhatsApp_Image_2025-02-28_at_14_22_34.jpeg', 'Belum Validasi'),
(80, 'USR0009', '2025-02-26', '07:30:00', '16:00:00', 'Menrestart vending machine', '1740727736_WhatsApp_Image_2025-02-28_at_14_27_25.jpeg', 'Belum Validasi'),
(81, 'USR0009', '2025-02-27', '07:30:00', '16:00:00', 'Menrestart vending machine', '1740727904_WhatsApp_Image_2025-02-28_at_14_31_06.jpeg', 'Belum Validasi'),
(82, 'USR0009', '2025-02-28', '07:30:00', '16:00:00', 'Menrestart vending machine', '1740728054_WhatsApp_Image_2025-02-28_at_13_42_55.jpeg', 'Belum Validasi'),
(83, 'USR0009', '2025-02-28', '07:29:00', '16:00:00', 'Menginput kegiatan kinerja', '1740728250_WhatsApp_Image_2025-02-28_at_14_35_53.jpeg', 'Belum Validasi'),
(84, 'USR0005', '2025-02-27', '14:01:00', '22:23:00', 'tes', '1740992581_photo_2023-01-02_16-18-08.jpg', 'Ditolak'),
(85, 'USR0005', '2025-03-05', '07:30:00', '16:00:00', 'Pemasangan Kamera CCTV di Area Eks Bus TJ', '1741143877_photo_2024-06-03_15-47-54.jpg', 'Belum Validasi'),
(86, 'USR0009', '2025-02-17', '07:30:00', '16:00:00', 'Menrestart vending machine', '1741153679_WhatsApp_Image_2025-03-05_at_12_39_42.jpeg', 'Belum Validasi'),
(87, 'USR0009', '2025-02-17', '07:30:00', '16:00:00', 'Mengkrimping kabel LAN', '1741153876_WhatsApp_Image_2025-03-05_at_12_39_37.jpeg', 'Belum Validasi'),
(88, 'USR0009', '2025-02-18', '07:30:00', '16:00:00', 'Menrestart Vending Machine', '1741154145_WhatsApp_Image_2025-03-05_at_12_42_39_(1).jpeg', 'Belum Validasi'),
(89, 'USR0009', '2025-02-18', '07:30:00', '16:00:00', 'Pengecekan server \r\n', '1741154458_WhatsApp_Image_2025-03-05_at_12_39_40_(1).jpeg', 'Belum Validasi'),
(90, 'USR0010', '2025-02-28', '13:30:00', '14:30:00', 'Sosialisasi Terkait Penanggulangan Bencana Bagi Masyarakat Perkotaan', '1741161930_WhatsApp_Image_2025-03-03_at_02_03_59_(1).jpeg', 'Belum Validasi'),
(91, 'USR0010', '2025-02-28', '07:30:00', '08:00:00', 'Update Data Perbandingan Harian Bus, Pnp, dan Pengunjung UP TTPG', '1741162090_WhatsApp_Image_2025-02-28_at_07_32_53.jpeg', 'Belum Validasi'),
(92, 'USR0010', '2025-03-03', '06:30:00', '09:00:00', 'Pelaksanaan Kegiatan Apel Gabungan Dinas Perhubungan Provinsi DKI Jakarta di Plaza Selatan Monas', '1741162411_WhatsApp_Image_2025-03-04_at_08_45_13.jpeg', 'Belum Validasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pjlp` varchar(50) NOT NULL,
  `jabatan` enum('Petugas IT','Staf Lantai 4','Petugas Teknisi','Petugas Keamanan','Petugas Kebersihan','Petugas Teknis Penyelengara Terminal','Petugas Tarif Layanan') DEFAULT NULL,
  `id_pengawas` int(11) NOT NULL,
  `pimpinan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` enum('admin','pengawas','user','pimpinan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `user_id`, `nama`, `id_pjlp`, `jabatan`, `id_pengawas`, `pimpinan`, `username`, `password`, `role`) VALUES
(2, 'USR0001', 'Poltak HAsugian', '80015449', 'Petugas IT', 1, 2, 'hasugian', '$2y$10$S2R3VnPzzXuiNANzb4a6Z.nC4unQ5Hx2INC9MzqlMO/nZSAbpSyKm', 'admin'),
(3, 'USR0002', 'Edy Siregar', '800154497', 'Staf Lantai 4', 2, 2, 'siregar', '$2y$10$0S.Lc8H5UoRGsctri.0r.uwzE6DnICBMlNOaZWuvCrAg/lWLAfui2', 'user'),
(5, 'USR0003', 'Jerry Decky', '1982051540144', 'Petugas IT', 1, 1, 'jerry', '$2y$10$0wZjuHciG9ArLMOVS6qWb.OjI8h79ZdNUTMjV37szNWsRvl0OTyZq', 'pengawas'),
(6, 'USR0004', 'bagus', '822121', 'Staf Lantai 4', 2, 2, 'bagus', '$2y$10$BSIQ0IE1lTSDFhmg.wGt6eYv5dEvaU5bQXUdeTA..q3CIoNsK8uwi', 'pimpinan'),
(7, 'USR0005', 'Agung Hartanto 2', '844516316', 'Petugas Teknis Penyelengara Terminal', 1, 1, 'agung', '$2y$10$BXO2KJLruQ7G1TruBlguBusXwSf.u53zOu8ZLCWJ2T.w4hUeWB0iG', 'user'),
(8, 'USR0006', 'gunanto Simamora', '9945656449', 'Petugas IT', 2, 1, 'gunanto', '$2y$10$30A3ItOV8ci01tXDgca82..LihYi1bBqhit.ibauMTNRrr2P.7eT.', 'user'),
(9, 'USR0007', 'Fadillah', '8415245', 'Petugas IT', 1, 1, 'fadil', '$2y$10$llIMlxquUDeaEQObDlmUIOjWKToHoDa6r4uCBmyRqWbGgHzzL9i.u', 'user'),
(10, 'USR0008', 'sanusi', '8056565', 'Petugas IT', 1, 1, 'sanusi', '$2y$10$89jPBe5Wfc8oYwjhsnXNY.xOx2G9JcSw3BHqTeoEtFA28Fo4pl3aO', 'user'),
(11, 'USR0009', 'SMK Kikin', '123456789', 'Petugas IT', 1, 1, 'pkl', '$2y$10$0HAFvIQVrnW4XcEJYp1ODeymnfZ3v5KZZQMKtBTCgmeiYrKzw4Fc2', 'user'),
(12, 'USR0010', 'Ghani', '8056565', 'Staf Lantai 4', 11, 2, 'gani', '$2y$10$3/1xRX84K5vJYpcoulaYa.jSoMNX4ax5IIrQzdVcqSorbZLwlK9vG', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai2`
--

CREATE TABLE `pegawai2` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pjlp` varchar(20) DEFAULT NULL,
  `jabatan` varchar(100) NOT NULL,
  `unit_kerja` varchar(100) NOT NULL,
  `pengawas` varchar(255) DEFAULT NULL,
  `nip_pengawas` varchar(255) DEFAULT NULL,
  `pimpinan` varchar(255) DEFAULT NULL,
  `nip_pimpinan` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai2`
--

INSERT INTO `pegawai2` (`id`, `nama`, `id_pjlp`, `jabatan`, `unit_kerja`, `pengawas`, `nip_pengawas`, `pimpinan`, `nip_pimpinan`, `username`, `password`, `role`) VALUES
(1, 'Poltak Hasugian', '80333230', 'Petugas PPLL', 'Terminal Pulo Gebang', 'Jery Decky', '123456789', 'Umi Hindayanti', '198001232010012019', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Bagus Dwiyantoro', '80333231', 'Pengawas PPLL', 'Terminal Pulo Gebang', 'Edis Tamba', '921542145', 'Novita Martiani', '198001232010012019', 'bagus', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(3, 'Agung Hartanto', '80333233', 'Kepala Satuan Pengawas', 'Terminal Pulo Gebang', 'Jery Decky', '123456789', 'Umi Hindayanti', '198001232010012019', '198103282010012022', '21232f297a57a5a743894a0e4a801fc3', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawas`
--

CREATE TABLE `pengawas` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `nama_pengawas` varchar(100) NOT NULL,
  `nip_pengawas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengawas`
--

INSERT INTO `pengawas` (`id`, `user_id`, `nama_pengawas`, `nip_pengawas`) VALUES
(1, 'USR0003', 'Jerry Decky', '198212312010011050'),
(2, '', 'Nasib Simanjuntak', '198407202008011006'),
(3, '', 'Edis Tamba', '198105082008011023'),
(11, '', 'Irvan Rizky', '199104102014031001'),
(12, '', 'Bekti Sejati', '197202242014082003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pimpinan`
--

CREATE TABLE `pimpinan` (
  `id` int(11) NOT NULL,
  `nama_pimpinan` varchar(100) NOT NULL,
  `nip_pimpinan` varchar(50) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pimpinan`
--

INSERT INTO `pimpinan` (`id`, `nama_pimpinan`, `nip_pimpinan`, `satuan`) VALUES
(1, 'Umi Hindayanti', '198001232010012019', 'Kasatpel Kemitraan dan Informasi'),
(2, 'Hendra Kurniawan', '198409192010011027', 'Kasatpel Operasional'),
(9, 'Wahyu Hidayat', '198303142010011020', 'Kasatpel Prasarana dan Sarana'),
(10, 'Novita Martiani', '198103262010012022', 'Kepala Satuan Pengawas Internal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('Staf Lantai 4','Petugas IT','Petugas Penyelengara Terminal','Petugas Keamanan','Petugas Kebersihan','Petugas Teknisi') DEFAULT NULL,
  `role` enum('pimpinan','admin','pengawas','user') NOT NULL DEFAULT 'user',
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `jabatan`, `role`, `nama`) VALUES
(1, 'hasugian', '$2y$10$grAaWPDsWWB.F9RDfpgZWOb9TaUVfaVbo2qsiW81MAwldBcoH7c/6', 'Petugas IT', 'admin', 'Poltak Hasugian'),
(2, 'bagus', '$2y$10$2mvzaaG3yQzmSVaOxpi4eOeSLK/wZzthDVKo7DZXtWY5POZOqw47u', 'Staf Lantai 4', 'pimpinan', 'Bagus Dwiyantoro'),
(3, 'Siregar', '$2y$10$3s0rnRTmfh7O4v445FqPKuxOt0n3TgGMT/iiz6/8xZ4/LOJbekjEG', 'Petugas Keamanan', 'user', 'Edy Siregar'),
(4, 'jerry', '$2y$10$nKeoeWuZbGQO5ks.kWVDUeHFr0jM1hPKzTED9BUgTXWsrdIpyR2wm', 'Petugas Kebersihan', 'pengawas', 'Jery Decky');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_jabatan` (`nama_jabatan`);

--
-- Indeks untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `user_name` (`username`);

--
-- Indeks untuk tabel `pegawai2`
--
ALTER TABLE `pegawai2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`username`),
  ADD UNIQUE KEY `id_pjlp` (`id_pjlp`);

--
-- Indeks untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pengawas` (`nama_pengawas`);

--
-- Indeks untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pimpinan` (`nama_pimpinan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pegawai2`
--
ALTER TABLE `pegawai2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
