<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kinerja</title>

    <!-- Bootstrap & DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>

    <style>
        body { background: linear-gradient(135deg, #2c3e50, #34495e); color: white; }
        .container { margin-top: 20px; }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            color: black;
        }
        h3 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            border: none;
            margin-bottom: 15px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        .img-preview {
            width: 60px;
            height: auto;
            border-radius: 6px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }

        .status-disetujui { background-color: #28a745; color: white; }
        .status-pending   { background-color: #ffc107; color: black; }
        .status-ditolak   { background-color: #dc3545; color: white; }

        table.dataTable td, table.dataTable th {
            white-space: nowrap;
            text-align: center;
            vertical-align: middle;
        }

        @media (max-width: 768px) {
            .btn-back {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <h3>Detail Kinerja Petugas</h3>
        <button onclick="history.back()" class="btn btn-back mb-3"><i class="fas fa-arrow-left"></i> Kembali</button>

        <div class="table-responsive">
            <table id="tabelKinerja" class="table table-striped table-bordered nowrap w-100">
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
                    foreach ($kinerja_data as $row) : ?>
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
                                <?php 
                                $status = !empty($row['status']) ? $row['status'] : 'Pending'; 
                                ?>
                                <span class="status-badge 
                                    <?= ($status == 'Disetujui') ? 'status-disetujui' : (($status == 'Pending') ? 'status-pending' : 'status-ditolak'); ?>">
                                    <?= $status; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tabelKinerja').DataTable({
        responsive: true,
        scrollX: true,
        fixedHeader: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            paginate: { previous: "⬅️", next: "➡️" }
        }
    });
});
</script>
</body>
</html>
