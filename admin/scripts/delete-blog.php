<?php
session_start();
// 1. Gatekeeper: Ensure only logged-in admins can delete
if (!isset($_SESSION['admin_user'])) {
    header("Location: ../login.php");
    exit();
}

include '../../config/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // 2. Fetch the image filename before deleting the record
    $result = mysqli_query($conn, "SELECT image_path FROM blogs WHERE id = $id");
    if ($row = mysqli_fetch_assoc($result)) {
        $image_to_delete = $row['image_path'];
        $file_path = "../../uploads/blog/" . $image_to_delete;

        // 3. Delete the physical file from the server if it exists
        if (!empty($image_to_delete) && file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // 4. Delete the record from the database
    $delete_query = "DELETE FROM blogs WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        header("Location: ../admin.php?delete=1");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: ../admin.php");
}
