<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

</style>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-5">
                <div class="alert alert-block alert-info" style="height: 96%; background-color: #20c997!important; border-color: #20c997!important; color: #fff!important;">
                    <br>
                    <br>
                    <h2>Nomor Antrian</h2>
                    <hr>
                    <h1 class="display-1 font-weight-bold" id="nomor_antrian">265</h1>
                    <hr>
                    <h3 id="keterangan" style="display:inline;">-</h3>
                    <h3 style="display:inline;" class="font-weight-bold"><i class="icon fas fa-arrow-circle-right"> </i> Loket B</h3>
                    <h3 id="nomor_loket" style="display:inline;" class="font-weight-bold">-</h3>
                </div>
            </div>
    
            <!-- /.col -->
            <div class="col-md-7">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="clock">
                            <span id="tanggal"></span>
                            <span id="waktu"></span><a>:</a>
                            <span id="detik"></span>
                        </div>
                        <img width="100%" height="320" src="https://ilhamrizqi.com/wp-content/uploads/2014/08/computer-programming.jpg" alt="Gambar Programming">
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="small-box">
                    <!-- Isi Konten Sama Dengan Container Antrian -->
                    <h2>Nomor Antrian</h2>
                    <hr>
                    <h1 class="display-1 font-weight-bold">222</h1>
                    <hr>
                    <h3 style="display:inline;">-</h3>
                    <h3 style="display:inline;" class="font-weight-bold"><i class="icon fas fa-arrow-circle-right"> </i> Loket C</h3>
                    <h3 style="display:inline;" class="font-weight-bold">-</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box">
                    <!-- Isi Konten Sama Dengan Container Antrian -->
                    <h2>Nomor Antrian</h2>
                    <hr>
                    <h1 class="display-1 font-weight-bold">204</h1>
                    <hr>
                    <h3 style="display:inline;">-</h3>
                    <h3 style="display:inline;" class="font-weight-bold"><i class="icon fas fa-arrow-circle-right"> </i> Loket A</h3>
                    <h3 style="display:inline;" class="font-weight-bold">-</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box">
                    <!-- Isi Konten Sama Dengan Container Antrian -->
                    <h2>Nomor Antrian</h2>
                    <hr>
                    <h1 class="display-1 font-weight-bold">235</h1>
                    <hr>
                    <h3 style="display:inline;">-</h3>
                    <h3 style="display:inline;" class="font-weight-bold"><i class="icon fas fa-arrow-circle-right"> </i> Loket B</h3>
                    <h3 style="display:inline;" class="font-weight-bold">-</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box">
                    <!-- Isi Konten Sama Dengan Container Antrian -->
                    <h2>Nomor Antrian</h2>
                    <hr>
                    <h1 class="display-1 font-weight-bold">269</h1>
                    <hr>
                    <h3 style="display:inline;">-</h3>
                    <h3 style="display:inline;" class="font-weight-bold"><i class="icon fas fa-arrow-circle-right"> </i> Loket A</h3>
                    <h3 style="display:inline;" class="font-weight-bold">-</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Running text -->
    <div class="running-text-container">
        <span class="running-text">bodol bodol bodol bodol</span>
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
