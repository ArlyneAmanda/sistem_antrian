<?php
require '../../koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layar Antrian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
      body {
        background-color: #fff; /* Tambahkan warna latar belakang untuk seluruh dokumen */
    }
    .flex-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .footer {
        position: fixed;
        bottom: 0px;
        right: 0px;
        width: 100%;
        z-index: 1000;
        padding: 2px;
        margin: auto;
        text-align: center;
        float: none;
        box-shadow: 0px -2px 10px #c0c0c0;
        background-color: #20c997;
        color: #fff;
    }

    .small-box {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        text-align: center;
        max-width: 350px; /* Lebar lebih besar */
        background-color: #20c997; /* Warna latar belakang baru */
        color: #fff; /* Warna teks putih */
        position: relative;
    }
    
    .small-box h2 {
        font-size: 1.5rem;
    }
    
    .small-box h1 {
        font-size: 2.5rem;
    }
    
    .small-box h3 {
        font-size: 1rem;
    }

    .clock {
        position: absolute;
        top: 2px;
        right: 2px;
        font-size: 1rem;
        background-color: rgba(32, 201, 151, 0.8); /* Warna latar belakang semi-transparan */
        color: #fff; /* Warna teks putih */
        padding: 5px 10px;
        border-radius: 5px;
    }

   /* Gaya untuk running text */
   .running-text-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #4FC0D0;
        color: #fff;
        font-size: 1.2rem;
        overflow: hidden;
    }

    .running-text {
        position: relative;
        animation: marquee 15s linear infinite;
    }

    /* Animasi running text */
    @keyframes marquee {
        0% {
            left: 100%; /* Memulai dari pinggir luar sebelah kanan */
        }
        100% {
            left: -100%; /* Berakhir di pinggir luar sebelah kiri */
        }
    }

    .card-body {
        text-align: center; /* Untuk mengatur posisi horizontal ke tengah halaman */
        display: flex; /* Menggunakan tata letak flex */
        justify-content: center; /* Untuk mengatur posisi vertikal ke tengah halaman */
        align-items: center; /* Untuk mengatur posisi vertikal ke tengah halaman */
    }

</style>
<body>
 
    <!-- /.col -->
            <div class="card-body">
                <!-- Centered image -->
                <div class="clock">
                    <span id="tanggal"></span>
                    <span id="waktu"></span><a>:</a>
                    <span id="detik"></span>
                </div>
                <iframe width="45%" height="350" src="https://tv.detik.com/trans7/embed?smartautoplay=true" frameborder="0" allowfullscreen></iframe>

            </div>

    <!-- /.col -->
</div>
<!-- /.row -->
</div>

    <div class="container mt-3">
    <div class="row">
        <?php
        // Query untuk mengambil data loket
        $loketQuery = "SELECT * FROM loket";
        $loketResult = $conn->query($loketQuery);

        if ($loketResult->num_rows > 0) {
            while ($loketRow = $loketResult->fetch_assoc()) {
                $namaLoket = $loketRow['nama_loket'];

                // Query untuk mengambil data antrian yang sudah dipanggil berdasarkan loket
                $antrianQuery = "SELECT MAX(nomor_antrian) AS nomor_antrian_tertinggi
                                FROM antrian
                                INNER JOIN loket ON antrian.id_layanan = loket.id_layanan
                                WHERE antrian.called = '1' AND loket.nama_loket = '$namaLoket'";

                $antrianResult = $conn->query($antrianQuery);

                if ($antrianResult->num_rows > 0) {
                    $antrianRow = $antrianResult->fetch_assoc();
                    $nomorAntrian = $antrianRow['nomor_antrian_tertinggi'];
                } else {
                    $nomorAntrian = '-';
                }
        ?>
                <div class="col-md-3">
                    <div class="small-box"> 
                        <h2>Nomor Antrian</h2>
                        <hr>
                        <h1 class="display-1 font-weight-bold"><?php echo $nomorAntrian; ?></h1>
                        <hr>
                        <h3 style="display:inline;">- </h3>
                        <h3 style="display:inline;" class="font-weight-bold"><i class="icon fas fa-arrow-circle-right"> </i> <?php echo $namaLoket; ?></h3>
                        <h3 style="display:inline;" class="font-weight-bold">-</h3>
                    </div>
                </div>
        <?php
            }
        } else {
            // Tampilkan pesan jika tidak ada loket yang ditemukan
            echo '<p>Tidak ada loket yang ditemukan.</p>';
        }
        ?>
    </div>
</div>




   
    <!-- Running text -->
    <div class="running-text-container">
        <span class="running-text">Selamat datang di Layanan Antrian Online kami!  || Mohon bersabar, layanan sedang berlangsung || Ingat, jaga jarak sosial dan gunakan masker </span>
    </div>
    <!-- Include Bootstrap JS if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript untuk menampilkan tanggal, waktu, dan detik -->
    <script>
        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('tanggal').textContent = now.toLocaleDateString('id-ID', options);
            document.getElementById('waktu').textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            document.getElementById('detik').textContent = now.getSeconds();
        }
        
        // Panggil fungsi updateClock setiap detik
        setInterval(updateClock, 1000);
        
        // Pertama kali panggil fungsi untuk menampilkan waktu
        updateClock();

         // Element kotak yang ingin diubah ke mode full screen
    const container = document.querySelector('.alert.alert-block.alert-info');

// Element ikon full screen
const fullscreenIcon = document.getElementById('fullscreen-icon');

// Fungsi untuk memasukkan ke mode full screen
function enterFullScreen() {
    if (container.requestFullscreen) {
        container.requestFullscreen();
    } else if (container.mozRequestFullScreen) { // Firefox
        container.mozRequestFullScreen();
    } else if (container.webkitRequestFullscreen) { // Chrome, Safari, dan Opera
        container.webkitRequestFullscreen();
    } else if (container.msRequestFullscreen) { // IE/Edge
        container.msRequestFullscreen();
    }
}

// Fungsi untuk keluar dari mode full screen
function exitFullScreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) { // Firefox
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) { // Chrome, Safari, dan Opera
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { // IE/Edge
        document.msExitFullscreen();
    }
}

// Fungsi untuk memantau perubahan mode full screen
function fullscreenChangeHandler() {
    if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
        fullscreenIcon.className = 'fas fa-compress-arrows-alt'; // Ubah ikon ke mode keluar full screen
    } else {
        fullscreenIcon.className = 'fas fa-expand-arrows-alt'; // Ubah ikon ke mode masuk full screen
    }
}

// Tambahkan event listener untuk ikon full screen
fullscreenIcon.addEventListener('click', () => {
    if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
        exitFullScreen(); // Keluar dari mode full screen jika sudah dalam mode full screen
    } else {
        enterFullScreen(); // Masuk ke mode full screen jika tidak dalam mode full screen
    }
});

// Tambahkan event listener untuk perubahan mode full screen
document.addEventListener('fullscreenchange', fullscreenChangeHandler);
document.addEventListener('webkitfullscreenchange', fullscreenChangeHandler);
document.addEventListener('mozfullscreenchange', fullscreenChangeHandler);
document.addEventListener('MSFullscreenChange', fullscreenChangeHandler);
    </script>
</body>
</html>
