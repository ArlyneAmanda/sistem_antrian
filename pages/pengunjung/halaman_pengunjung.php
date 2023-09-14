<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrean Pengunjung</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    </style>
</head>
<body>
    <div class="container">
        <div class="judul">Selamat Datang di Layanan Kami</div>
        <div class="subjudul">Silakan pilih jenis layanan di bawah ini untuk mendapatkan nomor antrian Anda:</div>
        <div class="btn-container">
            <button class="btn btn-success btn-verifikasi">Verifikasi</button>
            <button class="btn btn-success btn-perbaikan">Perbaikan Data</button>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
