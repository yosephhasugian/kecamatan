<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="card-title">Tambah Jabatan</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('Admin/simpan_jabatan'); ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Jabatan Pegawai</label>
                    <input type="text" name="nama_jabatan" class="form-control" required>
                </div>
                                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="<?= base_url('admin/index_jabatan'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
