<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SICEKAT | Login</title>

  <!-- Fonts & Icons -->
  <!-- Menggunakan Poppins sebagai font utama untuk tampilan yang bersih dan modern -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
  <!-- Font Awesome untuk ikon yang stylish -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  
  <!-- Tailwind CSS CDN untuk styling yang cepat dan responsif -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Mengatur font Poppins sebagai font default untuk seluruh body */
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Wrapper untuk kontainer login, memberikan latar belakang gradien yang sangat halus */
    .login-container-wrapper {
      background: linear-gradient(135deg, #f4f4f4, #e0e0e0); 
    }

    /* Styling untuk kotak kanan (right-box) yang menampilkan visual ilustrasi */
    .right-box {
      /* Gradien latar belakang dinamis yang bergerak perlahan */
      background: linear-gradient(45deg, #764ba2, #667eea, #764ba2);
      background-size: 200% 200%; /* Ukuran latar belakang agar bisa dianimasikan */
      animation: gradient-animation 10s ease infinite; /* Animasi gradien */
    }

    /* Pseudo-elemen untuk menambahkan pola abstrak transparan di atas gradien */
    .right-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      /* Data URI untuk SVG pattern yang putih transparan */
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="25" cy="25" r="5" fill="%23FFFFFF" opacity="0.1"/><circle cx="75" cy="75" r="5" fill="%23FFFFFF" opacity="0.1"/><path d="M0 0 L100 100 M100 0 L0 100" stroke="%23FFFFFF" stroke-width="0.5" opacity="0.05"/></svg>') repeat;
      opacity: 0.8; /* Sedikit transparan agar gradien tetap terlihat */
      animation: pattern-move 30s linear infinite; /* Animasi pergerakan pola */
    }

    /* Keyframes untuk animasi gradien latar belakang */
    @keyframes gradient-animation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Keyframes untuk animasi pergerakan pola abstrak */
    @keyframes pattern-move {
      0% { background-position: 0% 0%; }
      100% { background-position: 100% 100%; }
    }

    /* Animasi fade-in-up untuk elemen yang muncul dari bawah */
    .animate-fade-in-up {
        animation: fade-in-up 0.7s ease-out forwards;
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animasi bounce yang sangat lambat untuk logo atau elemen tertentu */
    .animate-bounce-slow {
        animation: bounce-slow 4s infinite ease-in-out;
    }

    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Styling khusus untuk background ikon pada input group, agar sesuai dengan tema ungu */
    .input-icon-bg {
      background: #764ba2; /* Warna ungu primer */
      color: white; /* Warna teks ikon putih */
      border-radius: 9999px 0 0 9999px; /* Pembulatan penuh di sisi kiri */
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 font-poppins login-container-wrapper">

<div class="login-container flex flex-col md:flex-row w-full max-w-6xl mx-auto rounded-3xl shadow-2xl overflow-hidden">
  <!-- Bagian KIRI: Form Login -->
  <!-- Menggunakan Tailwind untuk layout responsif, padding, warna background, shadow, dan animasi -->
  <div class="left-box w-full md:w-1/2 bg-white p-8 md:p-12 flex flex-col justify-center items-center relative z-10 animate-fade-in-up">
    <!-- Logo aplikasi dengan ikon Font Awesome dan animasi bounce lambat -->
    <div class="login-logo text-6xl text-purple-600 mb-4 animate-bounce-slow">
      <i class="fas fa-user-circle"></i>
    </div>
    <!-- Judul aplikasi -->
    <div class="app-title text-3xl font-bold text-gray-800 mb-2">SICEKAT</div>
    <!-- Subjudul aplikasi -->
    <div class="app-subtitle text-base text-gray-600 mb-6 text-center">Sistem E-Kinerja PJLP Cempaka Putih</div>
    <!-- Judul form login -->
    <h4 class="text-2xl font-semibold text-gray-700 mb-3">Login</h4>
    <!-- Deskripsi form login -->
    <p class="text-gray-500 mb-8 text-center">Silakan login untuk mengakses aplikasi</p>

    <!-- Form Login -->
    <!-- Menggunakan placeholder PHP untuk action URL dan CSRF token -->
    <form action="<?= base_url('auth/do_login'); ?>" method="post" class="w-full" style="max-width: 360px;">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
      
      <!-- Input Username -->
      <div class="mb-5">
        <div class="flex items-center border border-gray-300 rounded-full overflow-hidden shadow-sm 
                    focus-within:ring-2 focus-within:ring-purple-300 transition duration-200">
          <span class="input-icon-bg px-4 py-3">
            <i class="fas fa-user text-lg"></i>
          </span>
          <input type="text" class="flex-1 px-4 py-3 outline-none text-gray-700 placeholder-gray-400 rounded-r-full" 
                 name="username" placeholder="Username" required>
        </div>
      </div>

      <!-- Input Password -->
      <div class="mb-8">
        <div class="flex items-center border border-gray-300 rounded-full overflow-hidden shadow-sm 
                    focus-within:ring-2 focus-within:ring-purple-300 transition duration-200">
          <span class="input-icon-bg px-4 py-3">
            <i class="fas fa-lock text-lg"></i>
          </span>
          <input type="password" class="flex-1 px-4 py-3 outline-none text-gray-700 placeholder-gray-400 rounded-r-full" 
                 name="password" placeholder="Password" required>
        </div>
      </div>
      
      <!-- Tombol Sign In -->
      <button type="submit" class="btn-login w-full bg-gradient-to-r from-purple-600 to-indigo-700 
                                  hover:from-purple-700 hover:to-indigo-800 text-white font-semibold py-3 
                                  rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
        Sign In
      </button>
    </form>
  </div>

  <!-- Bagian KANAN: Visual Ilustrasi Dinamis -->
  <!-- Tersembunyi di mobile (hidden md:flex), menampilkan gradien animasi dan teks -->
  <div class="right-box hidden md:flex md:w-1/2 relative flex-col justify-center items-center p-12">
    <div class="text-white text-4xl font-extrabold text-center leading-snug">
       <span class="text-indigo-200">SICEKAT</span>
    </div>
    <p class="mt-4 text-white text-opacity-80 text-center max-w-sm">Kelola kinerja Anda dengan mudah dan efisien.</p>
  </div>
</div>

</body>
</html>
