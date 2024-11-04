<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/rentform.css">
    <title>Rent Form</title>
</head>
<body>
    <div class="login-section">
        <a href="/" class="back-left"><i class="fas fa-arrow-left"></i></a>
        <p class="textBYD1">Ayo Sewa Alat Kemah!</p>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form class="form" id="scheduleForm" action="<?= base_url('/rent') ?>" method="POST">
        <select class="optioncar" id="alat" name="i_alat" required>
            <option value="" disabled selected>Pilih alat Anda</option>
            <?php foreach ($items as $item): ?>
                <option value="<?= htmlspecialchars($item['alat']) ?>">
                    <?= htmlspecialchars($item['alat']) ?>
                </option>
            <?php endforeach; ?>
        </select>


            <select class="optioncar" id="rentalDuration" name="i_rentalDuration" required>
                <option value="" disabled selected>Pilih durasi sewa</option>
                <option value="1 day">1 Hari</option>
                <option value="2 days">2 Hari</option>
                <option value="3 days">3 Hari</option>
                <option value="More Than 3 Days">Lebih dari 3 Hari</option>
            </select>

            <select class="optioncar" id="paymentMethod" name="i_paymentMethod" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="BRI">BRI</option>
                <option value="Dana">Dana</option>
                <option value="ShopeePay">ShopeePay</option>
                <option value="Bayar di Tempat">Bayar di Tempat</option>
            </select>

            <input type="datetime-local" id="scheduleDateTime" name="i_scheduleDateTime" required min="<?= date('Y-m-d\TH:i') ?>">

            

            <br><br>
            <button id="schedule-here" type="submit" class="google-login">Next</button>
            <a href="/cart" class="schedule-link">
                <button type="button" class="google-login">Tampilkan Keranjang</button>
            </a>
        </form>



        <div class="terms-section">
            <h2>Ketentuan dan Prosedur Rental:</h2>
            <ul>
                <li>1. Pengguna harus login untuk memesan.</li>
                <li>2. Isi formulir dengan nama barang, durasi, dan metode pembayaran.</li>
                <li>3. Tekan "Next" untuk menambahkan barang ke keranjang.</li>
                <li>4. Tekan "Booking" untuk konfirmasi pemesanan.</li>
                <li>5. Tunggu konfirmasi admin dan ikuti instruksi pembayaran (Melalui whatsapp).</li>
                <li>6. Pembayaran dalam 8 jam setelah metode dikirim.</li>
                <li>7. Barang bisa diambil atau dikirim dengan verifikasi KTP.</li>
                <li>8. Denda Rp20.000 per hari jika terlambat mengembalikan.</li>
            </ul>
        </div>
    </div>

    <div class="video-section">
        <video width="2560" height="800" autoplay loop muted>
            <source src="assets/videos/footageLatar1.mov" type="video/quicktime">
            <source src="assets/videos/footageLatar1.mp4" type="video/mp4">
        </video>
    </div>

    <script src="static/script.js"></script>
</body>
</html>