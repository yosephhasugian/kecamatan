<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- Font Awesome & AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/custom.css'); ?>">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* ---- BACKGROUND UTAMA ---- */
        body {
            background-color: #f4f6f9; /* Warna latar belakang */
        }

        /* ---- NAVBAR ---- */
        .main-header.navbar {
            background-color: #003366 !important; /* Biru Navy DISHUB */
            color: white !important;
            border-bottom: 3px solid #FFD700; /* Garis emas */
        }

        .main-header .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
            transition: 0.3s;
        }

        .main-header .navbar-nav .nav-link:hover {
            color: #FFD700 !important; /* Hover emas */
        }

        /* ---- SIDEBAR ---- */
        .main-sidebar {
            background-color: #003366 !important; /* Warna Biru DISHUB */
            color: white;
        }

        .sidebar a {
            color: white !important;
            font-weight: bold;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #0055A4 !important; /* Biru terang */
            color: #FFD700 !important; /* Warna emas */
        }

        .nav-sidebar > .nav-item .nav-icon {
            color: #FFD700 !important; /* Ikon emas */
        }

        /* ---- CONTENT AREA ---- */
        .content-wrapper {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* ---- FOOTER ---- */
        .main-footer {
            background-color: #003366 !important; /* Warna Biru DISHUB */
            color: white !important;
            text-align: center;
            padding: 10px;
            font-weight: bold;
            border-top: 3px solid #FFD700; /* Garis atas emas */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    
    <?php $this->load->view('layouts/navbar'); ?>

    <?php $this->load->view('layouts/sidebar'); ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </section>
    </div>

    <?php $this->load->view('layouts/footer'); ?>
</div>

<!-- Bootstrap & AdminLTE -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js'); ?>"></script>

</body>
</html>
