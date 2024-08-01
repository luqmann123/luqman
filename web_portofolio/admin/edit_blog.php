<?php
session_start();
require '../config.php';

if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM blog WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $target = "../uploads/" . basename($thumbnail);

    if (!empty($thumbnail)) {
        $sql = "UPDATE blog SET title='$title', content='$content', thumbnail='$thumbnail' WHERE id=$id";
    } else {
        $sql = "UPDATE blog SET title='$title', content='$content' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        if (!empty($thumbnail) && !move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)) {
            echo "Gagal mengupload gambar.";
        } else {
            echo "Artikel berhasil diperbarui.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel</title>
    <script src="../js/tinymce/tinymce.min.js"></script>
    <script>
    tinymce.init({
      selector: 'textarea'
    });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #444d;
            margin: 20px;
        }
        h2 {
            color: #fff;
            text-align: center;
        }
        form {
            background-color: #ffde9c;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <h2>Edit Artikel</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Judul:</label><br>
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
        <label>Konten:</label><br>
        <textarea name="content" required><?php echo $row['content']; ?></textarea><br>
        <label>Thumbnail:</label><br>
        <input type="file" name="thumbnail"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
