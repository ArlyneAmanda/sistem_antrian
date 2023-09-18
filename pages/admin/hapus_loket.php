<?php
// Pastikan Anda memiliki koneksi ke database yang sesuai di sini
require '../../koneksi.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Buat query SQL untuk menghapus data berdasarkan ID
    $query = "DELETE FROM loket WHERE id = $id";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    
    // Tutup conn ke database
    $conn->close();
} else {
    echo "ID tidak valid.";
}
?>
