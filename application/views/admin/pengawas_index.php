<!DOCTYPE html>
<html lang="id">
<head>
    <title>Daftar Pengawas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <style>
        .card-header {
            background-color: #003366 !important;
            color: white !important;
            font-weight: bold;
        }

        .btn-success {
            background-color: #FFD700 !important;
            border-color: #FFD700 !important;
            color: black !important;
            font-weight: bold;
        }

        .btn-success:hover {
            background-color: #FFC107 !important;
            border-color: #FFC107 !important;
        }

        .table thead {
            background-color: #003366 !important;
            color: white !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Daftar Pengawas Kecamatan Cempaka Putih</h3>
            <div class="card-tools">
                <a href="<?= base_url('Admin/tambah_pengawas'); ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-user-plus"></i> Tambah Pengawas
                </a>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        <table id="pengawasTable" class="table table-striped table-hover dt-responsive nowrap" style="width:100%">
        <thead class="table-dark">
        
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nip</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pengawas as $pengawas) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pengawas['nama_pengawas']; ?></td>
                            <td><?= $pengawas['nip_pengawas']; ?></td>
                            <td>
                            <a href="<?= base_url('admin/edit_pengawas/'.$pengawas['id']); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                 </a>
                                <a href="<?= base_url('admin/hapus_pengawas/'.$pengawas['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Pengawas ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#pengawasTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>
</body>
</html>