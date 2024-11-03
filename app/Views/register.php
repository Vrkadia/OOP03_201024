<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Registration</title>
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
        <!-- Tautan untuk kembali ke halaman utama -->
        <a href="/index" class="back-left"><i class="fas fa-arrow-left"></i></a>
        <p class="textlogin1">Shadow Wheels <br>Pendaftaran</p>

        <form class="form" action="<?php echo base_url('/register'); ?>" method="POST">
            <br><br>
            <!-- Input untuk username -->
            <input type="text" id="username" placeholder="Username" name="username" value="<?= old('username') ?>" required><br>
            <!-- Input untuk email -->
            <input type="text" id="email" placeholder="Email" name="email" value="<?= old('email') ?>" required><br>
            <!-- Input untuk nomor telepon -->
            <input type="text" id="phone_number" placeholder="Nomor Telepon" name="phone_number" value="<?= old('phone_number') ?>" required><br>
            <div class="password-field">
                <!-- Input untuk password -->
                <input type="password" placeholder="Password" name="password" id="password" required>
                <i class="fas fa-eye show-password" onclick="togglePasswordVisibility('password')"></i>
            </div>
            <div class="password-field">
                <!-- Input untuk konfirmasi password -->
                <input type="password" placeholder="Konfirmasi Password" name="confirm_password" id="confirm_password" required>
                <i class="fas fa-eye show-password" onclick="togglePasswordVisibility('confirm_password')"></i>
            </div>
            <!-- Tombol untuk mendaftar -->
            <button type="submit" class="signintext" name="register">Daftar Sekarang</button>
            <br>
            <br>
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
        // Fungsi untuk menampilkan atau menyembunyikan password
        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const passwordType = passwordField.type === "password" ? "text" : "password";
            passwordField.type = passwordType; // Mengubah tipe input
        }
    </script>
    <script src="script.js"></script>
</body>
</html>