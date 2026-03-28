<?php
include '../../config/db.php';

if (isset($_GET['id']) && isset($_GET['current_status'])) {
    $id = (int)$_GET['id'];
    $new_status = ($_GET['current_status'] == 1) ? 0 : 1;

    $sql = "UPDATE products SET status = $new_status WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin.php?success=status_updated");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
exit();