<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Navbar Bootstrap 4</title>
    <!-- Tambahkan link ke CSS Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .dropdown:hover >.dropdown-menu{
        display: block !important;
        }
        .dropdown-submenu:hover > .dropdown-menu{
        display: block !important;
            left: 100%;
            margin-top: -37px;
        }

        .dropdown-item{
        font-size: small; /* 13px */
        }
        .dropdown-toggle::after{
        font-size: var(--font-md);
        margin-bottom: -2px;
        }
        .dropdown-menu li a.active{
        color:#fff;
        }

        .custom-toggle-arrow{
            font-size: 18px;
            margin-top: 1px;
            line-height: 12px;
        }
    </style>
</head>

    <nav class="navbar navbar-expand-lg navbar-light bg-custom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-white" id="navbarNav">
            <?php include 'header.php'; ?>
            <ul class="navbar-nav mx-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link text-white" href="/">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pengunjung/halaman_pengunjung.php">
                        <i class="fas fa-calendar-check"></i> Ambil Antrean
                    </a>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"                     aria-expanded="false">
                    CS
                    </a>
                    <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="#"> Verifikasi<span
                            class="float-end custom-toggle-arrow">&#187</span></a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Loket 1</a></li>
                        <li><a class="dropdown-item" href="#">Loket 2</a></li>
                        <li><a class="dropdown-item" href="#">Loket 3</a></li>
                        <li><a class="dropdown-item" href="#">Loket 4</a></li>
                        <li><a class="dropdown-item" href="#">Loket 5</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="#"> Perbaikan  <span
                            class="float-end custom-toggle-arrow">&#187</span></a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Loket 1</a></li>
                        <li><a class="dropdown-item" href="#">Loket 2</a></li>
                        </ul>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/loket.php">
                    <i class="fas fa-users-line"></i> Loket
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/layanan.php">
                        <i class="fas fa-history"></i> Pelayanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pengunjung/layarAntrean.php">
                        <i class=" fas fa-history"></i> Layar Antrian
                    </a>
                </li>
            </ul>
        </div>
    </nav>

<style>
    .bg-custom {
        background-color: #20c997;
    }
</style>


<!-- Tambahkan link ke JavaScript Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
