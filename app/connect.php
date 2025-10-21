<?php
ob_start();
// Konfigurasi database
$host = 'mysql-container'; // Nama container MySQL sesuai dengan 'container_name' di docker-compose.yml
$dbname = 'db_warung_meduro'; // Nama database yang dibuat
$username = 'user'; // User MySQL sesuai konfigurasi
$password = 'warung_meduro'; // Password MySQL sesuai konfigurasi

try {
    // Membuat koneksi menggunakan PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set atribut PDO untuk menampilkan error jika ada
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Koneksi ke database berhasil!";
} catch (PDOException $e) {
    // Menampilkan pesan error jika koneksi gagal
    die("Koneksi gagal: " . $e->getMessage());
}
ob_end_flush();
?>

