<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['blogId'];
    $title = mysqli_real_escape_string($conn, $_POST['blogTitle']);
    $content = mysqli_real_escape_string($conn, $_POST['blogContent']);

    // Check for new image
    if (!empty($_FILES['blogImage']['name'])) {
        $fileName = $_FILES['blogImage']['name'];
        $fileTmpName = $_FILES['blogImage']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid('blog_', true) . "." . $fileExt;
        $dest = '../../uploads/' . $newFileName;

        if (move_uploaded_file($fileTmpName, $dest)) {
            $sql = "UPDATE blogs SET title='$title', content='$content', image_path='$newFileName' WHERE id=$id";
        }
    } else {
        // Update without changing the image
        $sql = "UPDATE blogs SET title='$title', content='$content' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin.php?blog_update=success");
        exit();
    }
}
?>