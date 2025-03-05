<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kinerja</title>
    <style>
        /* Styling untuk media print */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: auto;
        }
        .header-table td {
            border: none;
            padding: 10px;
        }
        .signature-table td {
            text-align: center;
            padding-top: 10px;
            border: none;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print(); window.close();">
    <!-- Judul Laporan -->
    <h2>LAPORAN KINERJA PETUGAS</h2>

    <!-- Header Table -->
    <table class="header-table">
        <tr>
            <td><strong>Nama:</strong> <?= htmlspecialchars($user['nama'] ?? '-') ?></td>
            <td><strong>ID PJLP:</strong> <?= htmlspecialchars($user['id_pjlp'] ?? '-') ?></td>
        </tr>
        <tr>
            <td><strong>Jabatan:</strong> <?= htmlspecialchars($user['jabatan'] ?? '-') ?></td>
            <td><strong>Periode:</strong> <?= htmlspecialchars($periode ?? '-') ?></td>
        </tr>
        <tr>
            <td><strong>Pengawas:</strong> <?= htmlspecialchars($user['nama_pengawas'] ?? '-') ?></td>
            <td><strong>Pimpinan:</strong> <?= htmlspecialchars($user['nama_pimpinan'] ?? '-') ?></td>
        </tr>
    </table>

    <!-- Tabel Kinerja -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari / Tanggal</th>
                <th>Pukul</th>
                <th>Kegiatan</th>
                <th>Dokumentasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kinerja_data)) : ?>
                <?php
                $no = 1;
                foreach ($kinerja_data as $row) :
                    $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                    $tanggal = $hari[date('w', strtotime($row->tanggal))] . ", " . date('d-m-Y', strtotime($row->tanggal));
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $tanggal ?></td>
                        <td><?= date('H:i', strtotime($row->jam_mulai)) . " - " . date('H:i', strtotime($row->jam_selesai)); ?></td>
                        <td><?= htmlspecialchars($row->kinerja); ?></td>
                        <td class="text-center">
                            <?php
                            $image_path = FCPATH . 'uploads/kinerja/' . $row->foto;
                            if (!empty($row->foto) && file_exists($image_path)) {
                                $imageData = base64_encode(file_get_contents($image_path));
                                $src = 'data:image/jpeg;base64,' . $imageData;
                            ?>
                                <img src="<?= $src ?>" alt="Dokumentasi">
                            <?php } else { ?>
                                <p>Gambar tidak ditemukan</p>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center"><b>Tidak ada data kinerja tersedia</b></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <br><br>
    <table class="signature-table">
        <tr>
            <td>
                <b>Pengawas Petugas</b><br><br><br><br><br>
                <?= htmlspecialchars($user['nama_pengawas'] ?? '-') ?><br>
                <b>NIP:</b> <?= htmlspecialchars($user['nip_pengawas'] ?? '-') ?>
            </td>
            <td>
                <b>Petugas</b><br><br><br><br><br>
                <?= htmlspecialchars($user['nama'] ?? '-') ?><br>
                <b>ID PJLP:</b> <?= htmlspecialchars($user['id_pjlp'] ?? '-') ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
                <b>Mengetahui</b><br>
                Kepala Satuan Pengawas Internal<br><br><br><br><br>
                <?= htmlspecialchars($user['nama_pimpinan'] ?? '-') ?><br>
                <b>NIP:</b> <?= htmlspecialchars($user['nip_pimpinan'] ?? '-') ?>
            </td>
        </tr>
    </table>
</body>
</html>