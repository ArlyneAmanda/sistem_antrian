<?php
// Pastikan Anda memiliki koneksi ke database yang sesuai di sini
require '../../koneksi.php';

// Buat query SQL untuk menghapus semua data
$query = "DELETE FROM loket";

// Eksekusi query
if ($conn->query($query) === TRUE) {
    echo "Semua data berhasil dihapus.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

// Tutup conn ke database
$conn->close();
?>
