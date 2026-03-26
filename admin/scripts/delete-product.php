<?php
include '../../config/db.php';

if (isset($_GET['id']) && isset($_GET['image'])) {
    $id = $_GET['id'];
    $imageName = $_GET['image'];
    $filePath = "../uploads/" . $imageName;

    // 1. Delete the physical file from the 'uploads' folder
    if (file_exists($filePath)) {
        unlink($filePath); 
    }

    // 2. Delete the record from the database
    $sql = "DELETE FROM products WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to admin panel with success message
        header("Location: ../admin.php?delete=success");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../admin.php");
}
?>