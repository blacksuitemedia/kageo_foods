<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Capture and Clean Data
    $title = mysqli_real_escape_string($conn, $_POST['blogTitle']);
    $content = mysqli_real_escape_string($conn, $_POST['blogContent']);

    // 2. Handle Image Upload
    if (!empty($_FILES['blogImage']['name'])) {
        $file = $_FILES['blogImage'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png', 'webp');

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                $newFileName = uniqid('blog_', true) . "." . $fileExt;
                // Path must go up TWO levels to find 'uploads' from 'admin/scripts/'
                $fileDestination = '../../uploads/' . $newFileName;

                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // 3. Insert into Database
                    $sql = "INSERT INTO blogs (title, content, image_path) VALUES ('$title', '$content', '$newFileName')";
                    
                    if (mysqli_query($conn, $sql)) {
                        header("Location: ../blogs_admin.php?blog=success");
                        exit();
                    } else {
                        // DB Error Debugging
                        die("Database Error: " . mysqli_error($conn));
                    }
                } else {
                    die("Error: Could not move uploaded file to $fileDestination. Check if 'uploads' folder exists.");
                }
            } else {
                die("File Upload Error Code: " . $fileError);
            }
        } else {
            die("Invalid file type. Allowed: jpg, jpeg, png, webp.");
        }
    } else {
        die("Please select an image. Blogs require a featured image.");
    }
}