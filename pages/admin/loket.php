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

// Koneksi ke database
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

if (isset($_POST['tambah'])) {
    $namaPetugas = $_POST['namaPetugas'];
    $namaLayanan = $_POST['namaLayanan'];
    $namaLoket = $_POST['namaLoket'];

    // Prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO loket(petugas, id_layanan, nama_loket) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $namaPetugas, $namaLayanan, $namaLoket);
    
    if ($stmt->execute()) {
        // Data berhasil ditambahkan, tampilkan notifikasi
        echo '<script>$("#notifModal").modal("show");</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();
}

// Query SQL untuk mengambil data dari tabel peLoket
$query = "SELECT * FROM loket";
$result = $conn->query($query);

// Tutup koneksi ke database
$conn->close();
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
        
    </style>
</head>
<body>
    <div class="container mt-5 pb-5">
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
                    <th>Nama Petugas</th>
                    <th>Nama Layanan</th>
                    <th>loket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['petugas'] . '</td>';
                        echo '<td>' . $row['id_layanan'] . '</td>';
                        echo '<td>' . $row['nama_loket'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-danger hapus-data" data-id="' . $row['id'] . '">Hapus</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "Loket belum tersedia.";
                }
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
                    <form id="formTambahMenu" method="post">
                        <div class="form-group">
                            <label for="namaPetugas">Nama Petugas</label>
                            <input type="text" class="form-control" id="namaPetugas" name="namaPetugas" required>
                        </div>
                        <div class="form-group">
                            <label for="namaLayanan">Nama Layanan</label>
                            <input type="text" class="form-control" id="namaLayanan" name="namaLayanan" required>
                        </div>
                        <div class="form-group">
                            <label for="namaLoket">Nama Loket</label>
                            <input type="text" class="form-control" id="namaLoket" name="namaLoket" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tambahkanMenu" name="tambah">Tambahkan</button>
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

    <!-- Tambahkan script Bootstrap, jQuery, dan DataTables di sini -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#antreanTable').DataTable();

            // ...

            // Event handler untuk tombol "Tambahkan" pada modal diklik
            $("#tambahkanMenu").click(function() {
                var namaPetugas = $("#namaPetugas").val();
                var namaLayanan = $("#namaLayanan").val();
                var namaLoket = $("#namaLoket").val();
                
                $.ajax({
                    type: "POST",
                    url: "loket.php", // Ganti dengan path ke halaman ini
                    data: {
                        tambah: true,
                        namaPetugas: namaPetugas,
                        namaLayanan: namaLayanan,
                        namaLoket: namaLoket
                    },
                    success: function(response) {
                        console.log(response); // Ini akan menampilkan response dari server di konsol browser
                        
                        // Tutup modal
                        $('#tambahMenuModal').modal('hide');

                        // Refresh halaman setelah 1 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000); // Refresh setelah 1 detik (1000 milidetik)
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
                        url: "hapus_loket.php", // Ganti dengan path ke script PHP yang akan menghapus data
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
                        url: "hapus_semua_data_loket.php", // Ganti dengan path ke script PHP yang akan menghapus semua data
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
