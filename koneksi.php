<?php
// Pengaturan koneksi database
$host = "localhost";
$username = "root"; // Ganti dengan nama pengguna Anda
$password = "";     // Ganti dengan kata sandi Anda
$database = "sistem_antrean";       // Ganti dengan nama database Anda

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}
?>
