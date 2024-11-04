<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Display Produk</title>
    <link rel="stylesheet" href="css/catalog.css"> <!-- Memasukkan stylesheet untuk tampilan produk -->
</head>
<body>
<!-- Navbar -->
<section id="Home">
    <div class="left-nav">
        <div class="user-menu2" style="cursor: pointer;">
            <img src="assets/images/LOGO2.jpg" alt="User"> <!-- Logo pengguna -->
        </div>
        <div class="hamburger"> <!-- Menu hamburger untuk navigasi responsif -->
            <div class="line"></div>
            <div class="line"></div> 
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div>
            <nav class="nav-bar">
                <ul>
                    <li>
                        <a href="/" class="active">HOME</a> <!-- Tautan ke halaman utama -->
                    </li>
                    <li>
                        <a href="/rent">RENT YOUR GEAR</a> <!-- Tautan untuk menyewa gear -->
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="scrollToCatalog()">CATALOG</a> <!-- Tautan untuk scroll ke katalog -->
                    </li>
                    <li>
                        <?php if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true): ?>
                            <li>
                                <a href="/login">LOGIN</a> <!-- Tautan untuk login jika pengguna belum login -->
                            </li>
                            <li>
                                <a href="/register">REGISTER</a> <!-- Tautan untuk registrasi -->
                            </li>
                            <?php else: ?>
                                <li>
                                    <a href="/logout" style="text-decoration: none;">LOGOUT</a>
                                    <form id="/logout-form" method="POST" style="display: none; color: whitesmoke;">
                                        <input type="hidden" name="logout" value="1"> <!-- Form untuk logout -->
                                    </form>
                                </li>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true): ?>
                            <div class="user-menu" onclick="window.location.href='/profile';" style="cursor: pointer;">
                                <img src="assets/images/lamboo.jpg" alt="User"> <!-- Gambar pengguna jika sudah login -->
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- Section Produk -->
<section id="product">
    <div class="container"><br><br><br><br>
        <h1>Display Produk</h1> <!-- Judul halaman produk -->

        <div class="filter-container">
            <input type="text" class="search-bar" id="search-input" placeholder="Cari produk..." oninput="filterProducts()"> <!-- Input untuk pencarian produk -->
            <select id="sort-filter" onchange="sortProducts()"> <!-- Dropdown untuk mengurutkan produk -->
                <option value="default">Urutkan berdasarkan</option>
                <option value="price">Harga</option>
                <option value="rating">Rating</option>
            </select>
        </div>

        <div class="product-grid" id="product-grid">
            <!-- Produk akan dimasukkan secara dinamis di sini -->
        </div>

        <div class="pagination" id="pagination">
            <!-- Tombol pagination akan dimasukkan secara dinamis di sini -->
        </div>

        <div class="cart-message" id="cart-message"></div> <!-- Pesan untuk keranjang -->
    </div>

    <!-- Modal untuk menampilkan detail produk -->
    <div class="modal" id="product-modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span> <!-- Tombol untuk menutup modal -->
            <h2 id="modal-product-name"></h2> <!-- Nama produk di modal -->
            <p><strong>Harga:</strong> <span id="modal-product-price"></span></p> <!-- Harga produk di modal -->
            <p><strong>Ketersediaan:</strong> <span id="modal-product-availability"></span></p> <!-- Ketersediaan produk di modal -->
            <p><strong>Deskripsi:</strong> <span id="modal-product-description"></span></p> <!-- Deskripsi produk di modal -->
            <h3>Spesifikasi:</h3>
            <p id="modal-product-specifications"></p> <!-- Spesifikasi produk di modal -->
            <button onclick="addToCart(document.getElementById('modal-product-name').textContent)">Tambahkan ke Keranjang</button> <!-- Tombol untuk menambahkan ke keranjang -->
            <button onclick="window.location.href='/rent'">Booking</button> <!-- Tombol untuk booking -->
        </div>
    </div>
</section>


<script>
    let cartCount = 0; // Variabel untuk menghitung jumlah produk di keranjang
    let currentPage = 1; // Halaman saat ini
    const productsPerPage = 10; // Jumlah produk per halaman
    let products = []; // Array untuk menyimpan data produk

    // Fungsi untuk mengambil data produk dari database
    async function fetchProducts() {
        const response = await fetch('service/get_cars.php');
        if (response.ok) {
            products = await response.json(); // Mengonversi response JSON menjadi array produk
            displayProducts(currentPage); // Menampilkan produk pada halaman saat ini
        } else {
            console.error('Failed to fetch products:', response.statusText); // Menangani kesalahan jika gagal mengambil data
        }
    }

    // Fungsi untuk menampilkan produk berdasarkan halaman
    function displayProducts(page) {
        const productGrid = document.getElementById("product-grid");
        productGrid.innerHTML = ""; // Mengosongkan grid produk

        const startIndex = (page - 1) * productsPerPage; // Indeks awal untuk produk
        const endIndex = startIndex + productsPerPage; // Indeks akhir untuk produk
        const paginatedProducts = products.slice(startIndex, endIndex); // Mengambil produk untuk halaman saat ini

        paginatedProducts.forEach(product => {
            const productCard = document.createElement("div");
            productCard.className = "product-card";
            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}"> <!-- Gambar produk -->
                <h3>${product.name}</h3> <!-- Nama produk -->
                <p>Harga: Rp. ${product.price}</p> <!-- Harga produk -->
                <p>Deskripsi: ${product.description}</p> <!-- Deskripsi produk -->
                <button onclick="showProductModal('${product.name}')">Lihat Detail</button> <!-- Tombol untuk melihat detail produk -->
                <button onclick="window.location.href='/rent'">Booking</button> <!-- Tombol untuk booking -->
            `;
            productGrid.appendChild(productCard); // Menambahkan kartu produk ke grid
        });

        displayPagination(); // Menampilkan pagination setelah produk ditampilkan
    }

    // Fungsi untuk menampilkan pagination
    function displayPagination() {
        const totalPages = Math.ceil(products.length / productsPerPage); // Menghitung total halaman
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = ""; // Mengosongkan elemen pagination

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i; // Menambahkan nomor halaman ke tombol
            button.onclick = () => {
                currentPage = i; // Mengubah halaman saat ini
                displayProducts(currentPage); // Menampilkan produk pada halaman yang dipilih
            };
            pagination.appendChild(button); // Menambahkan tombol ke elemen pagination
        }
    }

    // Fungsi untuk menampilkan modal produk
    function showProductModal(productName) {
        const modal = document.getElementById("product-modal");
        const product = products.find(p => p.name === productName); // Mencari produk berdasarkan nama

        document.getElementById("modal-product-name").textContent = product.name; // Menampilkan nama produk di modal
        document.getElementById("modal-product-price").textContent = product.price; // Menampilkan harga produk di modal
        document.getElementById("modal-product-availability").textContent = product.availability; // Menampilkan ketersediaan produk di modal
        document.getElementById("modal-product-description").textContent = product.description; // Menampilkan deskripsi produk di modal
        document.getElementById("modal-product-specifications").textContent = product.specifications; // Menampilkan spesifikasi produk di modal
        modal.style.display = "block"; // Menampilkan modal
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById("product-modal").style.display = "none"; // Menyembunyikan modal
    }

    // Fungsi untuk menambahkan produk ke keranjang
    function addToCart(productName) {
        cartCount++; // Meningkatkan jumlah produk di keranjang
        document.getElementById("cart-message").textContent = `${productName} berhasil ditambahkan ke keranjang. Total produk dalam keranjang: ${cartCount}`; // Menampilkan pesan
        setTimeout(() => {
            document.getElementById("cart-message").textContent = ""; // Menghapus pesan setelah 3 detik
        }, 3000);
    }

    // Fungsi untuk memfilter produk berdasarkan input pencarian
    function filterProducts() {
        const searchInput = document.getElementById("search-input").value.toLowerCase(); // Mengambil input pencarian
        const filteredProducts = products.filter(product => product.name.toLowerCase().includes(searchInput)); // Memfilter produk
        const productGrid = document.getElementById("product-grid");
        productGrid.innerHTML = ""; // Mengosongkan grid produk

        filteredProducts.forEach(product => {
            const productCard = document.createElement("div");
            productCard.className = "product-card";
            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}"> <!-- Gambar produk -->
                <h3>${product.name}</h3> <!-- Nama produk -->
                <p>Harga: Rp. ${product.price}</p> <!-- Harga produk -->
                <p>Deskripsi: ${product.description}</p> <!-- Deskripsi produk -->
                <button onclick="showProductModal('${product.name}')">Lihat Detail</button> <!-- Tombol untuk melihat detail produk -->
                <button onclick="window.location.href='/rent'">Booking</button> <!-- Tombol untuk booking -->
            `;
            productGrid.appendChild(productCard); // Menambahkan kartu produk ke grid
        });
    }

    // Fungsi untuk mengurutkan produk
    function sortProducts() {
        const sortValue = document.getElementById("sort-filter").value; // Mengambil nilai dari dropdown sorting
        let sortedProducts = [...products]; // Menyalin produk untuk diurutkan

        if (sortValue === "price") {
            // Mengurutkan produk berdasarkan harga
            sortedProducts.sort((a, b) => parseInt(a.price.replace(/[^0-9]/g, '')) - parseInt(b.price.replace(/[^0-9]/g, '')));
        }

        products.length = 0; // Mengosongkan array produk
        products.push(...sortedProducts); // Menyalin produk yang sudah diurutkan kembali ke array
        displayProducts(currentPage); // Menampilkan produk yang sudah diurutkan
    }

    // Fungsi untuk scroll ke katalog
    function scrollToCatalog() {
        const element = document.getElementById("product");
        element.scrollIntoView({ behavior: 'smooth' }); // Melakukan scroll halus ke elemen katalog
    }

    // Memanggil fetchProducts saat halaman dimuat
    window.onload = function() {
        fetchProducts(); // Mengambil data produk saat halaman siap
    };
</script>
</body>
</html>