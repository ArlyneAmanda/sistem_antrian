
<?php
// Mulai sesi
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Arahkan pengguna kembali ke halaman login atau halaman lain sesuai kebijakan Anda
header("Location: login.php");
exit();
?>
