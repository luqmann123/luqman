<?php
include('../config.php');
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['login_user'])) {
    header('Location: ../login.php');
    exit();
}

// Coba koneksi ke database (contoh penggunaan, asumsikan $conn telah didefinisikan)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lakukan query untuk mengambil data pesan
$query = "SELECT idpesan, timestamp, nama, email, message FROM kontak";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #525252;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffde9c;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000000;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ffde9c;
        }

        td a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #333;
            transition: background-color 0.3s ease;
        }

        td a:hover {
            background-color: #ddd;
        }

        .back-button {
            text-align: center;
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #333;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inbox</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Timestamp</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idpesan'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['timestamp'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="del_inbox.php?id=<?php echo htmlspecialchars($row['idpesan'], ENT_QUOTES, 'UTF-8'); ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php }
                } else {
                    echo "<tr><td colspan='6'>No messages found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="back-button">
            <a href="dashboard.php">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
