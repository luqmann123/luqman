<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

$id = $_GET['id'];
$sql = "DELETE FROM admin WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Admin berhasil dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
