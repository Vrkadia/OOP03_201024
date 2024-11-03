<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Halaman Login</title>
    <style>
        /* Gaya untuk field password */
        .password-field {
            position: relative;
        }
        /* Ikon untuk menampilkan atau menyembunyikan password */
        .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="login-section">
        <a href="<?= base_url('/') ?>" class="back-left"><i class="fas fa-arrow-left"></i></a>
        <p class="textlogin1">Login Shadow Wheels</p>
        <p class="textlogin2">Belum punya akun Shadow Wheels? Daftar <a href="<?= base_url('/register') ?>" class="here">di sini</a>.</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?= \Config\Services::validation()->listErrors(); ?>

        <form class="form" action="<?= base_url('/login') ?>" method="POST">
            <?= csrf_field(); ?>
            <input type="email" id="email" name="email" placeholder="Email" required value="<?= old('email') ?>">
            <div class="password-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-eye show-password" onclick="togglePasswordVisibility('password')"></i>
            </div>
            <div class="role-selector" onclick="toggleRole()">
                <i id="roleIcon" class="fas fa-user" title="Klik untuk beralih ke Admin"></i>
                <input type="hidden" id="role" name="role" value="user">
            </div>
            <button type="submit" class="signintext" name="login">Login</button>
        </form>
    </div>
    <div class="video-section">
        <!-- Video latar belakang -->
        <video width="2560" height="800" autoplay loop muted>
            <source src="assets/videos/footageLatar1.mov" type="video/quicktime">
            <source src="assets/videos/footageLatar1.mp4" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
    </div>

    <script>
        // Fungsi untuk beralih antara peran admin dan user
        function toggleRole() {
            const roleInput = document.getElementById('role');
            const roleIcon = document.getElementById('roleIcon');
            
            if (roleInput.value === 'user') {
                roleInput.value = 'admin'; // Mengubah nilai role menjadi admin
                roleIcon.classList.remove('fa-user'); // Mengubah ikon
                roleIcon.classList.add('fa-user-shield');
                roleIcon.title = 'Klik untuk beralih ke User'; // Mengubah tooltip
            } else {
                roleInput.value = 'user'; // Mengubah nilai role kembali ke user
                roleIcon.classList.remove('fa-user-shield'); // Mengubah ikon
                roleIcon.classList.add('fa-user');
                roleIcon.title = 'Klik untuk beralih ke Admin'; // Mengubah tooltip
            }
        }

        // Fungsi untuk menampilkan atau menyembunyikan password
        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const passwordType = passwordField.type === "password" ? "text" : "password";
            passwordField.type = passwordType; // Mengubah tipe input
        }
    </script>

    <script src="static/script.js"></script>
</body>
</html>
