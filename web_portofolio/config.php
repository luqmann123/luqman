<?php
$servername = "localhost";
$username = "root"; // ganti dengan username database Anda
$password = "12345678"; // ganti dengan password database Anda
$dbname = "webprofil";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
