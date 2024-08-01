<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];

    $sql = "INSERT INTO admin (username, password, email, nama_lengkap) VALUES ('$username', '$password', '$email', '$nama_lengkap')";
    if ($conn->query($sql) === TRUE) {
        echo "Admin berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #525252;
            margin: 20px;
        }
        h2 {
            color: #fff;
        }
        form {
            width: 50%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Tambah Admin</h2>
    <form action="" method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" required><br><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
