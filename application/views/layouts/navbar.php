<style>
/* Styling Navbar */
.main-header.navbar {
    background-color: #003366; /* Warna biru navy DISHUB */
    color: white;
    border-bottom: 3px solid #FFD700; /* Garis bawah warna emas */
}

.navbar-nav .nav-link {
    color: white !important;
    font-weight: bold;
    transition: 0.3s;
}

.navbar-nav .nav-link:hover {
    color: #FFD700 !important; /* Hover warna emas */
    transform: scale(1.05);
}

.navbar-nav .nav-link i {
    color: #FFD700; /* Ikon warna emas */
}
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?php
            $role = $this->session->userdata('role');
            $user_id = $this->session->userdata('user_id');

            if ($role && $user_id) {
                // Load model pegawai
                $this->load->model('Pegawai_model');

                // Ambil nama pegawai dari database
                $nama_pegawai = $this->Pegawai_model->get_nama_by_user_id($user_id);

                if ($nama_pegawai) {
                    echo '<span class="nav-link">Nama: ' . $nama_pegawai . ' | Role: ' . ucfirst($role) . '</span>';
                } else {
                    echo '<span class="nav-link">Role: ' . ucfirst($role) . '</span>';
                }
            } else {
                echo '<span class="nav-link">Role: Guest</span>';
            }
            ?>
        </li>
    </ul>
</nav>