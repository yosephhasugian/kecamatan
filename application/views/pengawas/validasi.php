<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Validasi Kinerja Petugas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> <style>
        :root {
            --primary-color: #4CAF50; /* Hijau untuk sukses/validasi */
            --secondary-color: #007bff; /* Biru umum */
            --warning-color: #ffc107; /* Kuning untuk peringatan */
            --danger-color: #dc3545; /* Merah untuk ditolak */
            --light-bg: #f8f9fa; /* Latar belakang terang */
            --dark-text: #343a40; /* Teks gelap */
            --border-color: #e0e0e0; /* Warna border */
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Shadow yang lebih lembut */
            --hover-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Poppins', sans-serif; /* Menggunakan Poppins */
            font-size: 15px;
            line-height: 1.6;
            margin: 0;
            background-color: var(--light-bg);
            color: var(--dark-text);
            padding: 20px 0; /* Padding vertikal */
        }

        .container {
            width: 100%;
            max-width: 1400px; /* Maksimal lebar sedikit lebih besar */
            margin: 20px auto;
            background-color: white;
            padding: 30px; /* Padding lebih besar */
            border-radius: 12px; /* Sudut lebih membulat */
            box-shadow: var(--card-shadow); /* Shadow dinamis */
            transition: box-shadow 0.3s ease; /* Transisi shadow */
        }
        .container:hover {
            box-shadow: var(--hover-shadow);
        }

        h3 {
            text-align: center;
            color: var(--secondary-color); /* Warna judul lebih berkelas */
            margin-bottom: 30px; /* Jarak bawah lebih lega */
            font-weight: 600; /* Lebih tebal */
            font-size: 2.2rem; /* Ukuran lebih besar */
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
        }
        h3 strong {
            color: var(--primary-color); /* Nama petugas highlight */
        }

        /* Summary Boxes (cards) */
        .row {
            display: flex;
            flex-wrap: wrap; /* Mengatasi wrapping di mobile */
            justify-content: center; /* Posisikan di tengah */
            gap: 20px; /* Jarak antar kotak */
            margin-bottom: 30px;
        }

        .col-md-4 { /* Menggunakan flexbox, jadi col-md-4 lebih mudah diatur */
            flex: 1 1 calc(33.333% - 20px); /* 3 kolom per baris dengan gap */
            max-width: calc(33.333% - 20px);
            min-width: 280px; /* Batasan lebar minimum untuk mobile */
            box-sizing: border-box; /* Pastikan padding masuk hitungan lebar */
        }

        .summary-card {
            background-color: white; /* Latar belakang putih untuk kartu */
            color: var(--dark-text); /* Teks gelap di dalam kartu */
            border-radius: 10px;
            padding: 25px; /* Padding lebih besar */
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animasi hover */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%; /* Pastikan semua kartu punya tinggi sama */
        }
        .summary-card:hover {
            transform: translateY(-5px); /* Efek melayang */
            box-shadow: var(--hover-shadow);
        }
        .summary-card h5 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-weight: 500;
            color:rgb(1, 5, 8); /* Warna teks judul kartu */
            display: flex;
            align-items: center;
            gap: 8px; /* Jarak antara ikon dan teks */
        }
        .summary-card h3 {
            font-size: 2.5rem; /* Ukuran angka lebih besar */
            margin: 0;
            font-weight: 700;
            color:rgb(1, 5, 8); /* Warna teks judul kartu */
        }
        /* Warna spesifik untuk angka di kartu */
      
        /* Select and Button Styling */
        .select-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px; /* Jarak antar elemen lebih besar */
            margin-bottom: 30px;
            padding: 15px;
            background-color: var(--light-bg);
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.06); /* Inset shadow */
        }
        .select-container label {
            margin: 0; /* Hapus margin kanan */
            font-weight: 600;
            color: var(--dark-text);
            white-space: nowrap; /* Mencegah label putus baris */
        }
        .select-container select {
            flex-grow: 1; /* Dropdown bisa memanjang */
            padding: 10px 15px; /* Padding lebih nyaman */
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: white;
            font-size: 1rem;
            color: var(--dark-text);
            appearance: none; /* Sembunyikan panah default */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236c757d'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
            cursor: pointer;
        }
        .select-container select:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        .btn-validasi {
            padding: 10px 25px; /* Tombol lebih besar */
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            white-space: nowrap;
            background-color: var(--secondary-color); /* Biru untuk tampilkan */
            color: white;
            box-shadow: 0 2px 5px rgba(0, 123, 255, 0.2);
        }
        .btn-validasi:hover {
            background-color: #0056b3; /* Darker blue on hover */
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
            transform: translateY(-1px);
        }


        /* Table Styling */
        .table-responsive {
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden; /* Sembunyikan overflow untuk sudut tabel */
            box-shadow: var(--card-shadow);
        }
        table {
            width: 100%;
            border-collapse: separate; /* Untuk border-radius */
            border-spacing: 0; /* Menghilangkan spasi default */
            background-color: white;
        }
        th, td {
            padding: 15px; /* Padding lebih lega */
            text-align: left;
            border-bottom: 1px solid var(--border-color); /* Hanya border bawah */
        }
        th {
            background-color: var(--secondary-color); /* Header biru */
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        /* Style untuk sudut tabel */
        th:first-child { border-top-left-radius: 8px; }
        th:last-child { border-top-right-radius: 8px; }
        tr:last-child td { border-bottom: none; } /* Hapus border bawah pada baris terakhir */

        tbody tr:nth-child(even) {
            background-color: #f6f6f6; /* Warna zebra untuk baris */
        }
        tbody tr:hover {
            background-color: #e9ecef; /* Hover effect pada baris */
            cursor: pointer;
        }

        /* Action Buttons in Table */
        .action-cell .btn-validasi,
        .action-cell .btn-tolak {
            padding: 7px 14px;
            font-size: 0.85rem;
            border-radius: 5px;
            font-weight: 500;
            margin: 3px; /* Jarak antar tombol */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .action-cell .btn-validasi {
            background-color: var(--primary-color);
            color: white;
        }
        .action-cell .btn-validasi:hover {
            background-color: #36a43e; /* Darker green */
            transform: translateY(-1px);
        }
        .action-cell .btn-tolak {
            background-color: var(--danger-color);
            color: white;
        }
        .action-cell .btn-tolak:hover {
            background-color: #c82333; /* Darker red */
            transform: translateY(-1px);
        }

        /* Status Styling */
        .status-disetujui {
            color: var(--primary-color);
            font-weight: 600;
            background-color: rgba(76, 175, 80, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block; /* Agar padding dan border berlaku */
        }
        .status-ditolak {
            color: var(--danger-color);
            font-weight: 600;
            background-color: rgba(220, 53, 69, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .status-cell {
            text-transform: capitalize; /* Otomatis kapitalisasi status */
        }

        /* Image Preview */
        .img-preview {
            max-width: 80px; /* Ukuran gambar lebih kecil */
            height: auto;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        .img-preview:hover {
            transform: scale(1.05); /* Efek zoom ringan */
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #777;
            padding: 20px;
            font-size: 1.1rem;
        }

        /* Responsive Table (Card-like layout on small screens) */
        @media (max-width: 992px) { /* Ubah breakpoint agar lebih responsif */
            .col-md-4 {
                flex: 1 1 calc(50% - 20px); /* 2 kolom di tablet */
                max-width: calc(50% - 20px);
            }
        }
        @media (max-width: 768px) {
            body { padding: 10px 0; }
            .container { padding: 20px; margin: 10px auto; border-radius: 8px; }
            h3 { font-size: 1.8rem; margin-bottom: 20px; }
            .row { gap: 15px; }
            .col-md-4 {
                flex: 1 1 100%; /* 1 kolom di mobile */
                max-width: 100%;
            }
            .summary-card { padding: 20px; }

            .select-container { flex-direction: column; align-items: stretch; padding: 10px; gap: 10px; }
            .select-container label { text-align: left; width: 100%; }
            .select-container select, .select-container button { width: 100%; }

            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px; /* Sembunyikan thead secara visual */
            }
            tr {
                border: 1px solid var(--border-color);
                margin-bottom: 15px;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            }
            td {
                border: none; /* Hapus border antar sel */
                position: relative;
                padding-left: 50%; /* Ruang untuk label */
                text-align: right;
                font-size: 0.95rem;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px; /* Jarak label dari kiri */
                width: calc(50% - 30px);
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: 600;
                color: #6c757d;
            }
            .action-cell {
                text-align: center; /* Tombol aksi di tengah */
                padding: 15px;
                border-top: 1px dashed var(--border-color); /* Pemisah visual */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Inisialisasi variabel untuk nama petugas yang dipilih
    $selected_petugas_name = "Semua Petugas"; // Default value

    // Periksa apakah ada user_id_pegawai yang dipilih dari request GET
    // Ini akan terisi jika form disubmit dengan method GET
    // Menggunakan $selected_user_id_for_dropdown yang dikirim dari controller
    if (isset($selected_user_id_for_dropdown) && !empty($selected_user_id_for_dropdown)) {
        $selected_user_id = $selected_user_id_for_dropdown;
        // Cari nama petugas berdasarkan user_id yang dipilih dari $users array
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['user_id'] == $selected_user_id) {
                    $selected_petugas_name = $user['nama'];
                    break; // Keluar dari loop jika nama ditemukan
                }
            }
        }
    }
    ?>
    <h3>Validasi Kinerja Petugas: <strong><?= $selected_petugas_name; ?></strong></h3>

    <?php
    // Variabel-variabel ini sekarang seharusnya berasal dari controller
    // $total_kegiatan_db, $belum_validasi_db, $ditolak_db
    // Pastikan controller Anda mengirimkan variabel-variabel ini.
    // Jika masih menggunakan perhitungan di view, pastikan $kinerja_data tidak kosong.
    $sudah_validasi = 0; // Inisialisasi ulang jika perhitungan masih di sini
    $belum_validasi = 0;
    $ditolak = 0;
    $total_data = 0;

    if (!empty($kinerja_data)) {
        foreach ($kinerja_data as $r) {
            $status = isset($r->status) ? strtolower(trim($r->status)) : '';

            if ($status === 'disetujui') {
                $sudah_validasi++;
            } elseif ($status === 'ditolak') {
                $ditolak++;
            } else {
                $belum_validasi++;
            }
        }
        $total_data = count($kinerja_data);
        // Variabel $selesai ini tidak lagi digunakan, tetapi biarkan jika ada kekhawatiran kompatibilitas
        if ($total_data > 0 && $sudah_validasi === $total_data) {
            $selesai = '✔️ ' . $sudah_validasi;
        } else {
            $selesai = $sudah_validasi . ' dari ' . $total_data;
        }
    } else {
        $selesai = '0';
    }
    // Jika Anda sudah migrasi perhitungan ke controller, Anda bisa menghapus blok PHP ini.
    // Gunakan variabel: $total_kegiatan_db, $belum_validasi_db, $ditolak_db.
    // Untuk saat ini, saya biarkan keduanya sebagai fallback.
    $display_total_kegiatan = isset($total_kegiatan_db) ? $total_kegiatan_db : $total_data;
    $display_belum_validasi = isset($belum_validasi_db) ? $belum_validasi_db : $belum_validasi;
    $display_ditolak = isset($ditolak_db) ? $ditolak_db : $ditolak;
    ?>


    <div class="row">
        <div class="col-md-4">
            <div class="summary-card bg-success">
                <h5><i class="fas fa-tasks"></i> Total Kegiatan</h5> <h3><?= $display_total_kegiatan; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card bg-warning">
                <h5><i class="fas fa-hourglass-half"></i> Belum Validasi</h5> <h3><?= $display_belum_validasi; ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card bg-danger">
                <h5><i class="fas fa-times-circle"></i> Ditolak</h5> <h3><?= $display_ditolak; ?></h3>
            </div>
        </div>
    </div>

    <form method="get" action="<?= base_url('pengawas/index'); ?>">
        <div class="select-container">
            <label for="user_id_pegawai">Pilih Pegawai yang akan divalidasi:</label>
            <select name="user_id_pegawai" id="user_id_pegawai">
                <option value="">--Silahkan Pilih Nama--</option>
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user['user_id']; ?>" <?= (isset($selected_user_id_for_dropdown) && $selected_user_id_for_dropdown == $user['user_id']) ? 'selected' : ''; ?>>
                            <?= $user['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option value="">Tidak ada pegawai yang diawasi</option>
                <?php endif; ?>
            </select>
            <button type="submit" class="btn-validasi">Tampilkan</button>
        </div>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hari / Tanggal</th>
                    <th>Pukul</th>
                    <th>Kegiatan</th>
                    <th>Dokumentasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kinerja_data)) : $no = 1; ?>
                    <?php foreach ($kinerja_data as $row) : ?>
                        <tr data-id="<?= $row->id; ?>">
                            <td data-label="No"><?= $no++; ?></td>
                            <td data-label="Hari / Tanggal"><?= date('d-m-Y', strtotime($row->tanggal)); ?></td>
                            <td data-label="Pukul"><?= date('H:i', strtotime($row->jam_mulai)) . " - " . date('H:i', strtotime($row->jam_selesai)); ?></td>
                            <td data-label="Kegiatan"><?= htmlspecialchars($row->kinerja); ?></td>
                            <td data-label="Dokumentasi">
                                <?php if (!empty($row->foto)) : ?>
                                    <img src="<?= base_url('uploads/kinerja/' . $row->foto); ?>" class="img-preview" alt="Dokumentasi Kegiatan">
                                <?php else : ?>
                                    <p>Tidak ada foto</p>
                                <?php endif; ?>
                            </td>
                            <td data-label="Status" class="status-cell">
                                <?php
                                $status_text = htmlspecialchars($row->status ?? '');
                                $status_class = '';
                                if (strtolower($status_text) === 'disetujui') {
                                    $status_class = 'status-disetujui';
                                } elseif (strtolower($status_text) === 'ditolak') {
                                    $status_class = 'status-ditolak';
                                }
                                ?>
                                <span class="<?= $status_class; ?>"><?= $status_text; ?></span>
                            </td>
                            <td data-label="Aksi" class="action-cell">
                                <?php if (strtolower($row->status) == 'belum validasi') : ?>
                                    <button type="button" data-id="<?= $row->id; ?>" data-status="Disetujui" class="btn-validasi validate-action">Validasi</button>
                                    <button type="button" data-id="<?= $row->id; ?>" data-status="Ditolak" class="btn-tolak validate-action">Tolak</button>
                                <?php else : ?>
                                    <span class="status-message <?= $status_class; ?>">Sudah Diverifikasi</span> <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="7" class="no-data">Tidak ada data kinerja tersedia.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-..." crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $('.validate-action').click(function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var userIdPegawai = $('#user_id_pegawai').val();
        var rowElement = $('tr[data-id="' + id + '"]'); // Tangkap elemen baris

        $.ajax({
            url: '<?= base_url('pengawas/proses_validasi/'); ?>' + id,
            type: 'POST',
            data: { status: status, user_id_pegawai: userIdPegawai },
            dataType: 'json',
            beforeSend: function() {
                // Tampilkan loading spinner atau disable tombol
                rowElement.find('.validate-action').prop('disabled', true).text('Memproses...');
            },
            success: function(response) {
                console.log("Respons dari server:", response);

                if (response.status === 'success') {
                    var newStatus = response.updated_status;
                    var statusClass = '';
                    if (newStatus.toLowerCase() === 'disetujui') {
                        statusClass = 'status-disetujui';
                    } else if (newStatus.toLowerCase() === 'ditolak') {
                        statusClass = 'status-ditolak';
                    }

                    // Update tampilan tabel langsung tanpa refresh
                    rowElement.find('.status-cell').html('<span class="' + statusClass + '">' + newStatus + '</span>');
                    rowElement.find('.action-cell').html('<span class="status-message ' + statusClass + '">Sudah Diverifikasi</span>');

                    // Opsional: Perbarui summary boxes jika perlu (membutuhkan AJAX call terpisah atau data dari respons)
                    // Untuk saat ini, kita biarkan refresh halaman untuk update summary.
                    // Jika Anda ingin update dinamis, controller harus mengembalikan data summary yang diperbarui juga.
                    location.reload(); // Refresh halaman untuk update summary boxes dan dropdown

                } else {
                    alert('Gagal melakukan validasi: ' + response.message);
                    rowElement.find('.validate-action').prop('disabled', false).text('Validasi'); // Aktifkan kembali
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert('Terjadi kesalahan saat memproses permintaan. Mohon coba lagi.');
                rowElement.find('.validate-action').prop('disabled', false).text('Validasi'); // Aktifkan kembali
            }
        });
    });
});
</script>
</body>
</html>