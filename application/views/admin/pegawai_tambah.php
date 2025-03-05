<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3 class="card-title">Tambah Pegawai</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pegawai/simpan'); ?>" method="post">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID PJLP</label>
                            <input type="text" name="id_pjlp" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <?php if (!empty($jabatan)) : ?>
                                    <?php foreach ($jabatan as $j) : ?>
                                        <option value="<?= $j['id'] ?? ''; ?>"><?= $j['nama_jabatan'] ?? ''; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="">Tidak ada data jabatan</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pengawas</label>
                            <select name="pengawas" class="form-control">
                                <option value="">-- Pilih Pengawas --</option>
                                <?php if (!empty($pengawas)) : ?>
                                    <?php foreach ($pengawas as $p) : ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['nama_pengawas']; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="">Tidak ada data pengawas</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Pimpinan</label>
                            <select name="pimpinan" class="form-control">
                                <option value="">-- Pilih Pimpinan --</option>
                                <?php if (!empty($pimpinan)) : ?>
                                    <?php foreach ($pimpinan as $p) : ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['nama_pimpinan']; ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="">Tidak ada data pimpinan</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="pengawas">Pengawas</option>
                                <option value="user">User</option>
                                <option value="pimpinan">Pimpinan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
