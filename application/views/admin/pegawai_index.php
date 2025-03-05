<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pegawai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* --- CARD HEADER (Judul) --- */
        .card-header {
            background-color: #003366 !important; /* Biru Navy */
            color: white !important;
            font-weight: bold;
        }

        /* --- TOMBOL TAMBAH PEGAWAI --- */
        .btn-success {
            background-color: #FFD700 !important; /* Emas */
            border-color: #FFD700 !important;
            color: black !important;
            font-weight: bold;
        }

        .btn-success:hover {
            background-color: #FFC107 !important; /* Emas lebih terang */
            border-color: #FFC107 !important;
        }

        /* --- HEADER TABEL --- */
        .table thead {
            background-color: #003366 !important; /* Biru Navy */
            color: white !important;
        }

        /* --- TABEL RESPONSIVE --- */
        .table-responsive {
            overflow-x: auto;
        }

        /* --- AGAR TEKS TIDAK MELEBAR --- */
        table {
            word-wrap: break-word;
            table-layout: auto;
        }

        th, td {
            white-space: nowrap; /* Mencegah teks pecah */
        }
        .dt-control{
            cursor : pointer;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Daftar Pegawai Unit Pengelola Terminal Terpadu Pulo Gebang</h3>
                <div class="card-tools">
                    <a href="<?= base_url('pegawai/tambah'); ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-user-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>
            <div class="card-body">
            <table id="pegawaiTable" class="table table-striped table-hover" style="width:100%">
        <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>ID PJLP</th>
            <th>Jabatan</th>
            <th>Pengawas</th>
            <th>Pimpinan</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($pegawai as $p) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $p['nama']; ?></td>
                <td><?= $p['id_pjlp']; ?></td>
                <td><?= $p['nama_jabatan'] ?? '-'; ?></td> <!-- Perbaiki jabatan -->
                <td><?= $p['nama_pengawas'] ?? '-'; ?></td> <!-- Tampilkan Nama Pengawas -->
                <td><?= $p['nama_pimpinan'] ?? '-'; ?></td> <!-- Tampilkan Nama Pimpinan -->
                <td><?= $p['username']; ?></td>
                <td><?= ucfirst($p['role']); ?></td>
                <td>
                    <a href="<?= base_url('pegawai/edit/'.$p['id']); ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="<?= base_url('pegawai/hapus/'.$p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">
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
            $('#pegawaiTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>
</body>
</html>