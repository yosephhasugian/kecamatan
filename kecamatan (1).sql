-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 12 Jun 2025 pada 10.41
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
-- Database: `kecamatan`
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
(7, 'Petugas Keamanan'),
(8, 'Petugas Kebersihan'),
(17, 'Pimpinan');

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
(378, 'USR0010', '2025-05-27', '07:30:00', '10:00:00', 'Monitoring Kegiatan Pengamanan Area Kantor', '1749625452_sek.jpg', 'Disetujui'),
(379, 'USR0010', '2025-05-28', '07:30:00', '10:00:00', 'penjagaan ketertiban dan keamanan lingkungan, melakukan patroli rutin', '1749693992_sekurity.jpg', 'Belum Validasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pjlp` varchar(50) NOT NULL,
  `jabatan` int(11) DEFAULT NULL,
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
(2, 'USR0001', 'Poltak HAsugian', '80015449', 0, 1, 2, 'hasugian', '$2y$10$S2R3VnPzzXuiNANzb4a6Z.nC4unQ5Hx2INC9MzqlMO/nZSAbpSyKm', 'admin'),
(5, 'USR0003', 'Anita Mutiara', '198506222010012028', 4, 15, 0, 'anita', '$2y$10$lSTHF73n66n1IeiW4rjBkelZKnTx15YdD9JDfdeJUBbFHnR/gbZYK', 'pengawas'),
(6, 'USR0004', 'bagus', '822121', 0, 2, 2, 'bagus', '$2y$10$BSIQ0IE1lTSDFhmg.wGt6eYv5dEvaU5bQXUdeTA..q3CIoNsK8uwi', 'pimpinan'),
(17, 'USR0010', 'Amril Januar', '80001383', 7, 15, 15, 'amril', '$2y$10$dhz4ZVWcZuZFrQpDS.vLwu1kCZ.XtT0K4Q2V50.O0aSiNv3kYpnwe', 'user'),
(18, 'USR0011', 'Muhamad Ilhamsyah', '80241688', 7, 15, 15, 'Ilhamsyah', '$2y$10$9sKvhBrvZrblYdTeVGi17eWxSlGPNKklA0f/9ghZnjVeHMiKp51f6', 'user'),
(19, 'USR0012', 'Saepudin Akbar', '80548195', 7, 15, 15, 'saepudin', '$2y$10$r7ViJZU3urBoV/AaJ0roT.2dzfad2l9fm0/LWM4VpIVVwjZkYkI3y', 'user'),
(20, 'USR0013', 'Supriyanto', '80001384', 7, 15, 15, 'supriyanto', '$2y$10$sNFuNezLTHci22I0g2r7UudRoJ5CmFUewMKkPCvQ1mhWdO9EMCM4m', 'user'),
(21, 'USR0014', 'Ade Kusjuhaedi', '80001378', 8, 15, 15, 'ade', '$2y$10$zT2340q0O7FfOuqvKYwKgO.U0NYp8gJ1NBIWOBuRg3anYJrsH3PUi', 'user'),
(22, 'USR0015', 'Untung Firdaus', '80001385', 8, 15, 15, 'untung', '$2y$10$FCQFyQTo.IQH8cTckXn1Rept4KxZ2/D9N7Bn.84L56I7mZW9h0lR2', 'user'),
(23, 'USR0016', 'Silvia Anggraini', '80001381', 8, 15, 15, 'silvia', '$2y$10$RFa4Gqrqb6RXHwYIHL0h7OAv72Pnr8Qu2y7Mc6.UMU0CUeI9cojJC', 'user'),
(24, 'USR0017', 'Sukirman', '80001382', 8, 15, 15, 'sukirman', '$2y$10$l2UvwSOVer8coqyPn6.mmeQr71O2IycuypogiNYAxO3JxiStehK72', 'user'),
(25, 'USR0018', 'Yusnita', '80683393', 8, 15, 15, 'yusnita', '$2y$10$EwpKL6qsXw/TpfD9pwnT/.hR.tUEtp5CXFEfUEt45RrrdwdV9PqKG', 'user'),
(26, 'USR0019', 'Fenry Sinurat', '197004141990061001', 4, 15, 15, 'fenry', '$2y$10$NUdyZSlxYb6SJ2xs3i5Zaekal8JuUfP3xML7DbIoADUh5.bIq.ltC', 'pimpinan');

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
(15, 'USR0001', 'Anita Mutiara', '198506222010012028 ');

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
(15, 'Fenry Sinurat', '197004141990061001', 'Sekretaris Kecamatan Cempaka Putih');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pimpinan`
--
ALTER TABLE `pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
