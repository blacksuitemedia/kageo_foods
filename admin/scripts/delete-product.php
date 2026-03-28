<?php
include '../../config/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // 1. Optional: Get image path to delete the physical file
    $res = mysqli_query($conn, "SELECT image_path FROM products WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    
    if ($row && !empty($row['image_path'])) {
        $filePath = "../../uploads/" . $row['image_path'];
        if (file_exists($filePath)) {
            unlink($filePath); // Deletes the actual photo from the folder
        }
    }

    // 2. Delete from Database
    $sql = "DELETE FROM products WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        // 3. CRITICAL: Redirect back to refresh the list
        header("Location: ../admin.php?delete=success");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>