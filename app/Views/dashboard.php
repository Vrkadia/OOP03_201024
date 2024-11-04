<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css"> <!-- Mengimpor stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Mengimpor Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Mengimpor Chart.js untuk grafik -->
    <style>
        /* Styling untuk statistik */
        .statistics {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Styling untuk ringkasan */
        .recap {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Styling untuk daftar */
        .recap ul {
            list-style: none;
            padding: 0;
        }

        /* Styling untuk item daftar */
        .recap li {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* Efek hover untuk item daftar */
        .recap li:hover {
            transform: scale(1.02);
        }

        /* Styling untuk form penambahan produk */
        .products form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Styling input dan textarea dalam form */
        .products form input,
        .products form textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Styling tombol dalam form */
        .products form button {
            background-color: #6B8A7A;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Efek hover untuk tombol */
        .products form button:hover {
            background-color: #254336;
        }

        /* Styling untuk textarea */
        .products form textarea {
            resize: vertical;
            min-height: 60px;
        }
    </style>
</head>
<body>

<!-- Navigasi Samping -->
<div class="sidebar">
    <h2>Peralatan Kemping</h2>
    <a href="#" onclick="navigateTo('dashboard')">
        <i class="fas fa-mountain"></i> Dashboard
    </a>
    <a href="#" onclick="navigateTo('orders')">
        <i class="fas fa-list-alt"></i> Pesanan
    </a>
    <a href="#" onclick="navigateTo('statistics')">
        <i class="fas fa-chart-bar"></i> Statistik
    </a>
    <a href="#" onclick="navigateTo('products')">
        <i class="fas fa-campground"></i> Produk
    </a>
    <a href="#" onclick="navigateTo('stock')">
        <i class="fas fa-warehouse"></i> Stok
    </a>
</div>
<!-- Akhir Navigasi Samping -->

<!-- Konten Utama: Dashboard -->
<div class="main-content">

    <!-- Dashboard -->
    <div class="dashboard" id="dashboard" style="display: block;">
        <div class="header">
            <div class="title">Dashboard</div>
        </div>

        <div class="welcome-message">
            <h3>
                Selamat Datang Kembali, 
                <?php echo htmlspecialchars($username); ?>!
            </h3>
            <p>Berikut adalah gambaran cepat tentang kinerja bisnis sewa Anda.</p>
        </div>

        <div class="summary" style="margin-left: 30px;">
            <div class="summary-item">
                <h4>Total Produk</h4>
                <p><?= htmlspecialchars($item_count) ?></p>
            </div> 
            <div class="summary-item">
                <h4>Total Produk Dipesan</h4>
                <p><?= htmlspecialchars($order_count) ?></p>
            </div>
            <div class="summary-item">
                <h4>Total Akun Terdaftar</h4>
                <p><?= htmlspecialchars($user_count) ?></p>
            </div>
        </div>
        <div class="most-booked">
            <?php if (!empty($most_ordered)): ?>
                <p style="color: #6B8A7A; font-weight: bold;"><?= $most_ordered['alat'] . ' (' . $most_ordered['order_count'] . ' orders)' ?></p>
            <?php else: ?>
                <p style="color: #6B8A7A; font-weight: bold;">No orders found.</p>
            <?php endif; ?>
        </div>

        <div class="orders">
            <h4>Pesanan Terbaru</h4>
            <table>
                <thead>
                    <tr>
                    <th>Nama Pelanggan</th>
                    <th>Alat</th>
                    <th>Durasi Sewa</th>
                    <th>Tanggal Jadwal</th>
                    <th>Metode Pembayaran</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                <?php 
                $no = 1; 
                foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td><?= htmlspecialchars($order['alat']) ?></td>
                        <td><?= htmlspecialchars($order['rental_duration']) ?></td>
                        <td><?= htmlspecialchars($order['schedule_date_time']) ?></td>
                        <td><?= htmlspecialchars($order['payment_method']) ?></td>
                        <td><?= htmlspecialchars($order['phone_number']) ?></td>
                        <td>
                            <form method="POST" action="/order_process" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <button type="submit" name="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
    <!-- Akhir Dashboard -->

    <!-- Bagian Pesanan -->
    <div class="orders" id="orders" style="display: none;">
        <h3>Daftar Pesanan</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Alat</th>
                    <th>Durasi Sewa</th>
                    <th>Tanggal Jadwal</th>
                    <th>Metode Pembayaran</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">
                <?php 
                $no = 1; 
                foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($no++) ?></td>
                        <td><?= htmlspecialchars($order['username']) ?></td>
                        <td><?= htmlspecialchars($order['alat']) ?></td>
                        <td><?= htmlspecialchars($order['rental_duration']) ?></td>
                        <td><?= htmlspecialchars($order['schedule_date_time']) ?></td>
                        <td><?= htmlspecialchars($order['payment_method']) ?></td>
                        <td><?= htmlspecialchars($order['phone_number']) ?></td>
                        <td>
                            <form method="POST" action="order_process.php" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <button type="submit" name="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Akhir Bagian Pemesanan -->

    <!-- Bagian Statistik -->
    <div class="statistics" id="statistics" style="display: none;">
        <h3>Statistik Pesanan</h3>
        
        <!-- Ringkasan Statistik -->
        <div class="summary">
            <h4>Total Pesanan Mingguan</h4>
            <p><?= htmlspecialchars($week_stats['week_count']) ?> pesanan</p>
            
            <h4>Total Pesanan Bulanan</h4>
            <p><?= htmlspecialchars($month_stats['month_count']) ?> pesanan</p>
            
            <h4>Total Pesanan Tahunan</h4>
            <p><?= htmlspecialchars($year_stats['year_count']) ?> pesanan</p>
        </div>

        <canvas id="myChart"></canvas>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const labels = <?= json_encode(array_column($statistics, 'date')) ?>; // Mengambil tanggal dari statistik
            const data = <?= json_encode(array_column($statistics, 'count')) ?>; // Mengambil jumlah pesanan dari statistik

            const myChart = new Chart(ctx, {    
                type: 'line', // Tipe grafik
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pesanan', // Label grafik
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)', // Warna garis
                        borderWidth: 2,
                        fill: false // Tidak mengisi area di bawah garis
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Memulai sumbu Y dari nol
                        }
                    }
                }
            });
        </script>
    </div>
    <!-- Akhir Bagian Statistik -->

    <!-- Bagian Produk -->
    <div class="products" id="products" style="display: none;">
        <h3>Daftar Produk</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Total Stok</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Spesifikasi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kemah_stock as $alat): ?>
                    <tr>
                        <td><?= htmlspecialchars($alat['id']) ?></td>
                        <td><?= htmlspecialchars($alat['name']) ?></td>
                        <td><?= htmlspecialchars($alat['total_stock']) ?></td>
                        <td><?= htmlspecialchars($alat['price']) ?></td>
                        <td><?= htmlspecialchars($alat['description']) ?></td>
                        <td><?= htmlspecialchars($alat['specifications']) ?></td>
                        <td><img src="<?= htmlspecialchars($alat['image']) ?>" alt="<?= htmlspecialchars($alat['name']) ?>" style="width: 100px;"></td>
                        <td>
                            <form method="POST" action="/product_process" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= $alat['id'] ?>">
                                <button type="submit" name="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Tambahkan Produk Baru</h4>
        <form method="POST" action="/product_process/add" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nama Produk" required>
            <input type="number" name="total_stock" placeholder="Total Stok" required>
            <input type="text" name="price" placeholder="Harga" required>
            <textarea name="description" placeholder="Deskripsi" required></textarea>
            <textarea name="specifications" placeholder="Spesifikasi" required></textarea>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Tambah Produk</button>
        </form>
    </div>
    <!-- Akhir Bagian Produk -->

    <!-- Bagian Stok -->
    <div class="stock" id="stock" style="display: none;">
        <h3>Stok Tersedia</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Total Stok</th>
                    <th>Stok Tersedia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kemah_stock as $alat): ?>
                    <tr>
                        <td><?= htmlspecialchars($alat['name']) ?></td>
                        <td><?= htmlspecialchars($alat['total_stock']) ?></td>
                        <td><?= htmlspecialchars($alat['availability']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Akhir Bagian Stok -->

    <script>
        // Fungsi untuk menavigasi antar bagian
        function navigateTo(section) {
            const sections = ['dashboard', 'orders', 'statistics', 'products', 'stock'];
            sections.forEach(sec => {
                document.getElementById(sec).style.display = (sec === section) ? 'block' : 'none';
            });
        }
    </script>

</body>
</html>