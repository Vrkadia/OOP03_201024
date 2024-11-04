<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css"> <!-- Memasukkan stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Memasukkan Font Awesome -->
    <title>Aya Camp Rent</title>
</head>

<body>
    <!-- Navigasi -->
    <section id="Home">
        <div class="left-nav">
            <div class="user-menu2" style="cursor: pointer;">
                <img src="assets/images/LOGO2.jpg" alt="User"> <!-- Logo pengguna -->
            </div>
            <div class="hamburger">
                <div class="line"></div>
                <div class="line"></div> 
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div>
                <nav class="nav-bar">
                    <ul>
                        <li>
                            <a href="#sectionProduck" class="active">EQUIPMENTS</a> <!-- Menu untuk peralatan -->
                        </li>
                        <li>
                            <a href="/rent">RENT YOUR GEAR</a> <!-- Menu untuk menyewa gear -->
                        </li>
                        <li>
                            <a href="/catalog">CATALOG</a> <!-- Menu untuk katalog -->
                        </li>
                        <li>
                            <?php if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true): ?>
                                <li>
                                    <a href="/login">LOGIN</a> <!-- Menu login jika pengguna belum login -->
                                </li>
                                <li>
                                    <a href="/register">REGISTER</a> <!-- Menu registrasi -->
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
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!-- Akhir Navigasi -->

    <!-- Video Halaman -->
    <section id="sectionvid">
        <center>
            <div class="vidio">
                <video width="2560" height="800" autoplay loop muted>
                    <source src="assets/videos/footageLatar1.mov" type="video/quicktime"> <!-- Sumber video dalam format MOV -->
                    <source src="assets/videos/footageLatar1.mp4" type="video/mp4"> <!-- Sumber video dalam format MP4 -->
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>  
        </center>
    </section>
    <!-- Akhir Video Halaman -->

    <!-- Produk -->
    <section id="sectionProduck">
        <center>
            <div class="judul-produck">
                <h1>Petualangan Anda Dimulai Di Sini: Lihat Peralatan Kami</h1> <!-- Judul produk -->
            </div>
        </center>
        <div class="footerT2">
            <a href=/"catalog"><p>Lihat Selengkapnya</p></a> <!-- Tautan ke halaman katalog -->
        </div>
        <div class="produk-list">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="produk-item">
                        <h3><?= esc($item['name']); ?></h3> <!-- Display item name -->
                        <img src="<?= esc($item['image']); ?>" alt="<?= esc($item['name']); ?>" /> <!-- Display item image -->
                        <p>Description: <?= esc($item['description']); ?></p> <!-- Display item description -->
                        <p>Price: <strong>Rp <?= esc($item['price']); ?>/day</strong></p> <!-- Display item price -->
                        <a href="/rent"><button>Rent Now</button></a> <!-- Rental button -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No items available.</p> <!-- Display message if no items are available -->
            <?php endif; ?>
        </div>
    </section>
    <!-- Akhir Produk -->

    <!-- Tentang Kami -->
    <section id="AboutUs" style="padding: 40px; background-color: #6B8A7A; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
        <h3 style="text-align: center; font-family: 'Arial', sans-serif; color: #00796b; margin-bottom: 20px; font-size: 2.5em; text-transform: uppercase;">Tentang Kami</h3>
        
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 30px; padding: 20px;">
            <!-- Anggota Tim -->
            <div class="team-member" style="text-align: center; width: 220px; background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                <img src="assets/images/rifki.jpg" alt="Rifki" style="border-radius: 50%; width: 150px; height: 150px; border: 4px solid #4CAF50; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);" />
                <h3 style="color: #4CAF50; margin-top: 10px;">Rifki</h3>
                <p style="color: #666;">223443021</p> <!-- NIM anggota tim -->
            </div>

            <div class="team-member" style="text-align: center; width: 220px; background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                <img src="assets/images/nat.jpg" alt="Natasya" style="border-radius: 50%; width: 150px; height: 150px; border: 4px solid #FF6F61; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);" />
                <h3 style="color: #FF6F61; margin-top: 10px;">Natasya</h3>
                <p style="color: #666;">223443020</p> <!-- NIM anggota tim -->
            </div>

            <div class="team-member" style="text-align: center; width: 220px; background-color: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                <img src="assets/images/pam.jpg" alt="Ramadhan" style="border-radius: 50%; width: 150px; height: 150px; border: 4px solid #3F51B5; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);" />
                <h3 style="color: #3F51B5; margin-top: 10px;">Ramadhan</h3>
                <p style="color: #666;">223443015</p> <!-- NIM anggota tim -->
            </div>
        </div>

        <p style="text-align: center; font-size: 1.2em; margin-top: 30px; color: #004d40;">
            SEMANGAT SEMANGAT OKEOKE
        </p>
    </section>
    <!-- Akhir Tentang Kami -->

    <!-- Tentang Saya -->
    <section id="AboutMe">
        <div class="AboutMeImg">
            <img src="assets/images/LatarWebsite.JPG" alt="mobil"> <!-- Gambar untuk section Tentang Saya -->
        </div>
        <p class="AboutMeT">CAMP IN WEST JAVA</p> <!-- Deskripsi tentang saya -->
        <a href="#" class="scroll-to-top"><i class="fas fa-arrow-up"></i></a> <!-- Tautan untuk scroll ke atas -->
    </section>
    <!-- Akhir Tentang Saya -->

    <!-- Footer -->
    <section id="footer1">
        <?php include "layouts/footer.html" ?> <!-- Menyertakan footer -->
    </section>
    <!-- Akhir Footer -->

    <script src="assets/images/script.js"></script> <!-- Memuat script JavaScript -->
</body>
</html>