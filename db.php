<?php
try {
    $db = new PDO('sqlite:cat_care.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("CREATE TABLE IF NOT EXISTS cat_care (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT NOT NULL
    )");
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
