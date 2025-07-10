<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Edit Pengawas..</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update_pengawas/' . $pengawas['id']); ?>" method="post">
                <input type="hidden" name="id" value="<?= $pengawas['id']; ?>">
                
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Pengawas</label>
                            <input type="text" name="nama_pengawas" class="form-control" value="<?= $pengawas['nama_pengawas']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIP Pengawas</label>
                            <input type="text" name="nip_pengawas" class="form-control" value="<?= $pengawas['nip_pengawas']; ?>" required>
                        </div>

                        
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                <a href="<?= base_url('pengawas'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
