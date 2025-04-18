<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nomor_pendaftaran'])) {
    $nomor_pendaftaran = $_GET['nomor_pendaftaran'];

    // Koneksi ke database
    require 'config/database.php';

    // Contoh query (sesuaikan dengan struktur tabel pengumuman Anda)
    $stmt = $conn->prepare("SELECT nama_lengkap, program_studi, status FROM pengumuman WHERE nomor_pendaftaran = ?");
    $stmt->bind_param("s", $nomor_pendaftaran);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Hasil Pencarian untuk Nomor Pendaftaran: " . htmlspecialchars($nomor_pendaftaran) . "<br>";
        echo "Nama: " . htmlspecialchars($row['nama_lengkap']) . "<br>";
        echo "Program Studi: " . htmlspecialchars($row['program_studi']) . "<br>";
        echo "Status: " . htmlspecialchars($row['status']) . "<br>";
    } else {
        echo "Nomor pendaftaran tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Silakan masukkan nomor pendaftaran.";
}
?>
