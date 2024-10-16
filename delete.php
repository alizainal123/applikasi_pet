<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $db->prepare("DELETE FROM cat_care WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      
        header("Location: index.php");
        exit();
    } else {
       
        echo "Gagal menghapus data. Silakan coba lagi.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>
