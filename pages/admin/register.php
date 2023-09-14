<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    require '../../koneksi.php';

    // Ambil data dari formulir
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $role = $_POST['role'];

    // Query SQL untuk menyimpan data ke dalam tabel "user"
    $sql = "INSERT INTO `user` (`nama`, `username`, `password`, `role`) VALUES ('$nama_lengkap', '$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        $message = "Pendaftaran berhasil!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style>
    body {
      background-color: #f2f3f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .register-container {
      width: 400px;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      text-align: center;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-color: #ccc;
      box-shadow: none;
    }
    .btn-register {
      background-color: #28a745;
      border: none;
      border-radius: 25px;
      padding: 10px 20px;
      color: #ffffff;
      cursor: pointer;
      width: 100%;
    }
    .btn-register:hover {
      background-color: #1f7430;
    }
    .login-link {
      display: block;
      margin-top: 15px;
      color: #007bff;
      text-decoration: none;
    }
    .login-link:hover {
      text-decoration: underline;
    }
    .notification-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
    .notification-box {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2 class="mb-4">Registrasi Akun</h2>
    <?php if (isset($message)) : ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php elseif (isset($error_message)) : ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary" id="show-password-btn">
              <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>
    <div class="form-group">
      <label for="role"></label>
      <select class="form-control" id="role" name="role" required>
        <option value="">Pilih Role</option>
        <option value="CS">Customer Service</option>
        <option value="Admin">Admin</option>
        <!-- Tambahkan opsi lain sesuai kebutuhan Anda -->
      </select>
    </div>
      </div>
      <button type="submit" class="btn btn-register">Daftar</button>
    </form>
    <a href="index.php" class="login-link">Batal</a>
  </div>

  <script>
    // Script JavaScript untuk menampilkan/menyembunyikan password
    document.addEventListener("DOMContentLoaded", function() {
      const showPasswordButton = document.getElementById("show-password-btn");
      const passwordInput = document.getElementById("password");
      const form = document.querySelector("form");

      showPasswordButton.addEventListener("click", function() {
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          showPasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
          passwordInput.type = "password";
          showPasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
        }
      });

      form.addEventListener("submit", function(event) {
        event.preventDefault();

        const nama_lengkap = document.getElementById("nama_lengkap").value;
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const role = document.getElementById("role").value;

        if (nama_lengkap === "" || username === "" || password === "" || role === "") {
          alert("Semua field harus diisi!");
        } else {
          // Form pendaftaran akan mengirim data ke proses_daftar.php
          form.submit();
        }
      });
    });
  </script>
</body>
</html>
