<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update'); ?>" method="post">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Pimpinan </label>
                    <input type="text" name="nama_pimpinan" class="form-control" value="<?= $user['nama_pimpinan']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nip Pimpinan</label>
                    <input type="text" name="nip_pimpinan" class="form-control" value="<?= $user['nip_pimpinan']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="satuan" class="form-control" value="<?= $user['satuan']; ?>" required>
                </div>

                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="<?= base_url('admin'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
