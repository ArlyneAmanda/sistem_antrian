<?php
// Lakukan koneksi ke database sesuai dengan pengaturan Anda
require '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Periksa apakah data id_layanan telah dikirimkan dari halaman sebelumnya
    if (isset($_POST["id_layanan"])) {
        $idLayanan = $_POST["id_layanan"];

        // Ambil nomor antrian terakhir dari database
        $getLastQueueNumberQuery = "SELECT MAX(nomor_antrian) AS max_nomor FROM antrian where id_layanan = '$idLayanan'";
        $result = $conn->query($getLastQueueNumberQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nomorAntrian = $row["max_nomor"] + 1;
        } else {
            $nomorAntrian = 1; // Jika tidak ada data antrian sebelumnya, mulai dari nomor 1
        }

        // Contoh query untuk menambahkan data ke tabel antrian
        $insertQuery = "INSERT INTO antrian (id_layanan, nomor_antrian) VALUES ($idLayanan, $nomorAntrian)";

        if ($conn->query($insertQuery) === TRUE) {
            // Kembalikan nomor antrian dan id_layanan dalam format JSON
            echo json_encode(array("nomor_antrian" => $nomorAntrian, "id_layanan" => $idLayanan));
        } else {
            // Jika terjadi kesalahan dalam penambahan data
            echo json_encode(array("error" => "Error: " . $insertQuery . "<br>" . $conn->error));
        }
    } else {
        // Jika id_layanan tidak dikirimkan dengan benar
        echo json_encode(array("error" => "Invalid Request"));
    }
} else {
    // Jika request bukan POST
    echo json_encode(array("error" => "Invalid Request"));
}

// Tutup koneksi ke database
$conn->close();
?>
