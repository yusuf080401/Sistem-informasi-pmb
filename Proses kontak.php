<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $subjek = $_POST['subjek'];
    $pesan = $_POST['pesan'];

    // Lakukan validasi sederhana
    if (empty($nama) || empty($email) || empty($subjek) || empty($pesan)) {
        echo "Semua field harus diisi.";
        exit;
    }

    // Kirim email (gunakan fungsi mail() atau library seperti PHPMailer)
    $to = "admin@pmb.com"; // Ganti dengan alamat email admin
    $mail_subjek = "Pesan dari Formulir Kontak PMB: " . $subjek;
    $mail_body = "Nama: " . $nama . "\n";
    $mail_body .= "Email: " . $email . "\n";
    $mail_body .= "Pesan:\n" . $pesan;
    $headers = "From: " . $email;

    if (mail($to, $mail_subjek, $mail_body, $headers)) {
        echo "Pesan Anda berhasil dikirim!";
        // Redirect ke halaman sukses
    } else {
        echo "Terjadi kesalahan saat mengirim pesan.";
    }

} else {
    header("HTTP/1.1 403 Forbidden");
    echo "Akses ditolak.";
    exit;
}
?>
