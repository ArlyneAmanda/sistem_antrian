<?php
// Koneksi ke database
$DB_host = "localhost"; // Ganti sesuai dengan host database Anda
$DB_username = "root"; // Ganti sesuai dengan username database Anda
$DB_password = ""; // Ganti sesuai dengan password database Anda
$DB_name = "sistem_antrian"; // Ganti sesuai dengan nama database Anda

// Membuat koneksi ke database
$koneksi = new mysqli($DB_host, $DB_username, $DB_password, $DB_name);
$conn = mysqli_connect($DB_host, $DB_username, $DB_password, $DB_name);


// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);

}
?>
