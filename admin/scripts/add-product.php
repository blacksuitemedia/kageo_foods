<?php
include '../../config/db.php';

if (isset($_POST['submit'])) {
    // 1. Get all the POST data, including category_id
    $category_id = (int)$_POST['category_id']; // Cast to integer for safety
    $name = mysqli_real_escape_string($conn, $_POST['productName']);
    $price = $_POST['productPrice'];
    $weight = mysqli_real_escape_string($conn, $_POST['productWeight']);
    $desc = mysqli_real_escape_string($conn, $_POST['productDesc']);

    // Handle Image Upload
    $file = $_FILES['productImage'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png', 'webp');

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            $newFileName = uniqid('', true) . "." . $fileExt;
            // Go up two levels to reach the root 'uploads' folder
            $fileDestination = '../../uploads/' . $newFileName;

            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // 2. Updated SQL to include category_id
                $sql = "INSERT INTO products (category_id, name, price, weight, description, image_path) 
                        VALUES ('$category_id', '$name', '$price', '$weight', '$desc', '$newFileName')";
                
                if (mysqli_query($conn, $sql)) {
                    header("Location: ../admin.php?upload=success");
                    exit(); // Always exit after a header redirect
                } else {
                    echo "Database error: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Error code: " . $fileError;
        }
    } else {
        echo "Invalid file type.";
    }
}
?>