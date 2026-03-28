<?php
include '../../config/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // 1. Check if the blog exists and if it has an image (Optional prep for future)
    $query = "SELECT * FROM blogs WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);

        // 2. Delete associated image file if you add one later
        if (!empty($blog['image_path'])) {
            $filePath = "../../uploads/blogs/" . $blog['image_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // 3. Delete the record from the database
        $deleteSql = "DELETE FROM blogs WHERE id = $id";
        if (mysqli_query($conn, $deleteSql)) {
            // Redirect back with a success message
            header("Location: ../admin.php?delete=success");
            exit();
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Blog post not found.";
    }
} else {
    header("Location: ../admin.php");
}
?>