<!DOCTYPE html>
<html lang="id">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Database Penyewaan</title>
    <style>
        /* Gaya untuk tampilan halaman */
        body { background-color: #1a1a1a; color: white; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border: 1px solid #f5f5f5; }
        th { background-color: #6B8A7A; }
        tr:nth-child(even) { background-color: #6B8A7A; }
        .google-login { background-color: #ffcc00; color: black; padding: 10px 15px; border: none; cursor: pointer; }
        .delete-link { color: white; }
        .delete-link:hover { color: #ff6666; } /* Merah muda saat hover */
    </style>
</head>
<body>
    <div class="login-section" style="width: 27%;">
        <a href="/rent" class="back-left"><i class="fas fa-arrow-left"></i></a>
        <p class="textBYD1">Keranjang Anda</p>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Alat</th>
                    <th>Durasi Sewa</th>
                    <th>Tanggal & Waktu Jadwal</th>
                    <th>Metode Pembayaran</th> <!-- Kolom metode pembayaran -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $item): ?>
                <tr>
                    <td><?= esc($item['username']); ?></td>
                    <td><?= esc($item['alat']); ?></td>
                    <td><?= esc($item['rental_duration']); ?></td>
                    <td><?= esc($item['schedule_date_time']); ?></td>
                    <td><?= esc($item['payment_method']); ?></td> <!-- Displaying payment method -->
                    <td>
                        <a href="delete.php?id=123" class="delete-link" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tautan untuk kembali ke formulir penyewaan -->
        <a href="/rent" class="google-login">Kembali ke Form Penyewaan</a>
        <br>
        <form action="/history" method="POST">
            <button type="submit" class="google-login">Pesan</button>
        </form>
    </div>

    <div class="video-section">
        <!-- Video latar belakang -->
        <video width="2560" height="800" autoplay loop muted>
            <source src="assets/videos/footagelatar1.mov" type="video/quicktime">
            <source src="assets/videos/footagelatar1.mp4" type="video/mp4">
        </video>
    </div>

    <script src="static/script.js"></script> <!-- Memuat script JavaScript -->
</body>
</html>
