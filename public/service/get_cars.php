<?php
include 'database.php'; // Memasukkan file koneksi database

// Menyusun query SQL untuk mengambil data alat kemah
$sql = "SELECT name, price, availability, description, specifications, image FROM alat_kemah";
$result = mysqli_query($db, $sql); // Menjalankan query dan menyimpan hasilnya

$alat_kemah = []; // Array untuk menyimpan data alat kemah
if ($result) {
    // Mengambil setiap baris hasil query dan menambahkannya ke array
    while ($row = mysqli_fetch_assoc($result)) {
        $alat_kemah[] = $row; // Menambahkan data baris ke array
    }
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json'); // Mengatur header untuk format JSON
echo json_encode($alat_kemah); // Mengubah array menjadi format JSON dan mengirimkannya

mysqli_close($db); // Menutup koneksi database
?>
