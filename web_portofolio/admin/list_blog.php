<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

$sql = "SELECT * FROM blog";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Artikel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #dddddd;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #000000;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffde9c;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #000000;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ffde6c;
            color: #000000;
        }
        td {
            vertical-align: top;
        }
        img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .actions {
            text-align: center;
        }
        .actions a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
        }
        .actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Daftar Artikel</h2>
    <a href="add_blog.php">Tambah Artikel</a><br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Konten</th>
            <th>Thumbnail</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
        <?php
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . substr($row['content'], 0, 100) . "...</td>";
            echo "<td><img src='../assets/" . $row['thumbnail'] . "' alt='Thumbnail'></td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td class='actions'><a href='edit_blog.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete_blog.php?id=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
