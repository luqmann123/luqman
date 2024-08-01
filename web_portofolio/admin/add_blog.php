<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $target = "../assets/" . basename($thumbnail);

    $sql = "INSERT INTO blog (title, content, thumbnail) VALUES ('$title', '$content', '$thumbnail')";
    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
            echo "Artikel berhasil ditambahkan.";
        } else {
            echo "Gagal mengupload gambar.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Artikel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #dddddd;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            width: 60%;
            margin: auto;
            background-color: #ffde9c;
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
        input[type="file"],
        input[type="submit"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
        }
        textarea {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
            height: 200px;
        }
        input[type="submit"] {
            background-color: #333f;
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
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'link image code',
      toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image code'
    });
    </script>
</head>
<body>
    <h2>Tambah Artikel</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Judul:</label><br>
        <input type="text" name="title" required><br>
        <label>Konten:</label><br>
        <textarea name="content" required></textarea><br>
        <label>Thumbnail:</label><br>
        <input type="file" name="thumbnail" required><br><br>
        <input type="submit" value="Tambah">
    </form>
</body>
</html>
