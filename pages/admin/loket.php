<?php
require '../../koneksi.php';

session_start();

// Periksa apakah pengguna sudah login sebagai Admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "Admin") {
    // Jika bukan Admin, arahkan ke halaman login atau halaman lain sesuai kebijakan Anda
    header("Location: ../login.php");
    exit();
}

// Selanjutnya, Anda dapat menggunakan session untuk mendapatkan informasi pengguna, misalnya:
$username = $_SESSION["username"];

// Tampilkan halaman admin dengan informasi yang sesuai
// ...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>

    <!-- Link ke CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Link ke font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!-- Link ke CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .img1{
            position: absolute;
            right: 0;
            bottom: 0;
            width: 300px;
        }
    </style>
</head>
<!--  -->
<body>
    <div class="container mt-5">
        <!-- Baris untuk satu baris dengan dua kotak -->
        <div class="row">
            <!-- Kotak "Jumlah Antrean" di sebelah kiri -->
            <div class="col-md-6">
                <div class="card mb-4 bg-success text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Antrean</h5>
                        <p class="card-text">123</p>
                    </div>
                </div>
            </div>
            <!-- Kotak "Antrean Tersisa" di sebelah kanan -->
            <div class="col-md-6">
                <div class="card mb-4 bg-primary text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Antrean Tersisa</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel untuk menampilkan data antrean -->
        <table class="table mt-4" id="antreanTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kode loket</th>
                    <th>loket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                // Query SQL untuk mengambil data dari tabel peLoket
                $query = "SELECT * FROM loket";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['penjaga'] . '</td>';
                        echo '<td>' . $row['kode_loket'] . '</td>';
                        echo '<td>' . $row['nama_loket'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-danger hapus-data" data-id="' . $row['id'] . '">Hapus</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "Loket belum tersedia.";
                }

                // Tutup koneksi ke database
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- Tombol "Tambah Menu" di bawah tabel -->
        <div class="text-center mt-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMenuModal">Tambah Loket</button>
            <a href="logout.php" class="btn btn-danger ml-3">Log Out</a>
        </div>

        <!-- Tombol Hapus Data dan Tombol Register -->
        <div class="text-center mt-3">
            <button class="btn btn-danger" id="hapusSemuaData">
                <i class="bi bi-trash"></i> Hapus Semua Data
            </button>
            <a href="register.php" class="btn btn-success ml-3">
                Register Akun
            </a>
        </div>
    </div>

    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Loket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMenu">
                        <div class="form-group">
                            <label for="namaPenjaga">Nama Penjaga</label>
                            <input type="text" class="form-control" id="namaPenjaga" name="namaPenjaga" required>
                        </div>
                        <div class="form-group">
                            <label for="kodeLoket">Kode Loket</label>
                            <input type="text" class="form-control" id="kodeLoket" name="kodeLoket" required>
                        </div>
                        <div class="form-group">
                            <label for="namaMenu">Nama Loket</label>
                            <input type="text" class="form-control" id="namaMenu" name="namaMenu" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="tambahkanMenu">Tambahkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi -->
    <div class="modal fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Data berhasil ditambahkan!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <img src="../../images/adminpics.webp" alt="" class="img1">

    <!-- Tambahkan script Bootstrap, jQuery, dan DataTables di sini -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#antreanTable').DataTable();

            // Event handler untuk tombol "Tambahkan" pada modal diklik
            $("#tambahkanMenu").click(function() {
                var namaPenjaga = $("#namaPenjaga").val();
                var kodeLoket = $("#kodeLoket").val();
                var namaMenu = $("#namaMenu").val();
                $.ajax({
                    type: "POST",
                    url: "tambah_menu.php", // Ganti dengan path ke script PHP yang akan menambahkan data
                    data: {
                        namaPenjaga: namaPenjaga,
                        kodeLoket: kodeLoket,
                        namaMenu: namaMenu
                    },
                    // ...

                    success: function(response) {
                        console.log(response); // Ini akan menampilkan response dari server di konsol browser
                        // Tampilkan modal notifikasi
                        $('#notifModal').modal('show');

                        // Tutup modal
                        $('#tambahMenuModal').modal('hide');

                        // Refresh halaman setelah 3 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000); // Refresh setelah 3 detik (1000 milidetik)
                    },

                    // ...

                    error: function(xhr, textStatus, errorThrown) {
                        console.error(xhr.responseText);
                        // Tambahkan kode di sini untuk menangani kesalahan
                    }
                });
            });

            // Event handler untuk tombol "Hapus"
            $(".hapus-data").click(function() {
                var idData = $(this).data("id");
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    $.ajax({
                        type: "POST",
                        url: "hapus_menu.php", // Ganti dengan path ke script PHP yang akan menghapus data
                        data: {
                            id: idData
                        },
                        success: function(response) {
                            // Tambahkan kode di sini untuk mengupdate tabel atau melakukan tindakan lainnya
                            console.log(response);
                            // Refresh halaman setelah 3 detik
                            setTimeout(function() {
                                location.reload();
                            }, 500); // Refresh setelah 3 detik (500 milidetik)
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(xhr.responseText);
                            // Tambahkan kode di sini untuk menangani kesalahan
                        }
                    });
                }
            });

            // Event handler untuk tombol "Hapus Semua Data"
            $("#hapusSemuaData").click(function() {
                if (confirm("Apakah Anda yakin ingin menghapus semua data?")) {
                    $.ajax({
                        type: "POST",
                        url: "hapus_semua_data.php", // Ganti dengan path ke script PHP yang akan menghapus semua data
                        success: function(response) {
                            // Tambahkan kode di sini untuk mengupdate tabel atau melakukan tindakan lainnya
                            console.log(response);
                            // Refresh halaman setelah 3 detik
                            setTimeout(function() {
                                location.reload();
                            }, 500); // Refresh setelah 3 detik (500 milidetik)
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(xhr.responseText);
                            // Tambahkan kode di sini untuk menangani kesalahan
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
