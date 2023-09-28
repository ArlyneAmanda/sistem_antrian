<?php

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["username"])) {
    // Jika belum login, arahkan ke halaman login atau halaman lain sesuai kebijakan Anda
    header("Location: ../login.php");
    exit();
}

// Selanjutnya, Anda dapat menggunakan session untuk mendapatkan informasi pengguna, misalnya:
$username = $_SESSION["username"];
$role = $_SESSION["role"];

// Pengecekan peran untuk mengakses halaman CS
if ($role === "Admin" || $role === "CS") {
    // Pengguna yang memiliki peran "Admin" atau "CS" diizinkan mengakses halaman CS
    // Isi halaman CS di sini
} else {
    // Jika bukan "Admin" atau "CS," arahkan ke halaman lain atau tampilkan pesan akses ditolak
    header("Location: ../login.php"); // Atau arahkan ke halaman lain
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 15%;
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
<?php include '../../includes/navbar.php'; ?>
<body>
<div class="container">
        <div class="judul">Selamat Datang di Halaman Admin</div>
        <div class="subjudul">Silakan pilih menu yang ada pada navbar untuk memanage fitur yang tersedia.</div>  
</div>
<img src="../../images/adminpics.webp" alt="" class="img1">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>