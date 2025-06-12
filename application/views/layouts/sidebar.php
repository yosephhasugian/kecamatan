<?php
$role = $this->session->userdata('role');
if (isset($role)) {
    // print_r($role); // Debugging
} else {
    $role = ''; // Default role jika tidak terdefinisi
}
?>

<style>
/* Styling Sidebar */
.main-sidebar {
    background-color: #003366 !important; /* Warna biru navy DISHUB */
    color: white;
}

.sidebar a {
    color: white !important;
    font-weight: bold;
    transition: 0.3s;
}

.sidebar a:hover {
    background-color: #0055A4 !important; /* Biru lebih terang untuk hover */
    color: #FFD700 !important; /* Warna emas */
}


.brand-text {
    font-size: 18px;
    font-weight: bold;
    color: white;
    margin-left: 15px;
}

/* Efek Hover pada Menu */
.nav-sidebar .nav-item .nav-link {
    color: white;
    font-weight: 500;
    transition: 0.3s ease-in-out;
    border-radius: 6px;
    margin: 5px 10px;
}

.nav-sidebar .nav-item .nav-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.05);
}

.nav-sidebar .nav-item .nav-link.active {
    background: rgba(255, 255, 255, 0.3);
}

/* Ikon Warna */
.nav-icon {
    color: #f8c291; /* Warna ikon */
}

/* Header */
.nav-header {
    font-size: 14px;
    font-weight: bold;
    color: #f8c291;
    padding: 10px;
}
</style>


<aside class="main-sidebar sidebar-dark-info elevation-4">
    <img src="<?= base_url('assets/dist/img/AdminLTELogo.png'); ?>" alt="Admin Logo" style="width: 50px; margin-left: 10px; margin-top: 10px;">
    <span class="brand-text font-weight-light" style="margin-left: 10px; color: white;">e-Kinerja</span>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <?php if ($role === 'admin'): ?>
                    <li class="nav-header">Menu Administrator</li>
                    <li class="nav-item">
                        <a href="<?= base_url('Admin'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Data Pimpinan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Admin/index_pengawas'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Data Pengawas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Admin/index_jabatan'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Data Jabatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Pegawai'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pegawai</p>
                        </a>
                    </li>

                  
                <?php elseif ($role === 'user'): ?>
                    <li class="nav-header">Menu Petugas</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>Kinerja <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('user/Dashboard'); ?>" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>Isi Kinerja</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('user/Dashboard/lihat'); ?>" class="nav-link">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>Lihat Hasil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('user/Dashboard/password'); ?>" class="nav-link">
                                    <i class="nav-icon fas fa-key"></i>
                                    <p>Ubah Password</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php elseif ($role === 'pengawas'): ?>
                    <li class="nav-header">Laporan</li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengawas/validasi'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Validasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('pengawas/dashboard'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
