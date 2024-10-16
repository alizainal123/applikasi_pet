<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $db->prepare("DELETE FROM cat_care WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: index.php?message=Data berhasil dihapus.");
        exit();
    } else {
        header("Location: index.php?error=Gagal menghapus data.");
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
    <title>Perawatan Kucing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Perawatan Kucing</h1>
        <a href="add.php" class="btn">Tambah Perawatan Kucing</a>

        <!-- Menampilkan pesan sukses atau kesalahan -->
        <?php if (isset($_GET['message'])): ?>
            <div class="message success"><?= htmlspecialchars($_GET['message']); ?></div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="message error"><?= htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Kucing</th>
                    <th class="description">Deskripsi Perawatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($cat_cares) > 0): ?>
                    <?php foreach ($cat_cares as $cat_care): ?>
                        <tr>
                            <td><?= htmlspecialchars($cat_care['title']); ?></td>
                            <td class="description"><?= htmlspecialchars($cat_care['description']); ?></td>
                            <td>
                                <div class="button-group">
                                    <a href="edit.php?id=<?= $cat_care['id']; ?>" class="btn-action">Edit</a>
                                    <form action="index.php" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <input type="hidden" name="id" value="<?= $cat_care['id']; ?>">
                                        <button type="submit" class="btn-action">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="no-data">Tidak ada data perawatan kucing.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
          
         <footer>
                <tr>
                    <td colspan="3" class="signature">di buat oleh Ali.</td>
                </tr>
         </footer>
              
        </table>
    </div>
</body>
</html>
