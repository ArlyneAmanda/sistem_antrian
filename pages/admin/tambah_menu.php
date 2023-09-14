<?php
require '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai kode layanan dan nama menu dari data yang dikirimkan melalui AJAX
    $kodeLayanan = $_POST['kodeLayanan'];
    $namaMenu = $_POST['namaMenu'];

    // Contoh query SQL untuk menambahkan data ke dalam tabel layanan
    $query = "INSERT INTO layanan (nama_layanan, kode_layanan) VALUES ('$namaMenu', '$kodeLayanan')";

    if ($koneksi->query($query)) {
        // Jika query berhasil dijalankan, kirimkan pesan berhasil ke AJAX
        echo "Data berhasil ditambahkan!";
    } else {
        // Jika terjadi kesalahan, kirimkan pesan error ke AJAX
        echo "Error: " . $koneksi->error;
    }

    // Tutup koneksi ke database
    $koneksi->close();
}
?>
