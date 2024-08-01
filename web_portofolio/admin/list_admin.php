<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

$sql = "SELECT * FROM admin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #525252;
            padding: 20px;
        }
        h2 {
            color: #fff;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-bottom: 10px;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #000000;
        }
        th {
            background-color: #ffde9c;
        }
        td {
            background-color: #ffde9c;
        }
        td a {
            text-decoration: none;
            color: #333;
            padding: 2px 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
            transition: background-color 0.3s ease;
        }
        td a:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar Admin</h2>
    <a href="add_admin.php">Tambah Admin</a><br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <th>Aksi</th>
        </tr>
        <?php
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
            echo "<td><a href='edit_admin.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_admin.php?id=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
    
