<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Riwayat Pemesanan</title>
    <style>
        body { 
            background-color: #6B8A7A; 
            color: white; 
            margin: 0; 
            padding: 0; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            height: 100vh; 
            justify-content: flex-start; 
            font-family: sans-serif;
        }
        .booking-section22 { 
            width: 90%; 
            max-width: 100%; 
            padding: 20px; 
            background-color: #254336; 
            border-radius: 0; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            margin-top: 20px; 
        }
        .booking-table22 { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0; 
        }
        .booking-th22, .booking-td22 { 
            padding: 12px; 
            text-align: left; 
            border: 1px solid #f5f5f5; 
        }
        .booking-th22 { 
            background-color: #6B8A7A; 
        }
        .booking-tr22:nth-child(even) { 
            background-color: #6B8A7A; 
        }
        .booking-google-login22 { 
            background-color: #6B8A7A; 
            color: white; 
            padding: 10px 20px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            cursor: pointer; 
            border: none; 
            font-weight: 500; 
            margin-top: 20px; 
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s; 
        }
        .booking-google-login22:hover { 
            background-color: #254336; 
            color: whitesmoke; 
            box-shadow: 0 0 0 2px white; 
        }
        .booking-back-left22 { 
            color: white; 
            text-decoration: none; 
            font-size: 20px; 
        }
        .booking-textBYD122 { 
            font-size: 24px; 
            margin-bottom: 20px; 
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .icon-container {
            display: flex;
        }
        .icon-link {
            color: white;
            font-size: 18px;
            margin-left: 10px;
            text-decoration: none;
        }
        .icon-link:hover {
            color: #6B8A7A; 
        }
    </style>
</head>
<body>
    <div class="booking-section22">
        <a href="index.php" class="booking-back-left22"><i class="fas fa-arrow-left"></i></a>
        <p class="booking-textBYD122">Riwayat Pemesanan</p>

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
                <?php foreach ($history as $item): ?>
                <tr class="booking-tr22">
                    <td class="booking-tr22"><?= esc($item['username']); ?></td>
                    <td class="booking-tr22"><?= esc($item['alat']); ?></td>
                    <td class="booking-tr22"><?= esc($item['rental_duration']); ?></td>
                    <td class="booking-tr22"><?= esc($item['schedule_date_time']); ?></td>
                    <td class="booking-tr22"><?= esc($item['payment_method']); ?></td> <!-- Displaying payment method -->
                    <td>
                        <a href="delete.php?id=123" class="delete-link" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="button-container">
            <a href="/rent" class="booking-google-login22">Kembali ke Form Penyewaan</a>
            <div class="icon-container">
                <a href="https://wa.me/081320728886" target="_blank" class="icon-link"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.google.com/maps/search/?api=1&query=Komplek+Permai+Nusa+Hijau+Blok+R2G+Cimahi,+Cimahi+40512" target="_blank" class="icon-link"><i class="fas fa-map-marker-alt"></i></a>
            </div>
        </div>
    </div>

    <script src="static/script.js"></script>
</body>
</html>