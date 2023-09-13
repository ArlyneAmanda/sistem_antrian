<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Navbar Bootstrap 4</title>
    <!-- Tambahkan link ke CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            font-weight: bold; /* Teks menjadi tebal */
        }   
    </style>
</head>
    <nav class="navbar navbar-expand-lg navbar-light bg-custom">
        <a class="navbar-brand custom-font text-white" href="">Antrean PPDB</a>
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
                    <a class="nav-link text-white" href="../pages/panitia/index.php">
                        <i class="fas fa-calendar-check"></i> Ambil Antrean
                    </a>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> Verfikasi
                    </a>   
                            <ul class="dropdown-menu" aria-labelledby="nestedDropdown2">
                                <a class="dropdown-item" href="#">loket 1</a>
                                <a class="dropdown-item" href="#">loket 2</a>
                                <a class="dropdown-item" href="#">loket 3</a>
                                <a class="dropdown-item" href="#">loket 4</a>
                                <a class="dropdown-item" href="#">loket 5</a>
                            </ul>  
                </li>  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> Perbaikan Data
                    </a>   
                            <ul class="dropdown-menu" aria-labelledby="nestedDropdown2">
                                <a class="dropdown-item" href="#">loket 1</a>
                                <a class="dropdown-item" href="#">loket 2</a>
                            </ul>  
                </li> 
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/admin/pelayanan.php">
                        <i class="fas fa-history"></i> Pelayanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../pages/admin/layarAntrean.php">
                        <i class=" fas fa-solid fa-display"></i> Layar Antrian
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

</body>
</html>
