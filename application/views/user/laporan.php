<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kinerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
        }
        .container {
            max-width: 1100px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        h2 {
            text-align: center;
            color: #198754;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #198754;
            color: white;
            text-align: center;
        }
        .btn-custom {
            width: 150px;
        }
        .img-preview {
            max-width: 100px;
            height: auto;
            display: block;
            margin: auto;
        }
        @media print {
            .no-print { display: none; }
            body { background: white; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>LAPORAN KINERJA PETUGAS</h2>
        <div class="row mb-3 no-print">
            <div class="col-md-6">
                <form method="GET" action="<?= base_url('user/Dashboard/print_laporan'); ?>">
                    <div class="input-group mb-3">
                        <label class="input-group-text">Dari</label>
                        <input type="date" class="form-control" name="tanggal_mulai" value="<?= htmlspecialchars($_GET['tanggal_mulai'] ?? '') ?>" required>
                        <label class="input-group-text">Sampai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" value="<?= htmlspecialchars($_GET['tanggal_selesai'] ?? '') ?>" required>
                        <button type="submit" class="btn btn-success">Print</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= base_url('user/dashboard'); ?>" class="btn btn-primary btn-custom">Kembali</a>
              
            </div>
        </div>
        
        <table class="table table-bordered">
            <tr>
                <td><strong>Nama:</strong> <?= htmlspecialchars($user->nama ?? '-') ?></td>
                <td><strong>ID PJLP:</strong> <?= htmlspecialchars($user->id_pjlp ?? '-') ?></td>
            </tr>
            <tr>
                <td><strong>Jabatan:</strong> <?= htmlspecialchars($user->jabatan ?? '-') ?></td>
                <td><strong>Periode:</strong> <?= htmlspecialchars($_GET['tanggal_mulai'] ?? '-') ?> s/d <?= htmlspecialchars($_GET['tanggal_selesai'] ?? '-') ?></td>
            </tr>
            <tr>
                <td><strong>Pengawas:</strong> <?= htmlspecialchars($user->nama_pengawas ?? '-') ?></td>
                <td><strong>Pimpinan:</strong> <?= htmlspecialchars($user->nama_pimpinan ?? '-') ?></td>
            </tr>
        </table>
        
        <table id="dataTable" class="table table-striped table-bordered">
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
                            <td class="text-center"><?= $no++ ?></td>
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
                                    <img src="<?= $src ?>" alt="Dokumentasi" class="img-preview">
                                <?php } else { ?>
                                    <p>Gambar tidak tersedia</p>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center"><b>Tidak ada data kinerja</b></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function printLaporan() {
            window.print();
        }
    </script>
</body>
</html>