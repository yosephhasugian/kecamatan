<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Kinerja</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f9f9f9; }
        .container { margin-top: 20px; }
        .table-container { background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .img-preview { max-width: 150px; height: auto; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        .container { width: 100%; max-width: 100%; margin: auto; }
        th, td { text-align: center; vertical-align: middle; padding: 10px; border: 1px solid #ddd; }
        .img-preview { max-width: 120px; max-height: 150px; border-radius: 5px; object-fit: cover; }
        .btn-edit { background-color: #ffc107; color: black; border-radius: 5px; padding: 5px 10px; }
        .status-disetujui { background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
        <div class="table-container">
            <h4>Daftar Kinerja</h4>
            <table class="table table-bordered">
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
                                <td><?= $kinerja->kinerja; ?></td>
                                <td>
                                    <?php if (!empty($kinerja->foto) && file_exists(FCPATH . 'uploads/kinerja/' . $kinerja->foto)): ?>
                                        <img src="<?= base_url('uploads/kinerja/' . $kinerja->foto); ?>" class="img-preview">
                                    <?php else: ?>
                                        <small class="text-muted">Tidak ada foto</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($kinerja->status == 'Belum Validasi'): ?>
                                        <span class="badge bg-warning">Belum Validasi</span>
                                    <?php elseif ($kinerja->status == 'Disetujui'): ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php elseif ($kinerja->status == 'Ditolak'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($kinerja->status == 'Belum Validasi'): ?>
                                        <button class="btn btn-warning btn-sm btn-edit" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal"
                                                data-id="<?= $kinerja->id; ?>"
                                                data-tanggal="<?= $kinerja->tanggal; ?>"
                                                data-jam-mulai="<?= $kinerja->jam_mulai; ?>"
                                                data-jam-selesai="<?= $kinerja->jam_selesai; ?>"
                                                data-kinerja="<?= $kinerja->kinerja; ?>">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-hapus" data-id="<?= $kinerja->id; ?>">Hapus</button>
                                    <?php else: ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data kinerja.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
                        <label for="editFoto" class="form-label">Foto (Opsional)</label>
                        <input type="file" class="form-control" id="editFoto" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.btn-edit').click(function() {
            var id = $(this).data('id');
            var tanggal = $(this).data('tanggal');
            var jamMulai = $(this).data('jam-mulai');
            var jamSelesai = $(this).data('jam-selesai');
            var kinerja = $(this).data('kinerja');

            $('#editId').val(id);
            $('#editTanggal').val(tanggal);
            $('#editJamMulai').val(jamMulai);
            $('#editJamSelesai').val(jamSelesai);
            $('#editKinerja').val(kinerja);

            $('#editModal').modal('show');
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.btn-hapus').click(function() {
            var id = $(this).data('id');

            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                $.ajax({
                    url: "<?= base_url('user/Dashboard/hapus_kinerja/'); ?>" + id,
                    type: "POST",
                    success: function(response) {
                        alert("Data berhasil dihapus!");
                        location.reload();
                    },
                    error: function() {
                        alert("Terjadi kesalahan saat menghapus data.");
                    }
                });
            }
        });
    });
    </script>
    </body>
    </html>