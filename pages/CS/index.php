<!DOCTYPE html>
<html lang="en">
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
            margin-right: 20px;
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Loket 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Loket 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Loket 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Loket 4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Loket 5</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="judul-loket">Pelayanan Loket 1 (Verifikasi)</div>
        <div class="antrian">
            <p>Silahkan panggil nomor antrean jika nomor antrean telah tersedia</p>
        </div>
        <div>
            <p class="nomor-antrian">Nomor Antrian: A01</p>
            <div class="text-center">
                <i class="icon-orang fas fa-user"></i>
            </div>
            <div class="button-container">
                <button class="btn btn-panggil btn-success">Panggil</button>
                <button class="btn btn-selanjutnya btn-primary">Selanjutnya</button>
            </div>
        </div>
    </div>

  <img src="../../images/CSpics.webp" alt="" class="img1">
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
