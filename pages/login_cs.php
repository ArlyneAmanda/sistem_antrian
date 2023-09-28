<?php
session_start();
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query SQL untuk mendapatkan data pengguna berdasarkan username
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Memeriksa apakah password yang diinputkan cocok dengan password di database
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["loket"] = $row["loket"]; // Simpan loket dalam session

            // Arahkan ke halaman yang sesuai berdasarkan peran (role)
            if ($_SESSION["role"] === "CS") {
                $selectedLoket = $_POST['loket']; // Ambil loket yang dipilih oleh pengguna
                
                if (!empty($selectedLoket)) {
                    // Arahkan pengguna ke halaman CS dengan loket yang sesuai
                    $query = "SELECT id FROM loket WHERE nama_loket = '$selectedLoket'";
                    $result = mysqli_query($conn, $query);
            
                    if ($result && mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                        $id = $row['id'];
            
                        // Arahkan pengguna ke halaman CS dengan loket_id yang sesuai
                        header("Location: ../pages/CS/index.php?id=$id");
                        exit();
                    } else {
                        // Loket tidak ditemukan dalam database
                        $login_error = "Error: Loket tidak ditemukan.";
                    }
                } else {
                    // Tampilkan pemberitahuan jika loket tidak dipilih
                    $login_error = "Pilih loket untuk melanjutkan.";
                }
            } elseif ($_SESSION["role"] === "Admin") {
                // Tampilkan pemberitahuan jika login sebagai Admin
                $login_error = "Anda adalah seorang Admin. Silakan login melalui halaman admin.";
            } else {
                // Tambahkan kondisi lain jika perlu
            }
        } else {
            // Jika password tidak cocok, tampilkan pesan kesalahan
            $login_error = "Password salah.";
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan kesalahan
        $login_error = "Username atau password salah.";
    }

    // Tutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include FontAwesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #20c997;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            max-width: 400px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
            background-color: #fff;
        }
        .show-password {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="mb-4 text-center">Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text show-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group" >
            <label for="loket">Loket</label>
                <select class="form-control" id="loket" name="loket" required>
                    <option value="" selected disabled>Pilih Loket</option>
                    <?php
                    include '../koneksi.php';
                            //query menampilkan nama unit kerja ke dalam combobox
                        $b	= mysqli_query($conn, "SELECT * FROM loket");
                            while ($data = mysqli_fetch_array($b)) {
                            ?>
                            <option value="<?=$data['nama_loket'];?>"><?php echo $data['nama_loket'];?></option>
                            <?php
                            }
                            ?>
                    <!-- Tambahkan opsi lain sesuai kebutuhan Anda -->
                </select>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </form>
        <?php
        if (isset($login_error)) {
            echo '<p class="text-danger">' . $login_error . '</p>';
        }
        ?>
    </div>

    <!-- Include Bootstrap JS and jQuery (for toggling password visibility) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Toggle password visibility
        $("#togglePassword").click(function() {
            var passwordField = $("#password");
            var fieldType = passwordField.attr("type");
            if (fieldType === "password") {
                passwordField.attr("type", "text");
            } else {
                passwordField.attr("type", "password");
            }
        });
    </script>
</body>
</html>
