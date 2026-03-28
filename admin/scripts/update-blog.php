<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['blogId'])) {
    
    // 1. Sanitize Inputs
    $id = (int)$_POST['blogId'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // 2. Build the Update Query
    // We update the title and content. We use the 'updated_at' timestamp if your table has it.
    $sql = "UPDATE blogs SET 
            title = '$title', 
            content = '$content' 
            WHERE id = $id";

    // 3. Execute
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the admin dashboard with a success flag
        header("Location: ../admin.php?success=blog_updated");
        exit();
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
} else {
    // If accessed directly without a POST request
    header("Location: ../admin.php");
    exit();
}
?>