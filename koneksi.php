<?php
// Koneksi ke database
$host = "localhost"; // Ganti sesuai dengan host database Anda
$username = "root"; // Ganti sesuai dengan username database Anda
$password = ""; // Ganti sesuai dengan password database Anda
$database = "sistem_antrian"; // Ganti sesuai dengan nama database Anda

// Membuat koneksi ke database
$koneksi = new mysqli($host, $username, $password, $database);
$conn = mysqli_connect($host, $username, $password, $database);


// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}
?>
