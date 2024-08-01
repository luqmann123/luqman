<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = "12345678"; // Ganti dengan password MySQL Anda
$dbname = "webprofil";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mengambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$message = $_POST['message'];

// Menggunakan prepared statement untuk menghindari SQL injection
$stmt = $conn->prepare("INSERT INTO kontak (nama, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $message);

// Menjalankan prepared statement untuk memasukkan data
if ($stmt->execute()) {
    echo "Data berhasil disimpan.";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement dan koneksi database
$stmt->close();
$conn->close();
?>
