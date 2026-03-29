<?php
session_start();
include '../../config/db.php';

if (isset($_POST['title'])) {
    $blogId = $_POST['blogId'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // 1. Handle Image Upload
    $image_name = "";
    if (isset($_FILES['blogImage']) && $_FILES['blogImage']['error'] == 0) {
        $target_dir = "../../uploads/blog/";

        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_ext = pathinfo($_FILES["blogImage"]["name"], PATHINFO_EXTENSION);
        $image_name = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", $title) . "." . $file_ext;
        $target_file = $target_dir . $image_name;

        move_uploaded_file($_FILES["blogImage"]["tmp_name"], $target_file);
    }

    if (!empty($blogId)) {
        // --- UPDATE EXISTING BLOG ---
        if ($image_name != "") {
            // Update with new image
            $query = "UPDATE blogs SET title='$title', author='$author', content='$content', image_path='$image_name' WHERE id=$blogId";
        } else {
            // Update without changing image
            $query = "UPDATE blogs SET title='$title', author='$author', content='$content' WHERE id=$blogId";
        }
        $result = mysqli_query($conn, $query);
        $status = "update";
    } else {
        // --- CREATE NEW BLOG ---
        // Fallback image if none uploaded
        if ($image_name == "") {
            $image_name = "default-blog.jpg";
        }

        $query = "INSERT INTO blogs (title, author, content, image_path) VALUES ('$title', '$author', '$content', '$image_name')";
        $result = mysqli_query($conn, $query);
        $status = "success";
    }

    if ($result) {
        header("Location: ../admin.php?$status=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
