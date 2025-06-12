<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Kinerja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 1px;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 1500px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .select-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .select-container label {
            margin-right: 10px;
            font-weight: bold;
        }
        .select-container select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            flex-grow: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .btn-validasi, .btn-tolak {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-validasi {
            background-color: #4CAF50;
            color: white;
        }
        .btn-tolak {
            background-color: #f44336;
            color: white;
        }
        .img-preview {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .status-disetujui {
            color: green;
            font-weight: bold;
        }
        .status-ditolak {
            color: red;
            font-weight: bold;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #777;
        }
        .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.select-container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}

.select-container label {
    min-width: 200px;
}

.select-container select,
.select-container button {
    padding: 8px;
    font-size: 1rem;
}


@media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
        width: 100%;
    }

    thead tr {
        display: none; /* Sembunyikan header agar tidak duplikat */
    }

    tr {
        margin-bottom: 15px;
        border-bottom: 2px solid #ccc;
        padding: 10px;
    }

    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        top: 10px;
        font-weight: bold;
        text-align: left;
        white-space: nowrap;
    }
}
    </style>
</head>
<body>

<div class="container">
    <h3>Validasi Kinerja Petugas</h3>

    <form method="post" action="<?= base_url('pengawas/index'); ?>">
    <div class="select-container">
        <label for="user_id_pegawai">Pilih Pegawai yang akan divalidasi:</label>
        <select name="user_id_pegawai" id="user_id_pegawai">
            <option value="">--Silahkan Pilih Nama--</option>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <option value="<?= $user['user_id']; ?>" <?= ($this->input->get('user_id_pegawai') == $user['user_id']) ? 'selected' : ''; ?>>
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
                            <img src="<?= base_url('uploads/kinerja/' . $row->foto); ?>" class="img-preview">
                        <?php else : ?>
                            <p>Tidak ada foto</p>
                        <?php endif; ?>
                    </td>
                    <td data-label="Status" class="status-cell"><?= $row->status; ?></td>
                    <td data-label="Aksi" class="action-cell">
                        <?php if ($row->status == 'Belum Validasi') : ?>
                            <button type="button" data-id="<?= $row->id; ?>" data-status="Disetujui" class="btn-validasi validate-action">Validasi</button>
                            <button type="button" data-id="<?= $row->id; ?>" data-status="Ditolak" class="btn-tolak validate-action">Tolak</button>
                        <?php else : ?>
                            <span class="status-disetujui"><?= $row->status; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr><td colspan="7" class="text-center no-data"><b>Tidak ada data kinerja tersedia</b></td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.validate-action').click(function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var userIdPegawai = $('#user_id_pegawai').val();

        $.ajax({
            url: '<?= base_url('pengawas/proses_validasi/'); ?>' + id,
            type: 'POST',
            data: { status: status, user_id_pegawai: userIdPegawai },
            dataType: 'json',
            success: function(response) {
                console.log("Respons dari server:", response);

                if (response.status === 'success') {
                    // Update tampilan tabel langsung tanpa refresh
                    $('tr[data-id="' + id + '"] .status-cell').text(response.updated_status);
                    $('tr[data-id="' + id + '"] .action-cell').html('<span class="status-disetujui">' + response.updated_status + '</span>');
                } else {
                    alert('Gagal melakukan validasi: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert('Gagal melakukan validasi.');
            }
        });
    });
});
</script>
</body>
</html>