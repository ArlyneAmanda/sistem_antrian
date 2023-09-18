<?php
// Pastikan Anda memiliki koneksi ke database yang sesuai di sini
require '../../koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Buat query SQL untuk menghapus data berdasarkan ID
    $query = "DELETE FROM layanan WHERE id = $id";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
    
    // Tutup koneksi ke database
    $koneksi->close();
} else {
    echo "ID tidak valid.";
}
?>
