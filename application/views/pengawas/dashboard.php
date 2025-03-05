<?php
// Hitung periode yang bisa divalidasi (minimal 2 bulan sebelumnya)
$bulan_validasi = date('m', strtotime('-1 months'));
$tahun_validasi = date('Y', strtotime('-1 months'));

// Nama bulan dalam format bahasa Indonesia
$nama_bulan = date('F', mktime(0, 0, 0, $bulan_validasi, 1));
$periode_valid = "$nama_bulan $tahun_validasi";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kinerja Pimpinan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <style>
        .status-disetujui { color: green; font-weight: bold; }
        .status-belum { color: orange; font-weight: bold; }
        .status-ditolak { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
        <h3 class="text-center"><i class="fas fa-chart-line"></i> LAPORAN KINERJA PETUGAS</h3>
        <p><strong>Periode yang bisa divalidasi:</strong> <?= $periode_valid; ?></p>

        <hr>

        <h4><i class="fas fa-clipboard-list"></i> Rekap Kinerja</h4>
        <form method="GET" action="<?= base_url('pengawas/dashboard'); ?>" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="bulan" class="form-control">
                        <?php 
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ($i == $bulan_validasi) ? 'selected' : '';
                            echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="tahun" class="form-control">
                        <?php
                        $tahun_sekarang = date('Y');
                        for ($i = $tahun_sekarang - 3; $i <= $tahun_sekarang; $i++) {
                            $selected = ($i == $tahun_validasi) ? 'selected' : '';
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
       
        <table id="tabelKinerja" class="table table-hover table-bordered">
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
                </tr>
            </thead>
            <tbody>
    <?php 
    if (!empty($rekap)) :
        $no = 1;
        foreach ($rekap as $row) :
    ?>
    <tr>
        <td class="text-center"><?= $no++; ?></td>
        <td><?= htmlspecialchars($row->nama); ?></td>
        <td><?= htmlspecialchars($row->jabatan); ?></td>
        <td><?= htmlspecialchars($row->nama_pengawas); ?></td>
        <td class="text-center"><?= $row->jumlah_hari ?? 0; ?> Kegiatan</td>
        <td class="text-center"><span class="status-disetujui"><?= $row->sudah_validasi ?? 0; ?> Hari</span></td>
        <td class="text-center"><span class="status-belum"><?= $row->belum_validasi ?? 0; ?> Hari</span></td>
        <td class="text-center"><span class="status-ditolak"><?= $row->ditolak ?? 0; ?> Hari</span></td>
        <td class="text-center">
            <?php if ($row->jumlah_hari == $row->sudah_validasi) : ?>
                <span class="status-disetujui">Selesai</span>
            <?php else : ?>
                <span class="status-belum">Belum Selesai</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php else : ?>
    <tr><td colspan="9" class="text-center"><b>Tidak ada data tersedia</b></td></tr>
    <?php endif; ?>
</tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    if ($("#tabelKinerja tbody tr").length > 1) { // Pastikan ada lebih dari 1 baris (bukan header saja)
        $('#tabelKinerja').DataTable({
            "language": {
                "search": "🔍 Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                "paginate": { "previous": "⬅️", "next": "➡️" }
            }
        });
    } else {
        console.warn("Tabel kosong, DataTables tidak diinisialisasi.");
    }
});
</script>
</body>
</html>
