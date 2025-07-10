<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kinerja Pegawai</title>
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

      h3 {
        text-align: center;
        color: black;
         padding: 0;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
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

      .header-table {
        width: 100%;
        border: none;
        /* pastikan tidak ada border tabel */
      }

      .header-table td {
        padding: 5px 10px;
        vertical-align: top;
        border: none;
        /* pastikan tidak ada border tabel */
      }

      .header-table td.left {
        text-align: left;
      }

      .header-table td.right {
        text-align: right;
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
    <div style="text-align: center; margin-bottom: 20px;">
    <h3 style="margin-bottom: 5px; font-weight: bold;">LAPORAN KINERJA PENYEDIA JASA LAINNYA PERORANGAN (PJLP)</h3>
    <h3 style="margin: 0; font-weight: bold;">KECAMATAN CEMPAKA PUTIH</h3>
    <h3 style="margin-top: 5px; margin-bottom: 15px;">KOTA ADMINISTRASI JAKARTA PUSAT</h3>
    <hr style="border: 1px solid black; margin: 10px auto; width: 100%;">
</div>
    <!-- Header Table -->
    <table class="header-table">
      <tr>
        <td class="left">
          <strong>Nama:</strong> <?= htmlspecialchars($user['nama'] ?? '-') ?>
        </td>
        <td class="right">
          <strong>ID PJLP:</strong> <?= htmlspecialchars($user['id_pjlp'] ?? '-') ?>
        </td>
      </tr>
      <tr>
        <td class="left">
          <strong>Jabatan:</strong> <?= htmlspecialchars($user['nama_jabatan'] ?? '-') ?>
        </td>
        <td class="right">
          <strong>Periode:</strong> <?= htmlspecialchars($_GET['tanggal_mulai'] ?? '-') ?> s/d <?= htmlspecialchars($_GET['tanggal_selesai'] ?? '-') ?>
        </td>
      </tr>
    </table>
    <!-- Tabel Kinerja -->
    <table id="dataTable" class="display">
      <thead>
        <tr>
          <th>No</th>
          <th>Hari / Tanggal</th>
          <th>Pukul</th>
          <th>Kegiatan</th>
          <th>Dokumentasi</th>
        </tr>
      </thead>
      <tbody> <?php
        if (!empty($kinerja_data)) :
            $no = 1;
            $last_tanggal = null; // Variabel untuk menyimpan tanggal sebelumnya
            $first_image = null;  // Variabel untuk menyimpan foto pertama setiap tanggal

            foreach ($kinerja_data as $row) :
                $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                $tanggal = $hari[date('w', strtotime($row->tanggal))] . ", " . date('d-m-Y', strtotime($row->tanggal));

                // Cek apakah tanggal sudah berubah
                $show_date = ($tanggal !== $last_tanggal);
                
                // Ambil foto pertama pada tanggal tersebut
                if ($show_date) {
                    $image_path = FCPATH . 'uploads/kinerja/' . $row->foto;
                    if (!empty($row->foto) && file_exists($image_path)) {
                        $imageData = base64_encode(file_get_contents($image_path));
                        $first_image = 'data:image/jpeg;base64,' . $imageData;
                    } else {
                        $first_image = null;
                    }
                }
        ?> <tr> <?php if ($show_date) : ?> <td rowspan="
								<?= count(array_filter($kinerja_data, fn($r) => $r->tanggal == $row->tanggal)); ?>"> <?= $no++ ?> </td>
          <td rowspan="
								<?= count(array_filter($kinerja_data, fn($r) => $r->tanggal == $row->tanggal)); ?>"> <?= $tanggal ?> </td> <?php endif; ?> <td> <?= date('H:i', strtotime($row->jam_mulai)) . " - " . date('H:i', strtotime($row->jam_selesai)); ?> </td>
          <td> <?= htmlspecialchars($row->kinerja); ?> </td> <?php if ($show_date) : ?> <td rowspan="
								<?= count(array_filter($kinerja_data, fn($r) => $r->tanggal == $row->tanggal)); ?>" class="text-center"> <?php if ($first_image) : ?> <img src="
									<?= $first_image ?>" alt="Dokumentasi" style="max-width: 100px;"> <?php else : ?> <p>Gambar tidak ditemukan</p> <?php endif; ?> </td> <?php endif; ?>
        </tr> <?php
                $last_tanggal = $tanggal; // Update tanggal terakhir
            endforeach;
        else :
        ?> <tr>
          <td colspan="5" class="text-center">
            <b>Tidak ada data kinerja tersedia</b>
          </td>
        </tr> <?php endif; ?> </tbody>
    </table>
    <!-- Tanda Tangan -->
    <br>
    <br>
    <table class="signature-table">
      <tr>
        <td> Pengawas <br>
          <br>
          <br>
          <br>
          <br> <?= htmlspecialchars($user['nama_pengawas'] ?? '-') ?> <br> NIP. <?= htmlspecialchars($user['nip_pengawas'] ?? '-') ?>
        </td>
        <td> Petugas <br>
          <br>
          <br>
          <br>
          <br> <?= htmlspecialchars($user['nama'] ?? '-') ?> <br> ID PJLP. <?= htmlspecialchars($user['id_pjlp'] ?? '-') ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <br> Mengetahui </b> <br><?= htmlspecialchars($user['satuan'] ?? '-') ?> <br> Kota Administrasi Jakarta Pusah <br>
          </b>
          <br>
          <br>
          <br>
          <br>
          <br> <?= htmlspecialchars($user['nama_pimpinan'] ?? '-') ?> <br> NIP. <?= htmlspecialchars($user['nip_pimpinan'] ?? '-') ?>
        </td>
      </tr>
    </table>
  </body>
</html>