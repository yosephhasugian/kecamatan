<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kinerja</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts - Poppins untuk tampilan modern -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <!-- FixedHeader CSS (optional, if you want fixed headers) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap5.min.css">

    <style>
        /* Mengatur font Poppins sebagai font default untuk seluruh body */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Latar belakang yang lebih modern */
            padding-top: 20px; /* Sedikit padding di atas */
            padding-bottom: 20px; /* Sedikit padding di bawah */
        }
        .container {
            max-width: 1400px; /* Lebar maksimal kontainer lebih besar */
        }
        .table-container {
            background-color: #fff;
            padding: 25px; /* Padding lebih besar */
            border-radius: 12px; /* Sudut lebih melengkung */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); /* Bayangan yang lebih lembut dan dalam */
        }
        h4 {
            text-align: center;
            color: #343a40; /* Warna teks lebih gelap */
            margin-bottom: 30px; /* Jarak bawah lebih besar */
            font-weight: 600; /* Sedikit lebih tebal */
        }
        /* Style untuk gambar pratinjau dalam tabel */
        .img-preview {
            max-width: 80px; /* Ukuran gambar yang lebih kecil dan konsisten */
            height: auto;
            border-radius: 6px; /* Sudut lebih melengkung */
            border: 1px solid #e9ecef;
            object-fit: cover; /* Memastikan gambar mengisi area tanpa distorsi */
            display: block; /* Agar margin auto bekerja */
            margin: 0 auto; /* Pusatkan gambar */
        }
        /* Custom Message Box untuk notifikasi */
        #customMessageBox {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050; /* Ensure it's above other elements like modals */
            display: none; /* Hidden by default */
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 90%; /* Responsive width */
        }
        #customMessageBox.show {
            display: block;
            opacity: 1;
        }

        /* Gaya untuk tombol edit/hapus agar responsif */
        .action-buttons {
            display: flex;
            flex-direction: column; /* Tumpuk tombol secara vertikal di mobile */
            gap: 5px; /* Jarak antar tombol */
            align-items: center; /* Pusatkan tombol */
        }
        .action-buttons .btn-sm {
            width: 100%; /* Tombol mengambil lebar penuh di mobile */
        }

        /* Penyesuaian DataTables untuk responsivitas */
        /* Mengatasi lebar minimum agar tidak ada overflow tak terduga */
        #kinerjaTable {
            width: 100% !important; /* Pastikan tabel mengambil lebar penuh kontainer */
        }

        /* Mengatur padding dan warna untuk header dan sel tabel */
        #kinerjaTable th, #kinerjaTable td {
            padding: 12px !important; /* Padding yang konsisten */
            vertical-align: middle;
            text-align: center; /* Sesuaikan sesuai kebutuhan, bisa left jika banyak teks */
        }
        #kinerjaTable thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
        }

        /* Responsive Breakpoints for DataTables */
        @media (max-width: 767.98px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            .table-container {
                padding: 15px;
            }
            h4 {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }
            .action-buttons {
                flex-direction: column; /* Ensure buttons stack vertically */
                align-items: stretch; /* Stretch buttons to full width */
            }
            .img-preview {
                max-width: 60px; /* Smaller image preview on small screens */
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="table-container">
        <h4>Daftar Kinerja</h4>
        <div class="table-responsive"> <!-- Wrapper Bootstrap untuk tabel responsif -->
            <table id="kinerjaTable" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pukul</th>
                        <th>Kegiatan</th>
                        <th>Dokumentasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kinerja_data)): ?>
                        <?php $no = 1; foreach ($kinerja_data as $kinerja): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <?php
                                    $hari_indonesia = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                                    $tanggal = $hari_indonesia[date('w', strtotime($kinerja->tanggal))] . ", " . date('d-m-Y', strtotime($kinerja->tanggal));
                                ?>
                                <td><?= $tanggal; ?></td>
                                <td><?= $kinerja->jam_mulai . " - " . $kinerja->jam_selesai; ?></td>
                                <td><?= htmlspecialchars($kinerja->kinerja); ?></td>
                                <td>
                                    <?php if (!empty($kinerja->foto) && file_exists(FCPATH . 'uploads/kinerja/' . $kinerja->foto)): ?>
                                        <a href="<?= base_url('uploads/kinerja/' . $kinerja->foto); ?>" target="_blank">
                                            <img src="<?= base_url('uploads/kinerja/' . $kinerja->foto); ?>" class="img-preview" alt="Foto Dokumentasi">
                                        </a>
                                    <?php else: ?>
                                        <small class="text-muted">Tidak ada foto</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($kinerja->status == 'Belum Validasi'): ?>
                                        <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half me-1"></i>Belum Validasi</span>
                                    <?php elseif ($kinerja->status == 'Disetujui'): ?>
                                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Disetujui</span>
                                    <?php elseif ($kinerja->status == 'Ditolak'): ?>
                                        <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($kinerja->status == 'Belum Validasi'): ?>
                                        <div class="action-buttons">
                                            <button type="button" class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal"
                                                    data-id="<?= $kinerja->id; ?>"
                                                    data-tanggal="<?= $kinerja->tanggal; ?>"
                                                    data-jam-mulai="<?= $kinerja->jam_mulai; ?>"
                                                    data-jam-selesai="<?= $kinerja->jam_selesai; ?>"
                                                    data-kinerja="<?= htmlspecialchars($kinerja->kinerja); ?>"
                                                    data-foto="<?= base_url('uploads/kinerja/' . $kinerja->foto); ?>">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm btn-hapus" data-id="<?= $kinerja->id; ?>">
                                                <i class="fas fa-trash-alt me-1"></i>Hapus
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <?php
                                            $status_class = '';
                                            $icon_class = '';
                                            if ($kinerja->status == 'Disetujui') {
                                                $status_class = 'bg-success';
                                                $icon_class = 'fas fa-check-circle';
                                            } elseif ($kinerja->status == 'Ditolak') {
                                                $status_class = 'bg-danger';
                                                $icon_class = 'fas fa-times-circle';
                                            }
                                        ?>
                                        <span class="badge <?= $status_class; ?>">
                                            <i class="<?= $icon_class; ?> me-1"></i><?= $kinerja->status; ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center text-muted">Tidak ada data kinerja.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Kinerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="<?= base_url('user/Dashboard/update_kinerja'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="editTanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="editTanggal" name="tanggal" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editJamMulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="editJamMulai" name="jam_mulai">
                    </div>
                    <div class="mb-3">
                        <label for="editJamSelesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" id="editJamSelesai" name="jam_selesai">
                    </div>
                    <div class="mb-3">
                        <label for="editKinerja" class="form-label">Kegiatan</label>
                        <textarea class="form-control" id="editKinerja" name="kinerja" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label><br>
                        <img id="currentFotoPreview" src="" alt="Foto Dokumentasi" class="img-fluid rounded mb-2" style="max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="editFoto" class="form-label">Upload Foto Baru (Opsional)</label>
                        <input type="file" class="form-control" id="editFoto" name="foto" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff,.svg,.webp,.pdf">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom Message Box for alerts (replaces browser's alert) -->
<div id="customMessageBox" class="alert position-fixed top-0 start-50 translate-middle-x mt-3 fade show" role="alert" style="display: none;">
    <!-- Message will be inserted here -->
</div>

<!-- jQuery & DataTables JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Function to show a custom message (replaces native alert/confirm)
    function showCustomMessage(message, type = 'success') {
        const msgBox = $('#customMessageBox');
        msgBox.removeClass('alert-success alert-danger alert-warning alert-info').addClass('alert-' + type).text(message);
        msgBox.fadeIn().delay(3000).fadeOut(); // Fade in, then fade out after 3 seconds
    }

    // Inisialisasi DataTables
    $('#kinerjaTable').DataTable({
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Semua"] ], // Opsi jumlah data per halaman
        "responsive": true, // Aktifkan responsivitas
        "language": { // Terjemahan untuk DataTables
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
        }
    });

    // Event handler untuk tombol Edit
    $('#kinerjaTable').on('click', '.btn-warning', function() {
        var id = $(this).data('id');
        var tanggal = $(this).data('tanggal');
        var jamMulai = $(this).data('jam-mulai');
        var jamSelesai = $(this).data('jam-selesai');
        var kinerja = $(this).data('kinerja');
        var foto = $(this).data('foto');

        $('#editId').val(id);
        $('#editTanggal').val(tanggal);
        $('#editJamMulai').val(jamMulai);
        $('#editJamSelesai').val(jamSelesai);
        $('#editKinerja').val(kinerja);

        // Tampilkan gambar saat ini jika ada
        if (foto && foto !== '<?= base_url('uploads/kinerja/'); ?>') {
            $('#currentFotoPreview').attr('src', foto).show();
        } else {
            $('#currentFotoPreview').hide();
        }
        $('#editModal').modal('show');
    });

    // Event handler untuk tombol Hapus
    $('#kinerjaTable').on('click', '.btn-hapus', function() {
        var id = $(this).data('id');

        // Menggunakan modal konfirmasi kustom sebagai ganti confirm()
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            $.ajax({
                url: "<?= base_url('user/Dashboard/hapus_kinerja/'); ?>" + id,
                type: "POST",
                // Tambahkan CSRF token jika diperlukan oleh CodeIgniter
                data: { '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>' },
                success: function(response) {
                    showCustomMessage("Data berhasil dihapus!", 'success');
                    // Muat ulang halaman setelah penghapusan berhasil
                    // Atau, lebih baik: hapus baris dari tabel secara dinamis tanpa reload halaman
                    // $('#kinerjaTable').DataTable().row($('tr[data-id="' + id + '"]')).remove().draw();
                    location.reload(); // Untuk kemudahan, tetap reload halaman
                },
                error: function() {
                    showCustomMessage("Terjadi kesalahan saat menghapus data.", 'danger');
                }
            });
        }
    });

    // Reset form edit saat modal ditutup
    $('#editModal').on('hidden.bs.modal', function () {
        $('#editForm')[0].reset();
        $('#currentFotoPreview').hide().attr('src', ''); // Sembunyikan dan kosongkan gambar pratinjau
        $('#editFoto').val(''); // Kosongkan input file
    });

});
</script>
</body>
</html>
