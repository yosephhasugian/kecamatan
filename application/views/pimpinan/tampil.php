<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kinerja</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        body { background-color: #f4f7fc; }
        .container { margin-top: 30px; }
        .table-container { background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1); }
        .table thead { background-color: #007bff; color: white; }
        .table tbody tr:hover { background-color: #f1f1f1; }
        .img-preview { max-width: 120px; height: 120px; border-radius: 5px; object-fit: cover; }
        .status-badge { padding: 5px 10px; border-radius: 5px; font-weight: bold; }
        .status-disetujui { background-color: #28a745; color: white; }
        .status-pending { background-color: #ffc107; color: black; }
        .status-ditolak { background-color: #dc3545; color: white; }
        .header-container { display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <!-- Header dengan tombol kembali -->
        <div class="header-container mb-3">
            <h3>Detail Kinerja Petugas</h3>
            <button onclick="history.back()" class="btn btn-danger">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kinerja</th>
                    <th>Foto</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($kinerja_data as $row) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['tanggal']; ?></td>
                        <td><?= $row['jam_mulai']; ?></td>
                        <td><?= $row['jam_selesai']; ?></td>
                        <td><?= $row['kinerja']; ?></td>
                        <td>
                            <?php if (!empty($row['foto']) && file_exists(FCPATH . 'uploads/kinerja/' . $row['foto'])): ?>
                                <img src="<?= base_url('uploads/kinerja/' . $row['foto']); ?>" class="img-preview">
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/default.png'); ?>" class="img-preview">
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'Disetujui') { ?>
                                <span class="status-badge status-disetujui">Disetujui</span>
                            <?php } elseif ($row['status'] == 'Pending') { ?>
                                <span class="status-badge status-pending">Pending</span>
                            <?php } else { ?>
                                <span class="status-badge status-ditolak">Ditolak</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
