<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $db->prepare("INSERT INTO cat_care (title, description) VALUES (:title, :description)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}

$cat_cares = $db->query("SELECT * FROM cat_care")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Perawatan Kucing</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Perawatan Kucing</h1>

        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Jenis Kucing</label>
                <input type="text" name="title" id="title" required autofocus> 
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Perawatan</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <button type="submit" class="btn">Simpan</button>
            <a href="index.php" class="btn btn-cancel">Kembali</a>
        </form>
    </div>
</body>
</html>
