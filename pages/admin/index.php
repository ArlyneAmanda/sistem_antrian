<?php

session_start();

// Periksa apakah pengguna sudah login sebagai Admin
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "Admin") {
    // Jika bukan Admin, arahkan ke halaman login atau halaman lain sesuai kebijakan Anda
    header("Location: ../login.php");
    exit();
}

// Selanjutnya, Anda dapat menggunakan session untuk mendapatkan informasi pengguna, misalnya:
$username = $_SESSION["username"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</body>
</html>