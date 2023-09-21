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

// Koneksi ke database
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Query SQL untuk mengambil jumlah antrean dari tabel "loket"
$queryJumlahAntrean = "SELECT COUNT(*) as nomor_antrian FROM antrian";
$resultJumlahAntrean = $conn->query($queryJumlahAntrean);

// Periksa apakah query berhasil dijalankan
if ($resultJumlahAntrean) {
    $rowJumlahAntrean = $resultJumlahAntrean->fetch_assoc();
    $jumlahAntrean = $rowJumlahAntrean['nomor_antrian'];
} else {
    // Handle kesalahan jika query gagal
    $jumlahAntrean = "Tidak dapat mengambil data antrean.";
}

if (isset($_POST['tambah'])) {
    $namaPetugas = $_POST['namaPetugas'];
    $idLayanan = $_POST['namaLayanan'];
    $namaLoket = $_POST['namaLoket'];

    // Periksa apakah idLayanan adalah integer yang valid
    if (!is_numeric($idLayanan)) {
        echo "Error: id_layanan harus berupa integer.";
    } else {
        // Prepared statement untuk menghindari SQL Injection
        $stmt = $conn->prepare("INSERT INTO loket(petugas, id_layanan, nama_loket) VALUES (?, ?, ?)");
        
        // Periksa apakah prepared statement berhasil dibuat
        if ($stmt) {
            // Binding parameter ke prepared statement
            $stmt->bind_param("sss", $namaPetugas, $idLayanan, $namaLoket);

            // Eksekusi statement
            if ($stmt->execute()) {
                // Data berhasil ditambahkan, tampilkan notifikasi atau lakukan tindakan lainnya
                echo "Data berhasil ditambahkan!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Tutup prepared statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Query SQL untuk mengambil data dari tabel loket
$query = "SELECT * FROM loket";
$result = $conn->query($query);

$query = "SELECT loket.petugas, layanan.nama_layanan, loket.nama_loket, loket.id FROM loket
INNER JOIN layanan ON loket.id_layanan = layanan.id";

$queryLayanan = "SELECT nama_layanan FROM layanan";
$resultLayanan = $conn->query($queryLayanan);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Tambahkan ini di dalam bagian head -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* .card.bg-success {
            background-color: #20c997;
        } */
    </style>
</head>
<body>
<?php include '../../includes/navbar.php'; ?>
    <div class="container mt-5 pb-5">
        <!-- Baris untuk satu baris dengan dua kotak -->
        <div class="row">
            <!-- Kotak "Jumlah Antrean" di sebelah kiri -->
            <div class="col-md-6 mx-auto">
                <div class="card mb-4" style="background-color: #20c997; color: white;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Jumlah Antrean</h5>
                        <p class="card-text"><?php echo $jumlahAntrean; ?></p>
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
                    echo "";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMenuModal">Tambah Loket</button>
        </div>

        <!-- Tombol Hapus Data dan Tombol Register -->
        <div class="text-center mt-3">
            <button class="btn btn-danger" id="hapusSemuaData" data-id="semuaData">
                <i class="bi bi-trash"></i> Hapus Semua Antrian
            </button>
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
                            <select class="form-control" id="namaPetugas" name="namaPetugas" required>
                                <option> Silahkan Pilih Petugas </option>
                                <?php
                                include '../../koneksi.php';
				                //query menampilkan nama unit kerja ke dalam combobox
				                $b	= mysqli_query($conn, "SELECT * FROM user");
				                while ($data = mysqli_fetch_array($b)) {
				                ?>
				                <option value="<?=$data['username'];?>"><?php echo $data['nama'];?></option>
				                <?php
				                }
				                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaLayanan">Nama Layanan</label>
                            <select class="form-control" id="namaLayanan" name="namaLayanan" required>
                            <option> Silahkan Pilih Layanan </option>
                            <?php
                                include '../../koneksi.php';
				                //query menampilkan nama unit kerja ke dalam combobox
				                $b	= mysqli_query($conn, "SELECT * FROM layanan");
				                while ($data = mysqli_fetch_array($b)) {
				                ?>
				                <option value="<?=$data['id'];?>"><?php echo $data['nama_layanan'];?></option>
				                <?php
				                }
				                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaLoket">Nama Loket</label>
                            <input type="text" class="form-control" id="namaLoket" name="namaLoket" placeholder="Masukkan Nama Loket Disini" required>
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
    
    <!-- Tambahkan script Bootstrap, jQuery, dan DataTables di sini -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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

            // Menampilkan notifikasi "success" selama 1 detik
            toastr.success('Data berhasil ditambahkan!', 'Sukses', { timeOut: 1000 });

            
            // Tutup modal
            $('#tambahMenuModal').modal('hide');

            // Refresh halaman setelah 1 detik
            setTimeout(function() {
                location.reload();
            }, 500); // Refresh setelah 1 detik (1000 milidetik)
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

    // Tampilkan konfirmasi Sweet Alert
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna menekan tombol "Ya, Hapus!", kirim permintaan AJAX
            $.ajax({
                type: "POST",
                url: "hapus_loket.php", // Ganti dengan path ke script PHP yang akan menghapus data
                data: {
                    id: idData
                },
                success: function(response) {
                    // Tambahkan kode di sini untuk mengupdate tabel atau melakukan tindakan lainnya
                    console.log(response);

                    // Tampilkan notifikasi Sweet Alert jika data berhasil dihapus
                    Swal.fire(
                        'Sukses!',
                        'Data berhasil dihapus.',
                        'success'
                    );

                    // Refresh halaman setelah 3 detik
                    setTimeout(function() {
                        location.reload();
                    }, 3000); // Refresh setelah 3 detik (3000 milidetik)
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
    // Tampilkan konfirmasi Sweet Alert
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin menghapus semua jumlah antrian ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna menekan tombol "Ya, Hapus!", kirim permintaan AJAX
            $.ajax({
                type: "POST",
                url: "hapus_semua_data_loket.php", // Ganti dengan path ke script PHP yang akan menghapus semua data
                success: function(response) {
                    // Tambahkan kode di sini untuk mengupdate tabel atau melakukan tindakan lainnya
                    console.log(response);

                    // Tampilkan notifikasi Sweet Alert jika data berhasil dihapus
                    Swal.fire(
                        'Sukses!',
                        'Semua data berhasil dihapus.',
                        'success'
                    );

                    // Refresh halaman setelah 3 detik
                    setTimeout(function() {
                        location.reload();
                    }, 3000); // Refresh setelah 3 detik (3000 milidetik)
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr.responseText);
                    // Tambahkan kode di sini untuk menangani kesalahan
                }
            });
        }
    });
});


        });
    </script>
</body>
</html>
