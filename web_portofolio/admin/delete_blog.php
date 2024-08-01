<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

$id = $_GET['id'];
$sql = "DELETE FROM blog WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Artikel berhasil dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
