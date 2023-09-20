<?php
session_start();

// Periksa apakah pengguna sudah login sebagai CS
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "CS") {
    // Jika bukan CS, arahkan ke halaman login atau halaman lain sesuai kebijakan Anda
    header("Location: ../login.php");
    exit();
}

require '../../koneksi.php';

// Fungsi untuk mendapatkan informasi loket berdasarkan ID
function getLoket($conn, $id, $get){
    $query = "SELECT * FROM loket where id = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $row[$get];
        }
        return $data;
    }
    return ''; // Return string kosong jika tidak ada data yang ditemukan
}

// Fungsi untuk mendapatkan informasi layanan berdasarkan ID
function getLayanan($conn, $id, $get){
    $query = "SELECT * FROM layanan where id = $id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $row[$get];
        }
        return $data;
    }
    return ''; // Return string kosong jika tidak ada data yang ditemukan
}

// Fungsi untuk mendapatkan nomor antrian yang belum dipanggil
function getAntrian($conn, $id){
    $query = "SELECT min(nomor_antrian) as nomor_antrian FROM antrian where id_layanan = $id AND called = 0";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data = $row['nomor_antrian'];
    } else {
        // Jika tidak ada nomor antrian yang belum dipanggil, cek nomor antrian yang sudah dipanggil
        $query = "SELECT max(nomor_antrian) as nomor_antrian FROM antrian where id_layanan = $id AND called = 1";
        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $data = $row['nomor_antrian'];
        } else {
            $data = '';
        }
    }

    return $data;
}

// Cek apakah parameter 'id' telah diberikan dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $id_layanan = getLoket($conn, $id, "id_layanan");
    $nama_loket = getLoket($conn, $id, "nama_loket");
    $nama_layanan = getLayanan($conn, $id_layanan, "nama_layanan");
    $kode_layanan = getLayanan($conn, $id_layanan, "kode_layanan");
    $nomor_antrian = getAntrian($conn, $id_layanan);
    $message = true; // Inisialisasi notifikasi kosong
} else {
    // Jika 'id' tidak ada dalam URL, arahkan ke halaman lain atau berikan pesan kesalahan
    echo "ID Loket tidak ditemukan.";
    exit();
}

// Cek jika tombol "Selanjutnya" ditekan
if (isset($_POST['btnSelanjutnya'])) {
    $nomor_antrian = $_POST['btnSelanjutnya'];

    // Update nilai 'called' menjadi 1 untuk nomor antrian saat ini
    $updateQuery = "UPDATE antrian SET called = 1 WHERE id_layanan = $id_layanan AND nomor_antrian = $nomor_antrian";
    $conn->query($updateQuery);

    // Cari nomor antrian selanjutnya yang belum dipanggil
    $query_next = "SELECT nomor_antrian FROM antrian WHERE id_layanan = $id_layanan AND called = 0 ORDER BY nomor_antrian ASC LIMIT 1";
    $result_next = $conn->query($query_next);

    if ($result_next && $result_next->num_rows > 0) {
        // Ambil nomor antrian selanjutnya
        $row = $result_next->fetch_assoc();
        $nomor_antrian = $row['nomor_antrian'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayanan Loket (Verifikasi)</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
        }
        .navbar {
            background-color: #20c997;
            padding: 1rem 0;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        .navbar-nav {
            font-size: 18px;
        }
        .navbar-nav .nav-item {
            margin-right: 20px.
        }
        .navbar-nav .nav-link {
            color: #fff; /* Mengubah warna teks menjadi putih */
        }
        .judul-loket {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            margin-top: 30px;
        }
        .panggil-antrean p {
            margin: 0; /* Menghilangkan margin default */
        }
        .antrian {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
        .nomor-antrian {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
            text-align: center;
            margin-top: 35px;
        }
        .icon-orang {
            font-size: 200px;
            color: #007bff; /* Warna ikon orang */
        }
        .button-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-panggil {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            margin: 0 10px;
            text-transform: uppercase;
            background-color: #20c997; /* Mengubah warna tombol menjadi #20c997 */
            border: none; /* Menghilangkan border */
        }
        .btn-selanjutnya {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            margin: 0 10px;
            text-transform: uppercase;
        }
        .notification {
            color: red;
            text-align: center;
            font-weight: bold;
        }
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Pelayanan Loket</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="nav-item"><a class="nav-link" href="?id='.$row['id'].'">' . $row['nama_loket'] . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="judul-loket">Pelayanan <?php echo $nama_loket; ?> (<?php echo $nama_layanan; ?>)</div>
        <div class="antrian">
            <p>Silahkan panggil nomor antrean jika nomor antrian telah tersedia</p>
        </div>
        <form method="post">
            <p class="nomor-antrian">Nomor Antrian : <?php echo $kode_layanan; ?> <?php echo $nomor_antrian; ?> </p>
            <div class="text-center">
                <i class="icon-orang fas fa-user"></i>
            </div>
            <div class="button-container">
                <!-- Tombol "Selanjutnya" akan selalu aktif -->
                <button id="btnSelanjutnya" class="btn btn-selanjutnya btn-primary" name="btnSelanjutnya" value="<?php echo $nomor_antrian ?>">Selanjutnya</button>
            </div>
        </form>
       
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>