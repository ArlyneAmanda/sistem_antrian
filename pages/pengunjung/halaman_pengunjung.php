<?php
// Kode untuk mengambil data menu dari tabel "layanan"
// Lakukan koneksi ke database sesuai dengan pengaturan Anda
require '../../koneksi.php';

// Query SQL untuk mengambil data menu
$sql = "SELECT * FROM layanan";
$result = $conn->query($sql);

$menuItems = array(); // Inisialisasi array untuk menampung data menu
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menuItems[] = $row; // Menambahkan data menu ke dalam array
    }
}

// Tutup koneksi ke database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrean Pengunjung</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        .btn-container {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center; /* Menengahkan horizontal */
        }
        .btn-success,
        .btn-success {
            background-color: #20c997; /* Ubah warna tombol menjadi #20c997 */
            font-size: 24px;
            padding: 20px 40px;
            margin-bottom: 30px;
            width: 80%;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .btn-verifikasi:hover {
            background-color: #0056b3;
            box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
        }
        .btn-perbaikan:hover {
            background-color: #c82333;
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
        }
        .btn-verifikasi:focus, .btn-perbaikan:focus {
            outline: none;
        }
        .btn-verifikasi:active, .btn-perbaikan:active {
            transform: scale(0.95);
        }
        .judul {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .subjudul {
            font-size: 18px;
            margin-bottom: 30px;
            color: #666;
        }
        .img1{
            position: absolute;
            left: 0;
            bottom: 0;
            width: 300px;
        }
    </style>
</head>
<body>
        <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item mb-2 fs-5">
                    <a class="nav-link" aria-current="page" href="halaman_pengunjung.php">Halaman Utama</a>
                </li>
                <li class="nav-item dropdown mb-2 fs-5">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    CS
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="../CS/index.php">Verifikasi</a></li>
                    <li><a class="dropdown-item" href="../CS/index.php">Perbaikan Data</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-2 fs-5">
                    <a class="nav-link" aria-current="page" href="../admin/index.php">Admin</a>
                </li>

                </ul>
            </div>
            </div>
        </div>
        </nav>
    <div class="container">
        <div class="judul">Selamat Datang di Layanan Kami</div>
        <div class="subjudul">Silakan pilih jenis layanan di bawah ini untuk mendapatkan nomor antrian Anda:</div>
        <div class="btn-container">
            <?php
            // Menampilkan tombol-tombol menu dari data yang diambil dari database
            foreach ($menuItems as $menuItem) {
                echo '<button class="btn btn-success btn-menu" data-id="' . $menuItem["id"] . '">' . $menuItem["nama_layanan"] . '</button>';
            }
            ?>
        </div>
    </div>

    <img src="../../images/pengunjungpics.webp" alt="" class="img1">

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Fungsi untuk menambahkan nomor antrian
        function tambahkanNomorAntrian(idLayanan) {
            $.ajax({
                type: "POST",
                url: "proses_antrian.php", // Ganti dengan path ke script PHP yang telah diperbarui
                data: {
                    id_layanan: idLayanan
                },
                dataType: "json", // Menyatakan bahwa server akan mengirimkan respons dalam format JSON

                success: function(response) {
                    if (response.error) {
                        alert("Terjadi kesalahan: " + response.error);
                    } else {
                        // Menampilkan nomor antrian dalam modal
                        tampilkanNomorAntrian(response.nomor_antrian);
                    }
                },

                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan saat mengirim permintaan AJAX.");
                }
            });
        }

        // Event handler untuk tombol menu
        $(".btn-menu").click(function() {
            var idLayanan = $(this).data("id");
            tambahkanNomorAntrian(idLayanan);
        });

        // Fungsi untuk menampilkan nomor antrian dalam modal
        function tampilkanNomorAntrian(nomorAntrian) {
            // Munculkan modal dengan nomor antrian
            $('#nomorAntrianModal').modal('show');
            // Ubah isi modal dengan nomor antrian
            $('#nomorAntrian').text(nomorAntrian);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   <!-- Modal untuk menampilkan nomor antrian -->
<div class="modal fade" id="nomorAntrianModal" tabindex="-1" role="dialog" aria-labelledby="nomorAntrianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="nomorAntrianModalLabel">Nomor Antrian Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Nomor Antrian Anda adalah : <span id="nomorAntrian"></span><br> Nomor Antrian Anda Akan Segera Dicetak</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
