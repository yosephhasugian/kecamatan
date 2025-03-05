<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Edit Pegawai</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pegawai/update/' . $pegawai['id']); ?>" method="post">
                <input type="hidden" name="id" value="<?= $pegawai['id']; ?>">
                
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $pegawai['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID PJLP</label>
                            <input type="text" name="id_pjlp" class="form-control" value="<?= $pegawai['id_pjlp']; ?>" required>
                        </div>

                        <!-- Pilihan Jabatan -->
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <?php foreach ($jabatan as $j) : ?>
                                    <option value="<?= $j['id']; ?>" <?= ($pegawai['jabatan'] == $j['id']) ? 'selected' : ''; ?>>
                                        <?= $j['nama_jabatan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Pilihan Pengawas -->
                        <div class="mb-3">
                            <label class="form-label">Pengawas</label>
                            <select name="pengawas" class="form-control">
                                <option value="">-- Pilih Pengawas --</option>
                                <?php foreach ($pengawas as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?= ($pegawai['id_pengawas'] == $p['id']) ? 'selected' : ''; ?>>
                                        <?= $p['nama_pengawas']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Pilihan Pimpinan -->
                        <div class="mb-3">
                            <label class="form-label">Pimpinan</label>
                            <select name="pimpinan" class="form-control">
                                <option value="">-- Pilih Pimpinan --</option>
                                <?php foreach ($pimpinan as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?= ($pegawai['pimpinan'] == $p['id']) ? 'selected' : ''; ?>>
                                        <?= $p['nama_pimpinan']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">User ID</label>
                            <input type="text" class="form-control" value="<?= $pegawai['user_id']; ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $pegawai['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="admin" <?= ($pegawai['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="pengawas" <?= ($pegawai['role'] == 'pengawas') ? 'selected' : ''; ?>>Pengawas</option>
                                <option value="user" <?= ($pegawai['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                <option value="pimpinan" <?= ($pegawai['role'] == 'pimpinan') ? 'selected' : ''; ?>>Pimpinan</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                <a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
