<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM admin WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];

    $sql = "UPDATE admin SET username='$username', password='$password', email='$email', nama_lengkap='$nama_lengkap' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Admin berhasil diperbarui.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #525252;
            padding: 20px;
        }
        h2 {
            color: #fff;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: auto;
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
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Admin</h2>
    <form action="" method="post">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
