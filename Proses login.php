<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Koneksi ke database
    require 'config/database.php';

    // Contoh query (sesuaikan dengan tabel admin Anda)
    $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verifikasi password (gunakan password_verify jika password di-hash)
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            header("Location: admin/index.php"); // Redirect ke dashboard admin
            exit;
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika bukan metode POST, tampilkan form login atau redirect
    header("Location: login.php");
    exit;
}
?>
