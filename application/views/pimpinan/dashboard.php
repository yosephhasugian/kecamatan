<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kinerja Pimpinan</title>

    <!-- Bootstrap & DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- jQuery & DataTables JS -->
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

        h3 { color: #333; font-weight: bold; text-align: center; }
        table { width: 100% !important; }
        thead { background: #007bff; color: white; }
        th, td { text-align: center; vertical-align: middle; }

        /* Membuat tabel lebih responsif */
        .table-responsive { 
            overflow-x: auto; 
            width: 100%;
        }

        /* Gaya DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #2c3e50 !important;
            color: white !important;
            border-radius: 5px;
            padding: 6px 12px;
            margin: 5px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #1a252f !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <h3 class="text-center"><i class="fas fa-chart-line"></i> LAPORAN KINERJA PETUGAS</h3>

        <!-- Tampilkan periode hanya jika user sudah memilih -->
        <?php if (!empty($periode)) : ?>
            <p><strong>Periode:</strong> <?= $periode; ?></p>
        <?php endif; ?>

        <hr>

        <h4><i class="fas fa-clipboard-list"></i> Pilih Bulan dan Tahun </h4>
        <form method="GET" action="<?= base_url('pimpinan'); ?>" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <select name="bulan" class="form-control">
                <option value="">Pilih Bulan</option>
                <?php 
                for ($i = 1; $i <= 12; $i++) {
                    $selected = (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="tahun" class="form-control">
                <option value="">Pilih Tahun</option>
                <?php
                $tahun_sekarang = date('Y');
                for ($i = $tahun_sekarang - 3; $i <= $tahun_sekarang; $i++) {
                    $selected = (isset($_GET['tahun']) && $_GET['tahun'] == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tampilkan</button>
        </div>
    </div>
</form>

        <div class="table-responsive">
            <table id="tabelKinerja" class="table table-hover table-bordered display nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Pengawas</th>
                        <th>Pengisian Kinerja</th>
                        <th>Sudah Validasi</th>
                        <th>Belum Validasi</th>
                        <th>Ditolak</th>
                        <th>Status</th>
                        <th>Lihat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (!empty($rekap)) :
                        $no = 1;
                        foreach ($rekap as $row) :
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row->nama); ?></td>
                        <td><?= htmlspecialchars($row->jabatan); ?></td>
                        <td><?= htmlspecialchars($row->nama_pengawas); ?></td>
                        <td><?= $row->jumlah_hari ?? 0; ?> Kegiatan</td>
                        <td><span class="badge bg-success"><?= $row->sudah_validasi ?? 0; ?> Hari</span></td>
                        <td><span class="badge bg-warning"><?= $row->belum_validasi ?? 0; ?> Hari</span></td>
                        <td><span class="badge bg-danger"><?= $row->ditolak ?? 0; ?> Hari</span></td>
                        <td>
                            <?php if ($row->jumlah_hari == $row->sudah_validasi) : ?>
                                <span class="badge bg-primary">Selesai</span>
                            <?php else : ?>
                                <span class="badge bg-secondary">Belum</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('pimpinan/detail_kinerja/' . $row->user_id); ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr><td colspan="10" class="text-center"><b>Tidak ada data tersedia</b></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#tabelKinerja').DataTable({
        "responsive": true,
        "scrollX": true,
        "autoWidth": false,
        "fixedHeader": true, // Header tetap saat scroll
        "pageLength": 10, // Default jumlah baris per halaman
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]], // Opsi jumlah baris
        "language": {
            "search": "🔍 Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            "paginate": { "previous": "⬅️", "next": "➡️" }
        }
    });
});
</script>

</body>
</html>
