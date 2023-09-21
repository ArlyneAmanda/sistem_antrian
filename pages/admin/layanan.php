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

// Fungsi untuk menambahkan data layanan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kodeLayanan"]) && isset($_POST["namaMenu"])) {
    $kodeLayanan = $_POST["kodeLayanan"];
    $namaMenu = $_POST["namaMenu"];

    // Koneksi ke database
    // Gantilah bagian ini dengan koneksi ke database Anda

    // Query SQL untuk menambahkan data ke tabel layanan
    $query = "INSERT INTO layanan (kode_layanan, nama_layanan) VALUES ('$kodeLayanan', '$namaMenu')";
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi ke database
    $conn->close();
}
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
    <!-- Link ke library Swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body>
<?php include '../../includes/navbar.php'; ?>
    <div class="container mt-5">
        <!-- Baris untuk satu baris dengan dua kotak -->
        

        <!-- Tabel untuk menampilkan data antrean -->
        <table class="table mt-4" id="antreanTable">
            <thead>
                <tr>
                    <th>Kode Layanan</th>
                    <th>Nama Layanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                // Query SQL untuk mengambil data dari tabel pelayanan
                $query = "SELECT * FROM layanan";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['kode_layanan'] . '</td>';
                        echo '<td>' . $row['nama_layanan'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-danger hapus-data" data-id="' . $row['id'] . '">Hapus</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "Tidak ada data pelayanan.";
                }

                // Tutup koneksi ke database
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMenuModal">Tambah Menu</button>
        </div>
        
        <!-- Tombol Hapus Data dan Tombol Register -->
        <div class="text-center mt-3">
            <button class="btn btn-danger" id="hapusSemuaData">
                <i class="bi bi-trash"></i> Hapus Semua Data
            </button>
        </div>
    </div>

    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="tambahMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMenu">
                        <div class="form-group">
                            <label for="kodeLayanan">Kode Layanan</label>
                            <input type="text" class="form-control" id="kodeLayanan" name="kodeLayanan" required>
                        </div>
                        <div class="form-group">
                            <label for="namaMenu">Nama Layanan</label>
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
                var kodeLayanan = $("#kodeLayanan").val();
                var namaMenu = $("#namaMenu").val();
                $.ajax({
                    type: "POST",
                    url: "layanan.php", // Ganti dengan path ke script PHP yang akan menambahkan data
                    data: {
                        kodeLayanan: kodeLayanan,
                        namaMenu: namaMenu
                    },
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
                    error: function(xhr, textStatus, errorThrown) {
                        console.error(xhr.responseText);
                        // Tambahkan kode di sini untuk menangani kesalahan
                    }
                });
            });

$(".hapus-data").click(function() {
    var idData = $(this).data("id");
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "hapus_menu.php", // Ganti dengan path ke script PHP yang akan menghapus data
                data: {
                    id: idData
                },
                success: function(response) {
                    // Tambahkan kode di sini untuk mengupdate tabel atau melakukan tindakan lainnya
                    console.log(response);
                    // Tampilkan notifikasi data berhasil dihapus
                    Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                    // Refresh halaman setelah 1 detik
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // Refresh setelah 1 detik (1000 milidetik)
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr.responseText);
                    // Tambahkan kode di sini untuk menangani kesalahan
                }
            });
        }
    });
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
