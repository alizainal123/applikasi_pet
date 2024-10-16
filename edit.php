<?php
session_start();
include 'db.php';

// Mendapatkan data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM cat_care WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $cat_care = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cat_care) {
        header("Location: index.php");
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $db->prepare("UPDATE cat_care SET title = :title, description = :description WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Perawatan Kucing</title>
</head>
<body>
    <div class="container">
        <h1>Edit Perawatan Kucing</h1>

        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($cat_care['title']); ?>" required >
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" required><?= htmlspecialchars($cat_care['description']); ?></textarea>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn btn-action">Perbarui</button>
                <a href="index.php" class="btn btn-cancel">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
